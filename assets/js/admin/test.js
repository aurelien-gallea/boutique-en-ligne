fetch('../php/Controller/getAllorderfinal.php')
        .then((response) => response.json())
        .then(data=> {
            console.log(data)

            console.log(data.orderfinal.all);
        })
        .catch(error => console.log(error.message));
