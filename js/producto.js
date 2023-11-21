<!-- Lista de Productos -->
<ul id="product-list"></ul>

<script>
    // Función para agregar un producto a la lista
    function addProduct() {
        // Obtenemos los valores del formulario
        const productName = document.getElementById('product-name').value;
        const productPrice = document.getElementById('product-price').value;
        const productQuantity = document.getElementById('product-quantity').value;
        const productDescription = document.getElementById('product-description').value;

        // Creamos un nuevo elemento de lista
        const listItem = document.createElement('li');
        listItem.innerHTML = `<strong>${productName}</strong> - Precio: $${productPrice} - Cantidad: ${productQuantity} - ${productDescription} <button onclick="editProduct(this)">Editar</button> <button onclick="deleteProduct(this)">Eliminar</button>`;

        // Agregamos el elemento de lista a la lista de productos
        document.getElementById('product-list').appendChild(listItem);

        // Limpiamos el formulario
        document.getElementById('product-form').reset();
    }

    // Función para editar un producto
    function editProduct(button) {
        const listItem = button.parentNode;
        const productInfo = listItem.innerText.split(' - ');

        // Rellenamos el formulario con la información del producto
        document.getElementById('product-name').value = productInfo[0];
        document.getElementById('product-price').value = parseFloat(productInfo[1].replace('Precio: $', ''));
        document.getElementById('product-quantity').value = parseInt(productInfo[2].replace('Cantidad: ', ''));
        document.getElementById('product-description').value = productInfo[3];

        // Eliminamos el producto de la lista
        listItem.remove();
    }

    // Función para eliminar un producto
    function deleteProduct(button) {
        const listItem = button.parentNode;
        listItem.remove();
    }
</script>
   <!-- ... tu código HTML anterior ... -->

   <script>
       function addProduct() {
           // ... código para obtener valores del formulario ...

           // Enviar datos al servidor (PHP) para guardar en la base de datos
           fetch('guardar_producto.php', {
               method: 'POST',
               headers: {
                   'Content-Type': 'application/json',
               },
               body: JSON.stringify({
                   name: productName,
                   price: productPrice,
                   quantity: productQuantity,
                   description: productDescription
               }),
           })
           .then(response => response.json())
           .then(data => {
               // Manejar la respuesta del servidor si es necesario
               console.log('Producto guardado:', data);
           });

           // ... resto de tu código ...
       }

       // ... funciones editProduct y deleteProduct ...

   </script>