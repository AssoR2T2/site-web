let ListObjet = document.getElementsByClassName('list');
let ChooseEtat = document.getElementsByName('ChooseEtat');
let valeur;

ChooseEtat[0].addEventListener('click', filtre);
ChooseEtat[1].addEventListener('click', filtre);

function filtre(){
    for(let a = 0; a < ChooseEtat.length; a++){
        if(ChooseEtat[a].checked){
            valeur = ChooseEtat[a].value;
            break;
        }
    }

    for(let i = 0; i < ListObjet.length; i++){
        let PresentationObjet = ListObjet[i].children[1];
        let EtatObjet = PresentationObjet.children[1].textContent;    
        if(EtatObjet == "perdu" && valeur == "perdu") {
            ListObjet[i].style.display = "";
        }
        else if(EtatObjet == "trouver" && valeur == "trouve"){
            ListObjet[i].style.display = "";
        }
        else{
            ListObjet[i].style.display ="none";
        }
    }
}
