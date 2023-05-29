import { addElement } from "../modules/addElement.js";


fetch('../php/Json/AllProduct.php')
        .then(response => response.json())
        .then(data=> {
            // console.log(data);
        })

fetch('../php/Json/AllCategories.php')
        .then(response => response.json())
        .then( data => {
            let select = addElement('select', ["bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], {name: "prodOption"});
            document.getElementById('test').after(select)
            data.map(item => {
                let options = addElement('option', [], {value: `${item.id}`}, `${item.name}`);
                select.appendChild(options);
            })
        })

fetch('../php/Json/AllProdCat.php')
    .then(response => response.json())
    .then(data=> {
        console.log(data);
})