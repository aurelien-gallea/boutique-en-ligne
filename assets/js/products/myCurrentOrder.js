import { keyPath } from "../modules/key.js";
import { addElement } from "../modules/addElement.js";

const table       = document.querySelector("#orderTable");
const totalAmount = document.querySelector("#totalAmount");
let arrayAmounts = [];

fetch(`${keyPath}checkMyOrder.php`)
  .then((response) => response.json())
  .then((data) => {
    console.log(data);
    const arrayCart = data.cart;
    const carriers = data.orderdetails;
    for (const key in arrayCart) {
      if (Object.hasOwnProperty.call(arrayCart, key)) {

        const element = arrayCart[key];
        arrayAmounts.push(element.price * element.quantity);
        const tr = addElement("tr", [], {});
        const tdCartname = addElement(
          "td",
          ["pl-2", "text-lg", "border"],
          {},
          `${element.productName}`
        );
        const tdCartQty = addElement(
          "td",
          ["pl-2", "text-lg", "border"],
          {},
          `${element.quantity}`
        );
        const tdCartPrice = addElement(
          "td",
          ["pl-2", "text-lg", "border"],
          {},
          `${element.price} €`
        );
        const tdTotalPrice = addElement(
          "td",
          ["pl-2", "text-lg", "border"],
          {},
          `${(element.price * element.quantity).toFixed(2)} €`
        );

        tr.append(tdCartname, tdCartQty, tdCartPrice, tdTotalPrice);

        table.append(tr);
      }
    }
    const tr2 = addElement("tr", [], {});
    const tdCarriersName = addElement("td", ["pl-2", "text-lg", "border"], {}, `livraison`);
    const tdCarriersQty = addElement("td", ["pl-2", "text-lg", "border"], {}, "1");
    const tdCarriersPrice = addElement("td",["pl-2", "text-lg", "border"], {},`${carriers.carriers_price} €`);
    const tdCarriersTotalPrice = addElement("td",["pl-2", "text-lg", "border"], {},`${carriers.carriers_price} €`);
    
    tr2.append(tdCarriersName, tdCarriersQty, tdCarriersPrice, tdCarriersTotalPrice);
    table.append(tr2);
    arrayAmounts.push(carriers.carriers_price);
    let initialValue = 0;
    const finalPrice = arrayAmounts.reduce((accumulator, currentValue) => accumulator + currentValue,
    initialValue).toFixed(2);
    console.log(finalPrice)
    totalAmount.textContent = finalPrice + " €";

    // l'adresse de livraison
    const fullAddress = document.querySelector("#fullAddress");
    console.log(data.orderdetails.deliveryFullAddress);
    if (typeof data.orderdetails.deliveryFullAddress === "undefined") {
      window.location.href= "./"; // <---- changer la redirection
    } else {

      fullAddress.innerHTML = `<p>${data.orderdetails.deliveryFullAddress.replace(/,/g, "<br>")}</p>`;
    }

    // le livreur choisi
    const carriersChoice = document.querySelector("#carriersChoice");
    carriersChoice.innerHTML = `<p>${data.orderdetails.carriersDetails.replace(/,/g, "<br>")}</p>`;

    // le bouton goBack
    const goBack = document.querySelector("#goBack");
    goBack.addEventListener('click', () =>{
        window.history.back();
    });

    // le bouton payer
    const confirmOrder = document.querySelector("#confirmOrder");
    confirmOrder.addEventListener('click', () => {
        // on envoie des données pour creer une nouvelle commande prête à être payé
        
        

        window.location.href = "./done.php";
    });
});