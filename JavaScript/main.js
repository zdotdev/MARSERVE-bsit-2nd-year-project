let dialog = document.getElementById('myDialog')
document.querySelector('main').addEventListener('click', function (event) {
  let target = event.target
  while (target !== null && target.id !== 'name') {
    target = target.parentElement
  }
  if (target !== null) {
    document.querySelector('.dialog-food-name').textContent =
      target.getAttribute('data-name')
    dialog.showModal()
  }
})
document.getElementById('close-button').addEventListener('click', () => {
  dialog.close()
})
