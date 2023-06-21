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

// on remplit un tableau de nom pour éviter les doublons
deliveryNames.forEach(element => {
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
    addressName : addN,
    firstname : fn,
    lastname : ln,
    address : add,
    postalCode : pc,
    city : cit,
    country : coun,
    phone : phon
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

  element.addEventListener('focus', ()=>{
    myAddress.classList.add("hidden");
    nextAddress.classList.remove("hidden");
    carriers.classList.remove("hidden"); 
    adName.textContent = 'nom : ' + arrayFullDelivery[i].addressName;
    person.textContent = arrayFullDelivery[i].firstname + " " + arrayFullDelivery[i].lastname;
    adDelivery.textContent = arrayFullDelivery[i].address;
    adPcAndCity.textContent = arrayFullDelivery[i].postalCode + " " + arrayFullDelivery[i].city;
    adCountry.textContent = arrayFullDelivery[i].country;
    adPhone.textContent = arrayFullDelivery[i].phone;
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

// le formulaire de nouvelle adresse ----------------------------------
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
        // on écrit la suite de l'interaction dans le bloc 
        newAddress.classList.add("hidden");
        adName.textContent = `${nameAdValue}`;
        person.textContent = `${lastnameToUpperCase}  ${firstnameToCapitalize}`;
        adDelivery.textContent = `${addValue}`;
        adPcAndCity.textContent = `${PcToNb} ${cityToUpperCase}`;
        adCountry.textContent = `Pays : ${countryToUpperCase}`;
        adPhone.textContent = `téléphone : ${phoneValue}`;

        nextAddress.classList.remove("hidden");
        carriers.classList.remove("hidden");    
    })
    .catch(function (error) {
      console.log(error);
    });
});

