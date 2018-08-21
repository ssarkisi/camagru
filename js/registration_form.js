function checkAll() {
	email = document.getElementById("email").value;
	password = document.getElementById("password").value;
	password2 = document.getElementById("password2").value;
	user = document.getElementById("user").value;
	submit = document.getElementById("submit");

	if (email.match(/\S+@\S+\.\S+/) == email && password.match(/[a-zA-Z0-9]+/) == password && password == password2 && user.match(/[a-zA-Z\-]+/) == user) {
		submit.removeAttribute("disabled");
	}
	else {
		submit.setAttribute("disabled", true);
	}

}

function checkPassword() {
	a = document.getElementById("password").value;
	text = document.getElementById("error");
	submit = document.getElementById("submit");
	if (a.match(/[a-zA-Z0-9]+/) == a) {
		text.innerText = "";
	}
	else {
		text.innerText = "The password must contain only numbers and Latin letters";
	}
	checkAll();
}

function checkPassword2() {
	a = document.getElementById("password").value;
	b = document.getElementById("password2").value;
	text = document.getElementById("error");
	submit = document.getElementById("submit");
	if (a == b) {
		text.innerText = "";
	}
	else {
		text.innerText = "Passwords do not match";
	}
	checkAll();
}

function checkUser() {
	a = document.getElementById("user").value;
	text = document.getElementById("error");
	submit = document.getElementById("submit");
	if (a.match(/[a-zA-Z\-]+/) == a) {
		text.innerText = "";
	}
	else {
		text.innerText = "The username must contain only Latin letters and '-'";
	}
	checkAll();
}

function checkEmail() {
	a = document.getElementById("email").value;
	text = document.getElementById("error");
	submit = document.getElementById("submit");
	if (a.match(/\S+@\S+\.\S+/) == a) {
		text.innerText = "";
	}
	else {
		text.innerText = "Invalid email address";
	}
	checkAll();
}
