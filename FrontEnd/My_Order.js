

let orderRow = $(".my-orders .user-orders");
let order = $(".my-orders .user-orders .order");

orderRow.each(function() {
  $(this).on("click", ".order", function() {
    $(this)
      .toggleClass("custom-shadow")
      .next()
      .fadeToggle("700");

    $(this)
      .find("i")
      .toggleClass("fa-minus-square fa-plus-square", 1000);
  });
});

order.each(function() {
  $(this).on("click", ".cancel", function() {
    let parentOrder = $(this).closest(".order");
    parentOrder.next().remove(); // Remove the next element if needed
    parentOrder.remove();
  });
});


function computeTotalPrice() {
    var totalAmount = 0;

   
    $('#orderTableBody tr.order').each(function () {
    
        var amount = parseFloat($(this).find('td:nth-child(3) span').text());

        
        totalAmount += amount;
    });

    $('#totalAmount').text(totalAmount.toFixed(2));
}


computeTotalPrice();


function searchOrders() {
   
    computeTotalPrice();
}


$('.cancel').on('click', function () {

    computeTotalPrice();
});

