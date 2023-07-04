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
                        <li class="list-group-item active" onclick="showDashboard()">Dashboard</li>
                    
                        <li class="list-group-item" onclick="showOrders()">Orders</li>
                        <li class="list-group-item" onclick="showCustomers()">Customers</li>
                        <li class="list-group-item" onclick="showReports()">Reports</li>
                        <li class="list-group-item" onclick="showSettings()">Settings</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="right-panel">
                <div class="content" id="dashboard">
            
  
            </div>
                    <div class="content" id="Categories">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="category-header">
                            <h1 class="category-title">Category</h1>
                            <p class="category-description">Explore our collection of items.</p>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="search-container">
                            <form class="row align-items-center">
                                <div class="col-auto">
                                <input type="text" class="search-input form-control" placeholder="Search">
                                </div>
                                <div class="col-auto">
                                <input type="submit" class="btn btn-outline-primary" name="search" value="Search">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

        
                        <div class="row">
                            <?php
                            $query = "SELECT * FROM categories";
                            $run = $conn->query($query);

                            while ($row = $run->fetch_assoc()) {
                                ?>
                                <div class="col-md-4">
                                <div class="category-item" style="margin-bottom: 40px;">
                                <form>   
                                <h5 class="category-item-title"><?php echo $row['CategoryName']; ?></h5>
                                    <p class="category-item-description"><?php echo $row['Description']; ?></p>
                           
                                    <div class="dropdown">

<button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  Products
</button>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="font-family:cursive;">
<a class="dropdown-item" href="addproduct.php?ptype=<?php echo $row['CategoryName']; ?>">add Product</a>
<a class="dropdown-item" href="#">View Product</a>
<a class="dropdown-item" href="#" style="color:#e3626eb0">Delete Product</a>
</div>
</div>

                                </div>
                                </div>
                            <?php } ?>
                        </div>
                    
                    </div>
                    <!-- Add similar content divs for other sections -->
                    
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

     

        // Add similar functions for other sections

    </script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>  
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
