import { keyPath } from "../modules/key.js";

const errorMsg = document.querySelector('#errorMsg');
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const confirmPassword = document.querySelector("#confirm-password");
const signUp = document.querySelector("#signUp");

const btnOff = () => {
    signUp.disabled = true;
    signUp.style.cursor = "not-allowed";
    
}

const btnOn = () => {
    signUp.disabled = false;
    signUp.style.cursor = "pointer";
}

// à chaque changement de value on envoie une promesse
email.addEventListener('keyup', ()=>
{   
       
    fetch(`${keyPath}checkAvailable.php`,{
    method: "POST",

    body: 'email=' + email.value,
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  })
    .then((response) => {
      if (response.ok) {
        response.text().then(status => {

            // on utilise trim() pour éviter les caractères d'échappements
            if (status.trim() === "used") {
                
                errorMsg.textContent = "adresse email déjà utilisée !"
                btnOff();
            }else {
                errorMsg.textContent = "";
                btnOn();
            }
            
        });
      } else {
        alert("problème detecté merci de contacter un administrateur.");
      }
    })
    .catch(function (error) {
      console.log(error);
    });

});

function passChecker(inputPass) {
    inputPass.addEventListener('keyup', () => {
        if (password.value !== confirmPassword.value)  {
                
            errorMsg.textContent = "Les mots de passes ne correspondent pas !";
            btnOff();
        } else {
            errorMsg.textContent = "";
            btnOn();
        }
    });
}

passChecker(password);
passChecker(confirmPassword);