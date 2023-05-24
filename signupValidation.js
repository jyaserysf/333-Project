const form=document.getElementById('form');
const username= document.getElementById("username");
const email = document.getElementById("email");
const password =document.getElementById("password");
const passwordVerify=document.getElementById("cpassword");


//event listener for submit 

form.addEventListener('submit',function(e) {

   e.preventDefault();

    let errors=0;
        //validate all inputs 
        errors+=checkRequired([username,email,password,passwordVerify]);
        errors+=checkLength(username,3,14);
        errors+=checkLength(password,3,14);
        errors+=checkemail(email);
        errors+=checkPasswrodsMatch(password,passwordVerify);


        //if there is no errors submit 
        if(errors==0){
            form.submit();
        }
}

);

function showError(input,message){
    const inputarea=input.parentElement;
    inputarea.className='input-area error';
    const small =inputarea.querySelector('small');
    small.innerText=message;


}

function showSuccess(input){
    const inputarea=input.parentElement;
   inputarea.className='input-area success';
}

function checkRequired(userinputARR){
let error=0;
userinputARR.foreach(function(input){

    if(input.value.trim()===''){

            showError(input, `${getFieldName(input)} is required `);
            ++error;
    }else{
        showSuccess(input);
    }

})
        return error;
};

//get field name 

function getFieldName(input){
     
    return input.id.charAT(0).toUpperCase() + input.className.slice(1);
}

//check input length 

function checkLength(input,min,max){
    let error=0;

    if(input.value.length < min ){

        showError(

            input,`${getFieldName(input)} must be atleast ${min} characters `

        );
        ++error;
    }else if(input.value.length>max){
        showError(
            input, `${getFieldName(input) } must be less tha ${max} charachters ` );

            ++error;
        }
    else{
        showSuccess(input);
    }
    
    return error;
}

//check if email is valid

function checkemail(input){

    let error=0;

    const ex=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if(ex.test(input.value.trim())){
        showSuccess(input);
    }else{
        showError(input,'Email is not valid');
        ++error;
    }
    return error;
}

function checkPasswrodsMatch(input1,input2){
    let error=0;
    if(input1.value !== input2.value){
        showError(input2 , 'password do not match');
        ++error;
    }
    return error;
}