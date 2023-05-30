// Affichage page accueil
// const btnAccueil = document.getElementById('accueil');
// btnAccueil.addEventListener('click', () => {
//     const accueil = document.getElementById('');
//     accueil.style.display = "flex";
// })


// Affichage de l'ajout des produits
const btnProduct = document.getElementById('products');
 
btnProduct.addEventListener('click', () => {
    const addProduct = document.getElementById('addProduct');
    if(addProduct.style.display == "none"){
        addProduct.style.display = "flex";
    }else{
        addProduct.style.display = "none";
    }
}); 

// Affichage de toutes les catégories
const btnCategories = document.getElementById('categories');

btnCategories.addEventListener('click', () => {
    const categories = document.getElementById('allCategories');
    categories.style.display = "flex";
});