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
        <title>Order placed!!!</title>
        <!-- zdotdev -->
    </head>
    <body>
        <main>
            <?php
                if ($foundOrder !== null) {
                    echo "<h1>Order Details</h1>";
                    foreach ($orders->order as $order) {
                        if ((string) $order->table_number === $table) {
                            echo "
                                <div>
                                    <p>Total Orders: {$order->total_orders}</p>
                                    <p>Total Bill: {$order->total_bill}</p>
                                </div>
                            ";
                        }
                    }
                } else {
                    echo "Order not found.";
                }
                echo "
                <a href='http://localhost/orderSystem/index.php?table={$order->table_number}&orderId={$orderId}'>Buy again?</a>
                <p>Table Number{$table}</p>";
            ?>
        </main>
    </body>
</html>