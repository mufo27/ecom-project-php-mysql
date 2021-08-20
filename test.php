<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<div class="row ">
  <div class="col text-center">
    <!-- ปุ่ม paypal -->
    <div id="paypal-button-container"></div>
                                                            
  </div>
</div>
  
<script src="https://www.paypal.com/sdk/js?client-id=นำclient-idที่สมัครมาใส่&currency=USD"></script>

<script>
  paypal.Buttons({
    createOrder: function(data, actions) {

      var number = $('#pm_total').val();

      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '99.99'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        alert('ชำระเงินผ่าน Paypal เรียบร้อย' + details.payer.name.given_name);
        alert(window.location.href='index.php?paypal');

      });
      
    }
  }).render('#paypal-button-container');
  //This function displays Smart Payment Buttons on your web page.
</script>



</body>
</html>