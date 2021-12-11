$(document).ready(function(){
    var invoiceNo=0;
    var couponid=0;
    var getItems=[];
    var discount=0;
    var netPrice=0;
    var tax=0;
    var addTax=0;
    fetchItem();
    displayOrders()
    var totalQty=0;
    var totalPrice=0;
    // getInvoiceNo();

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
            'item_id': $('.itemcbo option:selected').val(),
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
          $.each(response.order, function(key, item){
               count++;
             $('#orders').append('<tr><td>'+count+'</td><td>'+item.item_name+'</td><td class="text-right">'+item.price+'</td><td class="text-right">'+item.qty+'</td><td  class="text-right">'+(item.price*item.qty)+'</td></tr>')
             totalQty+=item.qty;
             totalPrice+=(item.price*item.qty);

           });
           console.log(totalQty);
           $("#qty").text(totalQty);
           $(".totalprice").text(totalPrice);
          }
        });
      } 
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
            $('#tax').append('<li>'+value.tax_type+' '+(value.percentage*100)+'%</li>')
            $('#addTax').append('<li>'+(value.percentage*totalPrice)+'</li>')
            tax=value.percentage*totalPrice;
           });
           addTax=tax+totalPrice;
          }
        });

        $(".GROSS").text(addTax);
       // getTax();
        //  $("#discountPrice").text(totalPrice);
        // discountPrice=tax;
        // $("#netprice").text((discountPrice+tax));
        $("#discountPrice").text(totalPrice);
        console.log(totalPrice);
        //get discount price
        $("#discountPrice").text(totalPrice);
            netPrice=totalPrice;

    });
      $(document).on('click', '#code', function(e){
          var getCode=$('#txtcode').val();
          couponid=0;
          discount=0;
          netPrice=0;
        e.preventDefault();
        // alert('found');
        $.ajax({
            type:'GET',
            url:'/api/coupon',
            dataType:'JSON',
            success:function(response){
             $.each(response, function(key, value){
            //    $('#items').append('<option value="'+item.id+'">'+item.item_name+'</option>')
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
            console.log(value);
             });
             
             if(discount==0){
                $("#discountPrice").text(totalPrice);
                netPrice=totalPrice;
             }
             else{
             $("#discountPrice").text(totalPrice-(totalPrice*discount));
             netPrice=totalPrice-(totalPrice*discount);
             }
            }
          });

    });
    function getTax(){
     
    }
             
});