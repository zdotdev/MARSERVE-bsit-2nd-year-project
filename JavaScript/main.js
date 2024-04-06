let dialog = document.getElementById('dialog')
let orderCounts = {}
document.getElementById('total-orders').textContent = 0
document.getElementById('total-bill').textContent = '0.00'
let totalPrice = []
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
    document.getElementById(
      'dialog-food-image'
    ).src = `./Image/${target.dataset.image}`
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
  totalOrdersText = totalOrdersText.slice(0, -2)
  document.getElementById('total-orders').textContent = totalOrdersText || 0
}
document.getElementById('increment').addEventListener('click', () => {
  let foodName = document.getElementById('dialog-food-name').textContent
  let price = parseFloat(
    document.getElementById('dialog-food-price').textContent
  )
  if (!orderCounts[foodName]) {
    orderCounts[foodName] = 0
  }
  orderCounts[foodName]++
  document.getElementById('order-count').textContent = orderCounts[foodName]
  totalPrice.push(price)
  updateTotalBill()
  updateTotalOrders()
  document.getElementById(`order-count-${foodName}`).textContent =
    orderCounts[foodName] > 0 ? orderCounts[foodName] : ''
})
document.getElementById('decrement').addEventListener('click', () => {
  let foodName = document.getElementById('dialog-food-name').textContent
  if (orderCounts[foodName] > 0) {
    orderCounts[foodName]--
    document.getElementById('order-count').textContent =
      orderCounts[foodName] || 0
    let price = parseFloat(
      document.getElementById('dialog-food-price').textContent
    )
    let index = totalPrice.indexOf(price)
    if (index > -1) {
      totalPrice.splice(index, 1)
    }
    updateTotalBill()
    updateTotalOrders()
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
const saveOrderBtn = document.getElementById('save-order-btn')
function disableSaveOrderBtn () {
  const totalBill = parseFloat(
    document.getElementById('total-bill').textContent
  )
  if (totalBill === 0) {
    saveOrderBtn.style.display = 'none'
  } else {
    saveOrderBtn.style.display = 'block'
  }
}
disableSaveOrderBtn()
document
  .getElementById('total-bill')
  .addEventListener('DOMSubtreeModified', disableSaveOrderBtn)

let currentUrl = window.location.href

if (currentUrl.indexOf('orderId') !== -1) {
  document.getElementById('show-orders').style.display = 'block'
} else {
  document.getElementById('show-orders').style.display = 'none'
}

document.getElementById('show-orders').addEventListener('click', function () {
  let currentUrl = window.location.href // Get the current URL again
  let url = new URL(currentUrl)
  let oi = url.searchParams.get('orderId') // Get the current orderId
  window.location.href = `http://localhost/orderSystem/landing.php?orderId=${oi}`
  console.log(oi)
})
