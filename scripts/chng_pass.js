const form = document.querySelector(".login form");
const loginBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
    e.preventDefault();
}


