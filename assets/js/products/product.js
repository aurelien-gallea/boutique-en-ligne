"use strict";
import { key } from "../modules/key.js";

// Définir la variable que vous souhaitez envoyer
let myVariable = 3;
// Utilisation de fetch pour effectuer une requête POST vers le fichier PHP
fetch(`${key}productCard.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ variable: myVariable }),
  })
  .then(function(response) {
    if (response.ok) {
      // La requête a réussi
      return response.json();
    } else {
      // La requête a échoué
      throw new Error('Erreur lors de la requête.');
    }
  })
  .then(function(data) {
    // Utilisez les données retournées par le fichier PHP dans votre promesse
    console.log(data);
  })
  .catch(function(error) {
    // Gérer les erreurs
    console.log(error);
  });

// le container global de toutes nos cards
const container = document.querySelector(".myDiv");
container.classList.add("flex", "flex-grow", "gap-3", "my-6", "justify-center");

setTimeout(() => {
    
    fetch(`${key}productCard.php`)
    .then(response => response.json())
    .then(data => {
        
        //  on créé un carte représentant notre article tant qu'il y'en as
        console.log(data)
        for (const key in data.products) {
            
            const product = data.products[key];
            
            // console.log(product);
            
            // la card 
            const card = document.createElement("a");
            card.classList.add("flex", "flex-col", "border", "rounded", "p-2", "w-60", "gap-3");
            card.href = `product.php?id=${product.id}`;
            // le titre dans la carte - creation et personnalisation
            const cardHeader = document.createElement('div');
            cardHeader.innerHTML = `<span>${product.name}</span>`;
            
            // l'image dans la carte - creation et personnalisation
            const cardImg = document.createElement('img');
            for (const key in data.stock) {
                
            const stash = data.stock[key];
            
            // on affiche l'image correspondante au produit
            if (stash.product_id === product.id) {
                cardImg.src = `${stash.path}`;
            } 
            
        }
        
        // la description dans la carte - creation et personnalisation
        const cardDesc = document.createElement('div');
        cardDesc.innerHTML=`<p>${product.description}</p>`;
        
        // on ajoute aux parents
        card.append(cardHeader, cardImg, cardDesc);
        container.append(card);
    }
})
.catch(error => console.log(error));
}, 300);