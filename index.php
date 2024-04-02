<?php
$data = './Data/data.xml';
$xml = simplexml_load_file($data) or die("Error: Cannot create object");

$data_array = [];
foreach($xml->list->children() as $food) {
    $food_data = [];
    foreach($food->children() as $key => $value) {
        $food_data[$key] = (string)$value;
    }
    $data_array[] = $food_data;
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
        <?php
        foreach ($data_array as $food_data) {
            echo "
            <div id='card-container' data-description='{$food_data['description']}' data-price='{$food_data['price']}' data-name='{$food_data['name']}'>
                <h2>{$food_data['name']}</h2>
                <h3>Price: {$food_data['price']} php</h3>
            </div>";
        }
        ?>
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