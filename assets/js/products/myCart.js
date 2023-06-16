import { key } from "../modules/key.js";
import { addElement } from "../modules/addElement.js";

const mainContainer = document.querySelector(".myDiv");

fetch(`${key}checkMyCart.php`)
.then((response) => response.json())
.then((data) => {
  console.log(data)
    
  let arrayPrice = [];

    for (const key in data.cart) {

      const item = data.cart[key];
      console.log(item);
      const totalPrice = item.price * item.quantity;
      const dad = addElement("div", ["flex", "gap-3", "my-2"], {});
      const child0 = addElement("img",["object-cover", "h-full", "w-6"],{src : `Public/img/product/${item.imagePath}`});
      const child1 = addElement("div",[],{id : item.productId}, `${item.productName}`);
      const child2 = addElement("div",[],{}, `${item.color}`);
      const child3 = addElement("div",[],{}, `${item.size}`);
      const child4 = addElement("div",[],{}, `${item.quantity}`);
      const child5 = addElement("div",[],{}, `${item.price} €`);
      const child6 = addElement("div",[],{}, `${totalPrice} €`);
      
      arrayPrice.push(totalPrice);
      dad.append(child0, child1, child2, child3, child4, child5, child6);
      mainContainer.appendChild(dad);
    }
    const initialValue = 0; // on peut changer cette variable si un bon d'achat / code promo par exemple
    const finalPrice = arrayPrice.reduce((accumulator, currentValue) => accumulator + currentValue, initialValue ).toFixed(2);
    
    
    const child7 = addElement("div",["mt-5"],{}, `prix hors livraison : ${finalPrice} €`);
    mainContainer.append(child7);
    console.log(arrayPrice);
    console.log(finalPrice);
  });

