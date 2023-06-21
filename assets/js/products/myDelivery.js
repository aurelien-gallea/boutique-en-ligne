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
    // carriers.classList.remove("hidden");
  });
};

showHiddenToggler(btnMyAddress, myAddress, newAddress);
showHiddenToggler(btnNewAddress, newAddress, myAddress);

// formulaire en cas d'ajout d'une nouvelle adresse
// récupérations de tous les noms d'adresses pour bloquer en cas de doublons
const deliveryNames = document.querySelectorAll(".js-delivery");

let arrayDeliveryNames = [];

deliveryNames.forEach(element => {
    arrayDeliveryNames.push(element.value);
});

// le formulaire d'ajout d'adresse
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

// le bloc dès la selection de l'adresse
const nextAddress = document.querySelector("#nextAddress");
const contentNextAddress = document.querySelector("#contentNextAddress");

// bloquer le comportement du navigateur pour executer une promesse
// et modifier le visuel pour montrer que les données ont été ajoutées

// si le nom est en doublon on bloque le formulaire
nameAddress.addEventListener('keyup', () => {
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

// le formulaire de nouvelle adresse
addNewAddress.addEventListener("submit", (e) => {
    e.preventDefault();
    const nameAdValue = nameAddress.value;
    const firstnameToCapitalize = (firstname.value).charAt(0).toUpperCase() + (firstname.value).slice(1);
    const lastnameToUpperCase = (lastname.value).toUpperCase();
    const addValue = address.value;
    const PcToNb = Number(postalCode.value);
    const cityToUpperCase = (city.value).toUpperCase();
    const countryToUpperCase = (country.value).toUpperCase();
    const phoneValue = phone.value;

    const jsonValidation = {

        nameAddress : nameAdValue,
        firstname : firstnameToCapitalize,
        lastname : lastnameToUpperCase,
        address : addValue,
        postalCode : PcToNb,
        city : cityToUpperCase,
        country : countryToUpperCase ,
        phone : phoneValue
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
    .then(function (response) {
        // on écrit la suite de l'interaction
        newAddress.classList.add("hidden");
        const adName = addElement("h4", ["pb-2"], {}, `nom : ${nameAdValue}`);
        const person = addElement("p", [], {}, `${lastnameToUpperCase}  ${firstnameToCapitalize}`);
        const adDelivery = addElement("p", [], {}, `${addValue}`);
        const adPcAndCity = addElement("p", [], {}, `${PcToNb} ${cityToUpperCase}`);
        const adCountry = addElement("p", ["pb-2"], {}, `Pays : ${countryToUpperCase}`);
        const adPhone = addElement("p", [], {}, `téléphone : ${phoneValue}`);

        nextAddress.classList.remove("hidden");
        carriers.classList.remove("hidden");
        contentNextAddress.append(adName, person, adDelivery, adPcAndCity, adCountry, adPhone)
    })
    .catch(function (error) {
      console.log(error);
    });
});
