import { keyPath } from "../modules/key.js";
import { addElement } from "../modules/addElement.js";

const lastOrder = document.querySelector("#lastOrder");
const orders = document.querySelector("#orders");

fetch(`${keyPath}checkPassedOrders.php`)
  .then((response) => response.json())
  .then((data) => {
    const newData = data;
    let arrayOrders = [];
    for (const key in newData) {
      const row = newData[key];
      const date = new Date(row.createdAt);
      const dateToFrench = date.toLocaleDateString("fr-FR");

      //  on remplit des tableaux de produits pour mieux afficher les données
      const arrayProdNamesByRow = row.product_names.split(", ");
      const arrayColorNamesByRow = row.color_names.split(", ");
      const arraySizeNamesByRow = row.size_names.split(", ");
      const arrayPriceValuesByRow = row.price_values.split(", ");

      let rowOrder = [];
	//  on initialise un index vide pour push dedans
	  rowOrder["product"] = [];
      // on créé des tableaux associatifs pour inclure chaque ligne de produit par commande
      for (let i = 0; i < arrayProdNamesByRow.length; i++) {
        const name = arrayProdNamesByRow[i];
        const color = arrayColorNamesByRow[i];
        const size = arraySizeNamesByRow[i];
        const price = arrayPriceValuesByRow[i];

        // chaque ligne de produit sera stocké dedans
        let product = {
          name: name,
          color: color,
          size: size,
          price: price,
        };

		rowOrder["product"].push(product);
      }

      // les info de la commande
      rowOrder["info"] = {
        id: row.id,
        date: dateToFrench,
        quantity: row.quantity,
        total: row.total_amount,
        // on ne récupère que le nom du livreur
        shipping: row.carriersDetails.split(", ")[0],
      };

      // on envoie tout dans l'array final
      arrayOrders.push(rowOrder);
    }
    
    // on va travailler avec notre nouveau tableau arrayOrders

	// par commande
    for (const key in arrayOrders) {
      const row = arrayOrders[key];
	  // creer un conteneur
	  	const title = addElement("h3", ["mt-4","text-xl"], {}, `Commande N° ${row.info.id} du ${row.info.date}`);
		const subTitle = addElement("h4", ["mb-2"], {}, `Livrée par : ${row.info.shipping}`);
		const subTitle2 = addElement("h5", ["mb-5"], {}, `Prix total : ${row.info.total} €`);
		const totalArticles = addElement("p", [], {}, `Total produits commandés : ${row.info.quantity}`);
		const table = addElement("table", ["border", "my-2"], {});
		const tableRow = addElement("tr", ["border", "p-2"], {});
		const thName = addElement("th", ["border", "p-2"], {}, `Nom`);
		const thColor = addElement("th", ["border", "p-2"], {}, `Couleur`);
		const thSize = addElement("th", ["border", "p-2"], {}, `Taille`);
		const thPrice = addElement("th", ["border", "p-2"], {}, `Prix`);

		table.append(tableRow);
		tableRow.append(thName,thColor,thSize,thSize,thPrice);

		// par produit dans la commande
		for (const index in row.product) {
			
			const product = row.product[index];
			console.log(product);
			const name = product.name;
			const color = product.color;
			const size = product.size;
			const price = product.price;
			
			// creer un conteneur
			const trProd = addElement("tr", ["border", "p-2"], {});
			const tdName = addElement("td", ["border", "p-2"], {}, `${name}`);
			const tdColor = addElement("td", ["border", "p-2"], {}, `${color}`);
			const tdSize = addElement("td", ["border", "p-2"], {}, `${size}`);
			const tdPrice = addElement("td", ["border", "p-2"], {}, `${price} €`);

			trProd.append(tdName,tdColor,tdSize,tdPrice);
			table.append(trProd);
		}

		// on appel dans les conteneurs parents
	  if(Number(key) === arrayOrders.length-1) {
		lastOrder.append(title, subTitle, table,totalArticles, subTitle2);
	  } else { 
		// pour afficher de façon décroissante
		orders.prepend(title, subTitle, table, totalArticles, subTitle2);
	  }
      
      
      console.log(row.info.id);
    }
  })
  .catch((error) => console.log(error));
