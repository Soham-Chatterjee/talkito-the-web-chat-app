function toggle(id, id2) {
    var pswd = document.getElementById(id)
    var eye = document.getElementById(id2)
    if (pswd.type == 'password') {
        pswd.type = 'text'
        eye.style.color = "#000";
    }
    else {
        pswd.type = 'password'
        eye.style.color = "#adadae";
    }
}