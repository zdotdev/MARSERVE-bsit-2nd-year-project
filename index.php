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
    <!-- <script src="./JavaScript/main.js" defer></script> -->
</head>
<body>
    <main>
        <div>
            <p>Receipt:</p>
            <p>Total orders: <span id="total-orders"></span></p>
            <p>Total bill: <span id="total-bill"></span> php</p>
        </div>

        <ul>
            <li><button class="meals">Meals</button></li>
            <li><button class="snacks">Snacks</button></li>
            <li><button class="beverages">Beverages</button></li>
            <li><button class="sweets">Sweets</button></li>
        </ul>
        <div id="container">
        </div>
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
    <script>
        let dialog = document.getElementById('dialog')
let orderCounts = {} // Object to store order counts for each food item
document.getElementById('total-orders').textContent = 0
document.getElementById('total-bill').textContent = '0.00'
let totalPrice = []

// Initialize the order counts for each food item
let orderCountElements = document.querySelectorAll('.order-count')
orderCountElements.forEach(element => {
  element.textContent = 0
})

document.querySelector('main').addEventListener('click', function (event) {
  let target = event.target
  while (target !== null && target.id !== 'card-container') {
    target = target.parentElement
  }
  if (target !== null) {
    document.getElementById('dialog-food-description').textContent =
      target.dataset.description
    document.getElementById('dialog-food-name').textContent =
      target.dataset.name
    document.getElementById('dialog-food-price').textContent =
      target.dataset.price
    // Set the order count in the dialog box
    let foodName = target.dataset.name
    document.getElementById('order-count').textContent =
      orderCounts[foodName] || 0
    dialog.showModal()
  }
})

document.getElementById('close-button').addEventListener('click', () => {
  dialog.close()
})

function updateTotalBill () {
  // Calculate the total price inside the function
  let tPrice = totalPrice.reduce((a, b) => a + b, 0).toFixed(2)
  document.getElementById('total-bill').textContent = tPrice
}

function updateTotalOrders () {
  let totalOrdersText = ''
  for (let foodName in orderCounts) {
    if (orderCounts[foodName] > 0) {
      totalOrdersText += `${foodName}: ${orderCounts[foodName]}, `
    }
  }
  // Remove the last comma and space
  totalOrdersText = totalOrdersText.slice(0, -2)
  document.getElementById('total-orders').textContent = totalOrdersText
}

document.getElementById('increment').addEventListener('click', () => {
  let foodName = document.getElementById('dialog-food-name').textContent
  let price = parseFloat(
    document.getElementById('dialog-food-price').textContent
  )
  if (!orderCounts[foodName]) {
    orderCounts[foodName] = 0 // Initialize the count if it doesn't exist
  }
  orderCounts[foodName]++
  document.getElementById('order-count').textContent = orderCounts[foodName]
  totalPrice.push(price) // Add the price to the totalPrice array
  updateTotalBill()
  updateTotalOrders() // Update the total orders display

  // Update the order count for the specific food item
  document.getElementById(`order-count-${foodName}`).textContent =
    orderCounts[foodName]
})

document.getElementById('decrement').addEventListener('click', () => {
  let foodName = document.getElementById('dialog-food-name').textContent
  if (orderCounts[foodName] > 0) {
    orderCounts[foodName]--
    document.getElementById('order-count').textContent = orderCounts[foodName]
    // Remove the price from the totalPrice array
    let price = parseFloat(
      document.getElementById('dialog-food-price').textContent
    )
    let index = totalPrice.indexOf(price)
    if (index > -1) {
      totalPrice.splice(index, 1)
    }
    updateTotalBill()
    updateTotalOrders() // Update the total orders display

    // Update the order count for the specific food item
    document.getElementById(`order-count-${foodName}`).textContent =
      orderCounts[foodName]
  }
})

// declarative
const categories = {
  meals: `<section>
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
        </section>`,
  snacks: `<section>
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
        </section>`,
  beverages: `<section>
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
        </section>`,
  sweets: `<section>
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
        </section>`
}

document.querySelector('#container').innerHTML = categories.meals

document.querySelector('.meals').addEventListener('click', () => {
    document.querySelector('#container').innerHTML = ''
    document.querySelector('#container').innerHTML = categories.meals
})
document.querySelector('.snacks').addEventListener('click', () => {
    document.querySelector('#container').innerHTML = ''
    document.querySelector('#container').innerHTML = categories.snacks
})
document.querySelector('.beverages').addEventListener('click', () => {
    document.querySelector('#container').innerHTML = ''
    document.querySelector('#container').innerHTML = categories.beverages
})
document.querySelector('.sweets').addEventListener('click', () => {
    document.querySelector('#container').innerHTML = ''
    document.querySelector('#container').innerHTML = categories.sweets
})

    </script>
</body>
</html>
