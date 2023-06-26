import { addElement } from "../modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {

    fetch('../../php/Json/carrier.php')
        .then(response => response.json())
        .then(carriers => {
            let carrierName = addElement('div', [], {});
            document.querySelector('h2').after(carrierName);

            let labelCarrier = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], {for:'name'}, 'Nom');
            let inputCarrier = addElement('input', ["block", "w-full", "p-2", "text-sm", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-white", "dark:focus:border-white"], {type:'text', id:'name', name:'name', value:`${carriers[0].name}`});
            carrierName.appendChild(labelCarrier);
            carrierName.appendChild(inputCarrier);

            let carrierDesc = addElement('div', [], {});
            carrierName.after(carrierDesc);

            let labelDesc = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], {for:'description'}, 'Description');
            let inputDesc = addElement('textarea', ["block", "p-2.5", "w-full", "text-sm", "text-gray-900", "bg-gray-50", "rounded-lg", "border", "border-gray-300", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { type: "text", id: "description", name: "description" }, `${carriers[0].description}`);
            carrierDesc.appendChild(labelDesc);
            carrierDesc.appendChild(inputDesc);

            let carrierPrice = addElement('div', [], {});
            carrierDesc.after(carrierPrice);

            let labelPrice = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], {for:'price'}, 'Prix');
            let inputPrice = addElement('input', ["block", "p-2.5", "w-1/3", "text-sm", "text-gray-900", "bg-gray-50", "rounded-lg", "border", "border-gray-300", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { type: "number", id: "price", name: "price", step: "0.01", value: `${carriers[0].price}` });
            carrierPrice.appendChild(labelPrice);
            carrierPrice.appendChild(inputPrice);
        })

})