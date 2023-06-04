import { addElement } from "../modules/addElement.js";
document.addEventListener("DOMContentLoaded", function() {

fetch('../../php/Json/AllCategories.php')
    .then(response => response.json())
    .then( categorie => {
        if(categorie && categorie.length){

            let catContainer = addElement('div', ["flex", "p-4", "justify-start", "w-full", "overflow-x-auto", ], {});
            document.getElementById('main').appendChild(catContainer);

            let ContainerTable = addElement('div', ["flex", "flex-col", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border"], {});
            catContainer.appendChild(ContainerTable);

            let tableCat = addElement('table', ["w-full", "text-sm", "text-left", "text-gray-500", "dark:text-gray-400"], {});
            ContainerTable.appendChild(tableCat);

            let thead = addElement('thead', ["text-xs", "text-gray-700", "uppercase", "bg-gray-50", "dark:bg-gray-700", "dark:text-gray-400"], {});
            tableCat.appendChild(thead);

            let trthead = addElement('tr', [], {});
            thead.appendChild(trthead);

            let thId = addElement('th', ["px-6", "py-3"], {scope: "col"}, "Id");
            let thName = addElement('th', ["px-6", "py-3"], {scope: "col"}, "Name");
            trthead.appendChild(thId);
            trthead.appendChild(thName);

            let tbody = addElement('tbody', [], {});
            thead.after(tbody);
            
            
            categorie.map(item =>{
                var jsonData = JSON.stringify(item.id);
                console.log(jsonData);

                const url = "../../php/Json/AllProdCat.php";
                

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({data: jsonData})
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Afficher la réponse du fichier PHP pour le débogage
                        // Traiter la réponse de votre fichier PHP si nécessaire
                    })
                    .catch(error => {
                        console.error('Erreur lors de l\'envoi des données :', error);
                    });
                

                let trtbody = addElement('tr', ["bg-white", "border-b", "dark:bg-gray-800", "dark:border-gray-700"], {});
                tbody.appendChild(trtbody);

                let thContentId = addElement('th', ["px-6", "py-4", "font-normal", "text-gray-900", "whitespace-nowrap", "dark:text-white"], {scope: "row"}, `${item.id}`);
                let thContentName = addElement('td', ["px-6", "py-4"], {}, `${item.name}`);
                trtbody.appendChild(thContentId);
                trtbody.appendChild(thContentName);


            })
            

            fetch('../../php/Json/AllProdcat.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data.length);
                })

        }
    });
});