//Controlli sugli input
var formContatti = document.getElementById('contatti');
var formReg = document.getElementById('reg');
var formLog = document.getElementById("log");

var nome = document.getElementById('nome-cont');
var email = document.getElementById('email-cont');

var username = document.getElementById('username-reg');
var emailReg = document.getElementById('email-reg');
var password = document.getElementById('password-reg');
var password1 = document.getElementById('password-reg1');

if(formReg) {
	formReg.addEventListener('submit', function(e) {
		e.preventDefault();
		var usernameValue = username.value.trim();
		var emailRegValue = emailReg.value.trim();
		var passwordValue = password.value.trim();
		var password1Value = password1.value.trim();
		checkName(usernameValue, username);
		checkEmail(emailRegValue, emailReg);
		checkPassword(passwordValue, password);
		equalPassword(passwordValue, password1Value, password1);
	});
}

if(formContatti) {
	formContatti.addEventListener('submit', function(e) {
		e.preventDefault();
		var nomeValue = nome.value.trim();
		var emailValue = email.value.trim();
		checkName(nomeValue, nome);
		checkEmail(emailValue, email);
	});
}

function checkName(nameValue, inp) {
	if(nameValue  === ''){
		setErrorFor(inp, 'Il nome è vuoto');
	} else if (nameValue.length < 4){
     	setErrorFor(inp, 'Il nome ha meno di 4 caratteri');
  	} else if (nameValue.length > 20) {
    	setErrorFor(inp, 'Il nome ha più di 20 caratteri');
  	} else if (rightName(nameValue)){
    	setErrorFor(inp, 'Il nome contiene simboli');
  	} else {
    	setSuccessFor(inp);
	}	
}

function checkEmail(emailValue, inp) {
	if(emailValue === '') {
		setErrorFor(inp, 'L\' email non può essere vuota');
	} else if (!isEmail(emailValue)) {
		setErrorFor(inp, 'Email non valida');
	} else {
		setSuccessFor(inp);
	}
}

function checkPassword(passValue, inp) {
	if (passValue === '') {
		setErrorFor(inp, 'Scrivere una password');
	} else if (passValue.length < 4){
		setErrorFor(inp, 'Password troppo corta');		                                             
	} else if (passValue.length > 15){
		setErrorFor(inp, 'Password troppo lunga');
	} else if (!numbPassword(passValue)) {
		setErrorFor(inp, 'Manca il numero obbligatorio');
	} else if (!uppPassword(passValue)) {
		setErrorFor(inp, 'Manca la lettera maiuscola obbligatoria');
	} else {
		setSuccessFor(inp);
	}
}

function equalPassword(passValue, passValue1, inp) {
	if (passValue != passValue1){
		setErrorFor(inp,'Le password non coincidono');
	} else {
		setSuccessFor(inp);
	}
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
  var esito = input.nextElementSibling;
  var span = esito.querySelector('span');
  input.className = 'form-input not-valido';
  esito.className = 'esito error';
  span.innerText = message;
}

function setSuccessFor(input) {
  var esito = input.nextElementSibling;
  input.className = 'form-input valido';
  esito.className = 'esito success';
}

//Gestione del popup per login/registrazione
var popup = document.querySelector(".popup");
document.getElementById("btn-accedi").addEventListener("click", function() {
	popup.className = 'popup open';
	formLog.setAttribute("id","accedi");
})

document.getElementById("btn-registrati").addEventListener("click", function() {
	popup.className = 'popup open';
	formReg.setAttribute("id","registrati");
})

function exit() {
	close(formLog,formReg);
	clearStyle(formLog,formReg);
	reset(formLog,formReg);
}

function close(formLog,formReg) {
	popup.className = 'popup';
	formLog.setAttribute("id","log");
	formReg.setAttribute("id","reg");
}

function reset(formLog,formReg) {
	formLog.reset();
	formReg.reset();
}

function clearStyle(formLog,formReg) {
	var inputs = formReg.getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++) {
		var a = inputs[i];
		var esito = a.nextElementSibling;
		a.className = 'form-input';
		esito.className = 'esito';
	}
}


//Gestione degli eye per vedere/nascondere le password
var stato = false;
function toggle(elem) {
	var id = elem.id;
	if(stato){
		if(id == "eye1"){
			document.getElementById("password-log").setAttribute("type","password");	
		} else if (id == "eye2"){
			document.getElementById("password-reg").setAttribute("type","password");
		} else {
			document.getElementById("password-reg1").setAttribute("type","password");
		}
		stato = false;
	} else {
		if(id == "eye1"){
			document.getElementById("password-log").setAttribute("type","text");	
		} else if (id == "eye2"){
			document.getElementById("password-reg").setAttribute("type","text");
		} else {
			document.getElementById("password-reg1").setAttribute("type","text");
		}
		stato = true;
	}
}