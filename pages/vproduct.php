<style>
        body {
            margin: 0;
        }

        .container-fluid {
            height: 100vh;
            display: flex;
        }

        .navbar {
            flex-shrink: 0;
        }

        .left-navbar {
            width: 200px;
            background-color: #f8f9fa;
            padding: 20px;
            overflow-y: auto;
        }

        .right-panel {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            height: calc(100vh - 56px); /* Subtract height of top navbar */
        }

        .content {
            margin-bottom: 20px;
        }

        .nav-link {
            cursor: pointer;
        }

        .left-navbar .list-group-item {
            border: none;
            border-radius: 0;
        }

        .left-navbar .list-group-item.active {
            background-color: #fff;
            color: #007bff;
        }
    </style>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <?php require '../header.php';
  $key = $_GET['ptype'];
  $sql = "SELECT * FROM Products where categoryid = '$key'";
  $result = $conn->query($sql);
  $pid =  getproductid($conn,$key);
  ?>
  
 

    <div class="container-fluid">

            <div class="col-md-3 p-0">
                <div class="left-navbar">
                    <ul class="list-group">
                       <a href="view.php"> <li class="list-group-item active" onclick="showDashboard()">Dashboard</li></a>
                     
                        <li class="list-group-item" onclick="showOrders()">Orders</li>
                       <a href="transaction.php?productid=<?php echo $pid[0]; ?>"> <li class="list-group-item" onclick="showReports()">Transaction</li></a>
                        <li class="list-group-item" onclick="showSettings()">Settings</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="right-panel">
                <div class="content" id="dashboard">
            
  
                </div>
                 <div class="content " id="Categories">
                  
        
    <div class="container">
        <h1>Product List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>TotalQuantity</th>
                    <th>IssuedQuantity</th>
                    <th>RemainingQuantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the fetched products and display them in table rows
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ProductName"] . "</td>";
                        echo "<td>" . $row["Description"] . "</td>";
                        echo "<td>" . $row["TotalQuantity"] . "</td>";
                        echo "<td>" . $row["IssuedQuantity"] . "</td>";
                        echo "<td>" . $row["RemainingQuantity"] . "</td>";
                        echo "<td>" . $row["amount"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
                       
               
    
                </div>
            </div>
    
    </div>

   
    </body>
</html>
<script>
        function showDashboard() {
            document.getElementById("dashboard").classList.remove("d-none");
            document.getElementById("Categories").classList.add("d-none");
            // Hide other sections if necessary
        }

        function showCategories() {
            document.getElementById("dashboard").classList.add("d-none");
            document.getElementById("Categories").classList.remove("d-none");
            // Hide other sections if necessary
        }

        // Add similar functions for other sections

    </script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>  
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
