
document.addEventListener('DOMContentLoaded', function() {
  
  //slogen animation
    const slogans = [
        "Crafting Memories, One Cup at a Time",
        "Where Every Bean Holds a Promise of Joy",
        "Experience the Flavors of Tradition and Innovation",
        "A Taste of Tradition, Served with Passion"
    ];

    const sloganElement = document.getElementById('sloganText');
    let currentIndex = 0;

    function changeSlogan() {
        sloganElement.textContent = slogans[currentIndex];
        currentIndex = (currentIndex + 1) % slogans.length;
    }

    setInterval(changeSlogan, 5000);



  //select products

    const productContainer = document.getElementById('productContainer');
    const orderForm = document.getElementById('orderForm');
    const selectedProductsContainer = document.getElementById('selectedProducts');
    const removeAllProductsButton = document.getElementById('removeAllProducts');
    let selectedProductsList = [];

    //handle click on product cards at deleg
    productContainer.addEventListener('click', function(event) {
        const card = event.target.closest('.card');
        if (card) {
            const productName = card.querySelector('.card-title').innerText;
            const productPrice = parseFloat(card.querySelector('.card-text').innerText.split(': ')[1]);
            const productId = card.querySelector('.product-id').value;

            const existingProductIndex = selectedProductsList.findIndex(product => product.name === productName);
            if (existingProductIndex !== -1) {
                selectedProductsList[existingProductIndex].quantity++;
            } else {
                selectedProductsList.push({ product_id: productId, name: productName, price: productPrice, quantity: 1 });
            }

            updateOrderForm();
        }
    });

    //update order form 
    function updateOrderForm() {
        let totalPrice = 0;
        let selectedProductsHTML = '';

        selectedProductsList.forEach((product, index) => {
            const totalProductPrice = product.price * product.quantity;
            totalPrice += totalProductPrice;
            const quantitySign = product.quantity > 0 ? '+' : '-';
            const productId = `selectedProduct_${index}`;
            selectedProductsHTML += `
                <div id="${productId}" class="selected-product" style="width:100%;">
                    <input type="hidden" class="product-id" value="${product.product_id}">
                    ${product.name} 
                    <button id="incr" class="btn btn-primary text-center" onclick="changeQuantity(${index}, 1)">+</button>
                    ${quantitySign}${Math.abs(product.quantity)}
                    <button id="decr" class="btn btn-danger text-center" onclick="changeQuantity(${index}, -1)">-</button>
                    - $${totalProductPrice.toFixed(2)}
                    <button class="btn btn-danger close-icon" onclick="removeProduct(${index})">×</button>
                </div>`;
        });

        selectedProductsContainer.innerHTML = selectedProductsHTML;
        document.getElementById('totalPrice').value = totalPrice.toFixed(2);
        document.getElementById('orderButton').disabled = false;
    }

    //handle form submission
    orderForm.addEventListener('submit', function(event) {
        event.preventDefault();
        updateOrderForm();

        const selectedProductsJSON = JSON.stringify(selectedProductsList);
        const formData = new FormData(orderForm);
        formData.append('selectedProductsList', selectedProductsJSON);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'addOrder.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.body.innerHTML = xhr.responseText;
                window.location.href = "order.php";
            } else {
                console.error('Error:', xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error('Request failed');
        };
        xhr.send(formData);
    });

    //change the quantity
    window.changeQuantity = function(index, change) {
        if (index >= 0 && index < selectedProductsList.length) {
            selectedProductsList[index].quantity += change;
            if (selectedProductsList[index].quantity <= 0) {
                selectedProductsList.splice(index, 1);
            }
            updateOrderForm();
        }
    };

    //remove a product
    window.removeProduct = function(index) {
        if (index >= 0 && index < selectedProductsList.length) {
            selectedProductsList.splice(index, 1);
            updateOrderForm();
        }
    };

    //clear all 
    removeAllProductsButton.addEventListener('click', function() {
        selectedProductsList = [];
        updateOrderForm();
    });
});

