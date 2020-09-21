// if the user is logged in
function showLoggedInMenu() {
    // hide login and sign up from navbar & show logout button
    $("#login").hide();
    $("#sign_up").hide();
    $("#logout").show();
    $("#account").show();
}

// if the user is logged out
function showLoggedOutMenu() {
    // show login and sign up from navbar & hide logout button
    $("#login").show();
    $("#sign_up").show();
    $("#logout").hide();
    $("#account").hide();
}

// function to set cookie
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// get or read cookie
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }

        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}