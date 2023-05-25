import { addElement } from "../modules/addElement.js";


fetch('../php/Json/AllProduct.php')
        .then(response => response.json())
        .then(data=> {
            // console.log(data);
        })

fetch('../php/Json/AllCategories.php')
        .then(response => response.json())
        .then( data => {
            
            let select = addElement('select', [], {name: "prodOption"});
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