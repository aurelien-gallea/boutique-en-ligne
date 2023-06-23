import { addElement } from "../modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {
    
    fetch('../php/Json/productCard.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let product = data.products;
            let images = data.images;
            let colors = data.color;
            let price = data.price;
            let sizes = data.size;
            console.log(price);

            
            let gridProd = document.getElementById('grid_prod');
            if(product !== false){

                let gridImg = addElement('div', ["grid", "gap-2", "w-1/2", "py-8", "pl-2", "md:pl-8"], {});
                let containerProd = addElement('div', ["flex", "flex-col", "w-1/2", "pr-2", "py-8", "md:pr-8"], {});
                gridProd.appendChild(gridImg);
                gridProd.appendChild(containerProd);

                let containerFirstImg = addElement('div', ["flex", "w-full", "items-center", "justify-center"], {});
                gridImg.appendChild(containerFirstImg);
                if(images.length > 1){

                    if(images.length % 2 == 0){

                        let containerAllImg = addElement('div', ["grid", `grid-cols-${images.length}`, "gap-4"], {});
                        gridImg.appendChild(containerAllImg);

                        let firstImg = addElement('img', ["max-h-52", "max-w-full", "rounded-lg", "shadow-md"], {src:`../public/img/product/${images[0].path}`, alt:`${product.name}`});
                        containerFirstImg.appendChild(firstImg);

                        images.forEach(image => {
                        
                            let divImgs = addElement('div', ["flex", "w-full", "items-center", "justify-center"], {});
                            containerAllImg.appendChild(divImgs);

                            let imgs = addElement('img', ["max-h-[70px]", "max-w-full", "min-[425px]:max-h-24", "sm:max-h-[150px]", "md:max-h-44", "lg:max-h-[246px]", "xl:max-h-80", "rounded-lg"], {src:`../public/img/product/${image.path}`, alt:`${product.name}`});
                            divImgs.appendChild(imgs);

                        })

                    }else{

                        let containerAllImg = addElement('div', ["grid", `grid-cols-${images.length-1}`, "gap-2"], {});
                        gridImg.appendChild(containerAllImg);

                        let firstImg = addElement('img', ["max-h-[450px]", "max-w-full", "rounded-lg", "shadow-md"], {src:`../public/img/product/${images[0].path}`, alt:`${product.name}`});
                        containerFirstImg.appendChild(firstImg);

                        images.forEach(image => {
                        
                            let divImgs = addElement('div', ["flex", "w-full", "items-center", "justify-center"], {});
                            containerAllImg.appendChild(divImgs);

                            let imgs = addElement('img', ["max-h-[70px]", "max-w-full", "min-[425px]:max-h-24", "sm:max-h-[150px]", "md:max-h-44", "lg:max-h-[246px]", "rounded-lg"], {src:`../public/img/product/${image.path}`, alt:`${product.name}`});
                            divImgs.appendChild(imgs);

                        })
                    }

                    // for(const key in images){

                    //     const stash = images[key];
                    //     let myKeyColor = key;

                    // }
                    

                }else if(images.length === 1){
                    
                    const stash = images[0];
                    
                    if(stash.product_id == product.id){

                        let firstImg = addElement('img', ["max-h-[450px]", "max-w-full", "rounded-lg", "shadow-md"], {src:`../public/img/product/${stash.path}`, alt:`${product.name}`});
                        containerFirstImg.appendChild(firstImg);

                    }

                }
                
                let prodName = addElement('h2', ["text-md", "min-[425px]:text-xl", "md:text-3xl", "font-bold", "text-gray-500", "dark:text-white"], {}, `${product.name}`);
                containerProd.appendChild(prodName);
                

                let priceProd = addElement('h5', ["text-md", "min-[425px]:text-xl", "font-normal", "dark:text-white"], {}, `${price[0].price} €`);
                containerProd.appendChild(priceProd);

                let containerColor = addElement('div', ["grid", "w-full", "gap-6", `grid-cols-${colors.length}`, 'pt-6']);
                containerProd.appendChild(containerColor);

                colors.map(color =>{
                    console.log(color);
                    let contentColor = addElement('div', [], {});
                    containerColor.appendChild(contentColor);

                    let inputColor = addElement('input', ["hidden", "peer"], {value:`${color.id}`, name:`colorChoice`, type:"radio", id:`color-${color.id}`, required:""});
                    let labelColor = addElement('label', ["inline-flex", "items-center", "justify-between", "w-full", "p-5", "text-gray-500", "bg-white", "border", "border-gray-200", "rounded-lg", "cursor-pointer", "dark:hover:text-gray-300", "dark:border-gray-700", "dark:peer-checked:text-blue-500", "peer-checked:border-blue-600", "peer-checked:text-blue-600", "hover:text-gray-600", "hover:bg-gray-100", "dark:text-gray-400", "dark:bg-gray-900", "dark:hover:bg-gray-800"], {for:`color-${color.id}`})
                    contentColor.appendChild(inputColor);
                    contentColor.appendChild(labelColor);

                    let divBlock = addElement('div', ["block"], {});
                    labelColor.appendChild(divBlock);

                    let colorName = addElement('div', ["w-full", "text-lg", "font-semibold"], {}, `${color.color}`);
                    divBlock.appendChild(colorName);
                    
                })

                
            }else{

                gridProd.classList.add('flex-col', 'items-center');

                let noProd = addElement('div', ["flex", "w-full", "items-center", "justify-center"], {}, `oops ce produit n'existe pas...`);
                gridProd.appendChild(noProd);

                let btnProd = addElement('a', ["text-white", "w-auto", "mb-2", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-3", "py-2", "inline-flex", "items-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {href:"./products.php"}, `Retour aux produits`);
                gridProd.appendChild(btnProd);
            }
 
        })
        .catch((error) => console.log(error))

})