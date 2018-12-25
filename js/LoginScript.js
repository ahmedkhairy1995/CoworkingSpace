var emailLogin = document.getElementById("emailLogin");
emailLogin.onfocus = function () {
    if (emailLogin.value == "Email") {
        emailLogin.value = "";
        emailLogin.style.color = 'black';
    }
};
emailLogin.onblur = function () {
    if (emailLogin.value == "") {
        emailLogin.value = "Email";
        emailLogin.style.color = 'grey';
    }
};
var passwordLogin = document.getElementById("passwordLogin");
passwordLogin.onfocus = function () {
    if (passwordLogin.value == "Password") {
        passwordLogin.value = "";
        passwordLogin.style.color = 'black';
    }
};
passwordLogin.onblur = function () {
    if (passwordLogin.value == "") {
        passwordLogin.value = "Password";
        passwordLogin.style.color = 'grey';
    }
};

var rememberEmail = document.getElementById("remember_email");
if (rememberEmail.checked == true)
{
    var Email = document.getElementById("emailLogin");
    Email.autocomplete = "on";
}
else
{
    var Email = document.getElementById("emailLogin");
    Email.autocomplete = "off";
}
