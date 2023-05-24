fetch('../php/Controller/json.php')
        .then((response) => response.json())
        .then(data=> {
            console.log(data)
        })