const password = document.getElementById('NewPassword');
const ConfPassword = document.getElementById('ConfPassword');
const Email = document.getElementById('Email');
const Prenom = document.getElementById('Prenom');
const Nom = document.getElementById('Nom');

let boutton = document.getElementById('ButtonSign');
const Form = document.getElementById('FormConSign');
let ErreurPassword = document.getElementById('ErreurPassword');
let ErreurName = document.getElementById('ErreurName');
let ErreurPrenom = document.getElementById('ErreurPrenom');
let ErreurEmail = document.getElementById('ErreurEmail');



function VerifPassword(){
    if(password.value != ConfPassword.value || password.value == "" || ConfPassword == ""){
        ErreurPassword.innerText = "les mot de passe ne sont pas valide !!!";
        ErreurPassword.classList.remove('display');
        return false;
    } 
    else{
        ErreurPassword.classList.add('display');
        return true;
    }
}
password.addEventListener('focusout', VerifPassword);

function VerifEmail1(){
    if(Email.value == ""){
        ErreurEmail.innerText = "l'Email n'est pas valdide !!!";
        ErreurEmail.classList.remove('display');
        return false;
    } 
    else{
        ErreurEmail.classList.add('display');
        return true;
    }
}
Email.addEventListener('focusout', VerifEmail1)

function VerifPrenom(){
    if(Prenom.value == ""){
        ErreurPrenom.innerText = "Le prenom n'est pas valide !!!";
        ErreurPrenom.classList.remove('display');
        return false;
    }
    else{
        ErreurPrenom.classList.add('display');
        return true;
    }
}
Prenom.addEventListener('focusout', VerifPrenom);


function VerifNom(){
    if(Nom.value == ""){
        ErreurName.innerText = "Le nom n'est pas valide !!!";
        ErreurName.classList.remove('display');
        return false;
    }
    else{
        ErreurName.classList.add('display');
        return true;
    }
}
Nom.addEventListener('focusout', VerifNom);

function CheckSubmit(event){
    //empeche la soumission par default
    event.preventDefault();

    //vérifie si le formulaire est bien remplie, dans le cas contraire empêche la soumission
    if(VerifEmail1() && VerifNom() && VerifPassword() && VerifPrenom()){
        Form.submit();
    }
    else{
        return false;
    }
}