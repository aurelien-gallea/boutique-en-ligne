import { addElement } from "../modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {
    
    fetch('./php/Json/productCard.php')
        .then(response => response.json())
        .then(data => {
            
            const product = data.products;
            const images = data.images;
            const colors = data.color;
            const price = data.price;
            const sizes = data.size;

            
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

                        let firstImg = addElement('img', ["max-h-52", "max-w-full", "rounded-lg", "shadow-md"], {src:`./public/img/product/${images[0].path}`, alt:`${product.name}`});
                        containerFirstImg.appendChild(firstImg);

                        images.forEach(image => {
                        
                            let divImgs = addElement('div', ["flex", "w-full", "items-center", "justify-center"], {});
                            containerAllImg.appendChild(divImgs);

                            let imgs = addElement('img', ["max-h-[70px]", "max-w-full", "min-[425px]:max-h-24", "sm:max-h-[150px]", "md:max-h-44", "lg:max-h-[246px]", "xl:max-h-80", "rounded-lg"], {src:`./public/img/product/${image.path}`, alt:`${product.name}`});
                            divImgs.appendChild(imgs);

                        })

                    }else{

                        let containerAllImg = addElement('div', ["grid", `grid-cols-${images.length-1}`, "gap-2"], {});
                        gridImg.appendChild(containerAllImg);

                        let firstImg = addElement('img', ["max-h-[450px]", "max-w-full", "rounded-lg", "shadow-md"], {src:`./public/img/product/${images[0].path}`, alt:`${product.name}`});
                        containerFirstImg.appendChild(firstImg);

                        images.forEach(image => {
                        
                            let divImgs = addElement('div', ["flex", "w-full", "items-center", "justify-center"], {});
                            containerAllImg.appendChild(divImgs);

                            let imgs = addElement('img', ["max-h-[70px]", "max-w-full", "min-[425px]:max-h-24", "sm:max-h-[150px]", "md:max-h-44", "lg:max-h-[246px]", "rounded-lg"], {src:`./public/img/product/${image.path}`, alt:`${product.name}`});
                            divImgs.appendChild(imgs);

                        })
                    }


                }else if(images.length === 1){
                    
                    const stash = images[0];
                    
                    if(stash.product_id == product.id){

                        let firstImg = addElement('img', ["max-h-[450px]", "max-w-full", "rounded-lg", "shadow-md"], {src:`./public/img/product/${stash.path}`, alt:`${product.name}`});
                        containerFirstImg.appendChild(firstImg);

                    }

                }
                
                let prodName = addElement('h2', ["text-md", "min-[425px]:text-xl", "md:text-3xl", "font-bold", "text-gray-500", "dark:text-white"], {}, `${product.name}`);
                containerProd.appendChild(prodName);
                
                let priceProd = addElement('h5', ["text-md", "min-[425px]:text-xl", "font-normal", "dark:text-white"], {}, `${price[0].price} €`);
                containerProd.appendChild(priceProd);

                let containerColor = addElement('div', ["grid", "w-full", "gap-6", `grid-cols-${colors.length}`, 'pt-6']);
                containerProd.appendChild(containerColor);

                let sizeAndQty = addElement('div', ["flex", "pt-6", "w-full", "gap-6"], {});
                containerProd.appendChild(sizeAndQty);

                let containerSize = addElement('div', ["flex", "flex-col", "w-1/2"], {});
                let containerQty = addElement('div', ["flex", "flex-col", "w-1/2"], {});
                sizeAndQty.appendChild(containerSize);
                sizeAndQty.appendChild(containerQty);

                let labelSelectSize = addElement('label', ["block", "mb-2", "text-sm", "font-medium", "text-gray-900", "dark:text-white"], {for:'selectSize'}, 'Tailles');
                let selectSize = addElement('select', ["block", "w-full", "p-2", "mb-6", "text-sm", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-900", "dark:border-gray-600", "dark:placeholder-gray-500", "dark:text-gray-400", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], {id:'selectSize'});
                containerSize.appendChild(labelSelectSize);
                containerSize.appendChild(selectSize);

                let labelQty = addElement('label', ["block", "mb-2", "text-sm", "font-medium", "text-gray-900", "dark:text-white"], {for:"quantity"}, "Quantité");
                let inputQty = addElement('input', ["block", "w-full", "h-[38px]", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-900", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-gray-400", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], {type:"number", value:"1", max:"10", id:"quantity", name:"quantity"});
                containerQty.appendChild(labelQty);
                containerQty.appendChild(inputQty);

                let containerBtn = addElement('div', ["flex", "items-center", "justify-center", "pt-6"], {});
                containerProd.appendChild(containerBtn);

                let btnAddToCart = addElement('button', ["w-1/3", "text-white", "bg-blue-700", "hover:bg-blue-800", "focus:outline-none", "focus:ring-4", "focus:ring-blue-300", "font-medium", "rounded-full", "text-sm", "px-5", "py-2.5", "text-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {type:"submit", disabled:""}, "Ajouter au panier");
                containerBtn.appendChild(btnAddToCart);

                let sizeChoice = "";
                let colorChoice = "";
                let myColorId = "";

                let mySize = "";
                let mySizeId = "";
                let myQty = 1;
                
                colors.map(color =>{
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

                    const colorEventHandler = (action) => {

                        inputColor.addEventListener(action, () => {
                            selectSize.innerHTML = '';
                            sizes.map(size => {
                                if(size.colorId == color.id){
                                    sizeChoice = size.size;
                                    colorChoice = color.color;
                                    myColorId = Number(color.id);
                                    console.log(colorChoice, myColorId);
                                    sizeChoice.map(item => {
                                        let optionSize = addElement('option', [], {value:`${item.id}`}, `${item.size}`);
                                        selectSize.appendChild(optionSize);
                                    })
                                }
                            })

                            mySize = selectSize.options[selectSize.selectedIndex].textContent;
                            mySizeId = selectSize.value;
                            myQty = inputQty.value;
                            console.log(mySize, mySizeId, myQty);
                            
        
                            selectSize.addEventListener("change", () => {
                                mySize = selectSize.options[selectSize.selectedIndex].textContent;
                                mySizeId = selectSize.value;
                                console.log(mySize, mySizeId, myQty);
                            })

                            inputQty.addEventListener("change", () => (myQty = inputQty.value));
                            btnAddToCart.removeAttribute('disabled');
                            
                        }) 
                    }
                    colorEventHandler("click");              
                })

                btnAddToCart.addEventListener('click', function (){
                    if(mySize !== null & myQty > 0){

                        fetch('./php/Controller/verifAddToCart.php', {
                            method: "POST",

                            body: JSON.stringify({
                                product_id: product.id,
                                color: colorChoice,
                                color_id: myColorId,
                                size: mySize,
                                size_id: Number(mySizeId),
                                quantity: Number(myQty),
                                price: price[0].price,
                                price_id: price[0].id,
                            }),
                            headers: {
                                "Content-Type": "application/json",
                            },
                        })
                        .then(function (response){
                            inputQty.value = 1;
                            myQty = inputQty.value;

                            // on fait un toast de notification
                            const toast = document.createElement("div");
                            toast.classList.add("fixed",  'top-26');
                            toast.innerHTML = `<div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 dark:text-gray-500 dark:bg-white rounded-lg shadow text-gray-400 bg-gray-800" role="alert">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Check icon</span>
                                </div>
                                <div class="ml-3 text-sm font-normal">Produit ajouté au panier !</div>
                                <button id="close" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                                </div>`;
                            document.querySelector("#main-container").prepend(toast);
                            const closeToast = document.querySelector("#close");
                            setTimeout(() => {
                                toast.remove();
                            }, 3000);
                            closeToast.addEventListener('click', ()=> {
                                toast.remove();
                                
                            });
                            if (!response.ok) {
                              alert("Un problème a été détecté, merci de contacter un administrateur.");
                            }
                        })
                        .catch(function (error){
                            console.log(error);
                        })
                    }
                })
                
            }else{

                gridProd.classList.add('flex-col', 'items-center');

                let noProd = addElement('div', ["flex", "w-full", "items-center", "justify-center"], {}, `oops ce produit n'existe pas...`);
                gridProd.appendChild(noProd);

                let btnProd = addElement('a', ["text-white", "w-auto", "mb-2", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-3", "py-2", "inline-flex", "items-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {href:"../templates/products.php"}, `Retour aux produits`);
                gridProd.appendChild(btnProd);
            }
 
        })
        .catch((error) => console.log(error))

})