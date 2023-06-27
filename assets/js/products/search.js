import { addElement } from "../modules/addElement.js";
import { keyPath } from "../modules/key.js";

const searchBar = document.querySelector("#search");
const results = document.querySelector("#results");

searchBar.addEventListener("keyup", () => {
  results.innerHTML = "";
  const jsonValue = { name: searchBar.value };

  if (searchBar.value.length > 0) {
    fetch(`${keyPath}searchProducts.php`, {
      method: "POST",

      body: JSON.stringify(jsonValue),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => {
        if (response.ok) {
          response.text().then((result) => {
            const items = JSON.parse(result);
            for (const key in items[0]) {
              const nameProduct = items[0][key].name;
              const idProduct = items[0][key].id;
              console.log(nameProduct);

              const link = addElement(
                "a",
                ["block", "bg-white", "p-4", "dark:bg-gray-800", "dark:text-white", "border-b", "border-white"],
                { href: `./product.php?name=${nameProduct}&id=${idProduct}` },
                `${nameProduct}`
              );
              results.append(link);
            }
          });
        } else {
          alert("problème détecté merci de contacter un administrateur.");
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  }
});
