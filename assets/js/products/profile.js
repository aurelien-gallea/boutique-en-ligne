import { keyPath } from "../modules/key.js";
import { addToast } from "../modules/addToast.js";
// formulaire n 1
const block1 = document.querySelector("#block1");
const firstname = document.querySelector("#firstname");
const lastname = document.querySelector("#lastname");
const password = document.querySelector("#password");
const divBtn = document.querySelector("#divBtn"); // div du button 1er formulaire
const btn = document.querySelector("#btn"); // boutton 1er formulaire
const passWindow = document.querySelector("#passWindow"); // lien vers le 2e form

// formulaire n 2
const block2 = document.querySelector("#block2");
const pass1 = document.querySelector("#passChange1"); // ancien mdp
const pass2 = document.querySelector("#passChange2"); // nouveau mdp
const pass3 = document.querySelector("#passChange3"); // confirmer nouveau mdp
const notMatch = document.querySelector("#notMatch"); // message d'erreur form 2
const divBtn2 = document.querySelector("#divBtn2"); // div du button 2e formaulaire
const btn2 = document.querySelector("#btn2"); // boutton 2e formulaire
const userWindow = document.querySelector("#userWindow"); // lien vers le 1er form

block2.style.display = "none"; // on cache par défaut le block2: le changement de mdp

// activation du boutton
function enabledBtn(button, divButton) {
  button.disabled = false;
  button.style.cursor = "pointer";
  divButton.style.filter = "opacity(1)";
}
// desactivation du boutton
function disabledBtn(button, divButton) {
  button.disabled = true;
  button.style.cursor = "not-allowed";
  divButton.style.filter = "opacity(0.2)";
}

disabledBtn(btn2, divBtn2); // état initial du boutton 2

// pareil on désactive le 2e formulaire tant que le mdp ne respecte pas le regex
function disabledForm2(nameInput, event) {
  nameInput.addEventListener(event, () => {
    if ((pass2.value === pass3.value) && pass2.value.length > 0 && pass3.value.length > 0  && pass1.value.length > 0 ) {
      enabledBtn(btn2, divBtn2);
      notMatch.style.visibility = "hidden";
    } else {
      disabledBtn(btn2, divBtn2);
      notMatch.style.visibility = "visible";
    }
  });
}

//le lien qui fait apparaitre le 2e formulaire et disparaitre le 1er
passWindow.addEventListener("click", (e) => {
  e.preventDefault();
  block2.style.display = "block";
  block1.style.display = "none";
});

//le lien qui fait apparaitre le 1e formulaire et disparaitre le 2eme
userWindow.addEventListener("click", (e) => {
  e.preventDefault();
  block2.style.display = "none";
  block1.style.display = "block";
});

// on est à l'affût du moindre changement dans les inputs
// pour désactiver le formulaire
disabledForm2(pass1, "keyup");
disabledForm2(pass2, "keyup");
disabledForm2(pass3, "keyup");

// changement nom/prenom - block1
btn.addEventListener("click", (e) => {
  e.preventDefault();
  if (
    firstname.value.length > 0 &&
    lastname.value.length > 0 &&
    password.value.length > 0
  ) {
    const jsonValue = {
      firstname: firstname.value,
      lastname: lastname.value,
      password: password.value,
    };

    fetch(`${keyPath}updateMe.php`, {
      method: "POST",

      body: JSON.stringify(jsonValue),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => {
        if (response.ok) {
          response.text().then((result) => {
            const items = JSON.parse(result);

            if(items.correct) {
                
                addToast("Profil Mis à jour ! ", "success", block1);
            } else {
                addToast("Mot de passe Incorrect ! ", "danger", block1);
                
            }
          });
        } else {
          alert("problème detecté merci de contacter un administrateur.");
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  }
  password.value="";
});

// changement mot de passe - block2
btn2.addEventListener("click", (e) => {
    e.preventDefault();
    if (
        pass1.value.length > 0 &&
        pass2.value.length > 0 &&
        pass3.value.length > 0
      ) {
      const jsonValue = {
        pass1: pass1.value,
        pass2: pass2.value,
        pass3: pass3.value,
      };
  
      fetch(`${keyPath}updateMyPass.php`, {
        method: "POST",
  
        body: JSON.stringify(jsonValue),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          if (response.ok) {
            response.text().then((result) => {
                console.log(result);
              const items = JSON.parse(result);
  
              if(items.correct) {
                  
                  addToast("Mot de passe mis à jour ! ", "success", block2);
              } else {
                  addToast("Mot de passe Incorrect ! ", "danger", block2);
                  
              }
            });
          } else {
            alert("problème detecté merci de contacter un administrateur.");
          }
        })
        .catch(function (error) {
          console.log(error);
        });
      }
      pass1.value = "";
      pass2.value ="";
      pass3.value="";
  });