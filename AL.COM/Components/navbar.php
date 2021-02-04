<?php
    function navbar($active){
        $isactive = array("active","","");
        if($active == "index"){
            $isactive[0] = "active";
            $isactive[1] = "";
            $isactive[2] = "";
        }else if($active == "product"){
            $isactive[0] = "";
            $isactive[1] = "active";
            $isactive[2] = "";
        }else if($active == "about"){
            $isactive[0] = "";
            $isactive[1] = "";
            $isactive[2] = "active";
        }
        echo '  <nav class="navbar navbar-expand-sm bg-primary navbar-dark" >
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a href="index.php" class="navbar-brand" style="font-weight:bold">AL.COM</a>
                                
                            </div>
                            <ul class="navbar-nav">
                                <li class="nav-item '.$isactive[0].'"><a href="index.php"  class="nav-link">Home</a></li>
                                <li class="nav-item '.$isactive[1].'"><a href="product_form.php"  class="nav-link" >Add Product</a></li>
                                <li class="nav-item '.$isactive[2].'"><a  href="about.php" class="nav-link"  >About Us</a></li>
                            </ul>
                        </div>
                </nav>';
                    }




?>