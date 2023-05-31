import { addElement } from "../modules/addElement.js";


// fetch('../php/Json/AllProduct.php')
//         .then(response => response.json())
//         .then(data=> {
//             // console.log(data);
//         })



fetch('../../php/Json/AllProdCat.php')
    .then(response => response.json())
    .then(data=> {
        console.log(data);
})