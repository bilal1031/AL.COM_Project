
<!DOCTYPE html>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/styles.css">
        <script src="./js/jquery.min.js"></script>
        <script src="./js/popper.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
</head>
<body style="background-color: rgb(126, 186, 255);">
 
  <?php             
    include "./Components/navbar.php";
    navbar("product");
    include "./Components/product_form.php";
    include "./Components/footer.php";
  ?>  

</body>
</html>