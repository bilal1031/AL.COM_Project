<?php
         function print_table($p_id,$name,$purchaseprice,$saleprice,$category){

                    echo '<tr>
                    <td>'.$name.'</td>
                    <td>'.$purchaseprice.'</td>
                    <td>'.$saleprice.'</td>
                    <td>'.$category.'</td>
                    <td>                     
                      <form class="form-inline" action="'.$_SERVER["PHP_SELF"].'" method="post">
                           <input type="number" class="form-control" id="quantity" required placeholder="Enter Quantity" name="quantity" value = "">
                           <input type="hidden" name="p_id" value="'.$p_id.'"/>
                           <button class="btn btn-warning my-2 my-sm-0 col-15 ml-3" type="submit"  name="cart">Add to cart</button>                     
                      </form>
                   </td>
                    <td>
                    <div class="d-flex flex-row">
                        <form class="form-inline" action="product_form.php?editproduct='.$name.'" method="post">
                            <button class="btn btn-success my-2 my-sm-0 col-15 " type="submit"  name="add">Edit</button>
                        </form>
                        <form class="form-inline" action="'.$_SERVER["PHP_SELF"].'" method="post">
                             <input type="hidden" name="p_id" value="'.$p_id.'"/>
                             <input type="hidden" name="category" value="'.$category.'"/>
                             <button class="btn btn-danger my-2 my-sm-0 col-15 ml-3" type="submit"  name="delete">Delete</button>
                           
                         </form>
 
                    </div>
                    </td>
                    </tr>';

        }
        function print_invoice_table($c_id,$p_id,$name,$saleprice,$quantity,$button){
  
            echo '<tr>
            <td>'.$name.'</td>
            <td>'.$saleprice.'</td>
            <td>'.$quantity.'</td>
            <td>'.$saleprice*$quantity.'</td>';
            if($button == null){
                echo '<td>
                        <div class="d-flex flex-row">
                            <form class="form-inline" action="'.$_SERVER["PHP_SELF"].'" method="post">
                                <input type="hidden" name="p_id" value="'.$p_id.'"/>
                                <input type="hidden" name="c_id" value="'.$c_id.'"/>
                                <button class="btn btn-danger my-2 my-sm-0 col-15 ml-3" type="submit"  name="delete">Delete from cart</button>                
                            </form>
            
                        </div>
                        </td>';
            }
            echo '</tr>';
            return $saleprice*$quantity;
        }

        function delete_data($sql){
            include "serverconfig.php";
            if(!mysqli_query($conn, $sql)){
                echo "Error Occured";
            }else{
                echo '
                    <div class="d-flex flex-row justify-content-around pl-5">
                        <div class="alert alert-info w-50 mt-3 ml-5" role="alert">
                        Data Delete! 
                        </div>
                    </div>'; 
            }
        }
        function get_edit_data($name){
               
            include "serverconfig.php";

                $sql = "SELECT p_id,name,purchaseprice,saleprice,c_name FROM product INNER JOIN category ON name = '$name' AND c_id = category;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = $result->fetch_assoc();
                    return $row;
                }else{
                    echo "Result 0";
                }
            
            

        }
        function data_dupclication_check($sql){

            include "serverconfig.php";
            //echo "Connected successfully";
            //echo $sql;
            $c_id = "";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                return 1;   
            }else{
                return 0;
            }
            
        }

        function save_data($sql){
            include "serverconfig.php";
            //echo "Connected successfully";
            //echo $sql;
             if(mysqli_query($conn, $sql)){
                echo '<div class="alert alert-success" role="alert">
                        Data Saved
                    </div>';   
             }else{
                echo '<div class="alert alert-danger" role="alert">
                        Failed to Save!
                        '."Error: " . $sql . "<br>" . mysqli_error($conn).'
                    </div>';   
             }

        }
    
        
       
        function get_cat_id($sql){
            include "serverconfig.php";
            //echo "Connected successfully";
            //echo $sql;
            $c_id = "";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                   while($row = $result->fetch_assoc()){
                       $c_id = $row['c_id'];
                   }
            }else {
                echo "0 results";
            }
            return $c_id;
               
        }
        function get_data($sql,$mode){
            include "serverconfig.php";
            //echo "Connected successfully";
            //echo $sql;
             $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            if($mode == "main"){
                echo '
                <div class="container mt-5 mb-5">
                        <h2>Product Table</h2>     
                        <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Purchase Price</th>
                            <th>Sale Price</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>';
                        while($row = $result->fetch_assoc()) {
                            print_table($row['p_id'],$row['name'],$row['purchaseprice'],$row['saleprice'],$row['c_name'])  ; 
                        }                             
                echo '   </tbody>
                        </table>
                    </div>
                    <div style="height:100px"></div>
                    ';
            }else if($mode == "cart"){
                $isrecipt = null;

                echo '<div class="container mt-5 mb-5">';
                if(isset($_GET['recipt'])){
                        $isrecipt = $_GET['recipt'];
                }
                if($isrecipt){
                    echo '<h2>Recpit:</h2>';
                }else{
                    echo '<h2>Invoice Table</h2>';
                }
                
               
      
                echo'   
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Sale Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                          
                            </tr>
                        </thead>
                        <tbody>';
                        $total = 0;  
                        while($row = $result->fetch_assoc()) {
                            $total += print_invoice_table($row['c_id'],$row['p_id'],$row['name'],$row['saleprice'],$row['quantity'],isset($_GET['recipt']));
                        }                             
                echo '   </tbody>
                        </table>
                    </div>
                 <div class="d-flex flex-row justify-content-center mt-5">
                    <div class="alert alert-info" role="alert" style="width:38%;">
                    <form class="form-inline" action="'.$_SERVER["PHP_SELF"].'" method="post">
                             <b>Total Price= '.$total.'</b>
                    ';
                    if(!$isrecipt){
                         echo '<button class="btn btn-success my-2 my-sm-0 col-15 ml-5" type="submit"  name="generate">Generate Recipt</button>     
                            <button class="btn btn-danger my-2 my-sm-0 col-15 ml-3" type="submit"  name="deleteinvoice">Delete Invoice</button>                           
                        ';
                    }
                 echo  '</form>
                            
                        </div>
        
                    </div>   
                    <div style="height:100px"></div>
                    ';
            }
        } else {
            echo '
                <div class="d-flex flex-row justify-content-center mt-5">
                  <div class="alert alert-info" role="alert" style="width:40%;">
                        No Record Found!
                  </div>
                </div>';  
        }
        $conn->close();
    }
    /*<div class="container">
    <h2>Client Information</h2>
    <form class="form-inline mt-5" action="invoice.php" method="post">
      <div class="form-group">
        <label for="productname">Product Name:</label>
        <input type="client_name" class="form-control ml-2" id="client_name" required placeholder="Enter client name" name="client_name" value = "">
      </div>
      <div class="form-group ml-5">
        <label for="price">Purchase price:</label>
        <input type="tel" class="form-control ml-2" id="contactno" required placeholder="Enter number" name="contactno" value= "">
      </div> 
      <button type="submit" name="submit" class="btn btn-success ml-3">Generate Invoice</button>
    </form>
    <div style="height:100px"></div>
  </div>*/
    function get_category($ismain,$selected){
        include "serverconfig.php";
        $sql = "SELECT c_name FROM category";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                if($ismain == true){
                    echo ' <a class="dropdown-item" href="index.php?category='.strtolower($row['c_name']).'">'.$row['c_name'].'</a>' ;            
                }
                if($ismain == false){
                    if($selected == $row['c_name']){
                        echo '<option selected value="'.$row['c_name'].'">'.$row['c_name'].'</option>';
                    }else {
                        echo '<option value="'.$row['c_name'].'">'.$row['c_name'].'</option>';
                    }
                    
                    
                }
             }   
        }

    }
    function add_product_tocart($sql){

    }
?>