$(document).ready(function(){
    var invoiceNo=0;
    var couponid=0;
    var orderid=[];
    var discount=0;
    var netPrice=0;
    var tax=0;
    var addTax=0;
    fetchItem();
    displayOrders()
    var totalQty=0;
    var totalPrice=0;
    function fetchItem(){
      $.ajax({
        type:'GET',
        url:'/api/items',
        dataType:'JSON',
        success:function(response){
         $.each(response.submenu, function(key, item){
           $('#items').append('<option value="'+item.id+'">'+item.item_name+'</option>')
         });
        }
      });
    }

    function getInvoiceNo(){
        $.ajax({
            type:'GET',
            url:'/api/invoiceno',
            dataType:'JSON',
            success:function(response){
                invoiceNo=response;
            }
          });
    }
    $(document).on('click', '#addOrder', function(e){
            e.preventDefault();
        var data={
            'invoice_id':null,
            'item': $('.itemcbo option:selected').val(),
            'qty': $('.itemtxtbox').val(),
        }

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/api/order',
            data:data,
            dataType:'json',
            success:function (response) { 
                console.log("saved");
             }
        });
        displayOrders();
    });

    function displayOrders(){
      orderid=[];
        totalQty=0;
        totalPrice=0;
        $("#orders").html("");
        $("#qty").html("");
        $(".totalprice").html("");
        var count=0;
        $.ajax({
          type:'GET',
          url:'/api/order',
          dataType:'JSON',
          success:function(response){
          $.each(response.order, function(key, value){
            orderid.push(value.orid);
            
               count++;
             $('#orders').append('<tr><td>'+count+'</td><td>'+value.item_name+'</td><td class="text-right">'+value.price+'</td><td class="text-right">'+value.qty+'</td><td  class="text-right">'+(value.price*value.qty)+'</td><td><button type="button" data-id="'+value.orid+'" class="btn btn-danger delItem">x</button></td></tr>')
             totalQty+=value.qty;
             totalPrice+=(value.price*value.qty);
           });
           console.log(totalQty);
           $("#qty").text(totalQty);
           $(".totalprice").text(totalPrice);
          }
        });
      } 
      $(document).on('click', '.delItem', function(e){
        e.preventDefault();
        // alert($(this).attr("data-id"));
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          type:'DELETE',
          url:'/api/order/'+$(this).attr("data-id"),
          dataType:'json',
          success:function (response) { 
              console.log("deleted");
          }
      });
      location.reload(true);

      });
      $(document).on('click', '#payOrder', function(e){
        e.preventDefault();
        tax=0;
        addTax=0;
        $.ajax({
          type:'GET',
          url:'/api/tax',
          dataType:'JSON',
          success:function(response){
           $.each(response, function(key, value){
            $('#tax').append('<li>'+value.tax_type+' '+(value.percentage*100)+'%</li><input type="hidden" id="taxid" value="'+value.id+'">')
            $('#addTax').append('<li>'+(value.percentage*totalPrice)+'</li>')
            tax=value.percentage*totalPrice;
            
           });
           addTax=tax+totalPrice;
          $(".gross").text(addTax);
           totalPrice=addTax;
           console.log('total price:'+totalPrice.toFixed(2));
           $("#disc").text(0);
           $("#discountPrice").text(addTax.toFixed(2));
           $("#netprice").text(addTax.toFixed(2));
          }
          
        });
    });
    $(document).on('click', '#close', function(e){
      e.preventDefault();
      location.reload(true);
    });
      
      $(document).on('click', '#code', function(e){
          var getCode=$('#txtcode').val();
          couponid=0;
          discount=0;
          netPrice=0;
        e.preventDefault();

        $.ajax({
            type:'GET',
            url:'/api/coupon',
            dataType:'JSON',
            success:function(response){
             $.each(response, function(key, value){

            if(value.code==getCode){
                discount=value.discount;
                $("#disc").text(value.discount*100);
                couponid=value.id;
            }
            else{
                discount=0;
                $("#disc").text(0);
                couponid=null;
            }

             });
             
             if(discount==0){
                $("#discountPrice").text(totalPrice);
                netPrice=totalPrice;
             }
             else{
             $("#discountPrice").text(totalPrice-(totalPrice*discount));
             netPrice=(totalPrice-(totalPrice*discount)).toFixed(2);
             }
             $("#netprice").text(netPrice);
            }
          });

    });
    $(document).on('click', '#pay', function(e){
      e.preventDefault();
      
  var data={
      'discount':couponid,
      'tax': $('#taxid').val(),
   }

  $.ajaxSetup({
      headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
      type:'POST',
      url:'/api/invoice',
      data:data,
      dataType:'json',
      success:function (response) { 

        $.each(orderid, function (i, id) {
            updateOrder(response.insertedId,id);
        });
       }
  });
  location.reload(true);

});

  function updateOrder($invoice_id, $id){
  
    var data={
          'invoice_id':$invoice_id,
      }

      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
          type:'GET',
          url:'/api/updateorder/'+$id,
          data:data,
          dataType:'json',
          success:function (response) { 
              console.log("saved");
          }
      });
  }           
});