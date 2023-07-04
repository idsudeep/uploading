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
  

  ?>
  
 

    <div class="container-fluid">

            <div class="col-md-3 p-0">
                <div class="left-navbar">
                    <ul class="list-group">
                       <a href="view.php"> <li class="list-group-item active" onclick="showDashboard()">Dashboard</li></a>
                   <a href="vproduct.php?productname=<?php echo $_GET['ptype'];?>"><li class="list-group-item">view product</li></a>
                        <li class="list-group-item" onclick="showOrders()">Orders</li>
                        <li class="list-group-item" onclick="showReports()">Reports</li>
                        <li class="list-group-item" onclick="showSettings()">Settings</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="right-panel">
                <div class="content" id="dashboard">
            
  
            </div>
                    <div class="content " id="Categories">
                  
        
                       
                    
                 
                    <!-- Add similar content divs for other sections -->
                    <div class="col-sm-5">
        <h5 style="color:purple;font-family: mono space; ">Update Product</h5>
        <form action="../action.php?form=updateproduct" method="POST">
        <div class="form-group">
                <label for="category">Product Name</label>
                <select class="form-control" id="category" name="ProductID" required>
          
                <?php  
                $key = $_GET['ptype'];
                $query = "select * from products where categoryid = '$key' ";
                $run = $conn->query($query);
                
                while($row = $run->fetch_assoc()){ ?>
                <option value="<?php echo $row['ProductID'];?>"><?php echo $row['ProductName'];?></option>
                <?php }?> 
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="stockQuantity">Stock Quantity</label>
                <input type="number" class="form-control" id="stockQuantity" name="new_quantity" required>
                <input type="text" name="ptype" value="<?php echo $_GET['ptype'];?>" hidden>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="categoryid" required>
          
                <?php  
                $key = $_GET['ptype'];
                $query = "select * from categories where CategoryID = '$key' ";
                $run = $conn->query($query);
                
                while($row = $run->fetch_assoc()){ ?>
                <option value="<?php echo $row['CategoryID'];?>"><?php echo $row['CategoryName'];?></option>
                <?php }?> 
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
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
