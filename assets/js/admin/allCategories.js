import { addElement } from "../modules/addElement.js";
document.addEventListener("DOMContentLoaded", function() {

fetch('../../php/Json/AllCategories.php')
    .then(response => response.json())
    .then( categorie => {

        if(categorie && categorie.length){

            let ContainerTable = addElement('div', ["flex", "flex-col", "w-full", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border"], {});
            document.getElementById('catContainer').appendChild(ContainerTable);

            let tableCat = addElement('table', ["w-full", "text-sm", "text-left", "text-gray-500", "dark:text-gray-400"], {});
            ContainerTable.appendChild(tableCat);

            let thead = addElement('thead', ["text-xs", "text-gray-700", "uppercase", "bg-gray-50", "dark:bg-gray-700", "dark:text-gray-400"], {});
            tableCat.appendChild(thead);

            let trthead = addElement('tr', [], {});
            thead.appendChild(trthead);
            
            let thId = addElement('th', ["px-6", "py-3"], {scope: "col"}, "Id");
            let thName = addElement('th', ["px-6", "py-3"], {scope: "col"}, "Nom");
            let thNbProduct = addElement('th', ["px-6", "py-3"], {scope: "col"}, "Produits"); 
            trthead.appendChild(thId);
            trthead.appendChild(thName);
            trthead.appendChild(thNbProduct);
            
            let tbody = addElement('tbody', [], {});
            thead.after(tbody);
            
            categorie.map(item =>{
                const catId = item.id;
                let trtbody = addElement('tr', ["bg-white", "border-b", "dark:bg-gray-800", "dark:border-gray-700"], {});
                tbody.appendChild(trtbody);

                let thContentId = addElement('th', ["px-6", "py-4", "font-normal", "text-gray-900", "whitespace-nowrap", "dark:text-white"], {scope: "row"}, `${item.id}`);
                let thContentName = addElement('td', ["px-6", "py-4"], {}, `${item.name}`);
                trtbody.appendChild(thContentId);
                trtbody.appendChild(thContentName);

                fetch('../../php/Json/AllProdcat.php')
                    .then(response => response.json())
                    .then(product_cat => {
                        product_cat.map(item =>{
                            if(item.category_id == catId){
                                console.log(catId);
                                let thContentNbProduct = addElement('td', ["px-6", "py-4"], {}, `${item.product_count}`);
                                trtbody.appendChild(thContentNbProduct);
                            }
                        })
                    })
            })
            


        }
    });
});