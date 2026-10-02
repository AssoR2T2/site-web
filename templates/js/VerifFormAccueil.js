const password2 = document.getElementById('password2');
const ConfPassword2 = document.getElementById('ConfPassword2');
const Email2 = document.getElementById('Email2');
const Prenom2 = document.getElementById('prenom2');
const Nom2 = document.getElementById('nom2');

let boutton2 = document.getElementById('ButtonSign');
const Form2 = document.getElementById('inscriptionFast');
let ErreurPassword2 = document.getElementById('ErreurPassword2');
let ErreurName2 = document.getElementById('ErreurNom2');
let ErreurPrenom2 = document.getElementById('ErreurPrenom2');
let ErreurEmail2 = document.getElementById('ErreurEmail2');



function VerifPassword2(){
    if(password2.value != ConfPassword2.value || password2.value == "" || ConfPassword2 == ""){
        ErreurPassword2.innerText = "les mot de passe ne sont pas valide !!!";
        ErreurPassword2.classList.remove('display');
        return false;
    } 
    else{
        ErreurPassword2.classList.add('display');
        return true;
    }
}
password2.addEventListener('focusout', VerifPassword2);

function VerifEmail2(){
    if(Email2.value == ""){
        ErreurEmail2.innerText = "l'Email n'est pas valdide !!!";
        ErreurEmail2.classList.remove('display');
        return false;
    } 
    else{
        ErreurEmail2.classList.add('display');
        return true;
    }
}
Email2.addEventListener('focusout', VerifEmail2)

function VerifPrenom2(){
    if(Prenom2.value == ""){
        ErreurPrenom2.innerText = "Le prenom n'est pas valide !!!";
        ErreurPrenom2.classList.remove('display');
        return false;
    }
    else{
        ErreurPrenom2.classList.add('display');
        return true;
    }
}
Prenom2.addEventListener('focusout', VerifPrenom2);


function VerifNom2(){
    if(Nom2.value == ""){
        ErreurName2.innerText = "Le nom n'est pas valide !!!";
        ErreurName2.classList.remove('display');
        return false;
    }
    else{
        ErreurName2.classList.add('display');
        return true;
    }
}
Nom2.addEventListener('focusout', VerifNom2);

function CheckSubmit2(event){
    //empeche la soumission par default
    event.preventDefault();

    //vérifie si le formulaire est bien remplie, dans le cas contraire empêche la soumission
    if(VerifEmail2() && VerifNom2() && VerifPassword2() && VerifPrenom2()){
        Form2.submit();
    }
    else{
        return false;
    }
}