<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get the form data
    $product_name = $_POST["product_name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $opening = $_POST["opening stock"];

    // Prepare the SQL statement
    $sql = "INSERT INTO products (product_name, quantity, price) VALUES ('$product_name', '$quantity', '$price)";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>
        
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>
        
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>

        <label for ="opening_stock">opening Stock:</label>
        <input type ="text" name="opening_stock"required>
        
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
