const clickButton = document.querySelector('#click')

// Pergunta se o usuário quer mesmo sair da página
clickButton.addEventListener('click', () => {
  function handleExit() {
    if(exitButton.value != '') {
      return 'Você realmente quer sair?'
    }
  }
  window.onbeforeunload = handleExit

  window.location.href = '../Exit/logout.php'
})

/* Troca de página */
const btnClick = document.querySelector('#conquista')

btnClick.addEventListener('click', () => {
  window.location.href = '../Rewards/conquistas.php'
})