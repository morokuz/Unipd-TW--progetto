//Controlli sugli input
var formContatti = document.getElementById('form-contatti');
var formReg = document.getElementById('form-registrazione');
var formLog = document.getElementById('form-accedi');

var nome = document.getElementById('nome-cont');
var email = document.getElementById('email-cont');

var username = document.getElementById('username-reg');
var emailReg = document.getElementById('email-reg');
var password = document.getElementById('password-reg');
var password1 = document.getElementById('password-reg1');

var flag = false;
if(formReg) {
	formReg.addEventListener('submit', function(e) {
		e.preventDefault();
		flag = false;
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
		flag = false;
		let nomeValue = nome.value.trim();
		let emailValue = email.value.trim();
		checkName(nomeValue, nome);
		checkEmail(emailValue, email);
	});
}

function checkName(nameValue, inp) {
	if (nameValue  === '' || nameValue.length < 4 || nameValue.length > 20 || rightName(nameValue)){
		if(!flag){
			flag=true;
			inp.focus();
		}
	}
	if(nameValue === ''){
		setErrorFor(inp, 'Nome mancante');
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
	if(emailValue === '' || !isEmail(emailValue)) {
		if(!flag) {
			flag=true;
			inp.focus();
		}
	}
	if(emailValue === '') {
		setErrorFor(inp, 'L\' email non può essere vuota');
	} else if (!isEmail(emailValue)) {
		setErrorFor(inp, 'Email non valida');
	} else {
		setSuccessFor(inp);
	}
}

function checkPassword(passValue, inp) {
	if(passValue.length < 4 || passValue.length > 15 || !numbPassword(passValue) || !uppPassword(passValue)) {
		if(!flag){
			flag=true;
			inp.focus();
		}
	}
	if (passValue === ''){
		setErrorFor(inp, 'Password mancante');	
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
	if(passValue != passValue1) {
		if(!flag){
			flag=true;
			inp.focus();
		}
	}
	if (passValue != passValue1){
		setErrorFor(inp,'Le password non coincidono');
	} else if (passValue === '') {
		setErrorFor(inp,'Password mancante');
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
  let esito = input.nextElementSibling;
  let span = esito.querySelector('span');
  input.className = 'form-input not-valido';
  esito.className = 'esito error';
  span.innerText = message;
}

function setSuccessFor(input) {
  let esito = input.nextElementSibling;
  input.className = 'form-input valido';
  esito.className = 'esito success';
}

//Gestione del modal per login/registrazione
var modal = document.querySelector(".modal");
var title = document.querySelector(".title");
var containerReg = document.getElementById('reg');
var containerLog = document.getElementById('log');
var titleSRO = document.getElementById('SRO');
var btnClose = document.getElementById('btn-close');
var prevElement;
function formOpen(btn) {
	prevElement = document.activeElement;
	modal.className = 'modal visible';
	if(btn.id === "btn-accedi"){
		containerLog.setAttribute("id","accedi");
		titleSRO.textContent = 'Finestra con form per accedere.';
		title.textContent = 'ACCEDI';
	} else {
		containerReg.setAttribute("id","registrati");
		titleSRO.textContent = 'Finestra con form per registrarsi.';
		title.textContent = 'REGISTRATI';
	}
	titleSRO.focus();
}
	
document.addEventListener('keydown', function(e) {
  	let isTabPressed = e.key === 'Tab' || e.keyCode === 9;
 	if (isTabPressed) {
		if (e.shiftKey) { 
			if (document.activeElement === titleSRO) {
	  			btnClose.focus(); 
	  			e.preventDefault();
			}
		} else { 
			if (document.activeElement === btnClose) { 
				titleSRO.focus();
		      	e.preventDefault();
			}
		}
	}
});

function exit() {
	close();
	formReg.reset();
	formLog.reset();
	clearStyle();
	prevElement.focus();
}

function close() {
	modal.className = 'modal';
	containerLog.setAttribute("id","log");
	containerReg.setAttribute("id","reg");
}

function clearStyle() {
	var inputs = formReg.querySelectorAll(".form-input.not-valido, .form-input.valido");
	for(var i = 0; i < inputs.length ; i++) {
		inputs[i].className = 'form-input';
		inputs[i].nextElementSibling.className = 'esito';
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