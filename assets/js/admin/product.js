import { addElement } from "../modules/addElement.js";

document.addEventListener("DOMContentLoaded", function () {

    fetch('../../php/Json/product.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const product = data.products;
            const images = data.images;
            const price = data.price;
            const colors = data.color;
            const sizes = data.size;
            const stocks = data.stock;
            let Prod = document.getElementById('prodContainer');
            if (product !== false) {
                let container = addElement('div', ["flex", "flex-col", "w-full", "h-full", "space-y-5"], {});
                Prod.appendChild(container);

                let containerProd = addElement('div', ["flex", "flex-col", "shadow-md", "bg-white", "rounded-lg", "px-8", "py-4", "space-y-3", "dark:bg-gray-800", "dark:border"], {});
                container.appendChild(containerProd);

                let titleContainerProd = addElement('h2', ["text-md", "font-medium", "dark:text-white"], {}, "Produits");
                containerProd.appendChild(titleContainerProd);

                let nameProd = addElement('div', [], {});
                let labelName = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], { for: "title" }, "Nom");
                let inputName = addElement('input', ["block", "w-full", "p-2", "text-sm", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-white", "dark:focus:border-white"], { type: "text", id: "title", name: "title", value: `${product.name}` });
                containerProd.appendChild(nameProd);
                nameProd.appendChild(labelName);
                nameProd.appendChild(inputName);

                let descProd = addElement('div', [], {});
                let labelDesc = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], { for: "description" }, "Description");
                let inputDesc = addElement('textarea', ["block", "p-2.5", "w-full", "text-sm", "text-gray-900", "bg-gray-50", "rounded-lg", "border", "border-gray-300", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { type: "text", id: "description", name: "description" }, `${product.description}`);
                containerProd.appendChild(descProd);
                descProd.appendChild(labelDesc);
                descProd.appendChild(inputDesc);

                let containerImg = addElement('div', ["flex", "flex-col", "shadow-md", "bg-white", "rounded-lg", "px-8", "py-4", "space-y-3", "dark:bg-gray-800", "dark:border"], {});
                container.appendChild(containerImg);

                let titleContainerImg = addElement('h2', ["text-md", "font-medium", "dark:text-white"], {}, "Images");
                containerImg.appendChild(titleContainerImg);

                let gridOldImg = addElement('div', ["grid", "grid-cols-2", "md:grid-cols-4", "gap-4", "bg-gray-50", "rounded-lg", "dark:bg-gray-700", "p-2"], {})
                containerImg.appendChild(gridOldImg);

                images.map(image => {

                    let containerOldImg = addElement('div', ["flex", "relative", "shadow-sm", "bg-white", "rounded-lg"], {});
                    gridOldImg.appendChild(containerOldImg);

                    let oldImg = addElement('img', ["max-h-32", "max-w-full", "min-[425px]:max-h-24", "sm:max-h-[150px]", "md:max-h-44", "lg:max-h-[246px]", "xl:max-h-80", "rounded-lg"], { src: `../../public/img/product/${image.path}`, alt: `${product.name}` });
                    containerOldImg.appendChild(oldImg);

                    let crossImg = addElement('div', ["absolute", "flex", "w-full", "justify-end", "top-0", "h-auto", "px-2"], {});
                    containerOldImg.appendChild(crossImg);

                    let pathDelete = addElement('button', [], { type: "button", "data-modal-target": `popup-modal-${image.id}`, "data-modal-toggle": `popup-modal-${image.id}` });
                    crossImg.appendChild(pathDelete);

                    let deleteImg = addElement('i', ["fa-solid", "fa-xmark", "fa-lg", "text-red-700"], {});
                    pathDelete.appendChild(deleteImg);

                    pathDelete.addEventListener('click', () => {
                        let backdropModal = addElement('div', ["fixed", "backdrop-blur", "top-[0]", "left-[0]", "right-[0]", "z-50", "p-4", "overflow-x-hidden", "overflow-y-auto", "md:inset-0", "h-[calc(100%-1rem)]", "max-h-full"], { id: `popup-modal-${image.id}`, tabindex: "-1" });
                        document.body.appendChild(backdropModal);

                        let positionModal = addElement('div', ["flex", "justify-center", "items-center", "w-full", "h-full"], {});
                        backdropModal.appendChild(positionModal);

                        let containerModal = addElement('div', ["relative", "w-80", "h-auto", "bg-white", "rounded-lg", "shadow-lg", "dark:bg-gray-700"], {});
                        positionModal.appendChild(containerModal);

                        let contentModal = addElement('div', ["flex", "flex-col", "w-full", "h-full"], {});
                        containerModal.appendChild(contentModal);

                        let headerModal = addElement('div', ["flex", "w-full", "pt-3", "px-3", "justify-end"], {});
                        contentModal.appendChild(headerModal);

                        let closeModal = addElement('button', [], { "data-modal-hide": `popup-modal-${image.id}` });
                        headerModal.appendChild(closeModal);

                        let closeItem = addElement('i', ["fa-solid", "fa-xmark", "fa-lg", "text-gray-700", "dark:text-white"], {});
                        closeModal.appendChild(closeItem);

                        closeModal.addEventListener('click', () => {
                            backdropModal.classList.add('hidden');
                        })

                        let bodyModal = addElement('div', ["flex", "flex-col", "w-full", "p-3", "flex-wrap", "text-center"], {});
                        contentModal.appendChild(bodyModal);

                        let bodyItem = addElement('i', ["fa-solid", "fa-circle-exclamation", "text-5xl", "text-gray-500", "mb-2"], {});
                        bodyModal.appendChild(bodyItem);

                        let pModal = addElement('p', ["text-lg", "font-normal", "text-gray-500", "dark:text-white"], {}, `Êtes-vous sur de vouloir supprimer l'image ${image.path}`);
                        bodyModal.appendChild(pModal);

                        let footerModal = addElement('div', ["flex", "justify-around", "w-full", "py-3", "px-12"], {});
                        contentModal.appendChild(footerModal);

                        let buttonAgree = addElement('button', ["text-white", "bg-red-600", "hover:bg-red-800", "focus:ring-4", "focus:outline-none", "focus:ring-red-300", "dark:focus:ring-red-800", "font-medium", "rounded-lg", "text-sm", "inline-flex", "items-center", "px-5", "py-2.5", "text-center", "mr-2"], { type: "submit" }, "Confimer");
                        footerModal.appendChild(buttonAgree);
                        let buttonDisagree = addElement('button', ["text-gray-500", "bg-white", "hover:bg-gray-100", "focus:ring-4", "focus:outline-none", "focus:ring-gray-200", "rounded-lg", "border", "border-gray-200", "text-sm", "font-medium", "px-5", "py-2.5", "hover:text-gray-900", "focus:z-10", "dark:bg-gray-700", "dark:text-gray-300", "dark:border-gray-500", "dark:hover:text-white", "dark:hover:bg-gray-600", "dark:focus:ring-gray-600"], {}, "Annuler");
                        footerModal.appendChild(buttonDisagree);

                        buttonDisagree.addEventListener('click', () => {
                            backdropModal.classList.add('hidden');
                        })

                        buttonAgree.addEventListener('click', function () {
                            fetch('../../php/Controller/deleteImg.php', {
                                method: "POST",
                                body: JSON.stringify({
                                    image_id: image.id,
                                }),
                                headers: {
                                    'Content-Type': "application/json",
                                },
                            })
                                .then(function (response) {
                                    backdropModal.classList.add('hidden');
                                    window.location.reload();
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                        })
                    })
                })

                let imgProd = addElement('div', [], {});
                let labelImg = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], { for: "image" }, "Images");
                let inputImg = addElement('input', ["block", "w-full", "text-sm", "text-gray-900", "border", "border-gray-300", "rounded-lg", "cursor-pointer", "bg-gray-50", "dark:text-gray-400", "focus:outline-none", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400"], { type: "file", id: "image", name: "image[]", multiple: "" });
                containerImg.appendChild(imgProd);
                imgProd.appendChild(labelImg);
                imgProd.appendChild(inputImg);

                let containerPrice = addElement('div', ["flex", "flex-col", "shadow-md", "bg-white", "rounded-lg", "px-8", "py-4", "space-y-3", "dark:bg-gray-800", "dark:border"], {});
                container.appendChild(containerPrice);

                let titleContainerPrice = addElement('h2', ["text-md", "font-medium", "dark:text-white"], {}, "Prix");
                containerPrice.appendChild(titleContainerPrice);

                let priceProd = addElement('div', [], {});
                let labelPrice = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], { for: "price" }, "Prix");
                let inputPrice = addElement('input', ["block", "p-2.5", "w-1/3", "text-sm", "text-gray-900", "bg-gray-50", "rounded-lg", "border", "border-gray-300", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { type: "number", id: "price", name: "price", step: "0.01", value: `${price[0].price}` });
                containerPrice.appendChild(priceProd);
                priceProd.appendChild(labelPrice);
                priceProd.appendChild(inputPrice);

                let containerOptions = addElement('div', ["flex", "flex-col", "shadow-md", "bg-white", "rounded-lg", "px-8", "py-4", "space-y-3", "dark:bg-gray-800"], {});
                container.appendChild(containerOptions);

                let containerInputOptions = addElement('div', ["space-y-3"], {});
                containerOptions.appendChild(containerInputOptions);

                let titleOptions = addElement('h2', ["text-md", "font-medium", "dark:text-white"], {}, "Options");
                containerInputOptions.appendChild(titleOptions);

                let optionsProd = addElement('div', ["flex", "gap-2", "w-full"], {});
                containerInputOptions.appendChild(optionsProd);

                let containerColor = addElement('div', ["w-full"], {});
                let labelColor = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], { for: "color" }, "Couleurs");
                let inputColor = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { type: "text", id: "color" });
                optionsProd.appendChild(containerColor);
                containerColor.appendChild(labelColor);
                containerColor.appendChild(inputColor);

                let containerSize = addElement('div', ["w-full"], {});
                let labelSize = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], { for: "size" }, "Tailles");
                let inputSize = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { type: "text", id: "size" });
                optionsProd.appendChild(containerSize);
                containerSize.appendChild(labelSize);
                containerSize.appendChild(inputSize);

                let containerQty = addElement('div', ["w-full"], {});
                let labelQty = addElement('label', ["block", "mb-2", "text-sm", "font-normal", "text-gray-900", "dark:text-white"], { for: "quantity" }, "Quantités");
                let inputQty = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { type: "number", id: "quantity" });
                optionsProd.appendChild(containerQty);
                containerQty.appendChild(labelQty);
                containerQty.appendChild(inputQty);

                let buttonAddOptions = addElement('button', ["flex", "items-end", "pb-0.5"], { type: 'button', })
                let itemButton = addElement('i', ["fa-solid", "fa-arrow-turn-down", "fa-lg", "text-gray-600", "dark:text-white"], {})
                optionsProd.appendChild(buttonAddOptions);
                buttonAddOptions.appendChild(itemButton);

                buttonAddOptions.addEventListener('click', () => {
                    let colorChoice = inputColor.value;
                    let sizeChoice = inputSize.value;
                    let qtyChoice = inputQty.value;

                    if(colorChoice && sizeChoice && qtyChoice){
                        console.log(colorChoice, sizeChoice, qtyChoice);
                    }
                })

                let containerOldOptions = addElement('div', ["flex-col", "w-full", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border", "overflow-x-auto"], {});
                containerOptions.appendChild(containerOldOptions);

                let tableOptions = addElement('table', ["w-full", "text-sm", "text-left", "text-gray-500", "dark:text-gray-400"], {});
                containerOldOptions.appendChild(tableOptions);

                let thead = addElement('thead', ["text-xs", "text-gray-700", "uppercase", "bg-gray-50", "dark:bg-gray-700", "dark:text-gray-400"], {});
                tableOptions.appendChild(thead);

                let trthead = addElement('tr', [], {});
                thead.appendChild(trthead);

                let thColor = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Couleurs");
                let thSize = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Tailles");
                let thStock = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Quantités");
                let thDelete = addElement('th', ["px-6", "py-3"], { scope: "col" });
                trthead.appendChild(thColor);
                trthead.appendChild(thSize);
                trthead.appendChild(thStock);
                trthead.appendChild(thDelete);

                let tbody = addElement('tbody', [], {});
                tableOptions.appendChild(tbody);
                if (colors.length) {
                    stocks.map(stock => {
                        let color_id = "";
                        const Qty = stock.stock[0];

                        let trtbody = addElement('tr', ["bg-white", "border-b", "dark:bg-gray-800", "dark:border-gray-700"], {});
                        tbody.appendChild(trtbody);

                        let thContentDelete = addElement('td', ["px-6", "py-4"], {});
                        let pathDelete = addElement('button', [], { type: "button", "data-modal-target": `popup-modal-${Qty.id}`, "data-modal-toggle": `popup-modal-${Qty.id}` });
                        let DeleteItem = addElement('i', ["fa-regular", "fa-trash-can", "text-red-900", "dark:text-red-500", "fa-lg"], {});

                        let thQuantity = addElement('td', ["px-6", "py-4"], {});
                        let thInputQuantity = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { name: "quantity[]", value: `${Qty.quantity}` });

                        sizes.map(size => {
                            const eachSize = size.size;

                            eachSize.map(item => {
                                if (stock.sizeId == item.id) {

                                    let thSize = addElement('td', ["px-6", "py-4"], {});
                                    trtbody.appendChild(thSize);
                                    let thInputSize = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { name: "size[]", value: `${item.size}` });
                                    thSize.appendChild(thInputSize);

                                    colors.map(color => {
                                        if (size.colorId == color.id) {

                                            let thColor = addElement('th', ["px-6", "py-4", "font-normal", "text-gray-900", "whitespace-nowrap", "dark:text-white"], { scope: "row" });
                                            trtbody.appendChild(thColor);
                                            let thInputColor = addElement('input', ["block", "w-full", "p-2", "text-gray-900", "border", "border-gray-300", "rounded-lg", "bg-gray-50", "sm:text-xs", "focus:ring-blue-500", "focus:border-blue-500", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white", "dark:focus:ring-blue-500", "dark:focus:border-blue-500"], { name: "color[]", value: `${color.color}` });
                                            thColor.appendChild(thInputColor);
                                            color_id = Number(color.id);
                                        }
                                    })
                                    trtbody.appendChild(thSize);
                                    thSize.appendChild(thInputSize);
                                }
                            })
                        })
                        trtbody.appendChild(thQuantity);
                        thQuantity.appendChild(thInputQuantity);
                        trtbody.appendChild(thContentDelete);
                        thContentDelete.appendChild(pathDelete);
                        pathDelete.appendChild(DeleteItem);

                        pathDelete.addEventListener('click', () => {
                            let backdropModal = addElement('div', ["fixed", "backdrop-blur", "top-[0]", "left-[0]", "right-[0]", "z-50", "p-4", "overflow-x-hidden", "overflow-y-auto", "md:inset-0", "h-[calc(100%-1rem)]", "max-h-full"], { id: `popup-modal-${Qty.id}`, tabindex: "-1" });
                            document.body.appendChild(backdropModal);

                            let positionModal = addElement('div', ["flex", "justify-center", "items-center", "w-full", "h-full"], {});
                            backdropModal.appendChild(positionModal);

                            let containerModal = addElement('div', ["relative", "w-80", "h-auto", "bg-white", "rounded-lg", "shadow-lg", "dark:bg-gray-700"], {});
                            positionModal.appendChild(containerModal);

                            let contentModal = addElement('div', ["flex", "flex-col", "w-full", "h-full"], {});
                            containerModal.appendChild(contentModal);

                            let headerModal = addElement('div', ["flex", "w-full", "pt-3", "px-3", "justify-end"], {});
                            contentModal.appendChild(headerModal);

                            let closeModal = addElement('button', [], { "data-modal-hide": `popup-modal-${Qty.id}` });
                            headerModal.appendChild(closeModal);

                            let closeItem = addElement('i', ["fa-solid", "fa-xmark", "fa-lg", "text-gray-700", "dark:text-white"], {});
                            closeModal.appendChild(closeItem);

                            closeModal.addEventListener('click', () => {
                                backdropModal.classList.add('hidden');
                            })

                            let bodyModal = addElement('div', ["flex", "flex-col", "w-full", "p-3", "flex-wrap", "text-center"], {});
                            contentModal.appendChild(bodyModal);

                            let bodyItem = addElement('i', ["fa-solid", "fa-circle-exclamation", "text-5xl", "text-gray-500", "mb-2"], {});
                            bodyModal.appendChild(bodyItem);

                            let pModal = addElement('p', ["text-lg", "font-normal", "text-gray-500", "dark:text-white"], {}, `Êtes-vous sur de vouloir supprimer la ligne`);
                            bodyModal.appendChild(pModal);

                            let footerModal = addElement('div', ["flex", "justify-around", "w-full", "py-3", "px-12"], {});
                            contentModal.appendChild(footerModal);

                            let buttonAgree = addElement('button', ["text-white", "bg-red-600", "hover:bg-red-800", "focus:ring-4", "focus:outline-none", "focus:ring-red-300", "dark:focus:ring-red-800", "font-medium", "rounded-lg", "text-sm", "inline-flex", "items-center", "px-5", "py-2.5", "text-center", "mr-2"], { type: "submit" }, "Confimer");
                            footerModal.appendChild(buttonAgree);
                            let buttonDisagree = addElement('button', ["text-gray-500", "bg-white", "hover:bg-gray-100", "focus:ring-4", "focus:outline-none", "focus:ring-gray-200", "rounded-lg", "border", "border-gray-200", "text-sm", "font-medium", "px-5", "py-2.5", "hover:text-gray-900", "focus:z-10", "dark:bg-gray-700", "dark:text-gray-300", "dark:border-gray-500", "dark:hover:text-white", "dark:hover:bg-gray-600", "dark:focus:ring-gray-600"], {}, "Annuler");
                            footerModal.appendChild(buttonDisagree);

                            buttonDisagree.addEventListener('click', () => {
                                backdropModal.classList.add('hidden');
                            })

                            buttonAgree.addEventListener('click', function () {
                                fetch('../../php/Controller/deleteOptions.php', {
                                    method: "POST",
                                    body: JSON.stringify({
                                        quantity_id: Qty.id,
                                        size_id: Number(stock.sizeId),
                                        color: Number(color_id),
                                    }),
                                    headers: {
                                        'Content-Type': "application/json",
                                    },
                                })
                                    .then(function (response) {
                                        backdropModal.classList.add('hidden');
                                        window.location.reload();
                                    })
                                    .catch(function (error) {
                                        console.log(error);
                                    });
                            })
                        })
                    })
                }else{
                    containerOldOptions.classList.add('hidden');
                }


                sizes.map(size => {
                    colors.map(color => {
                        if (size.colorId == color.id) {
                            if (size.size.length == 0) {
                                fetch('../../php/Controller/deleteColor.php', {
                                    method: "POST",
                                    body: JSON.stringify({
                                        color_id: color.id,
                                    }),
                                    headers: {
                                        'Content-Type': "application/json",
                                    },
                                })
                                    .then(function (response) {
                                        console.log('supression réussi');
                                        window.location.reload();
                                    })
                                    .catch((error) => { console.log(error) })
                            }
                        }
                    })

                })

            } else {
                Prod.classList.add('items-center');

                let noProd = addElement('div', ["flex", "w-full", "items-center", "justify-center"], {}, `oops ce produit n'existe pas...`);
                Prod.appendChild(noProd);

                let btnProd = addElement('a', ["text-white", "w-auto", "mb-2", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-3", "py-2", "inline-flex", "items-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], { href: "./allProducts.php" }, `Retour aux produits`);
                Prod.appendChild(btnProd);
            }
        })
        .catch((error) => console.log(error));
})