<?php
$dataFile = './Data/data.xml';
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
    $foodName = $_POST['food_name'];
    $foodPrice = $_POST['food_price'];
    $foodDescription = $_POST['food_description'];
    $foodCategory = $_POST['food_category'];
    $foodImage = $_POST['food_image'];
    $randomLetters = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 5);
    if (!isset($foodXML->$foodCategory)) {
        $foodXML->$foodCategory;
    }
    $foodItem = $foodXML->$foodCategory->addChild($foodName);
    $foodItem->addChild('name', $foodName);
    $foodItem->addChild('price', $foodPrice);
    $foodItem->addChild('description', $foodDescription);
    $foodItem->addChild('id', $randomLetters);
    $foodItem->addChild('image', $foodImage);
    $foodXML->asXML($dataFile);
    header("Location: http://localhost/orderSystem/admin.php");
    exit();
}
if (isset($_POST['save_edited_food'])) {
    $foodName = $_POST['edit_food_name'];
    $foodPrice = $_POST['edit_food_price'];
    $foodDescription = $_POST['edit_food_description'];
    $foodCategory = $_POST['edit_food_category'];
    $foodImage = $_POST['edit_food_image'];
    $foodId = $_POST['edit_food_id'];
    if (!isset($foodXML->$foodCategory)) {
        $foodXML->addChild($foodCategory);
    }
    $itemExists = false;
    foreach ($foodXML->$foodCategory->children() as $item) {
        if ((string)$item->id === $foodId) {
            $item->name = $foodName;
            $item->price = $foodPrice;
            $item->description = $foodDescription;
            $item->image = $foodImage;
            $itemExists = true;
            break;
        }
    }
    if (!$itemExists) {
        $foodItem = $foodXML->$foodCategory->addChild($foodName);
        $foodItem->addChild('name', $foodName);
        $foodItem->addChild('price', $foodPrice);
        $foodItem->addChild('description', $foodDescription);
        $foodItem->addChild('id', $foodId);
        $foodItem->addChild('image', $foodImage);
    }
    $foodXML->asXML($dataFile);
    header("Location: http://localhost/orderSystem/admin.php");
    exit();
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
    $xml->asXML($dataFile);
    header("Location: http://localhost/orderSystem/admin.php");
    exit();
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
    $xml->asXML($dataFile);
    header("Location: http://localhost/orderSystem/admin.php");
    exit();
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
    $xml->asXML($dataFile);
    header("Location: http://localhost/orderSystem/admin.php");
    exit();
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
    header("Location: http://localhost/orderSystem/admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./Style/admin.css">
        <title>Admin</title>
    </head>
    <body>
        <header>
            <h1>MARSERVE</h1>
        </header>
        <nav class="sidebar-container">
            <div>
                <p class="sidebar-title">Foods and Beverages:</p>
                <ul class="sidebar-ul">
                    <li><a href="#" class="sidebar-li">Meals</a></li>
                    <li><a href="#" class="sidebar-li">Snacks</a></li>
                    <li><a href="#" class="sidebar-li">Beverages</a></li>
                    <li><a href="#" class="sidebar-li">Sweets</a></li>
                </ul>
            </div>
            <div class="vob">
                <a href="http://localhost/orderSystem/cashier.php" class='view-orders-button'>View Orders</a>
            </div>
        </nav>
        <main>
            <div class="container">
                <div class="sub-container">
                    <section class="form-section">
                        <form id="save-order-form" action="" method="post">
                            <input type="text" name="food_name" placeholder="Food Name">
                            <input type="number" step="0.01" name="food_price" placeholder="Price">
                            <input type="text" name="food_description" placeholder="Description">
                            <input type="file" name="food_image">
                            <select name="food_category">
                                <option value="meals" selected>Meal</option>
                                <option value="snacks">Snack</option>
                                <option value="beverages">Beverage</option>
                                <option value="sweets">Sweet</option>
                            </select>
                            <button type="submit" name="save_food" id="save-order-btn">Add Food Item</button>
                        </form>
                    </section>
                    <section id="meals">
                        <h2 class="f-title">Meals:</h2>
                        <div class="f-container">
                            <?php 
                                foreach ($meal_array as $meal_data){
                                    echo "<div id='food-container' data-foodId='{$meal_data['id']}'>
                                        <div id='card-container' data-description='{$meal_data['description']}' data-price='{$meal_data['price']}' data-name='{$meal_data['name']}'>
                                            <img src='./Image/{$meal_data['image']}' alt='{$meal_data['id']}' class='food-image'>
                                            <h2 class='food-title'>{$meal_data['name']}</h2>
                                            <p class='food-desc' id='order-count-{$meal_data['description']}'>{$meal_data['description']}</p>
                                            <h3 class='food-price'>Price: {$meal_data['price']} php</h3>
                                            <form class='form' method='post'>
                                                <input type='hidden' name='meals_id' value='{$meal_data['id']}' />
                                                <button type='submit' class='delete-button' name='delete_food' id='delete_food'>Delete</button>
                                                <button type='button' class='edit-btn' id='edit-btn-{$meal_data['id']}'>Edit</button>
                                            </form>
                                        </div>
                                        <dialog id='edit-dialog-{$meal_data['id']}'>
                                            <form id='save-edited-form' action='' method='post'>
                                                <input type='hidden' name='edit_food_id' placeholder='Food Id' value='{$meal_data['id']}'>
                                                <input type='text' name='edit_food_name' placeholder='Food Name' value='{$meal_data['name']}'>
                                                <input type='number' step='0.01' name='edit_food_price' placeholder='Price' value='{$meal_data['price']}'>
                                                <textarea name='edit_food_description' placeholder='Description' cols='30' rows='10'>{$meal_data['description']}</textarea>
                                                <input type='file' name='edit_food_image'>
                                                <select name='edit_food_category'>
                                                    <option value='meals' selected>Meal</option>
                                                    <option value='snacks'>Snack</option>
                                                    <option value='beverages'>Beverage</option>
                                                    <option value='sweets'>Sweet</option>
                                                </select>
                                                <button type='button' class='close-edit-dialog' id='close-edit-dialog-{$meal_data['id']}'>Close</button>
                                                <button type='submit' name='save_edited_food' id='save-edited-btn'>Save Food Item</button>
                                            </form>
                                        </dialog>
                                    </div>";
                                }
                            ?>
                        </div>
                    </section>
                    <section id="snacks">
                        <h2 class="f-title">Snacks:</h2>
                        <div class="f-container">
                            <?php 
                                foreach ($snacks_array as $snack_data){
                                    echo "<div id='food-container' data-foodId='{$snack_data['id']}'>
                                        <div id='card-container' data-description='{$snack_data['description']}' data-price='{$snack_data['price']}' data-name='{$snack_data['name']}'>
                                            <img src='./Image/{$snack_data['image']}' alt='{$snack_data['id']}' class='food-image'>
                                            <h2 class='food-title'>{$snack_data['name']}</h2>
                                            <p class='food-desc'>{$snack_data['description']}</p>
                                            <h3 class='food-price'>Price: {$snack_data['price']} php</h3>
                                            <form class='form' method='post'>
                                                <input type='hidden' name='snacks_id' value='{$snack_data['id']}' />
                                                <button type='submit' class='delete-button' name='delete_food' id='delete_food'>Delete</button>
                                                <button type='button' class='edit-btn' id='edit-btn-{$snack_data['id']}'>Edit</button>
                                            </form>    
                                        </div>
                                        <dialog id='edit-dialog-{$snack_data['id']}'>
                                            <form id='save-edited-form' action='' method='post'>
                                                <input type='hidden' name='edit_food_id' placeholder='Food Id' value='{$snack_data['id']}'>
                                                <input type='text' name='edit_food_name' placeholder='Food Name' value='{$snack_data['name']}'>
                                                <input type='number' step='0.01' name='edit_food_price' placeholder='Price' value='{$snack_data['price']}'>
                                                <textarea name='edit_food_description' placeholder='Description' cols='30' rows='10'>{$snack_data['description']}</textarea>
                                                <input type='file' name='edit_food_image'>
                                                <select name='edit_food_category'>
                                                    <option value='meals' selected>Meal</option>
                                                    <option value='snacks'>Snack</option>
                                                    <option value='beverages'>Beverage</option>
                                                    <option value='sweets'>Sweet</option>
                                                </select>
                                                <button type='button' class='close-edit-dialog' id='close-edit-dialog-{$snack_data['id']}'>Close</button>
                                                <button type='submit' name='save_edited_food' id='save-edited-btn'>Save Food Item</button>
                                            </form>
                                        </dialog>
                                    </div>";
                                }
                            ?>
                        </div>
                    </section>
                    <section id="beverages">
                        <h2 class="f-title">Beverages:</h2>
                        <div class="f-container">
                            <?php 
                                foreach ($beverages_array as $beverage_data){
                                    echo "<div id='food-container' data-foodId='{$beverage_data['id']}'>
                                        <div id='card-container' data-description='{$beverage_data['description']}' data-price='{$beverage_data['price']}' data-name='{$beverage_data['name']}'>
                                            <img src='./Image/{$beverage_data['image']}' alt='{$beverage_data['id']}' class='food-image'>
                                            <h2 class='food-title'>{$beverage_data['name']}</h2>
                                            <p class='food-desc'>{$beverage_data['description']}</p>
                                            <h3 class='food-price'>Price: {$beverage_data['price']} php</h3>
                                            <form class='form' method='post'>
                                                <input type='hidden' name='beverages_id' value='{$beverage_data['id']}' />
                                                <button type='submit' class='delete-button' name='delete_food' id='delete_food'>Delete</button>
                                            <button type='button' class='edit-btn' id='edit-btn-{$beverage_data['id']}'>Edit</button>
                                        </form>
                                        </div>
                                        <dialog id='edit-dialog-{$beverage_data['id']}'>
                                            <form id='save-edited-form' action='' method='post'>
                                                <input type='hidden' name='edit_food_id' placeholder='Food Id' value='{$beverage_data['id']}'>
                                                <input type='text' name='edit_food_name' placeholder='Food Name' value='{$beverage_data['name']}'>
                                                <input type='number' step='0.01' name='edit_food_price' placeholder='Price' value='{$beverage_data['price']}'>
                                                <textarea name='edit_food_description' placeholder='Description' cols='30' rows='10'>{$beverage_data['description']}</textarea>
                                                <input type='file' name='edit_food_image'>
                                                <select name='edit_food_category'>
                                                    <option value='meals' selected>Meal</option>
                                                    <option value='snacks'>Snack</option>
                                                    <option value='beverages'>Beverage</option>
                                                    <option value='sweets'>Sweet</option>
                                                </select>
                                                <button type='button' class='close-edit-dialog' id='close-edit-dialog-{$beverage_data['id']}'>Close</button>
                                                <button type='submit' name='save_edited_food' id='save-edited-btn'>Save Food Item</button>
                                            </form>
                                        </dialog>
                                    </div>";
                                }
                            ?>
                        </div>
                    </section>
                    <section id="sweets">
                        <h2 class="f-title">Sweets:</h2>
                        <div class="f-container">
                            <?php 
                                foreach ($sweets_array as $sweet_data){
                                    echo "<div id='food-container' data-foodId='{$sweet_data['id']}'>
                                        <div id='card-container' data-description='{$sweet_data['description']}' data-price='{$sweet_data['price']}' data-name='{$sweet_data['name']}'>
                                            <img src='./Image/{$sweet_data['image']}' alt='{$sweet_data['id']}' class='food-image'>
                                            <h2 class='food-title'>{$sweet_data['name']}</h2>
                                            <p class='food-desc'>{$sweet_data['description']}</p>
                                            <h3 class='food-price'>Price: {$sweet_data['price']} php</h3>
                                            <form class='form' method='post'>
                                                <input type='hidden' name='sweets_id' value='{$sweet_data['id']}' />
                                                <button type='submit' class='delete-button' name='delete_food' id='delete_food'>Delete</button>
                                                <button type='button' class='edit-btn' id='edit-btn-{$sweet_data['id']}'>Edit</button>
                                            </form>
                                        </div>
                                        <dialog id='edit-dialog-{$sweet_data['id']}'>
                                            <form id='save-edited-form' action='' method='post'>
                                                <input type='hidden' name='edit_food_id' placeholder='Food Id' value='{$sweet_data['id']}'>
                                                <input type='text' name='edit_food_name' placeholder='Food Name' value='{$sweet_data['name']}'>
                                                <input type='number' step='0.01' name='edit_food_price' placeholder='Price' value='{$sweet_data['price']}'>
                                                <textarea name='edit_food_description' placeholder='Description' cols='30' rows='10'>{$sweet_data['description']}</textarea>
                                                <input type='file' name='edit_food_image'>
                                                <select name='edit_food_category'>
                                                    <option value='meals' selected>Meal</option>
                                                    <option value='snacks'>Snack</option>
                                                    <option value='beverages'>Beverage</option>
                                                    <option value='sweets'>Sweet</option>
                                                </select>
                                                <button type='button' class='close-edit-dialog' id='close-edit-dialog-{$sweet_data['id']}'>Close</button>
                                                <button type='submit' name='save_edited_food' id='save-edited-btn'>Save Food Item</button>
                                            </form>
                                        </dialog>
                                    </div>";
                                }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </main>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let editButtons = document.querySelectorAll('.edit-btn');
                editButtons.forEach(function(btn) {
                    let foodId = btn.parentNode.parentNode.parentNode.getAttribute('data-foodId');
                    btn.addEventListener('click', function() {
                        document.getElementById(`edit-dialog-${foodId}`).showModal();
                    });
                });
                let closeButtons = document.querySelectorAll('.close-edit-dialog');
                closeButtons.forEach(function(btn) {
                    let foodId = btn.parentNode.parentNode.parentNode.getAttribute('data-foodId');
                    btn.addEventListener('click', function() {
                        document.getElementById(`edit-dialog-${foodId}`).close();
                    });
                });
            });
            document.querySelectorAll('.food-desc').forEach(function(desc) {
                let descText = desc.textContent;
                desc.textContent = descText.substring(0, 10) + '...';
            });
        </script>
    </body>
</html>
