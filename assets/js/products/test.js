fetch('../php/Json/productCard.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })