<?php
$dataFile = './Data/orders.xml';

// Load XML file
if (file_exists($dataFile)) {
    $orders = simplexml_load_file($dataFile) or die("Error: Cannot create object");
} else {
    die("Error: XML file not found");
}

// $orderId = "nfhir"; // The order_id you want to search for
$orderId = $_GET['orderId'] ?? '';
$foundOrder = null;

foreach ($orders->order as $order) {
    if ((string) $order->order_id === $orderId) {
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
                    echo "
                        <h1>Order Details</h1>
                        <div>
                            <p>Total Orders: {$foundOrder->total_orders}</p>
                            <p>Total Bill: {$foundOrder->total_bill}</p>
                            <p>Table Number: {$foundOrder->table_number}</p>
                            <a href='http://localhost/orderSystem/index.php?table={$foundOrder->table_number}&orderId={$orderId}'>Buy again?</a>
                        </div>
                    ";
                } else {
                    echo "Order not found.";
                }
            ?>
        </main>
    </body>
</html>