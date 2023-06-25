// Importer la fonction addElement du fichier ../modules/addElement.js
import { addElement } from "../modules/addElement.js";

// Attendre que le contenu soit chargé avant d'exécuter le code
document.addEventListener("DOMContentLoaded", function () {

    // Récupérer les produits à partir du fichier JSON
    fetch('../../php/Json/AllProducts.php')
        .then(response => response.json())
        .then(data => {

            let products = data.products;
            let prices = data.price;
            let colors = data.color;
            let colorsCounts = data.color_count;
            let sizes = data.size;
            let sizesCounts = data.size_count;
            let stocks = data.stock;
            let stocksCounts = data.stock_count;
            let categories = data.categories;

            if (categories && categories.length) {
                // Vérifier s'il y a des produits et qu'ils ont une longueur
                if (products && products.length) {

                    // Créer un élément div avec des classes et des attributs spécifiques et l'ajouter au conteneur prodContainer
                    let ContainerTable = addElement('div', ["flex", "flex-col", "w-full", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border", "overflow-x-auto"], {});
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
                    let thColor = addElement('th', ["px-6", "py-3"], { scope: "col" }, "NB Couleurs");
                    let thSize = addElement('th', ["px-6", "py-3"], { scope: "col" }, "NB Tailles");
                    let thStock = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Quantités total");
                    let thPrice = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Prix");
                    let thDate = addElement('th', ["px-6", "py-3"], { scope: "col" }, "créé le");
                    let thDelete = addElement('th', ["px-6", "py-3"], { scope: "col" });
                    trthead.appendChild(thId);
                    trthead.appendChild(thName);
                    trthead.appendChild(thColor);
                    trthead.appendChild(thSize);
                    trthead.appendChild(thStock);
                    trthead.appendChild(thDate);
                    trthead.appendChild(thPrice);
                    trthead.appendChild(thDelete);

                    // Créer un élément tbody et l'ajouter après le thead
                    let tbody = addElement('tbody', [], {});
                    thead.after(tbody);

                    // Parcourir les produits et créer les éléments correspondants pour chaque produit
                    products.map(product => {

                        // Créer un élément tr pour chaque ligne du corps de la table et l'ajouter au tbody
                        let trtbody = addElement('tr', ["bg-white", "border-b", "dark:bg-gray-800", "dark:border-gray-700"], {});
                        tbody.appendChild(trtbody);

                        // Créer les éléments th pour chaque contenu (Id, Nom) et les ajouter au trtbody
                        let thContentId = addElement('th', ["px-6", "py-4", "font-normal", "text-gray-900", "whitespace-nowrap", "dark:text-white"], { scope: "row" }, `${product.id}`);
                        let thContentName = addElement('td', ["px-6", "py-4"], {});
                        let pathProduct = addElement('a', [], {href:`./product.php?name=${product.name}&id=${product.id}`}, `${product.name}`);
                        trtbody.appendChild(thContentId);
                        trtbody.appendChild(thContentName);
                        thContentName.appendChild(pathProduct);

                        for (let productId in colorsCounts) {
                            if (productId == product.id) {
                                if (colorsCounts.hasOwnProperty(productId)) {
                                    let colorTotal = colorsCounts[productId];
                                    let sizeTotal = sizesCounts[productId];
                                    let quantityTotal = stocksCounts[productId];

                                    let thContentColor = addElement('td', ["px-6", "py-4"], {}, `${colorTotal}`);
                                    let thContentSize = addElement('td', ["px-6", "py-4"], {}, `${sizeTotal}`);
                                    let thContentStock = addElement('td', ["px-6", "py-4"], {}, `${quantityTotal}`);
                                    trtbody.appendChild(thContentColor);
                                    trtbody.appendChild(thContentSize);
                                    trtbody.appendChild(thContentStock);
                                }
                            }
                        }

                        // Formater la date dans un format spécifique (jour-mois-année)
                        let date = new Date(product.createdAt);
                        let jour = date.getDate();
                        let mois = date.getMonth() + 1;
                        let annee = date.getFullYear();
                        let dateFormat = `${jour.toString().padStart(2, '0')}-${mois.toString().padStart(2, '0')}-${annee}`;

                        // Créer l'élément th pour la date et l'ajouter au trtbody
                        let thContentDate = addElement('td', ["px-6", "py-4"], {}, `${dateFormat}`);
                        trtbody.appendChild(thContentDate);

                        prices.map(price => {
                            if (price.product_id == product.id) {
                                let thContentPrice = addElement('td', ["px-6", "py-4", "no-wrap"], {}, `${price.price} €`);
                                trtbody.appendChild(thContentPrice);
                            }
                        })

                        let thContentDelete = addElement('td', ["px-6", "py-4"], {});
                        trtbody.appendChild(thContentDelete);

                        let pathDelete = addElement('button', [], { type: "button", "data-modal-target": `popup-modal-${product.id}`, "data-modal-toggle": `popup-modal-${product.id}` });
                        thContentDelete.appendChild(pathDelete);

                        let DeleteItem = addElement('i', ["fa-regular", "fa-trash-can", "text-red-900", "dark:text-red-500", "fa-lg"], {});
                        pathDelete.appendChild(DeleteItem);

                        pathDelete.addEventListener('click', () => {
                            let backdropModal = addElement('div', ["fixed", "backdrop-blur", "top-[0]", "left-[0]", "right-[0]", "z-50", "p-4", "overflow-x-hidden", "overflow-y-auto", "md:inset-0", "h-[calc(100%-1rem)]", "max-h-full"], { id: `popup-modal-${product.id}`, tabindex: "-1" });
                            document.body.appendChild(backdropModal);

                            let positionModal = addElement('div', ["flex", "justify-center", "items-center", "w-full", "h-full"], {});
                            backdropModal.appendChild(positionModal);

                            let containerModal = addElement('div', ["relative", "w-80", "h-auto", "bg-white", "rounded-lg", "shadow-lg", "dark:bg-gray-700"], {});
                            positionModal.appendChild(containerModal);

                            let contentModal = addElement('div', ["flex", "flex-col", "w-full", "h-full"], {});
                            containerModal.appendChild(contentModal);

                            let headerModal = addElement('div', ["flex", "w-full", "pt-3", "px-3", "justify-end"], {});
                            contentModal.appendChild(headerModal);

                            let closeModal = addElement('button', [], { "data-modal-hide": `popup-modal-${product.id}` });
                            headerModal.appendChild(closeModal);

                            let closeItem = addElement('i', ["fa-solid", "fa-xmark", "fa-lg", "text-gray-700", "dark:text-white"], {});
                            closeModal.appendChild(closeItem);

                            closeModal.addEventListener('click', () => {
                                backdropModal.classList.add('hidden');
                            })

                            let bodyModal = addElement('div', ["flex", "flex-col", "w-full", "p-3", "flex-wrap", "text-center"], {});
                            contentModal.appendChild(bodyModal);

                            let bodyItem = addElement('i', ["fa-solid", "fa-circle-exclamation", "text-5xl", "text-gray-500", "mb-2"], {});
                            bodyModal.appendChild(bodyItem);

                            let pModal = addElement('p', ["text-lg", "font-normal", "text-gray-500", "dark:text-white"], {}, `Êtes-vous sur de vouloir supprimer le produit ${product.name}`);
                            bodyModal.appendChild(pModal);

                            let footerModal = addElement('div', ["flex", "justify-around", "w-full", "py-3", "px-12"], {});
                            contentModal.appendChild(footerModal);

                            let buttonAgree = addElement('button', ["text-white", "bg-red-600", "hover:bg-red-800", "focus:ring-4", "focus:outline-none", "focus:ring-red-300", "dark:focus:ring-red-800", "font-medium", "rounded-lg", "text-sm", "inline-flex", "items-center", "px-5", "py-2.5", "text-center", "mr-2"], { type: "submit" }, "Confimer");
                            footerModal.appendChild(buttonAgree);
                            let buttonDisagree = addElement('button', ["text-gray-500", "bg-white", "hover:bg-gray-100", "focus:ring-4", "focus:outline-none", "focus:ring-gray-200", "rounded-lg", "border", "border-gray-200", "text-sm", "font-medium", "px-5", "py-2.5", "hover:text-gray-900", "focus:z-10", "dark:bg-gray-700", "dark:text-gray-300", "dark:border-gray-500", "dark:hover:text-white", "dark:hover:bg-gray-600", "dark:focus:ring-gray-600"], {}, "Annuler");
                            footerModal.appendChild(buttonDisagree);

                            buttonDisagree.addEventListener('click', () => {
                                backdropModal.classList.add('hidden');
                            })

                            buttonAgree.addEventListener('click', function () {
                                fetch('../../php/Controller/deleteProduct.php', {
                                    method: "POST",
                                    body: JSON.stringify({
                                        product_id: product.id
                                    }),
                                    headers: {
                                        'Content-Type': "application/json",
                                    },
                                })
                                    .then(function (response) {
                                        backdropModal.classList.add('hidden');
                                        window.location.href = '../../php/Controller/deleteProduct.php';
                                    })
                                    .catch(function (error) {
                                        console.log(error);
                                    });
                            })
                        })


                    });
                } else {
                    document.getElementById('addProd').classList.add('hidden');
                    // Créer un élément div avec des classes et des attributs spécifiques 
                    let Container = addElement('div', ["flex", "w-full", "justify-center", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border", "overflow-x-auto"], {});
                    document.getElementById('prodContainer').appendChild(Container);

                    let content = addElement('div', ["flex", "flex-col", "shadow-md", "items-center", "p-4", "bg-white", "rounded-lg", "space-y-3", "dark:bg-gray-700", "dark:border"], {});
                    Container.appendChild(content);

                    let title = addElement('h5', ["dark:text-white", "text-center"], {}, "Oops vous n'avez pas encore de produit");
                    content.appendChild(title);

                    let btnAddUser = addElement('a', ["text-white", "w-auto", "mb-2", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-3", "py-2", "inline-flex", "items-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], { href: "./addProduct.php" }, "Ajouter un produit");
                    content.appendChild(btnAddUser);
                }
            }else{
                document.getElementById('addProd').classList.add('hidden');
                // Créer un élément div avec des classes et des attributs spécifiques 
                let Container = addElement('div', ["flex", "w-full", "justify-center", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border", "overflow-x-auto"], {});
                document.getElementById('prodContainer').appendChild(Container);

                let content = addElement('div', ["flex", "flex-col", "shadow-md", "items-center", "p-4", "bg-white", "rounded-lg", "space-y-3", "dark:bg-gray-700", "dark:border"], {});
                Container.appendChild(content);

                let title = addElement('h5', ["dark:text-white", "text-center"], {}, "Oops avant de créer un produit vous devez avoir une catégorie");
                content.appendChild(title);

                let btnAddUser = addElement('a', ["text-white", "w-auto", "mb-2", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-3", "py-2", "inline-flex", "items-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {href:"./addCategory.php"}, "Ajouter une catégorie");
                content.appendChild(btnAddUser);
            }
        });
});