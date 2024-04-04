<?php
if(isset($_POST['save_food'])) {
    // Extracting form data
    $foodName = $_POST['food_name'];
    $foodPrice = $_POST['food_price'];
    $foodDescription = $_POST['food_description'];
    $foodCategory = $_POST['food_category'];

    // File and random string generation
    $dataFile = './Data/data.xml';
    $randomLetters = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 5);

    // Load XML file
    if (file_exists($dataFile)) {
        $foodXML = simplexml_load_file($dataFile) or die("Error: Cannot create object");
    } else {
        die("Error: XML file not found");
    }

    // Check if the category exists, if not, create it
    if (!isset($foodXML->$foodCategory)) {
        $foodXML->$foodCategory;
    }

    // Now you can safely add a child to the category
    $foodItem = $foodXML->$foodCategory->addChild($foodName);
    $foodItem->addChild('name', $foodName);
    $foodItem->addChild('price', $foodPrice);
    $foodItem->addChild('description', $foodDescription);
    $foodItem->addChild('id', $randomLetters);

    // Save the XML to the file
    $foodXML->asXML($dataFile);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <form id="save-order-form" action="" method="post">
        <input type="text" name="food_name" placeholder="Food Name">
        <input type="number" step="0.01" name="food_price" placeholder="Price">
        <input type="text" name="food_description" placeholder="Description">
        <select name="food_category">
            <option value="meals" selected>Meal</option>
            <option value="snacks">Snack</option>
            <option value="beverages">Beverage</option>
            <option value="sweets">Sweet</option>
        </select>
        <button type="submit" name="save_food" id="save-order-btn">Add Food Item</button>
    </form>
</body>
</html>
