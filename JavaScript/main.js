let dialog = document.getElementById('dialog')
let orderCount = 0

let totalPrice = [0]

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
    dialog.showModal()
  }
})
document.getElementById('close-button').addEventListener('click', () => {
  dialog.close()
})

document.getElementById('order-count').textContent = orderCount
document.getElementById('total-orders').textContent = orderCount
// Function to update the total bill
function updateTotalBill () {
  document.getElementById('total-bill').textContent = totalPrice
    .reduce((a, b) => a + b, 0)
    .toFixed(2)
}

document.getElementById('increment').addEventListener('click', () => {
  // Assuming tPrice is the price of the current item
  let tPrice = parseFloat(
    document.getElementById('dialog-food-price').textContent
  )
  orderCount++
  totalPrice.push(tPrice)
  updateTotalBill()

  document.getElementById('order-count').textContent = orderCount
  document.getElementById('total-orders').textContent = orderCount
})

document.getElementById('decrement').addEventListener('click', () => {
  if (orderCount > 0) {
    orderCount--
    // Remove the last price added to the totalPrice array
    totalPrice.pop()
    updateTotalBill()

    document.getElementById('order-count').textContent = orderCount
    document.getElementById('total-orders').textContent = orderCount
  }
})
