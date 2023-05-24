document.getElementById("results").style.display = "none";
function Searchbar(input){
    if (input.length==0){
        document.getElementById("results").style.display = "none";
        return;
    }
const xhttp=new XMLHttpRequest();
xhttp.onload=myAJAXFunction;
xhttp.open("GET","Search.php?S="+input);
xhttp.send();
}
function myAJAXFunction(){
    document.getElementById("results").style.display = "block";
document.getElementById("results").innerHTML=this.responseText;
}
const xhttp=new XMLHttpRequest();
xhttp.onload=myAJAXFunction;
xhttp.open("GET","answerSurvey.php?id="+input);
xhttp.send();

