import { addElement } from "../modules/addElement.js";
import { keyPath } from "../modules/key.js";

// nos boutons
const btnMyAddress = document.querySelector("#btnMyAddress");
const btnNewAddress = document.querySelector("#btnNewAddress");
// nos cibles
const myAddress = document.querySelector("#myAddress");
const newAddress = document.querySelector("#newAddress");
const carriers = document.querySelector("#carriers");

// une fonction qui cache / rend visible
const showHiddenToggler = (button, show, hidden) => {
  button.addEventListener("click", () => {
    show.classList.remove("hidden");
    hidden.classList.add("hidden");
  });
};

showHiddenToggler(btnMyAddress, myAddress, newAddress);
showHiddenToggler(btnNewAddress, newAddress, myAddress);

// récupérations de tous les noms d'adresses pour bloquer en cas de doublons
// ici tous les inputs radios
const deliveryNames = document.querySelectorAll(".js-delivery");

// récupérations de toutes les adresses existantes pour les reaficher entièrement APRES selection
const jsFirstname = document.querySelectorAll(".jsFirstname");
const jsLastname = document.querySelectorAll(".jsLastname");
const jsAddress = document.querySelectorAll(".jsAddress");
const jsPostalCode = document.querySelectorAll(".jsPostalCode");
const jsCity = document.querySelectorAll(".jsCity");
const jsCountry = document.querySelectorAll(".jsCountry");
const jsPhone = document.querySelectorAll(".jsPhone");

let arrayDeliveryNames = [];
let arrayFullDelivery = [];
let deliveryChoiceIndex = 0;
// on remplit un tableau de nom pour éviter les doublons
deliveryNames.forEach((element) => {
  arrayDeliveryNames.push(element.value);
});

// remplir un tableau à plusieurs dimensions pour récuperer les adresses complètes déjà existantes

for (let i = 0; i < deliveryNames.length; i++) {
  const addN = deliveryNames[i].value;
  const fn = jsFirstname[i].value;
  const ln = jsLastname[i].value;
  const add = jsAddress[i].value;
  const pc = jsPostalCode[i].value;
  const cit = jsCity[i].value;
  const coun = jsCountry[i].value;
  const phon = jsPhone[i].value;

  arrayFullDelivery.push({
    addressName: addN,
    firstname: fn,
    lastname: ln,
    address: add,
    postalCode: pc,
    city: cit,
    country: coun,
    phone: phon,
  });
}
console.log(arrayFullDelivery);

// le bloc récapitulatif pour l'adresse sélectionné -----------------
const nextAddress = document.querySelector("#nextAddress");
const adName = document.querySelector("#adName");
const person = document.querySelector("#person");
const adDelivery = document.querySelector("#adDelivery");
const adPcAndCity = document.querySelector("#adPcAndCity");
const adCountry = document.querySelector("#adCountry");
const adPhone = document.querySelector("#adPhone");

// creer le bloc lors de la sélection de l'input radio
for (let i = 0; i < deliveryNames.length; i++) {
  const element = deliveryNames[i];

  element.addEventListener("click", () => {
    myAddress.classList.add("hidden");
    nextAddress.classList.remove("hidden");
    carriers.classList.remove("hidden");
    adName.textContent = "nom : " + arrayFullDelivery[i].addressName;
    person.textContent =
      arrayFullDelivery[i].firstname + " " + arrayFullDelivery[i].lastname;
    adDelivery.textContent = arrayFullDelivery[i].address;
    adPcAndCity.textContent =
      arrayFullDelivery[i].postalCode + " " + arrayFullDelivery[i].city;
    adCountry.textContent = arrayFullDelivery[i].country;
    adPhone.textContent = arrayFullDelivery[i].phone;
    deliveryChoiceIndex = i;
    console.log("delivery = " + i);
  });
}

// le formulaire d'ajout d'adresse -------------------------------------------
const addNewAddress = document.querySelector("#addNewAddress");
// les inputs
const nameAddress = document.querySelector("#nameAddress");
const firstname = document.querySelector("#firstname");
const lastname = document.querySelector("#lastname");
const address = document.querySelector("#address");
const postalCode = document.querySelector("#postalCode");
const city = document.querySelector("#city");
const country = document.querySelector("#country");
const phone = document.querySelector("#phone");
const confirmAddress = document.querySelector("#confirmAddress");

// message d'erreur
const errorMsg = document.querySelector("#errorMsg");

// bloquer le comportement du navigateur pour executer une promesse
// et modifier le visuel pour montrer que les données ont été ajoutées

// si le nom est en doublon on bloque le formulaire
nameAddress.addEventListener("keyup", () => {
  if (arrayDeliveryNames.indexOf(nameAddress.value) !== -1) {
    confirmAddress.disabled = true;
    confirmAddress.style.cursor = "not-allowed";
    errorMsg.textContent = "Nom déjà existant !";
  } else {
    confirmAddress.disabled = false;
    confirmAddress.style.cursor = "";
    errorMsg.textContent = "";
  }
});

// le formulaire de nouvelle adresse ----------------------------------
addNewAddress.addEventListener("submit", (e) => {
  e.preventDefault();
  const nameAdValue = nameAddress.value;
  const firstnameToCapitalize =
    firstname.value.charAt(0).toUpperCase() + firstname.value.slice(1);
  const lastnameToUpperCase = lastname.value.toUpperCase();
  const addValue = address.value;
  const PcToNb = Number(postalCode.value);
  const cityToUpperCase = city.value.toUpperCase();
  const countryToUpperCase = country.value.toUpperCase();
  const phoneValue = phone.value;

  const jsonValidation = {
    nameAddress: nameAdValue,
    firstname: firstnameToCapitalize,
    lastname: lastnameToUpperCase,
    address: addValue,
    postalCode: PcToNb,
    city: cityToUpperCase,
    country: countryToUpperCase,
    phone: phoneValue,
  };

  console.log(jsonValidation);
  //   on envoie notre json vers la BDD
  fetch(`${keyPath}addToDelivery.php`, {
    method: "POST",

    body: JSON.stringify(jsonValidation),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => {
      // on écrit la suite de l'interaction dans le bloc
      newAddress.classList.add("hidden");
      nextAddress.classList.remove("hidden");
      carriers.classList.remove("hidden");

      if (response.ok) {
        adName.textContent = `${nameAdValue}`;
        person.textContent = `${lastnameToUpperCase}  ${firstnameToCapitalize}`;
        adDelivery.textContent = `${addValue}`;
        adPcAndCity.textContent = `${PcToNb} ${cityToUpperCase}`;
        adCountry.textContent = `${countryToUpperCase}`;
        adPhone.textContent = `${phoneValue}`;
      } else {
        adName.textContent =
          "Suite à un problème, l'ajout de la nouvelle adresse est impossible, merci de rechager la page et renouveler l'opération. Si le problème persiste, contactez un administrateur.";
      }
    })
    .catch(function (error) {
      console.log(error);
    });
});

// le choix du service de livraison
//  récupérations de toutes les input hidden des livreurs dans un tableau
const carriersRadio = document.querySelectorAll(".js-carriers");
const jsCarName = document.querySelectorAll(".jsCarName");
const jsCarDesc = document.querySelectorAll(".jsCarDesc");
const jsCarPrice = document.querySelectorAll(".jsCarPrice");

// le bouton de confirmation pour valider les informations et passer à la page suivante
const goBack = document.querySelector("#goBack");
const confirmAll = document.querySelector("#confirmAll");

let arrayCarriers = [];
let carriersCurrentIndex = 0;
for (let i = 0; i < carriersRadio.length; i++) {
  const jsCname = jsCarName[i].value;
  const jsCdesc = jsCarDesc[i].value;
  const jsCprice = jsCarPrice[i].value;

  arrayCarriers.push({
    name: jsCname,
    description: jsCdesc,
    price: jsCprice,
  });

  carriersRadio[i].addEventListener("click", () => {
    console.log(carriersRadio[i].value);
    carriersCurrentIndex = i;
    confirmAll.classList.remove("hidden");
    goBack.classList.remove("hidden");
  });
}
// le bouton goBack

goBack.addEventListener("click", () => {
  window.history.back();
});
// on récupère le panier actuel
fetch(`${keyPath}checkMyCart.php`)
  .then((response) => response.json())
  .then((values) => {
    console.log(values);
    let stringProdIds = "";
    let stringColorIds = "";
    let stringSizeIds = "";
    const cart = values.cart;
    let arrayPrices = [];

    cart.map((product) => {
      if (product === cart[cart.length-1]) {
        stringProdIds += `${product.productId}`;
        stringColorIds += `${product.colorId}`;
        stringSizeIds += `${product.sizeId}`;
      } else {
        stringProdIds += `${product.productId}, `;
        stringColorIds += `${product.colorId}, `;
        stringSizeIds += `${product.sizeId}, `;
      }
      arrayPrices.push(product.price * product.quantity);
    });
    const initialValue = 0;
    const totalPrice = arrayPrices.reduce((accumulator, currentValue) => accumulator + currentValue,
    initialValue);
    console.log(totalPrice);
    console.log(arrayPrices);
    console.log(stringProdIds);
    console.log(stringColorIds);
    console.log(stringSizeIds);
    // le bouton étape suivante
    confirmAll
      .addEventListener("click", () => {
        // on récupère toutes les valeurs saisies du formulaire et ont les envoient

        const deliveryFullAdress = `${person.textContent}, ${adDelivery.textContent},
      ${adPcAndCity.textContent}, ${adCountry.textContent}`;
        const carriersDetails = `${arrayCarriers[carriersCurrentIndex].name}, ${arrayCarriers[carriersCurrentIndex].description}`;
        const carriersPrice = Number(arrayCarriers[carriersCurrentIndex].price);
        const totalAmount = totalPrice + carriersPrice;
        const jsonOrderData = {
          deliveryFullAddress: deliveryFullAdress,
          carriersDetails: carriersDetails,
          carriers_price: carriersPrice,
          products_ids: stringProdIds,
          color_ids: stringColorIds,
          size_ids: stringSizeIds,
          quantity: cart.length,
          total_amount: totalAmount.toFixed(2),
        };

        fetch(`${keyPath}addToOrderdetails.php`, {
          method: "POST",

          body: JSON.stringify(jsonOrderData),
          headers: {
            "Content-Type": "application/json",
          },
        })
          .then((response) => {
            if (response.ok) {
              // on redirige vers la page récapitulatif en cas de succès
              window.location.href = "./resume.php";
            } else {
              alert("problème detecté merci de contacter un administrateur.");
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      });
    })
    .catch((error) => console.log(error));
