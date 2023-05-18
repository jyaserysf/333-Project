if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
  
const inputs = document.querySelectorAll(".input-field");

inputs.forEach((inp) => {
    inp.addEventListener("focus", () => {
        inp.classList.add("active");
    });
    inp.addEventListener("blur", () => {
        if(inp.value != "") return;
        inp.classList.remove("active");
    });
});


let profile_pic = document.getElementById("profilePicture");
let image_file = document.getElementById("image-file")

image_file.onchange = function()
{
  profile_pic.src = URL.createObjectURL(image_file.files[0]);
}

/*
var changePasswordButton = document.getElementById("sf2");
var form2 = document.getElementById("form2");

changePasswordButton.addEventListener("click", function() {
    form2.style.display = "block";
});
*/
