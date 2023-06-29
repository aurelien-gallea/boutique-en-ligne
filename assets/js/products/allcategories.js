import { addElement } from "../modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {

    fetch('./php/Json/allCategories.php')
        .then(response => response.json())
        .then(data => {
            
            const categories = data.categories;
            
            categories.map(category => {

                let li = addElement('li', [], {});
                document.getElementById('catDropdown').appendChild(li);

                let pathCat = addElement('a', ["block", "px-4", "py-2", "hover:bg-gray-100", "dark:hover:bg-gray-600", "dark:hover:text-white"], {href:`./category.php?name=${category.name}&id=${category.id}`},`${category.name}`);
                li.appendChild(pathCat);
            })
        })

})
