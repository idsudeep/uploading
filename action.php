<?php 
require_once("config.php");
require_once("pdo.php");
require_once("module.php");


// Register Form  behind the scene here :
        if(($_GET['form']=='register') AND ($_POST['btn_register']=='register')){

            $username = $_POST['username'];
            $email =  $_POST['email'];
            $password = $_POST['password'];
            $mobileno = $_POST['mobileno'];
            $address = $_POST['address'];

             $query = "select *from userlog where email = '$email'";
                $exec = mysqli_query($conn,$query);
            if($exec->num_rows !=0){
               
                $alert = "Email already exits";
                header('location:register.php?alert='.$alert);
                die();
              }
            $hashpass = md5($password);
            $queryi = "insert into userlog (username,email,password,mobileno,address) values('$username','$email','$hashpass','$mobileno','$address')";
            $run = mysqli_query($conn,$queryi);
            if($run){
            $alert = "user registered";
            header("location:login.php?alert=".$alert);
            }
       
        }


            //  login form start from here 

            if(($_GET['form']=='login') AND ($_POST['btn_login']=='login')){
                $email = $_POST['email'];
                $password = md5($_POST['password']);
            
                
                $query = "select * from userlog where email = '$email'";
                $sql =   mysqli_query($conn,$query);
               
                if($sql->num_rows ==0){
                    $alert = "user's not found";
                    header("location:login.php?alert=".$alert);
                    die();
                }
                if($sql->num_rows !=0){

                 
                    $queryp = "select *from userlog where email = '$email' AND password ='$password'"; 
                    $runqueryp = $conn->query($queryp);

                  
                    if($runqueryp->num_rows !=0){

                        $row = $runqueryp->fetch_assoc();

                      
                        logintostore($row['userid'],$row['username'],$row['usertype']);
                        $alert = "welcome ";
                        header('location: index.php');
                        $conn->close();
                        die();
                    }else{

                        $alert= "invalid login data";
                        header("location: login.php?alert=".$alert);
                    }
                }

            }


            if(($_GET['form']=='adminForm') AND ($_POST['btn_login']=='login')){
                $email = $_POST['email'];
                $password = md5($_POST['password']);
            
                
                $query = "select * from userlog where email = '$email'";
                $sql =   mysqli_query($conn,$query);
               
                if($sql->num_rows ==0){
                    $alert = "user's not found";
                    header("location:admin.php?alert=".$alert);
                    die();
                }

                if($sql->num_rows !=0){

                 
                    $queryp = "select *from userlog where email = '$email' AND password ='$password' AND usertype = 'manager'"; 
                    $runqueryp = $conn->query($queryp);

                  
                    if($runqueryp->num_rows !=0){

                        $row = $runqueryp->fetch_assoc();
                        logintostore($row['userid'],$row['username'],$row['usertype']);
                        $alert = "welcome ";
                        header('location: pages/view.php');
                        $conn->close();
                        die();
                    }else{

                        $alert= "invalid login data";
                        header("location: admin.php?alert=".$alert);
                    }
                }
            }


if (isset($_POST['new_quantity']) && ($_GET['form']=='addproduct') ) {
    
    
    

        try {
            $newQuantity = $_POST['new_quantity'];
            $productName = $_POST['productName'];
            $description = $_POST['description'];
            $amount = $_POST['price'];
            $categoryid = $_POST['categoryid'];
          
            
        
                // Begin the database transaction
                $connection->beginTransaction();
            
                // Insert the new product into the database
                $insertSql = "INSERT INTO Products (ProductName, Description, TotalQuantity, amount, RemainingQuantity, categoryid)
                              VALUES (:productName, :description, :totalQuantity, :amount,:totalQuantity ,:categoryid)";
                $insertStmt = $connection->prepare($insertSql);
                $insertStmt->bindParam(':productName', $productName);
                $insertStmt->bindParam(':description', $description);
                $insertStmt->bindParam(':totalQuantity', $newQuantity);
                $insertStmt->bindParam(':amount', $amount);
                $insertStmt->bindParam(':categoryid', $categoryid);
                $insertStmt->execute();
            
                
                $productID = $connection->lastInsertId(); // Get the auto-generated ProductID
                
            
                // Commit the transaction
                $connection->commit();
            
          

            if ($productID) {
                // Add a new transaction record
                $insertTransactionQuery = "INSERT INTO Transactions (TransactionDate, ProductID, Quantity, TotalAmount) VALUES (NOW(),:productID, :Quantity,:TotalAmount)";
                $stmt = $connection->prepare($insertTransactionQuery);
                $stmt->bindParam(':productID', $productID);
                $stmt->bindParam(':Quantity', $newQuantity);
                $stmt->bindParam(':TotalAmount', $amount);
                
                $stmt->execute();
            
           
                $alert = "inserted-successfully";
            header("location:pages/addproduct.php?ptype=".$categoryid."&&alert=".$alert);
            } else {
                echo "Failed to add the product.";
            }
          
            
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                $connection->rollback();
                $alert = "Product-already-exists.";
                header("location:pages/addproduct.php?ptype=".$categoryid."&&alert=".$alert);
                
            } else {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    if (isset($_POST['new_quantity']) && ($_GET['form']=='updateproduct')) {
      
    
            try {
                $ProductID = $_POST['ProductID'];
                $amount = $_POST['price'];
                $categoryid = $_POST['categoryid'];
                $newQuantity = $_POST['new_quantity'];

                $ta =$amount*$newQuantity;

             $updateQuery = "UPDATE Products SET TotalQuantity = TotalQuantity + $newQuantity, RemainingQuantity = RemainingQuantity + $newQuantity ,amount = amount + $amount WHERE ProductID = $ProductID";

                $query = mysqli_query($conn,$updateQuery);
             if ($query !=0) {

                    $insertTransactionQuery = "INSERT INTO Transactions ( ProductID, Quantity, TotalAmount)
                    VALUES (:productID, :Quantity,:TotalAmount)";
                   $stmt1 = $connection->prepare($insertTransactionQuery);
                   $stmt1->bindParam(':productID', $ProductID);
                   $stmt1->bindParam(':Quantity', $newQuantity);
                   $stmt1->bindParam(':TotalAmount', $amount);
                   
                   $stmt1->execute();
               
          
                   $alert = "inserted-successfully";
               header("location:pages/addproduct.php?ptype=".$categoryid."&&alert=".$alert);
                    echo "Product quantity updated successfully.";
                    
                } else {
                    echo "Failed to update the product quantity.";
                }

                
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    
                    $alert = "Product-already-exists.";
                    header("location:pages/addproduct.php?ptype=".$categoryid."&&alert=".$alert);
                    
                } else {
                    echo "Error: " . $e->getMessage();
                }
            }
        }
    
    


                

            




?>
