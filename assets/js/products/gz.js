import { keyPath } from "../modules/key.js";

const messageInfo = document.querySelector("#messageInfo");
messageInfo.textContent = "En attente de la réponse de votre banque";
let delay = 5000;
setTimeout(() => {
  // récupération de la commande en cours
  fetch(`${keyPath}checkMyOrder.php`) // a remplacer plus tard par une API : paypal /stripe
    .then((response) => response.json())
    .then((bank) => {
      
      //   lorsque la banque accepte le paiement on envoie les données à la table orderfinal pour terminer l'achat
      const bankResponse = true; // simulation de la variable récupéré
      const jsonOrderData = { payement_status: bankResponse };

    //   on remplit la table orderfinal
      fetch(`${keyPath}addToOrderfinal.php`, {
        method: "POST",

        body: JSON.stringify(jsonOrderData),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          if (response.ok) {
            messageInfo.innerHTML = `Félicitation votre paiement a été accepté ! <br> Redirection automatique dans ${
                    delay / 1000
                  } secondes`;
                  const remaining = setInterval(() => {
                    messageInfo.innerHTML = `Félicitation votre paiement a été accepté ! <br> Redirection automatique dans ${
                      delay / 1000
                    } secondes`;

                    delay -= 1000;
                    if (delay < 0) {
                      clearInterval(remaining);

                      window.location.href = "./"; // <--- a modifier plus tard vers "commande passé";
                    }
                  }, 1000);            
          } else {
            alert("problème detecté merci de contacter un administrateur.");
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    });
}, 3000);
