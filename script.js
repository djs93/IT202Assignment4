function hasCapital(word){
    let letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    for(let i = 0; i<word.length; i++){
        if(letters.find(function(element){
            return element===word.charAt(i);
        })){
            return true;
        }
    }
    return false;
}
function hasNumber(word){
    let numbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
    for(let i = 0; i<word.length; i++){
        if(numbers.find(function(element){
            return element===word.charAt(i);
        })){
            return true;
        }
    }
    return false;
}

function toggleEmail(checkbox){
    let emailbox = document.getElementById("email");
    emailbox.readOnly = !checkbox.checked;
    emailbox.style.color = checkbox.checked ? "black" : "gray";
    emailbox.style.backgroundColor = checkbox.checked ? "white" : "#cdcdcd";
    emailbox.required = checkbox.checked;
}

function validate(form){
    let name = form.name.value;
    let password = form.password.value;
    let id = form.id.value;
    let email = form.email.value;
    let emailRequested = form.emailConf.checked;

    if(emailRequested && email===""){
        alert("Please enter an email!");
        return false;
    }
    else if(password.length>8){
        alert("Password must be 8 or less characters!");
        return false;
    }
    else if(!hasCapital(password)){
        alert("Password must have at least one capital letter!");
        return false;
    }
    else if(!hasNumber(password)){
        alert("Password must have at least one number!");
        return false;
    }
    else if(id.length !== 8){
        alert("ID must be 8 digits!");
        return false;
    }
    else if(hasCapital(id.toUpperCase())){
        alert("ID must be only numbers!");
        return false;
    }
    else if(emailRequested) {
        if (email.length < 5 || !email.includes("@") || !email.includes(".")) {
            alert("Please enter a valid email!");
            return false;
        }
        else if(email.split("@").length>2 || email.split(".").length>2){
            alert("Please enter a valid email!");
            return false;
        }
        else if(!email.split("@")[1].includes(".")){
            alert("Please enter a valid email!");
            return false;
        }
    }

    return true;
}

function validate_registration(form){
    let name = form.name.value;
    let password = form.password.value;
    let id = form.id.value;
    let email = form.email.value;

    if(password.length>8){
        alert("Password must be 8 or less characters!");
        return false;
    }
    else if(!hasCapital(password)){
        alert("Password must have at least one capital letter!");
        return false;
    }
    else if(!hasNumber(password)){
        alert("Password must have at least one number!");
        return false;
    }
    else if(id.length !== 8){
        alert("ID must be 8 digits!");
        return false;
    }
    else if(hasCapital(id.toUpperCase())){
        alert("ID must be only numbers!");
        return false;
    }
    else if (email.length < 5 || !email.includes("@") || !email.includes(".")) {
        alert("Please enter a valid email!");
        return false;
    }
    else if(email.split("@").length>2 || email.split(".").length>2){
        alert("Please enter a valid email!");
        return false;
    }
    else if(!email.split("@")[1].includes(".")){
        alert("Please enter a valid email!");
        return false;
    }

    return true;
}