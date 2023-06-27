import { addElement } from "./modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {

    fetch('./php/Json/allProducts.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const products = data.products;
            const images = data.images;
            const categories = data.categories;
            const products_categories = data.products_categories;

            if (products.length) {
                let count = 0;
                products.map(product => {
                    if(count >= 5){
                        return;
                    }
                    let productImg = images.filter(image => image.product_id === product.id);
                    // console.log(productImg);
                    if (productImg.length == 1) {
                        let card = addElement('div', ["flex", "flex-col"], {});
                        document.getElementById('lastProduct').appendChild(card);
                        let img = addElement('img', ['max-w-none', 'w-[150px]', 'h-[250px]'], { src: `./public/img/product/${productImg[0].path}` });
                        card.appendChild(img);
                    } else {
                        let card = addElement('div', ["flex", "flex-col"], {});
                        document.getElementById('lastProduct').appendChild(card);
                        let img = addElement('img', ['max-w-none', 'w-[150px]', 'h-[250px]'], { src: `./public/img/product/${productImg[0].path}` });
                        card.appendChild(img);

                        card.addEventListener('mouseover', () => {
                            img.setAttribute("src", `./public/img/product/${productImg[1].path}`);
                            card.addEventListener('mouseout', () => {
                                img.setAttribute("src", `./public/img/product/${productImg[0].path}`);
                            })
                        })
                    }
                    count++;
                })

                let btnAllProducts = addElement('button', ["w-1/3", "text-white", "bg-blue-700", "hover:bg-blue-800", "focus:outline-none", "focus:ring-4", "focus:ring-blue-300", "font-medium", "rounded-full", "text-sm", "px-5", "py-2.5", "text-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {type:"button"}, "Voir plus");
                document.getElementById('lastProduct').after(btnAllProducts);

                btnAllProducts.addEventListener('click', () => {
                    window.location.href = './allproducts.php';
                })
                let catCount = 0;
                categories.map(category => {
                    if(catCount >= 2){
                        return;
                    }
                    
                    let title = addElement('h2', ["text-start"], {}, `${category.name}`);
                    btnAllProducts.after(title);

                    let containerCat = addElement('div', ["flex", "overflow-x-auto", "overflow-y-hidden", "gap-6", "w-full", "pt-4", "scroll-smooth", "mb-2"], {id:`category-${category.name}`});
                    title.after(containerCat);

                    let productCat = products_categories.filter(item => item.category_id === category.id);
                    products.map(product => {
                        
                        let ProdCat = productCat.filter(item => item.product_id === product.id);
                       
                        if(ProdCat.length){
                            
                            let productImg = images.filter(image => image.product_id === ProdCat[0].product_id);
                            if (productImg.length == 1) {
                                
                                let card = addElement('div', ["flex", "flex-col"], {});
                                containerCat.appendChild(card);
                                let img = addElement('img', ['max-w-none', 'w-[150px]', 'h-[250px]'], { src: `./public/img/product/${productImg[0].path}` });
                                card.appendChild(img);
                            } else {

                                let card = addElement('div', ["flex", "flex-col"], {});
                                containerCat.appendChild(card);
                                let img = addElement('img', ['max-w-none', 'w-[150px]', 'h-[250px]'], { src: `./public/img/product/${productImg[0].path}` });
                                card.appendChild(img);
        
                                card.addEventListener('mouseover', () => {
                                    img.setAttribute("src", `./public/img/product/${productImg[1].path}`);
                                    card.addEventListener('mouseout', () => {
                                        img.setAttribute("src", `./public/img/product/${productImg[0].path}`);
                                    })
                                })
                            }
                        }
                    })
                    let btnCategories = addElement('button', ["w-1/3", "text-white", "bg-blue-700", "hover:bg-blue-800", "focus:outline-none", "focus:ring-4", "focus:ring-blue-300", "font-medium", "rounded-full", "text-sm", "px-5", "py-2.5", "text-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {type:"button"}, "Voir plus");
                    containerCat.after(btnCategories);

                    btnCategories.addEventListener('click', () => {
                        window.location.href = `./category.php?name=${category.name}&id=${category.id}`;
                    })
                    catCount++;
                })
                    
            }
        })

})