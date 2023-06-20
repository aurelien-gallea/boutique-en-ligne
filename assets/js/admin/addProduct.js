import { addElement } from "../modules/addElement.js";

const test = document.getElementById('test');
test.addEventListener('click', () => {
    let color = document.getElementById('color').value;
    let size = document.getElementById('size').value;
    let quantity = document.getElementById('quantity').value;
    let i = 0;
    
    if(color && size){
        
        console.log(color+'/'+size+'/'+quantity);
        
        document.getElementById('containerTable').classList.remove('hidden');
        document.getElementById('containerTable').classList.add('flex');

        let trtbody = addElement('tr', ["bg-white", "border-b", "dark:bg-gray-800", "dark:border-gray-700"], {});
        document.getElementById('tbody').appendChild(trtbody);

        let thColor = addElement('th', ["px-6", "py-4", "font-normal", "text-gray-900", "whitespace-nowrap", "dark:text-white"], {scope: "row"});
        trtbody.appendChild(thColor);
        let thInputColor = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], {name:"color[]", value:`${color}`});
        thColor.appendChild(thInputColor);

        let thSize = addElement('td', ["px-6", "py-4"], {});
        trtbody.appendChild(thSize);
        let thInputSize = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], {name:"size[]", value:`${size}`});
        thSize.appendChild(thInputSize);

        let thQuantity = addElement('td', ["px-6", "py-4"], {});
        trtbody.appendChild(thQuantity);
        let thInputQuantity = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], {name:"quantity[]", value:`${quantity}`});
        thQuantity.appendChild(thInputQuantity);

        document.getElementById('size').value = "";
        document.getElementById('quantity').value = "";
    }
})


fetch('../../php/Json/AllCategories.php')
    .then(response => response.json())
    .then(data => {
       
        let categories = data.categories;
    
        // Vérifie qu'il y a bien des données
        if(categories && categories.length){

            // Crée un conteneur categories
            let catContainer = addElement('div', ["flex", "flex-col", "shadow-md", "bg-white", "rounded-lg", "px-8", "py-4", "space-y-3", "dark:bg-gray-800"], {id: "categories"});
            document.getElementById('button').before(catContainer);

            // Ajoute un titre au conteneur categories
            let titleCategories = addElement('h2', ["text-md", "font-medium", "dark:text-white"], {}, "Collection");
            catContainer.appendChild(titleCategories);

            // Création du label/select pour les catégories
            let labelCategories = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], {for: "selectCategories"}, "Collection");
            let selectCategories = addElement('select', ["bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], {name: "selectCategories", id: "selectCategories"});
            catContainer.appendChild(labelCategories);
            catContainer.appendChild(selectCategories);

            categories.map(category => {
                // Création des options pour le select
                let options = addElement('option', [], {value: `${category.id}`}, `${category.name}`);
                selectCategories.appendChild(options);
            })
        } 
    });