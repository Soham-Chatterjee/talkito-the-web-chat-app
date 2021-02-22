const form = document.querySelector(".signup form");
const signupBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt")


form.onsubmit = (e) => {
    e.preventDefault();
}


function savedata(){
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "php/sign-up.php", true);
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if (data == "Success"){
                    location.href = "user_page.php";
                }
                else{
                    errorText.textContent = data;
                    errorText.style.display = 'block';
                }
            }
        }
    }

    let formdata = new FormData(form);
    xhr.send(formdata);
}