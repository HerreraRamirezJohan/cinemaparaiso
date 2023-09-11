const comboApp = new (function(){
    this.product_id = document.getElementById("product_id");
    this.product_name = document.getElementById("product_name");
    this.price = document.getElementById("price_stock");
    this.stock = document.getElementById("stock")
    
    this.listado = async() => {
        return fetch("../Controllers/listProducts.php")
        .then((res) => res.json())
        .then((data) => {
            return data;
        })
        .catch((error) => console.log(error));
    }
    this.editCombo = async(productsList, prod) => {
        var form = new FormData();
        //ver si el json viene correcto
        myJson = JSON.stringify(productsList);
        prodJson = JSON.stringify(prod);

        form.append("listProducts",myJson);
        form.append("prod", prodJson);
        
        return fetch("../Controllers/editCombo.php", {
            method:"POST",
            body:form,
        })
        .then((res) => res.text())
        .then((data) => {
            return data;
        })
        .catch((error) => console.log(error));
    };

    this.saveProduct = async(prod) =>{
        var form = new FormData();
        //ver si el json viene correcto
        prodJson = JSON.stringify(prod);
        form.append("prod", prodJson);
        
        return fetch("../Controllers/saveDetailCombo.php", {
            method:"POST",
            body:form,
        })
        .then((res) => res.text())
        .then((data) => {
            return data;
        })
        .catch((error) => console.log(error));
    }

    this.saveCombo = async(productsList, prod) => {
        var form = new FormData();
        //ver si el json viene correcto
        myJson = JSON.stringify(productsList);
        prodJson = JSON.stringify(prod);

        form.append("listProducts",myJson);
        form.append("prod", prodJson);
        
        return fetch("../Controllers/saveDetailCombo.php", {
            method:"POST",
            body:form,
        })
        .then((res) => res.text())
        .then((data) => {
            return data;
        })
        .catch((error) => console.log(error));
    };

    this.search = async(id) => {
        var form = new FormData();
        form.append("id", id);
        return fetch("../Controllers/searchProduct.php", {
          method: "POST",
          body: form,
        })
          .then((res) => res.json())
          .then((data) => {
            this.product_id.value = data.product_id;
            this.product_name.value = data.product_name;
            this.price.value = data.price_stock;
            this.stock.value = data.stock;
          })
          .catch((error) => console.log(error));
      };
})();
