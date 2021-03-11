let def_panel = document.getElementById("def-pan");
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
let img_form = document.getElementById('img-form');
let error = document.querySelector('.error-txt');
let name_form = document.getElementById('name-form');

hov_txt_div.addEventListener('mouseover', function() {
  pic.classList.add('hovered');
}, false);

hov_txt_div.addEventListener('mouseout', function() {
  pic.classList.remove('hovered');
}, false);

function chat_page(){
    def_panel.style.display = 'none';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";

}

function chat_back(){
    def_panel.style.display = 'flex';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
    error.innerHTML = "";
    error.style.display = 'none';
}

function prof_change(){
    prof_panel.style.display = 'flex';
    prof_panel.style.left = '30.4%';
    def_panel.style.display = 'none';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
    error.innerHTML = "";
    error.style.display = 'none';
}

function prof_back(){
    def_panel.style.display = 'flex';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
    error.innerHTML = "";
    error.style.display = 'none';
}

function settings_open(){
    settings_panel.style.display = 'flex';
    settings_panel.style.left = '30.4%';
    def_panel.style.display = 'none';
    prof_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
    error.innerHTML = "";
    error.style.display = 'none';
}

function settings_back(){
    def_panel.style.display = 'flex';
    prof_panel.style.left = '100%';
    settings_panel.style.left = '100%';
    img_opt_div.style.display = 'none';
    main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
    hov_txt_div.style.transform = "translate(-50%, -100%)";
    error.innerHTML = "";
    error.style.display = 'none';
}

function toggle_theme(){
    if (main_body.classList.contains('light')){
        main_body.classList.remove('light'); //#d1d5de
        themebtn.textContent = 'Theme: Dark';
        img_opt_div.style.display = 'none';
        main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
        hov_txt_div.style.transform = "translate(-50%, -100%)";
        document.documentElement.style.setProperty('--theme-primary', '#262a33');
        document.documentElement.style.setProperty('--theme-secondary', '#2f3232');
        document.documentElement.style.setProperty('--theme-tertiary', '#3e4343');
        document.documentElement.style.setProperty('--theme-object-primary', '#fff');
        document.documentElement.style.setProperty('--theme-object-secondary', '#97918a');
        document.documentElement.style.setProperty('--theme-object-tertiary', '#000');
        document.documentElement.style.setProperty('--theme-border', '#4c5352');
        document.documentElement.style.setProperty('--theme-button-primary', '#343a4e');
        document.documentElement.style.setProperty('--theme-button-hover', '#364e5b');
        document.documentElement.style.setProperty('--theme-warning-div', '#ffebcd');
        document.documentElement.style.setProperty('--theme-online', '#05c41f');
    }
    else{
        main_body.classList.add('light');
        themebtn.textContent = 'Theme: Light';
        img_opt_div.style.display = 'none';
        main_hov_txt.innerHTML= "CHANGE PROFILE PHOTO";
        hov_txt_div.style.transform = "translate(-50%, -100%)";
        document.documentElement.style.setProperty('--theme-primary', '#e5ddd5');
        document.documentElement.style.setProperty('--theme-secondary', '#b2aba5');
        document.documentElement.style.setProperty('--theme-tertiary', '#ededed');
        document.documentElement.style.setProperty('--theme-object-primary', '#000');
        document.documentElement.style.setProperty('--theme-object-secondary', '#6f6f6f');
        document.documentElement.style.setProperty('--theme-object-tertiary', '#a3a3a3');
        document.documentElement.style.setProperty('--theme-border', '#aaaaaa');
        document.documentElement.style.setProperty('--theme-button-primary', '#7e7a75');
        document.documentElement.style.setProperty('--theme-button-hover', '#a49f98');
        document.documentElement.style.setProperty('--theme-warning-div', '#4b4845');
        document.documentElement.style.setProperty('--theme-online', '#05c41f');
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

function upload(){

    console.log('running');
    let xhr = new XMLHttpRequest();
    console.log('xhr variable created');
    xhr.open("POST", "php/upload.php", true);
    console.log("xhr opened");
    xhr.onload = function(){
        console.log('xhr loaded');
        if(xhr.readyState === XMLHttpRequest.DONE){
            console.log('xhr ready');
            if(xhr.status === 200){
                console.log('xhr status matched');
                let data = xhr.response;
                if(data == "Success"){
                    error.innerHTML = "";
                    error.style.display = "none";
                    location.reload();
                    // location.href("chat_page.php").reload();
                }
                else if(data == "Please upload an image file - jpeg, png, jpg"){
                    error.innerHTML = data;
                    error.style.display = 'block';
                }
                else{
                    console.log(data);
                }
            }
        }
    }
    let formdata = new FormData(img_form);
    xhr.send(formdata);
}

function remove(){
    console.log('running');
    let xhr = new XMLHttpRequest();
    console.log('xhr variable created');
    xhr.open("GET", "php/remove.php", true);
    console.log("xhr opened");
    xhr.onload = function(){
        console.log('xhr loaded');
        if(xhr.readyState === XMLHttpRequest.DONE){
            console.log('xhr ready');
            if(xhr.status === 200){
                console.log('xhr status matched');
                let data = xhr.response;
                if(data == "Success"){
                    error.innerHTML = "";
                    error.style.display = "none";
                    location.reload();
                    // location.href("chat_page.php").reload();
                }
                else{
                    error.innerHTML = data;
                    error.style.display = "block";
                }
            }
        }
    }
    xhr.send(); 
}

function name_change(){
    console.log('running');
    let xhr = new XMLHttpRequest();
    console.log('xhr variable created');
    xhr.open("POST", "php/rename.php", true);
    console.log("xhr opened");
    xhr.onload = function(){
        console.log('xhr loaded');
        if(xhr.readyState === XMLHttpRequest.DONE){
            console.log('xhr ready');
            if(xhr.status === 200){
                console.log('xhr status matched');
                let data = xhr.response;
                if(data == "Success"){
                    error.innerHTML = "";
                    error.style.display = "none";
                    location.reload();
                    // location.href("chat_page.php").reload();
                }
                else{
                    error.innerHTML = data;
                    error.style.display = 'block';
                }
            }
        }
    }
    let formdata = new FormData(name_form);
    xhr.send(formdata);
}