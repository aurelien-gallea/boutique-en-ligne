import { addElement } from "../modules/addElement.js";
document.addEventListener("DOMContentLoaded", function() {

fetch('../../php/Json/AllProducts.php')
    .then(response => response.json())
    .then( products => {
        
        if(products && products.length){

            let ContainerTable = addElement('div', ["flex", "flex-col", "w-full", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border"], {});
            document.getElementById('prodContainer').appendChild(ContainerTable);

            let tableProd = addElement('table', ["w-full", "text-sm", "text-left", "text-gray-500", "dark:text-gray-400"], {});
            ContainerTable.appendChild(tableProd);

            let thead = addElement('thead', ["text-xs", "text-gray-700", "uppercase", "bg-gray-50", "dark:bg-gray-700", "dark:text-gray-400"], {});
            tableProd.appendChild(thead);

            let trthead = addElement('tr', [], {});
            thead.appendChild(trthead);
            
            let thId = addElement('th', ["px-6", "py-3"], {scope: "col"}, "Id");
            let thName = addElement('th', ["px-6", "py-3"], {scope: "col"}, "Nom");
            let thDate = addElement('th', ["px-6", "py-3"], {scope: "col"}, "créé le"); 
            trthead.appendChild(thId);
            trthead.appendChild(thName);
            trthead.appendChild(thDate);

            let tbody = addElement('tbody', [], {});
            thead.after(tbody);

            products.map(item => {
        
                let trtbody = addElement('tr', ["bg-white", "border-b", "dark:bg-gray-800", "dark:border-gray-700"], {});
                tbody.appendChild(trtbody);

                let thContentId = addElement('th', ["px-6", "py-4", "font-normal", "text-gray-900", "whitespace-nowrap", "dark:text-white"], {scope: "row"}, `${item.id}`);
                let thContentName = addElement('td', ["px-6", "py-4"], {}, `${item.name}`);
                trtbody.appendChild(thContentId);
                trtbody.appendChild(thContentName);
                
                let date = new Date(item.createdAt);
                let jour = date.getDate();
                let mois = date.getMonth() + 1;
                let annee = date.getFullYear();
                let dateFormat = `${jour.toString().padStart(2, '0')}-${mois.toString().padStart(2, '0')}-${annee}`;
                let thContentDate = addElement('td', ["px-6", "py-4"], {}, `${dateFormat}`);
                trtbody.appendChild(thContentDate);
            })
        }
    });

});