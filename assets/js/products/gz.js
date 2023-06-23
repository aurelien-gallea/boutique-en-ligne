const messageInfo = document.querySelector("#messageInfo");
messageInfo.textContent = "En attente de la réponse de votre banque"
let delay = 5000;
setTimeout(() => {

    messageInfo.innerHTML = `Félicitation votre paiement a été accepté ! <br> Redirection automatique dans ${delay / 1000} secondes`;
    const remaining = setInterval(() => {
        messageInfo.innerHTML = `Félicitation votre paiement a été accepté ! <br> Redirection automatique dans ${delay / 1000} secondes`;
        
        delay -= 1000;
        if (delay < 0) {
            clearInterval(remaining);
            
            window.location.href = "./"; // <--- a modifier plus tard
        }
    }, 1000);
},4000);
