let recherche = document.getElementById('recherche');
let quit = document.getElementById('quit');
document.getElementById(quit).style.display = none;

function search(){
    document.getElementById(quit).style.display = none;
    if (recherche !=""){
        document.getElementById(quit).style.display = block;

    }
}
