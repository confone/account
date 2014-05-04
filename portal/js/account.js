function sendResetPasswordEmail() {
	var xhr = new GetXmlHttpObject();
	xhr.open('GET', '/email/reset-password');
	xhr.onload = function () {
		if (xhr.status === 200) {
			alert(xhr.responseText);
		} else {
			alert(xhr.status);
		}
	};
	xhr.send(null);
}

function sendActivationEmail() {
	var xhr = new GetXmlHttpObject();
	xhr.open('GET', '/email/activation');
	xhr.onload = function () {
		if (xhr.status === 200) {
			alert(xhr.responseText);
		} else {
			alert(xhr.status);
		}
	};
	xhr.send(null);
}