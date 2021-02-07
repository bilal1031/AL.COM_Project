<?php
         function print_table($p_id,$name,$purchaseprice,$saleprice,$category){

                    echo '<tr>
                    <td>'.$name.'</td>
                    <td>'.$purchaseprice.'</td>
                    <td>'.$saleprice.'</td>
                    <td>'.$category.'</td>
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
        function get_data($sql){
            include "serverconfig.php";
            //echo "Connected successfully";
            //echo $sql;
             $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

            echo '
            <div class="container mt-5 mb-5">
                    <h2>Product Table</h2>     
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Category</th>
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

    function get_category($ismain){
        include "serverconfig.php";
        $sql = "SELECT c_name FROM category";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                if($ismain == true){
                    echo ' <a class="dropdown-item" href="index.php?category='.strtolower($row['c_name']).'">'.$row['c_name'].'</a>' ;            
                }
                if($ismain == false){
                  
                    echo '<option value="'.$row['c_name'].'">'.$row['c_name'].'</option>';
                    
                }
             }   
        }

    }
?>