"use strict";
import { keyPath } from "../modules/key.js";

fetch(`${keyPath}productCard.php`)
  .then((response) => response.json())
  .then((data) => {
    //  on créé une carte représentant notre article tant qu'il y'en as
    
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
    
    if (data.images.length > 1) {
      for (const key in data.images) {
        const stash = data.images[key];
        myKeyColor = key;
        // on affiche l'image correspondante au produit
        if (stash.product_id === product.id) {
          cardImg.src = `./Public/img/product/${stash.path}`;
          cardImg.setAttribute("alt", product.name);
         
        }
      }
    } else if (data.images.length === 1) {
      const stash = data.images[0];
      // on affiche l'image correspondante au produit
      if (stash.product_id === product.id) {
        cardImg.src = `./Public/img/product/${stash.path}`;
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
      
      btnColor.classList.add("m-3", "py-2", "px-2");

      // on envoie les données dans le conteneur parent
      btnSubContainer.append(btnColor, label);

      // on crée l'interaction de changement de photo en cas de clique sur le bouton
      // attention cet algo ne fonctionne que s'il n'y a qu'une seule image par couleur
      const colorEventHandler = (action) => {

        btnColor.addEventListener(action, () => {
          
          try {
            cardImg.src =`./Public/img/product/${data.images[key].path}`;
          } catch {
            cardImg.src =`./Public/img/product/${data.images[0].path}`;
          };
          
          // on réasigne une valeur si jamais on change la couleur
          myKeyColor = key;
          sizeRangeByColor(myKeyColor);
        });
      }
      
      colorEventHandler("focus");
    }

    // récupération des tailles
    const select = document.querySelector('#js-select');
    
    const colorRange = data.color.length;
    
    // on rempli notre select avec les balises options remplies dynamiquement
    let sizeRange = data.size[colorRange - 1].size;
    
    const sizeRangeByColor = (colorIndex = colorRange-1) => {
      select.innerHTML = '';
      sizeRange = data.size[colorIndex].size;
      
      for (const key in sizeRange) {
        const row = sizeRange[key];
        const option = document.createElement("option");
        option.value = row.id;
        
        option.textContent = row.size;
        // on rajoute dans le conteneur parent
        select.append(option);
      }
    };

    sizeRangeByColor();
    
    // le bouton d'ajout au panier
    
    const quantity = document.querySelector('#js-quantity');
    const addToCart = document.querySelector('#js-addToCart');

    // initialisation du choix de la taille et quantité par défaut (la longueur du tableau -1)
    let mySize = data.size[data.size.length-1].size[0].size;
    let mySizeId = data.size[data.size.length-1].size[0].id;
    let myQty = quantity.value;

    // on recupère la valeur de la taille et la quantité
    select.addEventListener("change", () => {
      mySize = select.textContent;
      mySizeId = select.value;
      
    });
    quantity.addEventListener("change", () => (myQty = quantity.value));

    // on créé une intéraction à la fin de toutes les promesses pour associer toutes les valeurs envoyés à la vue
    const radios = document.querySelectorAll('input[type="radio"]');
    radios[radios.length-1].checked = true;
    radios[radios.length-1].focus();
    

    // gestion du formulaire en asynchrone
    addToCart.addEventListener("click", function () {
      
      if (quantity.value > 0) {
        
        fetch(`${keyPath}addToCart.php`, {
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
          // on réinitialise les valeurs par défaut en cas de ressoumission du formulaire
          quantity.value = 1;
          myQty = quantity.value;
        })
        .catch(function (error) {
          console.log("pb");
        });
        
      }
      });

      

  })
  .catch((error) => console.log(error));

  
