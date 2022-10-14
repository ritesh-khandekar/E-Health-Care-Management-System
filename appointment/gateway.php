<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <style>
        .loader {
          display: inline-block;
          border: 8px solid #f3f3f3;
          border-radius: 50%;
          clear: both;
          border-top: 8px solid #3498db;
          width: 40px;
          height: 40px;
          -webkit-animation: spin 2s linear infinite; /* Safari */
          animation: spin 2s linear infinite;
        }
        
        /* Safari */
        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }
        
        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
        </style>
</head>
<body>
    <div class="loader"></div>
    <h3 style="display: inline-block;clear: both;">Processing Payment....</h3>
    <script>
        setTimeout(function(){
            document.querySelector("h3").textContent="Payment Successful!";
        },2000);
        setTimeout(function(){
            window.close();
        },4000);
    </script>
</body>
</html>