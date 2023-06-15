// Importer la fonction addElement du fichier ../modules/addElement.js
import { addElement } from "../modules/addElement.js";

// Attendre que le contenu soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {

    // Récupérer les produits à partir du fichier JSON
    fetch('../../php/Json/AllProducts.php')
        .then(response => response.json())
        .then(products => {

            // Vérifier s'il y a des produits et qu'ils ont une longueur
            if (products && products.length) {

                // Créer un élément div avec des classes et des attributs spécifiques et l'ajouter au conteneur prodContainer
                let ContainerTable = addElement('div', ["flex", "flex-col", "w-full", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border"], {});
                document.getElementById('prodContainer').appendChild(ContainerTable);

                // Créer un élément table avec des classes et des attributs spécifiques et l'ajouter au ContainerTable
                let tableProd = addElement('table', ["w-full", "text-sm", "text-left", "text-gray-500", "dark:text-gray-400"], {});
                ContainerTable.appendChild(tableProd);

                // Créer un élément thead avec des classes et des attributs spécifiques et l'ajouter au tableProd
                let thead = addElement('thead', ["text-xs", "text-gray-700", "uppercase", "bg-gray-50", "dark:bg-gray-700", "dark:text-gray-400"], {});
                tableProd.appendChild(thead);

                // Créer un élément tr pour l'en-tête de la table et l'ajouter au thead
                let trthead = addElement('tr', [], {});
                thead.appendChild(trthead);

                // Créer les éléments th pour chaque colonne de l'en-tête (Id, Nom, créé le) et les ajouter au trthead
                let thId = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Id");
                let thName = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Nom");
                let thPrice = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Prix");
                let thDate = addElement('th', ["px-6", "py-3"], { scope: "col" }, "créé le");
                trthead.appendChild(thId);
                trthead.appendChild(thName);
                trthead.appendChild(thPrice);
                trthead.appendChild(thDate);

                // Créer un élément tbody et l'ajouter après le thead
                let tbody = addElement('tbody', [], {});
                thead.after(tbody);

                
                // Parcourir les produits et créer les éléments correspondants pour chaque produit
                products.map(product => {

                    let prodId = product.id;
                    // Créer un élément tr pour chaque ligne du corps de la table et l'ajouter au tbody
                    let trtbody = addElement('tr', ["bg-white", "border-b", "dark:bg-gray-800", "dark:border-gray-700"], {});
                    tbody.appendChild(trtbody);

                    // Créer les éléments th pour chaque contenu (Id, Nom) et les ajouter au trtbody
                    let thContentId = addElement('th', ["px-6", "py-4", "font-normal", "text-gray-900", "whitespace-nowrap", "dark:text-white"], { scope: "row" }, `${product.id}`);
                    let thContentName = addElement('td', ["px-6", "py-4"], {}, `${product.name}`);
                    trtbody.appendChild(thContentId);
                    trtbody.appendChild(thContentName);

                    // Formater la date dans un format spécifique (jour-mois-année)
                    let date = new Date(product.createdAt);
                    let jour = date.getDate();
                    let mois = date.getMonth() + 1;
                    let annee = date.getFullYear();
                    let dateFormat = `${jour.toString().padStart(2, '0')}-${mois.toString().padStart(2, '0')}-${annee}`;

                    // Créer l'élément th pour la date et l'ajouter au trtbody
                    let thContentDate = addElement('td', ["px-6", "py-4"], {}, `${dateFormat}`);
                    trtbody.appendChild(thContentDate);
                    
                    console.log(prodId);
                });
                fetch('../../php/Json/allPrice.php')
                    .then(response => response.json())
                    .then(prices => {
                        prices.map(price => {
                            console.log(price);

                        })
                    })


            }
        });
});