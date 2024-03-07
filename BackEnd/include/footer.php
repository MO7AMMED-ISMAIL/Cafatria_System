    </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orderContainer = document.getElementById('orderContainer');
            const productCards = document.querySelectorAll('.product_card');
            const orderDetails = {};
            let totalPrice = 0;

            function handleProductClick(event) {
                const productId = event.currentTarget.dataset.id;
                const productName = event.currentTarget.querySelector('.card-title').innerText;
                const productPrice = parseFloat(event.currentTarget.dataset.price); // Convert price to a number

                if (orderDetails[productId]) {
                    orderDetails[productId].quantity += 1;
                } else {
                    orderDetails[productId] = {
                        name: productName,
                        price: productPrice,
                        quantity: 1
                    };
                }

                updateOrderList();
                updateTotalPrice();
            }

            function updateOrderList() {
                orderContainer.innerHTML = '';
                for (const productId in orderDetails) {
                    createOrderListItem(productId);
                }
            }

            console.log(orderDetails);
            function createOrderListItem(productId) {
                const listItem = document.createElement('div');
                listItem.innerHTML = `
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="m-1">${orderDetails[productId].name} - <span class="badge text-bg-secondary">${orderDetails[productId].quantity} x $${orderDetails[productId].price}</span></div>
                            <button class="col-2 btn btn-sm btn-danger m-1" onclick="decreaseQuantity('${productId}')">-</button>
                            <input type="text" name="quantity['${productId}']" class="col-2 form-control d-inline text-center" style="width: 15%" id="quantity_${productId}" value="${orderDetails[productId].quantity}" />
                            <button class="col-2 btn btn-sm btn-success m-1" onclick="increaseQuantity('${productId}')">+</button>
                            <button class="col-2 btn btn-sm btn-warning m-1" onclick="removeProduct('${productId}')">x</button>
                            <input type="hidden" name="product_id['${productId}']" value="${productId}">
                            <input type="hidden" name="price['${productId}']" value="${orderDetails[productId].price}">
                            <input type="hidden" name="product_total_price['${productId}']" value="${orderDetails[productId].price * orderDetails[productId].quantity}">
                            <input type="hidden" name="order_total_price" value="${totalPrice.toFixed(2)}">
                        </div>
                    </div>
                `;
                orderContainer.appendChild(listItem);
            }

            function updateTotalPrice() {
                totalPrice = Object.values(orderDetails).reduce((acc, item) => acc + item.quantity * item.price, 0);
                document.getElementById('totalPrice').innerText = `Total Price: $${totalPrice.toFixed(2)}`;
            }

            window.increaseQuantity = function (productId) {
                if (orderDetails[productId]) {
                    orderDetails[productId].quantity += 1;
                    updateOrderList();
                }
            };

            window.decreaseQuantity = function (productId) {
                if (orderDetails[productId]) {
                    orderDetails[productId].quantity -= 1;
                    if (orderDetails[productId].quantity === 0) {
                        delete orderDetails[productId];
                    }
                    updateOrderList();
                }
            };

            window.removeProduct = function (productId) {
                if (orderDetails[productId]) {
                    delete orderDetails[productId];
                    updateOrderList();
                }
            };

            productCards.forEach(function (card) {
                card.addEventListener('click', handleProductClick);
            });
        });
    </script>
    </body>
</html>