import { addElement } from "../modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {
    const grid = document.getElementById('grid_prod');
    fetch('./php/json/productsByCategories.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let products = data.products_categories;
            let images = data.images;
            let prices = data.price;
            if (products.length) {
                products.map(product => {

                    let containerProd = addElement('a', ["flex", "justify-center", "items-center", "relative", "shadow-sm", "bg-white", "rounded-lg"], { href: `./product.php?name=${product.name}&id=${product.id}` });
                    grid.appendChild(containerProd);

                    let productImg = images.filter(image => image.product_id === product.id);
                    if (productImg.length > 0) {
                        let imgProd = addElement('img', ["max-h-32", "max-w-full", "min-[425px]:max-h-40", "min-[640px]:max-h-72", "md:max-h-80", "lg:max-h-72", "xl:max-h-80", "rounded-lg"], { src: `./Public/img/product/${productImg[0].path}`, alt: `${product.name}` })
                        containerProd.appendChild(imgProd);

                        let contentProd = addElement('div', ["absolute", "hidden", "flex", "flex-col", "bottom-0", "backdrop-blur-md", "w-full", "h-auto", "px-2", "min-[425px]:h-20", "rounded-b-lg"], {});
                        containerProd.appendChild(contentProd);

                        let prodName = addElement('div', ["w-full", "h-1/2", "flex", "flex-wrap", "items-center", "font-mono", "text-normal", "min-[640px]:text-xl"], {}, `${product.name}`);
                        contentProd.appendChild(prodName)

                        prices.map(price => {
                            if (product.id == price.product_id) {

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
            }else{

                document.getElementById('grid_prod').classList.add('hidden');
                // Créer un élément div avec des classes et des attributs spécifiques 
                // let Container = addElement('div', ["flex", "w-full", "justify-center", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border", "overflow-x-auto"], {});
                // document.getElementById('grid_prod').before(Container);

                let content = addElement('div', ["flex", "flex-col", "shadow-md", "items-center", "p-4", "bg-white", "rounded-lg", "space-y-3", "dark:bg-gray-800", "dark:border", "mt-4"], {});
                document.getElementById('grid_prod').before(content);

                let title = addElement('h5', ["dark:text-white", "text-center"], {}, "Les produits de cette catégorie se font une beauté");
                content.appendChild(title);

                let btnReturnProd = addElement('a', ["text-white", "w-auto", "mb-2", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-3", "py-2", "inline-flex", "items-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {href:"./allproducts.php"}, "Retour sur tous les produits");
                content.appendChild(btnReturnProd);
            }
        })

})
