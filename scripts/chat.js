const form = document.querySelector('.typing-area');
const sendBtn = document.getElementById('msg-send');
const inputField = document.getElementById('msg-input');
const chatBox = document.querySelector('.right-chat');
const status = document.getElementById('status-txt');

form.onsubmit = (e) => {
    e.preventDefault();
}

function send(){
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "php/chat_insert.php", true);
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = '';
                scrollToBottom();
            }
        }
    }

    let formdata = new FormData(form);
    xhr.send(formdata);
}

chatBox.onmouseenter = () =>{
    chatBox.classList.add('active');
}
chatBox.onmouseleave = () =>{
    chatBox.classList.remove('active');
}



setInterval(()=>{
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "php/chat_get.php", true);
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains('active')){
                    scrollToBottom();
                }
            }
        }
    }
    let formdata = new FormData(form);
    xhr.send(formdata);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}
