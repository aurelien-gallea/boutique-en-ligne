fetch('../php/Controller/json.php')
        .then((response) => response.json())
        .then(data=> {
            console.log(data)

            for (const key in data.cart) {
                console.log("id = " + data.cart[key].id);
            }
        })