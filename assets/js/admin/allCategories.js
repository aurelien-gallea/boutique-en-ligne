import { addElement } from "../modules/addElement.js";
document.addEventListener("DOMContentLoaded", function() {

fetch('../../php/Json/AllCategories.php')
    .then(response => response.json())
    .then( categorie => {

        if(categorie && categorie.length){

            
            // let catContainer = addElement('div', ["flex", "flex-col", "p-4", "justify-start", "w-full", "overflow-x-auto", ], {});
            // document.getElementById('main').appendChild(catContainer);

            // let btnAddCategory = addElement('button', ["text-white", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-5", "py-2.5", "text-center", "inline-flex", "items-center", "mr-2", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {type: "button"});
            // catContainer.appendChild(btnAddCategory);

            // let svgBtn = addElement('svg', ["w-6", "h-6"], {fill: "none", stroke:"currentColor", viewBox: "0 0 20 20", xmls: "http://www.w3.org/2000/svg", "aria-hidden": "true"}, "Ajouter collection");
            // btnAddCategory.appendChild(svgBtn);

            // let pathSvgBtn = addElement('path', ["h-full", "w-full", "text-white"], {d: "M12 6v6m0 0v6m0-6h6m-6 0H6", "stroke-linecap":"round", "stroke-linejoin":"round", "stroke-width":"2"})
            // svgBtn.appendChild(pathSvgBtn);

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
                                let thContentNbProduct = addElement('td', ["px-6", "py-4"], {}, `${item.product_count}`);
                                trtbody.appendChild(thContentNbProduct);
                            }
                        })
                    })
            })
            


        }
    });
});