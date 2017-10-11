/**
 * Created by SMITDOSHI on 10/4/17.
 */


function validateform() {

    var bool1=0;
    var bool2=0;
    // Username Validation
    var alphaExp = /^[a-zA-Z]+$/;
    var username_valid = document.forms["newsform"]["username"].value;
    if(username_valid.match(alphaExp)){
        bool1=1;
    }
    else {
        alert("Not a valid username");
        boo1=0;
    }

    // Email Validation
    var email_valid = document.forms["newsform"]["email"].value;
    var validate_reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!validate_reg.test(email_valid)) {
        alert("Not a valid e-mail address");
        bool2=0;
    }
    else{
        bool2=1;
    }
    if((bool1 == 1) && (bool2 == 1)){
        return true;
    }else {
        return false;
    }
    
}
