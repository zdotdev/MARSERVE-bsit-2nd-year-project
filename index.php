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
        <?php
        foreach ($data_array as $food_data) {
            echo "
            <div id='name' data-name='{$food_data['name']}'>
                <h2 >{$food_data['name']}</h2>
                <h3>Price: {$food_data['price']} php</h3>
                <h3>Stock: {$food_data['stock']}</h3>
                <p>{$food_data['description']}</p>
            </div>";
        }
        ?>
    </main>
    <dialog id="myDialog">
        <p class="dialog-food-name">This is a dialog element!</p>
        <button id="close-button">Close</button>
    </dialog>
</body>
</html>