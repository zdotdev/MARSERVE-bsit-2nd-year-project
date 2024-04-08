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
