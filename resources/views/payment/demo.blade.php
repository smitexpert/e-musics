@php
	$amount = 19.99;
@endphp
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
  </head>

  <body>
    <script src="https://www.paypal.com/sdk/js?client-id=Ae7XBEEKrWjUWMpj8BWekaSBwhRq3AWOaZEdmSEkvIZMlZGY2DrP0IJPDmTEyUSVbQcexGxUIk9FtFYt"> // Replace YOUR_SB_CLIENT_ID with your sandbox client ID
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>

    <div id="paypal-button-container"></div>

    <!-- Add the checkout buttons, set up the order and approve the order -->
    <script>
      paypal.Buttons({
		style: {
          shape: 'pill',
          color: 'gold',
          layout: 'horizontal',
          label: 'pay',
          
      },
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '{{ $amount }}'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
			  console.log(details)
			  
            // alert('Transaction completed by ' + details.payer.name.given_name);
          });
        }
      }).render('#paypal-button-container'); // Display payment options on your web page
    </script>
  </body>
</html>