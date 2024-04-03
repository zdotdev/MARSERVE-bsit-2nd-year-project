let dialog = document.getElementById('dialog')
let orderCounts = {} // Object to store order counts for each food item
document.getElementById('total-orders').textContent = 0
document.getElementById('total-bill').textContent = '0.00'
let totalPrice = []

// Initialize the order counts for each food item
let orderCountElements = document.querySelectorAll('.order-count')
orderCountElements.forEach(element => {
  element.textContent = ''
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
  document.getElementById('total-orders').textContent = totalOrdersText || 0
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
    orderCounts[foodName] > 0 ? orderCounts[foodName] : ''
})

document.getElementById('decrement').addEventListener('click', () => {
  let foodName = document.getElementById('dialog-food-name').textContent
  if (orderCounts[foodName] > 0) {
    orderCounts[foodName]--
    document.getElementById('order-count').textContent =
      orderCounts[foodName] || 0
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
      orderCounts[foodName] > 0 ? orderCounts[foodName] : ''
  }
})

document
  .getElementById('save-order-btn')
  .addEventListener('click', function () {
    let totalOrders = document.getElementById('total-orders').innerText
    let totalBill = document.getElementById('total-bill').innerText

    document.getElementById('total-orders-input').value = totalOrders
    document.getElementById('total-bill-input').value = totalBill
  })
