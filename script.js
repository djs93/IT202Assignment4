class Patron{
    constructor(name, password, id){
        this.name = name;
        this.password = password;
        this.id = id;
    }

    equals(other){
        if(!(other instanceof Patron)){
            return false;
        }
        if(other.name !== this.name || other.password !== this.password || other.id !== this.id){
            return false;
        }
        return true;
    }
}

let patronDB = [new Patron("Dale Schofield", "Passw0rd", 56420000),
                new Patron("John Doe", "pAnc4ke", 87654321),
                new Patron("Alice Smith", "pAnda44", 84561894),
                new Patron("Bert Wallace", "CinnaM0n", 46464646),
                new Patron("Herb Green", "sQuid16", 78912364),
                new Patron("Shelly Waters", "merMaid1", 51379468)];

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

function verify(name, password, id){
    let tempPatron = new Patron(name, password, id);

    for(let i =0; i<patronDB.length; i++){
        if(patronDB[i].equals(tempPatron)){
            let selections = document.getElementById("transactionType");
            alert("Welcome! You have entered into the system to "+selections.options[selections.selectedIndex].text);
            return true;
        }
    }

    alert("Patron not in DB!");
    return false;
}

function validate(){
    let name = document.getElementById("name").value;
    let password = document.getElementById("password").value;
    let id = document.getElementById("id").value;
    let email = document.getElementById("email").value;
    let emailRequested = document.getElementById("emailConf").checked;

    if(name.length<=0){
        alert("Please enter a name!");
        return;
    }
    else if(password.length<=0){
        alert("Please enter a password!");
        return;
    }
    else if(id===""){
        alert("Please enter an ID!");
        return;
    }
    else if(emailRequested && email===""){
        alert("Please enter an email!");
        return;
    }
    else if(password.length>8){
        alert("Password must be 8 or less characters!");
        return;
    }
    else if(!hasCapital(password)){
        alert("Password must have at least one capital letter!");
        return;
    }
    else if(!hasNumber(password)){
        alert("Password must have at least one number!");
        return;
    }
    else if(id.length !== 8){
        alert("ID must be 8 digits!");
        return;
    }
    else if(hasCapital(id.toUpperCase())){
        alert("ID must be only numbers!");
        return;
    }
    else if(emailRequested) {
        if (email.length < 5 || !email.includes("@") || !email.includes(".")) {
            alert("Please enter a valid email!");
            return;
        }
        else if(email.split("@").length>2 || email.split(".").length>2){
            alert("Please enter a valid email!");
            return;
        }
        else if(!email.split("@")[1].includes(".")){
            alert("Please enter a valid email!");
            return;
        }
    }

    verify(name, password, parseInt(id));
}