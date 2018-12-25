var firstName = document.getElementById("firstName");
firstName.onfocus = function () {
    if (firstName.value == "First") {
        firstName.value = "";
        firstName.style.color = 'black';
    }
};
firstName.onblur = function () {
    if (firstName.value == "") {
        firstName.value = "First";
        firstName.style.color = 'grey';
    }
};

var lastName = document.getElementById("lastName");
lastName.onfocus = function () {
    if (lastName.value == "Last") {
        lastName.value = "";
        lastName.style.color = 'black';
    }
};
lastName.onblur = function () {
    if (lastName.value == "") {
        lastName.value = "Last";
        lastName.style.color = 'grey';
    }
};