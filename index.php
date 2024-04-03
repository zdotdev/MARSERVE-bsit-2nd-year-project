<?php
$data = './Data/data.xml';
$xml = simplexml_load_file($data) or die("Error: Cannot create object");

$meal_array = [];
foreach($xml->meals->children() as $food) {
    $food_data = [];
    foreach($food->children() as $key => $value) {
        $food_data[$key] = (string)$value;
    }
    $meal_array[] = $food_data;
}
$snacks_array = [];
foreach($xml->snacks->children() as $food) {
    $food_data = [];
    foreach($food->children() as $key => $value) {
        $food_data[$key] = (string)$value;
    }
    $snacks_array[] = $food_data;
}
$beverages_array = [];
foreach($xml->beverages->children() as $food) {
    $food_data = [];
    foreach($food->children() as $key => $value) {
        $food_data[$key] = (string)$value;
    }
    $beverages_array[] = $food_data;
}
$sweets_array = [];
foreach($xml->sweets->children() as $food) {
    $food_data = [];
    foreach($food->children() as $key => $value) {
        $food_data[$key] = (string)$value;
    }
    $sweets_array[] = $food_data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordering System</title>
    <script src="./JavaScript/main.js" defer></script>
</head>
<body>
    <main>
        <div>
            <p>Receipt:</p>
            <p>Total orders: <span id="total-orders"></span></p>
            <p>Total bill: <span id="total-bill"></span> php</p>
        </div>
        <section>
            <h2>Meals:</h2>
            <?php
            foreach ($meal_array as $meal_data) {
                echo "
                <div id='card-container' data-description='{$meal_data['description']}' data-price='{$meal_data['price']}' data-name='{$meal_data['name']}'>
                    <h2>{$meal_data['name']}</h2>
                    <p class='order-count' id='order-count-{$meal_data['name']}'></p>
                    <h3>Price: {$meal_data['price']} php</h3>
                </div>";
            }
            ?>
        </section>
        <section>
            <h2>Snacks:</h2>
            <?php
            foreach ($snacks_array as $snack_data) {
                echo "
                <div id='card-container' data-description='{$snack_data['description']}' data-price='{$snack_data['price']}' data-name='{$snack_data['name']}'>
                    <h2>{$snack_data['name']}</h2>
                    <p class='order-count' id='order-count-{$snack_data['name']}'></p>
                    <h3>Price: {$snack_data['price']} php</h3>
                </div>";
            }
            ?>
        </section>
        <section>
            <h2>Beverages:</h2>
            <?php
            foreach ($beverages_array as $beverage_data) {
                echo "
                <div id='card-container' data-description='{$beverage_data['description']}' data-price='{$beverage_data['price']}' data-name='{$beverage_data['name']}'>
                    <h2>{$beverage_data['name']}</h2>
                    <p class='order-count' id='order-count-{$beverage_data['name']}'></p>
                    <h3>Price: {$beverage_data['price']} php</h3>
                </div>";
            }
            ?>
        </section>
        <section>
            <h2>Sweets:</h2>
            <?php
            foreach ($sweets_array as $sweet_data) {
                echo "
                <div id='card-container' data-description='{$sweet_data['description']}' data-price='{$sweet_data['price']}' data-name='{$sweet_data['name']}'>
                    <h2>{$sweet_data['name']}</h2>
                    <p class='order-count' id='order-count-{$sweet_data['name']}'></p>
                    <h3>Price: {$sweet_data['price']} php</h3>
                </div>";
            }
            ?>
        </section>
    </main>
    <dialog id="dialog">
        <h3 id="dialog-food-name"></h3>
        <p>Price: <span id="dialog-food-price"></span></p>
        <p id="dialog-food-description"></p>
        <div>
            <button id="decrement">-</button>
            <p>Order Count: <span id="order-count"></span></p>
            <button id="increment">+</button>
        </div>
        <button id="close-button">Close</button>
    </dialog>
</body>
</html>
