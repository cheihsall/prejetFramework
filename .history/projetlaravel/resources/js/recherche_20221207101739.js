let recherche = document.getElementById('recherche');
let quit = document.getElementById('quit');
function search(){
    document.getElementById("quit").style.display = none;
    if (recherche !=""){
        document.getElementById(identifiant_de_ma_div).style.display = block;

    }else{
        quit.classList.remove("none")

    }
}
