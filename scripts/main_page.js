let def_panel = document.getElementById("def-pan");
let chat_panel = document.getElementById("chat-pan");
let prof_panel = document.getElementById("prof-pan");

function chat_page(){
    def_panel.style.display = 'none';
    chat_panel.style.display = 'block';
    chat_panel.style.left = '0%';
    prof_panel.style.left = '100%';

}

function chat_back(){
    def_panel.style.display = 'flex';
    chat_panel.style.display = 'none';
    chat_panel.style.left = '100%';
    prof_panel.style.left = '100%';
}

function prof_change(){
    prof_panel.style.display = 'flex';
    prof_panel.style.left = '30.4%';
    def_panel.style.display = 'none';
    chat_panel.style.display = 'none';
}

function prof_back(){
    def_panel.style.display = 'flex';
    chat_panel.style.display = 'none';
    chat_panel.style.left = '100%';
    prof_panel.style.left = '100%';
}