let chat_panel = document.getElementById("chat-pan");
let prof_panel = document.getElementById("prof-pan");
var pic = document.getElementById('prof-pic');
var hov_txt_div = document.getElementById('hover-text');
var main_hov_txt = document.getElementById('hov-txt');
let main_body = document.getElementById('main_body');
let themebtn = document.getElementById('themebtn');
let settings_panel = document.getElementById('settings-pan');
let img_opt_div = document.getElementById('img-options-div');
let prof_name = document.getElementById('name-input');
let users_list = document.getElementById('userlist');
let searchBar = document.getElementById('search-input');
let no_user = document.getElementById('no-user');
let user_chat = document.getElementById('user-chat');

hov_txt_div.addEventListener('mouseover', function() {
  pic.classList.add('hovered');
}, false);

hov_txt_div.addEventListener('mouseout', function() {
  pic.classList.remove('hovered');
}, false);

function chat_page(){
    chat_panel.style.display = 'block';
    chat_panel.style.left = '0%';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";

}

function chat_back(){
    chat_panel.style.display = 'none';
    chat_panel.style.left = '100%';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
}

function prof_change(){
    prof_panel.style.display = 'flex';
    prof_panel.style.left = '30.4%';
    chat_panel.style.display = 'none';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
}

function prof_back(){
    chat_panel.style.display = 'block';
    // chat_panel.style.left = '100%';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
}

function settings_open(){
    settings_panel.style.display = 'flex';
    settings_panel.style.left = '30.4%';
    chat_panel.style.display = 'none';
    prof_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
}

function settings_back(){
    chat_panel.style.display = 'block';
    // chat_panel.style.left = '100%';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
}

function toggle_theme(){
    if (themebtn.textContent === "Theme: Dark"){
        main_body.classList.add('light');
        main_body.style.backgroundColor = '#d1d5de';
        themebtn.textContent = 'Theme: Light';
        img_opt_div.style.display = 'none';
        main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
        hov_txt_div.style.transform = "translate(-50%, -100%)";
    }
    else{
        main_body.classList.remove('light');
        themebtn.textContent = 'Theme: Dark';
        main_body.style.backgroundColor = '#262a33';
        img_opt_div.style.display = 'none';
        main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
        hov_txt_div.style.transform = "translate(-50%, -100%)";
    }
}

function change_pic(){
    if (img_opt_div.style.display === 'none'){
    img_opt_div.style.display = 'flex';
    main_hov_txt.innerHTML = "CANCEL";
    hov_txt_div.style.transform = "translate(-50%, -280%)";
    }
    else{
        img_opt_div.style.display = 'none';
        main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
        hov_txt_div.style.transform = "translate(-50%, -100%)"; 
    }
}

setInterval(()=>{
    let xhr = new XMLHttpRequest();

    xhr.open("GET", "php/users.php", true);
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if (!searchBar.classList.contains('active')){
                    users_list.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 500);


function search(){
    let searchTerm = searchBar.value;
    if (searchTerm != ""){
        searchBar.classList.add('active');
    }
    else{
        searchBar.classList.remove('active');
    }
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "php/search.php", true);
    xhr.onload = ()=> {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                users_list.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}