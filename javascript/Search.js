
function Searchbar(input){
const xhttp=new XMLHttpRequest();
xhttp.onload=myAJAXFunction;
xhttp.open("GET","Search.php?S="+input);
xhttp.send();

}
function myAJAXFunction(){
document.getElementById("results").innerHTML=this.responseText;

}


document.getElementById("results").style.display = "none";


document.getElementById("results").style.visibility = "hidden".innerHTML=this.responseText;