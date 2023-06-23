import { keyPath } from "../modules/key.js";
import { addElement } from "../modules/addElement.js";

// le formulaire et container
const mainContainer = document.querySelector("#confirmCart");
mainContainer.addEventListener('submit', (e) => e.preventDefault());

// on récupère les données
fetch(`${keyPath}checkMyCart.php`)
  .then((response) => response.json())
  .then((data) => {
    if (data.cart.length !== 0) {
      let arrayPrice = [];

      for (const key in data.cart) {
        const item = data.cart[key];

        let totalPrice = item.price * item.quantity;
        const dad = addElement("div", ["flex", "gap-3", "my-2"], {});
        const child0 = addElement("img", ["object-cover", "h-full", "w-6"], {
          src: `Public/img/product/${item.imagePath}`,
        });
        const child1 = addElement(
          "div",
          [],
          { id: item.productId },
          `${item.productName}`
        );
        const child2 = addElement("div", [], {}, `${item.color}`);
        const child3 = addElement("select", [], {
          name: item.sizeId,
          value: item.size,
        });

        for (const index in data.size[key]) {
          const valueSize = data.size[key][index].size;
          const valueSizeId = data.size[key][index].id;
          const child_3 = addElement(
            "option",
            [],
            { value: valueSizeId },
            `${valueSize}`
          );
          valueSize === item.size ? (child_3.selected = "true") : "";
          child3.append(child_3);
        }
        const child4 = addElement(
          "input",
          ["w-20"],
          { type: "number", value: item.quantity },
          `${item.quantity}`
        );
        const child5 = addElement("div", [], {}, `${item.price.toFixed(2)} €`);
        const child6 = addElement("div", [], {}, `${totalPrice.toFixed(2)} €`);
        const child7 = addElement(
          "button",
          ["btnDelete"],
          {
            type: "button",
            name: item.id,
            id: item.id,
            "data-modal-target": `popup-modal${-item.id}`,
            "data-modal-toggle": `popup-modal${-item.id}`,
          },
          "supprimer"
        );
        const child_7 = addElement(
          "div",
          [
            "fixed",
            "top-0",
            "left-0",
            "right-0",
            "z-50",
            "hidden",
            "p-4",
            "overflow-x-hidden",
            "overflow-y-auto",
            "md:inset-0",
            "h-[calc(100%-1rem)]",
            "max-h-full",
          ],
          { id: `popup-modal${-item.id}`, tabindex: "-1" }
        );
        child_7.innerHTML = `<div class="relative w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal"${-item.id}>
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              <span class="sr-only">Close modal</span>
          </button>
          <div class="p-6 text-center">
              <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
              <button data-modal-hide="popup-modal${-item.id}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                  Yes, I'm sure
              </button>
              <button data-modal-hide="popup-modal${-item.id}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
          </div>
      </div>
  </div>`;

        arrayPrice.push(totalPrice);
        dad.append(
          child0,
          child1,
          child2,
          child3,
          child4,
          child5,
          child6,
          child7,
          child_7
        );
        mainContainer.appendChild(dad);

        // dès que la quantité est changé tous les calculs sont mis à jour
        child4.addEventListener("change", () => {
          // on empêche une valeur négative
          if (child4.value < 0) child4.value = 0;

          totalPrice = item.price * child4.value;

          child6.textContent = totalPrice + "€";

          // on met à jour notre tableau des prix totaux et le visuel
          arrayPrice[key] = totalPrice;
          child8.textContent = `prix hors livraison : ${finalPrice()} €`;
        });
      }
      const initialValue = 0; // on peut changer cette variable si un bon d'achat / code promo par exemple
      const finalPrice = () =>
        arrayPrice
          .reduce(
            (accumulator, currentValue) => accumulator + currentValue,
            initialValue
          )
          .toFixed(2);

      const child8 = addElement(
        "div",
        ["mt-5"],
        {},
        `prix hors livraison : ${finalPrice()} €`
      );
      const child9 = addElement(
        "button",
        [],
        { type: "submit" },
        "Valider mon panier"
      );
      mainContainer.append(child8, child9);

      // mis à jour du panier en cas de valeurs différentes
      const select = document.querySelectorAll("select");
      const input = document.querySelectorAll("input");

      // gestion du formulaire en asynchrone
      const updateValuesHandler = () => {
        // notre futur json envoyé dans une seule promesse, on boucle en back pour extraire les valeurs
        let jsonData = [];

        for (const index in data.cart) {
          const element = data.cart[index];

          const jsonValidation = {
            cart_id: element.id,
            product_id: element.productId,
            color_id: element.colorId,
            size_id: Number(select[index].value),
            quantity: Number(input[index].value),
            price_id: element.priceId,
            user_id: element.userId,
          };

          jsonData.push(jsonValidation);
        }

        // on envoie ensuite un json plein de données
        fetch(`${keyPath}validateMyCart.php`, {
          method: "POST",

          body: JSON.stringify(jsonData),
          headers: {
            "Content-Type": "application/json",
          },
        })
        // on gère en fonction de la réponse du serveur
          .then(function (response) {
            if (response.ok) {
              window.location.href = "./delivery.php";
            } else {
              alert("Mise à jour du panier impossible ! Veuillez contactez un administrateur.");
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      };

      // bouttons supprimer
      const btnDelete = document.querySelectorAll(".btnDelete");

      // on boucle dessus et on leur créé la meme intéraction
      for (let i = 0; i < btnDelete.length; i++) {
        const element = btnDelete[i];

        element.addEventListener("click", () => {
          input[i].value = 0;
          updateValuesHandler();
        });
      }

      // bouton "valider le panier"
      child9.addEventListener("click", () => {
        updateValuesHandler();
      });

      // -------------------------------------------
    } else {
      const emptyMessage = addElement(
        "h2",
        ["text-3xl", "text-center"],
        {},
        "Votre panier est vide"
      );
      mainContainer.append(emptyMessage);
    }
  })
  .catch((error) => console.log(error.message));
