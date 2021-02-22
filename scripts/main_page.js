let def_panel = document.getElementById("def-pan");
let chat_panel = document.getElementById("chat-pan");
let prof_panel = document.getElementById("prof-pan");
var pic = document.getElementById('prof-pic');
var hov_txt = document.getElementById('hover-text');
let main_body = document.getElementById('main_body');
let themebtn = document.getElementById('themebtn');
let settings_panel = document.getElementById('settings-pan');

hov_txt.addEventListener('mouseover', function() {
  pic.classList.add('hovered');
}, false);

hov_txt.addEventListener('mouseout', function() {
  pic.classList.remove('hovered');
}, false);

function chat_page(){
    def_panel.style.display = 'none';
    chat_panel.style.display = 'block';
    chat_panel.style.left = '0%';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
}

function chat_back(){
    def_panel.style.display = 'flex';
    chat_panel.style.display = 'none';
    chat_panel.style.left = '100%';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
}

function prof_change(){
    prof_panel.style.display = 'flex';
    prof_panel.style.left = '30.4%';
    def_panel.style.display = 'none';
    chat_panel.style.display = 'none';
    settings_panel.style.left = '100%'
}

function prof_back(){
    def_panel.style.display = 'flex';
    chat_panel.style.display = 'none';
    chat_panel.style.left = '100%';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
}

function settings_open(){
    settings_panel.style.display = 'flex';
    settings_panel.style.left = '30.4%';
    def_panel.style.display = 'none';
    chat_panel.style.display = 'none';
    prof_panel.style.left = '100%';
}

function settings_back(){
    def_panel.style.display = 'flex';
    chat_panel.style.display = 'none';
    chat_panel.style.left = '100%';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
}

function toggle_theme(){
    if (themebtn.textContent === "Theme: Dark"){
        main_body.classList.add('light');
        main_body.style.backgroundColor = '#d1d5de';
        themebtn.textContent = 'Theme: Light';
    }
    else{
        main_body.classList.remove('light');
        themebtn.textContent = 'Theme: Dark';
        main_body.style.backgroundColor = '#262a33';
    }
}