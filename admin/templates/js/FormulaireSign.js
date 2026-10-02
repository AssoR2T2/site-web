const imgValue = document.getElementById('img');
imgValue.addEventListener('click', openFile);
const img = document.getElementById('file');
img.addEventListener('change', afficheImg);

//en appuyant sur le bouton cela click sur le input
function openFile(){
    const file = document.getElementById('file');
    file.click();
    const img = document.getElementById('file');
}

//affiche l'image dans un container

function afficheImg(event){
    let imgSignalement = document.getElementById('imgSignalement');
    
    if(event.target.files.length <= 2){
        //verifie si une balise img existe et la supprime
        for(let i = 0; i < imgSignalement.children.length; i++){
            imgSignalement.children[i].remove();
        }

        //récupere un lien pour l'afficher
        for(let a = 0; a < event.target.files.length; a++){
            const url = event.target.files[a];

            if(url){
                const CreatImg = document.createElement("img");
                imgSignalement.appendChild(CreatImg);
                const fileURL = URL.createObjectURL(url);
                CreatImg.src = fileURL;
                CreatImg.classList = "TailleImage";
            }
        }
    }
    else{
        alert("vous pouvez mettre que 2 image maximum");
    }  
}