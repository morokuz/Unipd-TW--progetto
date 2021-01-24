//Controlli sugli input
var nome = document.getElementById('nome-cont');
var email = document.getElementById('email-cont');
var username = document.getElementById('username-reg');
var emailReg = document.getElementById('email-reg');
var password = document.getElementById('password-reg');
var password1 = document.getElementById('password-reg1');

var result = true;
var flag = false;

function validateFormReg() {
  flag = false;
  var usernameValue = username.value.trim();
  var emailRegValue = emailReg.value.trim();
  var passwordValue = password.value.trim();
  var password1Value = password1.value.trim();

  var a = checkName(usernameValue, username);
  var b = checkEmail(emailRegValue, emailReg);
  var c = checkPassword(passwordValue, password);
  var d = equalPassword(passwordValue, password1Value, password1);
  return a && b && c && d;
}

function validateFormCont() {
  flag = false;
  var nomeValue = nome.value.trim();
  var emailValue = email.value.trim();
  var a = checkName(nomeValue, nome);
  var b = checkEmail(emailValue, email);
  return a && b;
}

function checkName(nameValue, inp) {
  if (nameValue === '' || nameValue.length < 4 || nameValue.length > 20 || rightName(nameValue)) {
    result = false;
    if (!flag) {
      flag = true;
      inp.focus();
    }
  }
  if (nameValue === '') {
    setErrorFor(inp, 'Nome mancante');
  } else if (nameValue.length < 4) {
    setErrorFor(inp, 'Il nome ha meno di 4 caratteri');
  } else if (nameValue.length > 20) {
    setErrorFor(inp, 'Il nome ha più di 20 caratteri');
  } else if (rightName(nameValue)) {
    setErrorFor(inp, 'Il nome contiene simboli');
  } else {
    setSuccessFor(inp, 'Nome valido');
    result = true;
  }
  return result;
}

function checkEmail(emailValue, inp) {
  if (emailValue === '' || !isEmail(emailValue)) {
    result = false;
    if (!flag) {
      flag = true;
      inp.focus();
    }
  }
  if (emailValue === '') {
    setErrorFor(inp, 'L\' email non può essere vuota');
  } else if (!isEmail(emailValue)) {
    setErrorFor(inp, 'Email non valida');
  } else {
    setSuccessFor(inp, 'Email valida');
    result = true;
  }
  return result;
}

function checkPassword(passValue, inp) {
  if (passValue.length < 5 || passValue.length > 15 || !numbPassword(passValue) || !uppPassword(passValue)) {
    result = false;
    if (!flag) {
      flag = true;
      inp.focus();
    }
  }
  if (passValue === '') {
    setErrorFor(inp, 'Password mancante');
  } else if (passValue.length < 5) {
    setErrorFor(inp, 'Password con meno di 5 caratteri');
  } else if (passValue.length > 15) {
    setErrorFor(inp, 'Passord più lunga di 15 caratteri');
  } else if (!numbPassword(passValue)) {
    setErrorFor(inp, 'Manca il numero obbligatorio');
  } else if (!uppPassword(passValue)) {
    setErrorFor(inp, 'Manca la lettera maiuscola obbligatoria');
  } else {
    setSuccessFor(inp, 'Password valida');
    result = true;
  }
  return result;
}

function equalPassword(passValue, passValue1, inp) {
  if (passValue != passValue1) {
    result = false;
    if (!flag) {
      flag = true;
      inp.focus();
    }
  }
  if (passValue != passValue1) {
    setErrorFor(inp, 'Le password non coincidono');
  } else if (passValue === '') {
    setErrorFor(inp, 'Password mancante');
  } else {
    setSuccessFor(inp, 'Le password coincidono');
    result = true;
  }
  return result;
}

function numbPassword(pass) {
  return /(?=.*[0-9])/.test(pass);
}

function uppPassword(pass) {
  return /(?=.*[A-Z])/.test(pass);
}

function isEmail(email) {
  return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function rightName(name) {
  return /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(name);
}

function setErrorFor(input, message) {
  let esito = input.nextElementSibling;
  let span = esito.querySelector('span');
  input.className = 'form-input not-valido';
  esito.className = 'esito error';
  span.innerText = message;
}

function setSuccessFor(input, message) {
  let esito = input.nextElementSibling;
  let span = esito.querySelector('span');
  input.className = 'form-input valido';
  esito.className = 'esito success';
  span.innerText = message;
}
