<?php
$dataFile = './Data/orders.xml';

// Load XML file
if (file_exists($dataFile)) {
    $orders = simplexml_load_file($dataFile) or die("Error: Cannot create object");
} else {
    die("Error: XML file not found");
}

// $orderId = "nfhir"; // The order_id you want to search for
$table = $_GET['table'] ?? '';
$orderId = $_GET['orderId'] ?? '';
$foundOrder = null;

foreach ($orders->order as $order) {
    if ((string) $order->table_number === $table) {
        $foundOrder = $order;
        break;
    }
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
        <link rel="stylesheet" href="./Style/landing.css">
        <title>Order placed!!!</title>
        <!-- zdotdev -->
    </head>
    <body>
        <header>
            <h1>MARSERVE</h1>
        </header>
        <main>
            <h1 class='title'>Orders:</h1>
            <?php
                if ($foundOrder !== null) {
                    foreach ($orders->order as $order) {
                        if ((string) $order->table_number === $table) {
                            echo "
                                <div class='each-orders'>
                                    <p class='order-names'>Total Orders: {$order->total_orders}</p>
                                    <p class='bill-container'>Price: <span id='bill'>{$order->total_bill}</span></p>
                                </div>
                            ";
                        }
                    }
                } else {
                    echo "Order not found.";
                }
                echo "
                <div class='total-div'>
                    <p>Table Number: {$table}</p>
                    <p>Total bill: <span id='total'></span> php</p>
                </div>";
                echo "
                <div class='buy-again-div'>
                    <a href='http://localhost/orderSystem/index.php?table={$order->table_number}&orderId={$orderId}'>Buy again?</a>
                </div>";
            ?>
        </main>
        <script>
            let arr = [];
            document.querySelectorAll('#bill').forEach(function (el) {
                el.textContent.split(' ').forEach(function (item) {
                    arr.push(parseFloat(item));
                });
            });
            document.getElementById('total').textContent = parseInt(arr.reduce((total, num) => total + num, 0));
        </script>
    </body>
</html>