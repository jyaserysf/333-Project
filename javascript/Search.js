
/*function Search(input){
const xhttp=new XMLHttpRequest();
xhttp.onload=myAJAXFunction;
xhttp.open("GET","Search.php?S="+input);
xhttp.send();

}

function myAJAXFunction(){
document.getElementById("results").innerHTML=this.responseText;
alert("meow");
}
*/

function Search(user){
    if (user.length == 0){
        document.getElementById('results').innerText="";
        return;
    }
    const xHttp = new XMLHttpRequest();
    xHttp.onreadystatechange = function(){
        if (this.readyState==4 && this.status== 200){
            document.getElementById('results').innerHTML = this.responseText;
            
        }
    };
    xHttp.open("GET","Search.php?S="+user)
    xHttp.send(null);
}



