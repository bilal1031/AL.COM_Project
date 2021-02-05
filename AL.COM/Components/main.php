   
    <div class="search_container">
        <form class="form-inline" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
            <input class="form-control mr-sm-2 col-7" type="search" id="tosearch" name="search" required placeholder="Search Product" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit"  name="submit">Search</button>
        </form>
        <div class="dropdown" style="margin-top:10px;">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              Category
            </button>
            <div class="dropdown-menu">
            <?php  include "./Config/connection.php";
                   get_category(); 
            ?>    
            </div>
          </div>
    </div>
    
        <?php
            if(isset($_POST['submit'])){
                                
                $sql = 'SELECT p_id,name,purchaseprice,saleprice,c_name FROM product INNER JOIN category ON c_id = category AND (name LIKE "%'.$_POST['search'].'%" OR c_name LIKE "%'.$_POST['search'].'%")';
                get_data($sql);               
                    
            }else if(isset($_GET['category'])){
                    $cat =  $_GET['category'];
                    $sql = 'SELECT p_id,name,purchaseprice,saleprice,c_name FROM product INNER JOIN category ON c_id = category AND c_name = "'.$cat.'";';
                    get_data($sql);

            }else if(isset($_POST['delete'])){
                    $sql = 'DELETE FROM product WHERE p_id = "'.$_POST['p_id'].'";';
                    delete_data($sql);
                    $cat =  $_POST['category'];
                    $sql = 'SELECT p_id,name,purchaseprice,saleprice,c_name FROM product INNER JOIN category ON c_id = category AND c_name = "'.$cat.'";';
                    get_data($sql);     
            }
   ?>