import { addElement } from "../modules/addElement.js";

fetch('../../php/Json/AllCategories.php')
    .then(response => response.json())
    .then( data => {
        console.log(data);
        // Vérifie qu'il y a bien des données
        if(data && data.length){

            // Crée un conteneur categories
            let catContainer = addElement('div', ["flex", "flex-col", "shadow-md", "bg-white", "rounded-lg", "px-8", "py-4", "space-y-3", "dark:bg-gray-800"], {id: "categories"});
            document.getElementById('price').after(catContainer);

            // Ajoute un titre au conteneur categories
            let titleCategories = addElement('h2', ["text-md", "font-medium", "dark:text-white"], {}, "Collection");
            catContainer.appendChild(titleCategories);

            // Création du label/select pour les catégories
            let labelCategories = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], {for: "selectCategories"}, "Collection");
            let selectCategories = addElement('select', ["bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], {name: "prodOption", id: "selectCategories"});
            catContainer.appendChild(labelCategories);
            catContainer.appendChild(selectCategories);


            data.map(item => {
                // Création des options pour le select
                let options = addElement('option', [], {value: `${item.id}`}, `${item.name}`);
                selectCategories.appendChild(options);
            })
        } 
    });