<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
      
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
   <!-- Topbar Start -->
 
    <!-- <script src="https://www.paypal.com/sdk/js?
    client-id=AbQGzGgQ4sbSAalTfVckcwWsfmOPu23ol_DQiXGkoglBkVlpDyQZLSm6roam0mhPuWtxENJ4xvYzSSbk"></script> -->
    
    <!-- Replace "test" with your own sandbox Business account app client ID -->
      <!-- Set up a container element for the button -->
    <script src="https://www.paypal.com/sdk/js?client-id=AbQGzGgQ4sbSAalTfVckcwWsfmOPu23ol_DQiXGkoglBkVlpDyQZLSm6roam0mhPuWtxENJ4xvYzSSbk&currency=USD"></script>  
      <!-- Set up a container element for the button -->
      <div id="paypal-button-container"></div>
      <script>
        paypal.Buttons({
          // Order is created on the server and the order id is returned
          createOrder: (data, actions) => {
      return actions.order.create({
         "purchase_units": [{
            "amount": {
              "currency_code": "USD",
              "value": "100",
              "breakdown": {
                "item_total": {  /* Required when including the items array */
                  "currency_code": "USD",
                  "value": "100"
                }
              }
            },
             
          }]
      });
    },
          
        }).render('#paypal-button-container');
      </script>

    <!-- Contact End -->







   
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
     

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

