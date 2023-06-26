import { addElement } from "../modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {

    fetch('../../php/Json/category.php')
        .then(response => response.json())
        .then(category => {
            let containerCat = addElement('div', [], {});
            document.querySelector('h2').after(containerCat);

            let labelCat = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], {for:'name'}, 'Nom');
            let inputCat = addElement('input', ["block", "w-full", "p-2", "text-sm", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-white", "dark:focus:border-white"], {type:'text', id:'name', name:'name', value:`${category[0].name}`});
            containerCat.appendChild(labelCat);
            containerCat.appendChild(inputCat);
        })

})