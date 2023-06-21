import { addElement } from "../modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {

    const grid = document.getElementById('grid_prod');
    fetch('../php/json/allproducts.php')
        .then(response => response.json())
        .then(data => {
            let products = data.products;
            let images = data.images;
            let prices = data.price;
            

            products.map(product => {
                
                let containerProd = addElement('a', ["relative"], {href:`./product.php?id=${product.id}`});
                grid.appendChild(containerProd);

                let productImg = images.filter(image => image.product_id === product.id);
                if(productImg.length > 0){ 
                    let imgProd = addElement('img', ["h-auto", "max-w-full", "rounded-lg"], {src:`../Public/img/${productImg[0].path}`, alt:`${product.name}`})
                    containerProd.appendChild(imgProd);

                    let contentProd = addElement('div', ["absolute", "hidden", "flex", "flex-col", "bottom-0", "backdrop-blur-md", "w-full", "h-auto", "px-2", "min-[425px]:h-20"], {});
                    containerProd.appendChild(contentProd);

                    let prodName = addElement('div', ["w-full", "h-1/2", "flex", "flex-wrap", "items-center", "font-mono", "text-normal", "min-[640px]:text-xl"], {}, `${product.name}`);
                    contentProd.appendChild(prodName)
                    
                    prices.map(price => {
                        if(product.id == price.product_id){
                            
                            let prodPrice = addElement('div', ["w-full", "h-1/2", "flex", "items-center", "font-mono", "text-xs", "min-[640px]:text-lg"], {}, `${price.price} €`);
                            contentProd.appendChild(prodPrice);
                        }
                    })

                    containerProd.addEventListener('mouseover', () => {
                        contentProd.classList.add('flex');
                        contentProd.classList.remove('hidden');
                    })

                    containerProd.addEventListener('mouseout', () => {
                        contentProd.classList.add('hidden');
                        contentProd.classList.remove('flex');
                    })


                }


            
            })
        })

})