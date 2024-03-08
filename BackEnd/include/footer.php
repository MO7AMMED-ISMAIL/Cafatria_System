    </div>
    
    <!-- Modal -->
    <div
        class="modal fade"
        id="modalId"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modalTitleId"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Modal title
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">Add rows here</div>
                </div>
                <div class="modal-footer">
                    <form action="./auth/logout.php" method="post">
                        <button type="submit" class="btn btn-primary">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orderContainer = document.getElementById('orderContainer');
            const productCards = document.querySelectorAll('.product_card');
            const orderItems = {};
            let totalPrice = 0;

            function handleProductClick(event) {
                const productId = event.currentTarget.dataset.productId;
                const productPrice = parseFloat(event.currentTarget.dataset.productPrice);
                const productName = event.currentTarget.dataset.productName;

                if (orderItems[productId]) {
                    orderItems[productId].quantity += 1;
                } else {
                    orderItems[productId] = {
                        product_name: productName,
                        product_id: productId,
                        product_price: productPrice,
                        quantity: 1,
                    };
                }

                updateOrderList();
                updateTotalPrice();
            }

            function updateOrderList() {
                orderContainer.innerHTML = '';
                for (const productId in orderItems) {
                    createOrderListItem(productId);
                }
            }

            console.log(orderItems);
            function createOrderListItem(productId) {
                const listItem = document.createElement('div');
                listItem.innerHTML = `
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="m-1">${orderItems[productId].product_name} - <span class="badge text-bg-secondary">${orderItems[productId].quantity} x $${orderItems[productId].product_price}</span></div>
                            <button class="col-2 btn btn-sm btn-danger m-1" onclick="decreaseQuantity('${productId}')">-</button>
                            <input type="text" name="quantity['${productId}']" class="col-2 form-control d-inline text-center" style="width: 15%" id="quantity_${productId}" value="${orderItems[productId].quantity}" />
                            <button class="col-2 btn btn-sm btn-success m-1" onclick="increaseQuantity('${productId}')">+</button>
                            <button class="col-2 btn btn-sm btn-warning m-1" onclick="removeProduct('${productId}')">x</button>
                            <input type="hidden" name="order_total_price" value="${totalPrice.toFixed(2)}">
                            
                            <input type="hidden" name="orderItems" value='${JSON.stringify(orderItems)}'>
                        </div>
                    </div>
                `;
                orderContainer.appendChild(listItem);
            }
            console.log(orderItems);
            /*<input type="hidden" name="product_id['${productId}']" value="${productId}">
            <input type="hidden" name="price['${productId}']" value="${orderItems[productId].price}">
            <input type="hidden" name="product_total_price['${productId}']" value="${orderItems[productId].price * orderItems[productId].quantity}">
            */
            function updateTotalPrice() {
                totalPrice = Object.values(orderItems).reduce((acc, item) => acc + item.quantity * item.product_price, 0);
                document.getElementById('totalPrice').innerText = `Total Price: $${totalPrice.toFixed(2)}`;
            }

            window.increaseQuantity = function (productId) {
                if (orderItems[productId]) {
                    orderItems[productId].quantity += 1;
                    updateOrderList();
                    updateTotalPrice();
                }
            };

            window.decreaseQuantity = function (productId) {
                if (orderItems[productId]) {
                    orderItems[productId].quantity -= 1;
                    if (orderItems[productId].quantity === 0) {
                        delete orderItems[productId];
                    }
                    updateOrderList();
                    updateTotalPrice();
                }
            };

            window.removeProduct = function (productId) {
                if (orderItems[productId]) {
                    delete orderItems[productId];
                    updateOrderList();
                    updateTotalPrice();
                }
            };

            productCards.forEach(function (card) {
                card.addEventListener('click', handleProductClick);
            });
        });
    </script>
    </body>
</html>
