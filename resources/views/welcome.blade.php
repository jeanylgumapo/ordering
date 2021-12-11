<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.js" integrity="sha512-HNbo1d4BaJjXh+/e6q4enTyezg5wiXvY3p/9Vzb20NIvkJghZxhzaXeffbdJuuZSxFhJP87ORPadwmU9aN3wSA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Ordering System</title>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Ordering</a>
    </nav>
    <div class="container mt-5">
        <div class="card ">
            <div class="card-header">
               Ordering System
              </div>
            <div class="card-body">
              <h5 class="card-title">What is your order?</h5>
              <div class="container">
                <div class="row m-3">
                  <div class="col-8">
                    <select class="combobox form-control itemcbo" id="items">
                    </select>
                  </div>
                  <div class="col-3">
                    <input class="form-control form-control itemtxtbox" type="text" placeholder="Quantity">
                  </div>
                  <div class="col-1">
                    <button type="button" class="btn btn-primary" id="addOrder">+</button>
                  </div>
                 </div>
                 <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Items</th>
                        <th scope="col" class="text-right">Price</th>
                        <th scope="col" class="text-right">Quantity</th>
                        <th scope="col" class="text-right">Total Price</th>
                      </tr>
                    </thead>
                    <tbody id="orders">
                      
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-6 text-right">
                        Total Quantity:
                  </div>
                    <div class="col-2 text-right">
                        <p id="qty"></p>
                  </div>
                      <div class="col-2 text-right">
                          total price
                      </div>
                      <div class="col-2 text-right">
                        <p class="totalprice"></p>
                    </div>
                  </div>
                 </div>
                </div>
                <div class="card-footer text-muted  justify-content-end">
                    <!-- Button trigger modal -->
                    <button type="button" id="payOrder" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="FLOAT: RIGHT;">
                        Pay Order
                    </button>
                    </div>      
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                            Amount
                            </div>                    
                            <div class="col-6 text-right">
                              <p class="totalprice"></p>                     
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <ul style="list-style-type:none;" id='tax'>
                            </ul>
                          </div>                
                          <div class="col-6 text-right">
                              <ul style="list-style-type:none;" id='addTax'>
                              </ul>               
                          <hr/>
                          </div>                
                      </div>
                      <div class="row">
                        <div class="col-6">
                        Gross Amount
                        </div>                    
                        <div class="col-6 text-right">
                          <p class="gross"></p>                     
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <input id="txtcode" type="text" class="form-control" placeholder="Coupon Code" >
                            <input id="couponid" type="hidden">
                            <button id="code" class="btn btn-outline-secondary" type="button" id="button-addon2">Find</button>
                            <i>less</i>(<span id="disc"></span>%)
                          </div>
                            
                        </div>                 
                            <div class="col-6 text-right">
                              <span id="discountPrice"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            Net Payment
                        </div>              
                        <div class="col-6 text-right">
                        <span id="netprice"></span>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="pay" class="btn btn-primary">Pay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    
    </body>
</html>