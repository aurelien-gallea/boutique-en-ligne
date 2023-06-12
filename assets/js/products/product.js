"use strict";
import { key } from "../modules/key.js";

fetch(`${key}productCard.php`)
  .then((response) => response.json())
  .then((data) => {
    //  on créé une carte représentant notre article tant qu'il y'en as
    console.log(data);
    console.log(data.images);

    const product = data.products;
    const color = data.color;

    // la card
    const card = document.querySelector("#js-card");

    // notre variable de choix de couleur
    let myKeyColor = 0;

    // le titre dans la carte - selection et personnalisation
    const productName = document.querySelector("#js-productName");
    productName.innerHTML = product.name;

    // l'image dans la carte - selection et personnalisation
    const cardImg = document.querySelector("#js-cardImg");
    console.log(data.images.length);
    if (data.images.length > 1) {
      for (const key in data.images) {
        const stash = data.images[key];
        myKeyColor = key;
        // on affiche l'image correspondante au produit
        if (stash.product_id === product.id) {
          cardImg.src = `${stash.path}`;
          cardImg.setAttribute("alt", product.name);
          // }
          console.log(stash.path);
        }
      }
    } else if (data.images.length === 1) {
      const stash = data.images[0];
      // on affiche l'image correspondante au produit
      if (stash.product_id === product.id) {
        cardImg.src = `${stash.path}`;
        // }
        console.log(stash.path);
      }
    } else {
      console.log("aucunes images");
    }

    // la description dans la carte - selection et personnalisation
    const cardDesc = document.querySelector("#js-cardDesc");
    cardDesc.innerHTML = product.description;

    // l'affichage du prix
    const priceContainer = document.querySelector("#js-price");
    priceContainer.innerHTML = `${data.price[0].price} €`;

    // le container du prix et des boutons
    const btnContainer = document.querySelector("#js-btnContainer");
    const btnSubContainer = document.querySelector("#js-btnSubContainer");

    //  on boucle pour creer des boutons correspondants aux couleurs
    for (const key in data.color) {
      // les boutons pour changer les couleurs
      const btnColor = document.createElement("input");
      const label = document.createElement("label");
      label.htmlFor = `${data.color[key].color}`;
      label.textContent = `${data.color[key].color}`;
      btnColor.type = "radio";
      btnColor.name = "choice";
      btnColor.value = `${data.color[key].color}`;

      //  on selectionne le bouton radio qui correspond à l'image et on le met en checked
      data.color.length - 1 == key ? (btnColor.checked = true) : null;

      btnColor.classList.add("m-3", "py-2", "px-2");

      // on envoie les données dans le conteneur parent
      btnSubContainer.append(btnColor, label);

      // on crée l'interaction de changement de photo en cas de clique sur le bouton
      // attention cet algo ne fonctionne que s'il n'y a qu'une seule image par couleur
      btnColor.addEventListener("click", () => {
        cardImg.src = data.images[key].path;
        // on réasigne une valeur si jamais on change la couleur
        myKeyColor = key;
      });
    }

    // récupération des tailles
    const select = document.querySelector('#js-select');
    
    // for (const key in data.size) {

    //   const colorId = data.size[key].colorId;
    const sizeRange = data.size[0].size;

    // on rempli notre select avec les balises options remplies dynamiquement
    for (const key in sizeRange) {
      const row = sizeRange[key];
      const option = document.createElement("option");
      option.value = row.id;
      
      option.textContent = row.value;
      // on rajoute dans le conteneur parent
      select.append(option);
    }
    // }

    // le bouton d'ajout au panier
    
    const quantity = document.querySelector('#js-quantity');
    
    const addToCart = document.querySelector('#js-addToCart');

    // initialisation du choix de la taille et quantité par défaut
    let mySize = data.size[0].size[0].value;
    let mySizeId = data.size[0].size[0].id;
    let myQty = quantity.value;

    console.log(mySizeId);
    // on recupère la valeur de la taille et la quantité
    select.addEventListener("change", () => {
      mySize = select.textContent;
      mySizeId = select.value;
    });
    quantity.addEventListener("change", () => (myQty = quantity.value));

    // gestion du formulaire en asynchrone
    addToCart.addEventListener("click", function () {
      fetch(`${key}addToCart.php`, {
        method: "POST",

        body: JSON.stringify({
          product_id: product.id,
          color: color[myKeyColor].color,
          color_id: color[myKeyColor].id,
          size: mySize,
          size_id : mySizeId,
          quantity: myQty,
          price: data.price[0].price,
          price_id : data.price[0].id,
        }),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then(function (response) {
          console.log("ok");
        })
        .catch(function (error) {
          console.log("pb");
        });
    });

  })
  .catch((error) => console.log(error));
