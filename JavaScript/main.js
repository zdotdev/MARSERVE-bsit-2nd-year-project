let dialog = document.getElementById('dialog')
let orderCount = 0
document.getElementById('total-orders').textContent = 0
document.getElementById('total-bill').textContent = '0.00'
let totalPrice = []

// Initially disable the decrement button
document.getElementById('decrement').disabled = true

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

function updateTotalBill () {
  document.getElementById('total-bill').textContent = totalPrice
    .reduce((a, b) => a + b, 0)
    .toFixed(2)
}

document.getElementById('increment').addEventListener('click', () => {
  let tPrice = parseFloat(
    document.getElementById('dialog-food-price').textContent
  )
  orderCount++
  totalPrice.push(tPrice)
  updateTotalBill()

  document.getElementById('order-count').textContent = orderCount
  document.getElementById('total-orders').textContent = orderCount

  // Enable the decrement button after incrementing
  document.getElementById('decrement').disabled = false
})

document.getElementById('decrement').addEventListener('click', () => {
  if (orderCount > 0) {
    orderCount--
    totalPrice.pop()
    updateTotalBill()

    document.getElementById('order-count').textContent = orderCount
    document.getElementById('total-orders').textContent = orderCount

    // If orderCount is 0, disable the decrement button again
    if (orderCount === 0) {
      document.getElementById('decrement').disabled = true
    }
  }
})
