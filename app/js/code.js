const app = new (function(){
    this.product_id = document.getElementById("product_id");
    this.product_name = document.getElementById("product_name");
    this.price = document.getElementById("price_stock");
    this.stock = document.getElementById("stock")
    
    this.listado = () => {
        fetch("../../Controllers/listProducts.php")
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
        })
        .catch((error) => console.log(error));
    }
    this.saveSale = async(productsList) => {
      var form = new FormData();
      //ver si el json viene correcto
      myJson = JSON.stringify(productsList);
      form.append("listProducts",myJson);
      
      return fetch("../../Controllers/productsSale.php", {
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
        return fetch("../../Controllers/searchProduct.php", {
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
