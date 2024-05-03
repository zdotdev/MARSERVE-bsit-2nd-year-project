document.addEventListener('DOMContentLoaded', function () {
  let editButtons = document.querySelectorAll('#food-container')
  editButtons.forEach(function (btn) {
    let foodId = btn.getAttribute('data-foodId')
    btn.addEventListener('click', function () {
      document.getElementById(`edit-dialog-${foodId}`).showModal()
    })
  })
})
document.querySelectorAll('.food-desc').forEach(function (desc) {
  let descText = desc.textContent
  desc.textContent = descText.substring(0, 10) + '...'
})
document.getElementById('add-product').addEventListener('click', function () {
  document.getElementById('add-product-dialog').showModal()
})
document
  .getElementById('close-add-product-dialog')
  .addEventListener('click', function () {
    document.getElementById('add-product-dialog').close()
  })
let arr = []
document.querySelectorAll('.food-title').forEach(element => {
  arr.push(element.textContent)
})

document.querySelector('.search-button').addEventListener('click', function () {
  let search = document.getElementById('search-input').value
  let toLow = search.toLowerCase()
  let upperFirstLetter = toLow.charAt(0).toUpperCase() + toLow.slice(1)
  if (search !== '') {
    document.querySelector('.search-button').href = `#${
      arr[arr.indexOf(upperFirstLetter)]
    }`
  }
})

const delbut = document.querySelectorAll('#delbut')
delbut.forEach(element => {
  element.addEventListener('click', function () {
    console.log('clicked')
    let id = element.dataset.log
    document.getElementById(`dialog-${id}`).classList.add('show')
  })
})
document.querySelectorAll('.no').forEach(element => {
  element.addEventListener('click', function () {
    let id = element.dataset.log
    document.getElementById(`dialog-${id}`).classList.remove('show')
  })
})
