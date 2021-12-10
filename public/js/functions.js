$(document).ready(function(){
//     $('.combobox').combobox();
    
//     // bonus: add a placeholder
//     $('.combobox').attr('placeholder', 'For example, start typing "Pennsylvania"');
//   });
    // alert("test");
    $.ajax({
        url: "http://127.0.0.1:8000/api/items",
        method: "GET",
        success: function(data) {
            // $("#payType").val(0);
            // $("#itemPriceCart").val(data.items[0].cash_price);
            // $("#barcodeCart").val(data.items[0].barcode);
            // $("#barcodeColumn").html(data.items[0].barcode);
            // $("#itemname").text(data.items[0].name);
            // $("#nameColumn").html(data.items[0].name);
            // $("#descColumn").html(data.items[0].description);
            // $("#cashpriceColumn").html(data.items[0].cash_price);
            // $("#creditpriceColumn").html(data.items[0].credit_price);
            // $("#cartModal").modal("show");
            console.log(data);
        },
        error: function(msg) {
            if (msg.status == 502) {
                console.log(msg);
                toastr.error(msg.responseJSON["msg"]);
            } else {
                console.log(msg.responseText);
                toastr.error("Something went wrongssss");
            }
        }
    });
  });