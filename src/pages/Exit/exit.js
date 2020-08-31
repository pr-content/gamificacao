const body = document.querySelector('body')
body.addEventListener('load', exitToMain())

function exitToMain() {
  alert('Você saiu!')
  document.location.href = '../HomePage/matricula.php'
  return false
}