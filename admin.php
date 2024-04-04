<?php
$dataFile = './Data/data.xml';

// Load XML file
if (file_exists($dataFile)) {
    $foodXML = simplexml_load_file($dataFile) or die("Error: Cannot create object");
} else {
    die("Error: XML file not found");
}

$meal_array = [];
foreach ($foodXML->meals->children() as $food) {
    $food_data = [];
    foreach ($food->children() as $key => $value) {
        $food_data[$key] = (string) $value;
    }
    $meal_array[] = $food_data;
}
$snacks_array = [];
foreach ($foodXML->snacks->children() as $food) {
    $food_data = [];
    foreach ($food->children() as $key => $value) {
        $food_data[$key] = (string) $value;
    }
    $snacks_array[] = $food_data;
}
$beverages_array = [];
foreach ($foodXML->beverages->children() as $food) {
    $food_data = [];
    foreach ($food->children() as $key => $value) {
        $food_data[$key] = (string) $value;
    }
    $beverages_array[] = $food_data;
}
$sweets_array = [];
foreach ($foodXML->sweets->children() as $food) {
    $food_data = [];
    foreach ($food->children() as $key => $value) {
        $food_data[$key] = (string) $value;
    }
    $sweets_array[] = $food_data;
}

if (isset($_POST['save_food'])) {
    // Extracting form data
    $foodName = $_POST['food_name'];
    $foodPrice = $_POST['food_price'];
    $foodDescription = $_POST['food_description'];
    $foodCategory = $_POST['food_category'];

    // File and random string generation
    $randomLetters = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 5);

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

    // Redirect to prevent form resubmission
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
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
    <div>
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
    </div>
    <div>
        <section id="meals">
                <h2>Meals:</h2>
                <?php
                foreach ($meal_array as $meal_data) {
                    echo "
                    <div id='card-container' data-description='{$meal_data['description']}' data-price='{$meal_data['price']}' data-name='{$meal_data['name']}'>
                        <h2>{$meal_data['name']}</h2>
                        <p class='order-count' id='order-count-{$meal_data['name']}'></p>
                        <h3>Price: {$meal_data['price']} php</h3>
                    </div>
                    <form method='post'>
                        <input type='hidden' name='meals_id' value='{$meal_data['id']}' />
                        <button type='submit' name='delete_food' id='delete_food'>Delete</button>
                    </form>";
                }
                if (isset($_POST['delete_food']) && isset($_POST['meals_id'])) {
                    $meal_id = $_POST['meals_id'];
                    $dataFile = './Data/data.xml';
                    $xml = simplexml_load_file($dataFile) or die("Error: Cannot create object");
                    if ($xml === false) {
                        die("Error: Cannot load XML file.");
                    }
                    foreach ($xml->meals->children() as $mealKey => $meal) {
                        if ((string) $meal->id === $meal_id) {
                            unset($xml->meals->{$mealKey});
                            break;
                        }
                    }
                    $xml->asXML($dataFile); // Corrected variable name from $foodXML to $dataFile
                }
                ?>
            </section>
            <section id="snacks">
                <h2>Snacks:</h2>
                <?php
                foreach ($snacks_array as $snack_data) {
                    echo "
                    <div id='card-container' data-description='{$snack_data['description']}' data-price='{$snack_data['price']}' data-name='{$snack_data['name']}'>
                        <h2>{$snack_data['name']}</h2>
                        <p class='order-count' id='order-count-{$snack_data['name']}'></p>
                        <h3>Price: {$snack_data['price']} php</h3>
                    </div>
                    <form method='post'>
                        <input type='hidden' name='snacks_id' value='{$snack_data['id']}' />
                        <button type='submit' name='delete_food' id='delete_food'>Delete</button>
                    </form>";
                }
                if (isset($_POST['delete_food']) && isset($_POST['snacks_id'])) {
                    $snack_id = $_POST['snacks_id'];
                    $dataFile = './Data/data.xml';
                    $xml = simplexml_load_file($dataFile) or die("Error: Cannot create object");
                    if ($xml === false) {
                        die("Error: Cannot load XML file.");
                    }
                    foreach ($xml->snacks->children() as $snackKey => $snack) {
                        if ((string) $snack->id === $snack_id) {
                            unset($xml->snacks->{$snackKey});
                            break;
                        }
                    }
                    $xml->asXML($dataFile); // Corrected variable name from $foodXML to $dataFile
                }
                ?>
            </section>
            <section id="beverages">
                <h2>Beverages:</h2>
                <?php
                foreach ($beverages_array as $beverage_data) {
                    echo "
                    <div id='card-container' data-description='{$beverage_data['description']}' data-price='{$beverage_data['price']}' data-name='{$beverage_data['name']}'>
                        <h2>{$beverage_data['name']}</h2>
                        <p class='order-count' id='order-count-{$beverage_data['name']}'></p>
                        <h3>Price: {$beverage_data['price']} php</h3>
                    </div>
                    <form method='post'>
                        <input type='hidden' name='beverages_id' value='{$beverage_data['id']}' />
                        <button type='submit' name='delete_food' id='delete_food'>Delete</button>
                    </form>";
                }
                if (isset($_POST['delete_food']) && isset($_POST['beverages_id'])) {
                    $beverage_id = $_POST['beverages_id'];
                    $dataFile = './Data/data.xml';
                    $xml = simplexml_load_file($dataFile) or die("Error: Cannot create object");
                    if ($xml === false) {
                        die("Error: Cannot load XML file.");
                    }
                    foreach ($xml->beverages->children() as $beverageKey => $beverage) {
                        if ((string) $beverage->id === $beverage_id) {
                            unset($xml->beverages->{$beverageKey});
                            break;
                        }
                    }
                    $xml->asXML($dataFile); // Corrected variable name from $foodXML to $dataFile
                }
                ?>
            </section>
            <section id="sweets">
                <h2>Sweets:</h2>
                <?php
                foreach ($sweets_array as $sweet_data) {
                    echo "
                    <div id='card-container' data-description='{$sweet_data['description']}' data-price='{$sweet_data['price']}' data-name='{$sweet_data['name']}'>
                        <h2>{$sweet_data['name']}</h2>
                        <p class='order-count' id='order-count-{$sweet_data['name']}'></p>
                        <h3>Price: {$sweet_data['price']} php</h3>
                    </div>
                    <form method='post'>
                        <input type='hidden' name='sweets_id' value='{$sweet_data['id']}' />
                        <button type='submit' name='delete_food' id='delete_food'>Delete</button>
                    </form>";
                }
                if (isset($_POST['delete_food']) && isset($_POST['sweets_id'])) {
                    $sweet_id = $_POST['sweets_id'];
                    $dataFile = './Data/data.xml';
                    $xml = simplexml_load_file($dataFile) or die("Error: Cannot create object");
                    if ($xml === false) {
                        die("Error: Cannot load XML file.");
                    }
                    foreach ($xml->sweets->children() as $sweetKey => $sweet) {
                        if ((string) $sweet->id === $sweet_id) {
                            unset($xml->sweets->{$sweetKey});
                            break;
                        }
                    }
                    $xml->asXML($dataFile);
                }
                ?>
        </section>
    </div>
</body>
</html>