import { addElement } from "../modules/addElement.js";
document.addEventListener("DOMContentLoaded", function () {

    fetch('../../php/Json/allCarriers.php')
        .then(response => response.json())
        .then(carriers => {
            console.log(carriers);

            if (carriers && carriers.length) {

                let ContainerTable = addElement('div', ["flex", "flex-col", "w-full", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border"], {});
                document.getElementById('carrierContainer').appendChild(ContainerTable);

                let tableCat = addElement('table', ["w-full", "text-sm", "text-left", "text-gray-500", "dark:text-gray-400"], {});
                ContainerTable.appendChild(tableCat);

                let thead = addElement('thead', ["text-xs", "text-gray-700", "uppercase", "bg-gray-50", "dark:bg-gray-700", "dark:text-gray-400"], {});
                tableCat.appendChild(thead);

                let trthead = addElement('tr', [], {});
                thead.appendChild(trthead);

                let thId = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Id");
                let thName = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Nom");
                let thDescription = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Description");
                let thPrice = addElement('th', ["px-6", "py-3"], { scope: "col" }, "Price");
                let thDelete = addElement('th', ["px-6", "py-3"], { scope: "col" });
                trthead.appendChild(thId);
                trthead.appendChild(thName);
                trthead.appendChild(thDescription);
                trthead.appendChild(thPrice);
                trthead.appendChild(thDelete);

                let tbody = addElement('tbody', [], {});
                thead.after(tbody);

                carriers.map(carrier => {

                    console.log(carrier.id);
                    let trtbody = addElement('tr', ["bg-white", "border-b", "dark:bg-gray-800", "dark:border-gray-700"], {});
                    tbody.appendChild(trtbody);

                    let thContentId = addElement('th', ["px-6", "py-4", "font-normal", "text-gray-900", "whitespace-nowrap", "dark:text-white"], { scope: "row" }, `${carrier.id}`);
                    let thContentName = addElement('td', ["px-6", "py-4"], {}, `${carrier.name}`);
                    let thContentDescription = addElement('td', ["px-6", "py-4"], {}, `${carrier.description}`);
                    let thContentPrice = addElement('td', ["px-6", "py-4"], {}, `${carrier.price} €`)
                    let thContentDelete = addElement('td', ["px-6", "py-4"], {});
                    trtbody.appendChild(thContentId);
                    trtbody.appendChild(thContentName);
                    trtbody.appendChild(thContentDescription);
                    trtbody.appendChild(thContentPrice);
                    trtbody.appendChild(thContentDelete);


                    let pathDelete = addElement('button', [], { type: "button", "data-modal-target": `popup-modal-${carrier.id}`, "data-modal-toggle": `popup-modal-${carrier.id}` });
                    thContentDelete.appendChild(pathDelete);

                    let DeleteItem = addElement('i', ["fa-regular", "fa-trash-can", "text-red-900", "dark:text-red-500", "fa-lg"], {});
                    pathDelete.appendChild(DeleteItem);

                    pathDelete.addEventListener('click', () => {
                        let backdropModal = addElement('div', ["fixed", "backdrop-blur", "top-[0]", "left-[0]", "right-[0]", "z-50", "p-4", "overflow-x-hidden", "overflow-y-auto", "md:inset-0", "h-[calc(100%-1rem)]", "max-h-full"], { id: `popup-modal-${carrier.id}`, tabindex: "-1" });
                        document.body.appendChild(backdropModal);

                        let positionModal = addElement('div', ["flex", "justify-center", "items-center", "w-full", "h-full"], {});
                        backdropModal.appendChild(positionModal);

                        let containerModal = addElement('div', ["relative", "w-80", "h-auto", "bg-white", "rounded-lg", "shadow-lg", "dark:bg-gray-700"], {});
                        positionModal.appendChild(containerModal);

                        let contentModal = addElement('div', ["flex", "flex-col", "w-full", "h-full"], {});
                        containerModal.appendChild(contentModal);

                        let headerModal = addElement('div', ["flex", "w-full", "pt-3", "px-3", "justify-end"], {});
                        contentModal.appendChild(headerModal);

                        let closeModal = addElement('button', [], { "data-modal-hide": `popup-modal-${carrier.id}` });
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

                        let pModal = addElement('p', ["text-lg", "font-normal", "text-gray-500", "dark:text-white"], {}, `Êtes-vous sur de vouloir supprimer le transporteur ${carrier.name}`);
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
                            fetch('../../php/Controller/deleteCarrier.php', {
                                method: "POST",
                                body: JSON.stringify({
                                    carrier_id: carrier.id
                                }),
                                headers: {
                                    'Content-Type':"application/json",
                                },
                            })
                            .then(function (response) {
                                console.log('envoie réussi');
                                console.log(carrier.id);
                                backdropModal.classList.add('hidden');
                                window.location.href = '../../php/Controller/deleteCarrier.php';
                            })
                            .catch(function (error) {
                                console.log('problème');
                            });
                        })

                    })



                })
            }else{
                document.getElementById('addCarrier').classList.add('hidden');
                // Créer un élément div avec des classes et des attributs spécifiques 
                let Container = addElement('div', ["flex", "w-full", "justify-center", "shadow-md", "bg-white", "rounded-lg", "p-4", "space-y-3", "dark:bg-gray-800", "dark:border", "overflow-x-auto"], {});
                document.getElementById('carrierContainer').appendChild(Container);

                let content = addElement('div', ["flex", "flex-col", "shadow-md", "items-center", "p-4", "bg-white", "rounded-lg", "space-y-3", "dark:bg-gray-700", "dark:border"], {});
                Container.appendChild(content);

                let title = addElement('h5', ["dark:text-white", "text-center"], {}, "Oops vous n'avez pas encore de transporteur");
                content.appendChild(title);

                let btnAddUser = addElement('a', ["text-white", "w-auto", "mb-2", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-3", "py-2", "inline-flex", "items-center", "dark:bg-blue-600", "dark:hover:bg-blue-700", "dark:focus:ring-blue-800"], {href:"./addCarrier.php"}, "Ajouter un transporteur");
                content.appendChild(btnAddUser);
            }
        })
})