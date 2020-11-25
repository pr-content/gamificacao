// Foco no input
document.querySelector('input').focus();

/* Customiza o required */
const fields = document.querySelectorAll('[required]')

function customValidation(event) {
  const field = event.target

  function verifyErrors() {
    let foundError = false;
  
    for (let error in field.validity) {
      if (error != 'customError' && field.validity[error]) {
        foundError = error
      }
    }

    return foundError;
  }

  const error = verifyErrors()

  if (error) {
    field.setCustomValidity('Esse campo é obrigatório')
  } else {
    field.setCustomValidity('')
  }
}

for (field of fields) {
  field.addEventListener('invalid', customValidation)
}