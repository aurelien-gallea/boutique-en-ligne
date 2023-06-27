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
                    if(count >= 10){
                        return;
                    }
                    let productImg = images.filter(image => image.product_id === product.id);
                    // console.log(productImg);
                    if (productImg.length == 1) {
                        let card = addElement('a', ["flex", "flex-col", "rounded-md", "shadow"], {href:`./product.php?name=${product.name}&id=${product.id}`});
                        document.getElementById('lastProduct').appendChild(card);
                        let img = addElement('img', ['max-w-none', 'w-[150px]', 'h-[250px]', "rounded-md"], { src: `./public/img/product/${productImg[0].path}` });
                        card.appendChild(img);
                    } else {
                        let card = addElement('a', ["flex", "flex-col", "rounded-md", "shadow"], {href:`./product.php?name=${product.name}&id=${product.id}`});
                        document.getElementById('lastProduct').appendChild(card);
                        let img = addElement('img', ['max-w-none', 'w-[150px]', 'h-[250px]', "rounded-md"], { src: `./public/img/product/${productImg[0].path}` });
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

                let btnAllProducts = addElement('button', ["w-1/2", "md:w-1/3", "xl:max-w-[300px]", "text-[#AD785D]", "bg-white", "border", "border-[#AD785D]", "focus:outline-none", "hover:bg-[#AD785D]", "hover:text-white", "focus:ring-4", "focus:ring-gray-200", "font-medium", "rounded-full", "text-sm", "px-5", "py-2.5", "mr-2", "mb-2", "dark:bg-[#FFF9F5]/30", "dark:text-[#AD785D]", "dark:hover:text-white", "dark:border-[#AD785D]", "dark:hover:bg-[#AD785D]", "dark:focus:ring-gray-700"], {type:"button"}, "Voir plus");
                document.getElementById('lastProduct').after(btnAllProducts);

                btnAllProducts.addEventListener('click', () => {
                    window.location.href = './allproducts.php';
                })
                let catCount = 0;
                categories.map(category => {
                    if(catCount >= 2){
                        return;
                    }
                    
                    let titlePlace = addElement('div', ["flex", "w-full", "max-w-screen-lg", "px-2", "mt-4"],{});
                    btnAllProducts.after(titlePlace)
                    let title = addElement('h2', ["text-2xl", "xl:text-4xl", "text-[#AD785D]", "font-bold", "text-start"], {}, `Nos ${category.name}s...`);
                    titlePlace.appendChild(title);

                    let containerCat = addElement('div', ["flex", "overflow-x-auto", "overflow-y-hidden", "max-w-screen-lg", "bg-[#AD785D]/30", "dark:bg-gray-700", "rounded-md", "gap-6", "w-full",  "px-4", "py-4", "scroll-smooth", "my-2"], {id:`category-${category.name}`});
                    titlePlace.after(containerCat);

                    let productCat = products_categories.filter(item => item.category_id === category.id);
                    products.map(product => {
                        
                        let ProdCat = productCat.filter(item => item.product_id === product.id);
                       
                        if(ProdCat.length){
                            
                            let productImg = images.filter(image => image.product_id === ProdCat[0].product_id);

                            if (productImg.length == 1) {
                                
                                let card = addElement('a', ["flex", "flex-col", "rounded-md", "shadow"], {href:`./product.php?name=${product.name}&id=${product.id}`});
                                containerCat.appendChild(card);
                                let img = addElement('img', ['max-w-none', 'w-[150px]', 'h-[250px]', "rounded-md"], { src: `./public/img/product/${productImg[0].path}` });
                                card.appendChild(img);
                            } else {

                                let card = addElement('a', ["flex", "flex-col", "rounded-md", "shadow"], {href:`./product.php?name=${product.name}&id=${product.id}`});
                                containerCat.appendChild(card);
                                let img = addElement('img', ['max-w-none', 'w-[150px]', 'h-[250px]', "rounded-md"], { src: `./public/img/product/${productImg[0].path}` });
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
            
                    let btnCategories = addElement('button', ["w-1/2", "md:w-1/3", "xl:max-w-[300px]", "text-[#AD785D]", "bg-white", "border", "border-[#AD785D]", "focus:outline-none", "hover:bg-[#AD785D]", "hover:text-white", "focus:ring-4", "focus:ring-gray-200", "font-medium", "rounded-full", "text-sm", "px-5", "py-2.5", "mr-2", "mb-2", "dark:bg-[#FFF9F5]/30", "dark:text-[#AD785D]", "dark:hover:text-white", "dark:border-[#AD785D]", "dark:hover:bg-[#AD785D]", "dark:focus:ring-gray-700"], {type:"button"}, "Voir plus");
                    containerCat.after(btnCategories);

                    btnCategories.addEventListener('click', () => {
                        window.location.href = `./category.php?name=${category.name}&id=${category.id}`;
                    })
                    catCount++;
                })
                    
            }
        })

})