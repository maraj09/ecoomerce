<?php
    include './lib/session.php';
    Session::init();
	include "./lib/database.php";
    include "./helpers/format.php";
	// include './classes/product.php';
	spl_autoload_register(function($class){
        include "classes/".$class.".php";
    });
    $pd = new product();
    $ct = new cart();
    $cat = new category();
    $bd = new brand();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./lib/fontawesome-free-5.13.0-web/css/all.css?v=<?php echo time(); ?>">
</head>
<body>
<!-- top navbar start -->
<div class=" topheader  ">
        <div class="container ">
            <a href="index.php"><img src="images/images.jpg" alt="" ></a>
            <form action="">
                <button type="submit"><i class="fas fa-search" aria-hidden="flase"></i></button>
                <input class="topsearch" type="text" placeholder="Search" >
                <input  class="topsearchbutton" type="submit" value="Search">
            </form>
                <div class="signup">
                    <a href='./signup.php' ><button><i class='fas fa-user'></i><span>Sign In</span></button></a>
                </div>
                <div class="chart">
                    <a href='./cart.php'><button><i class='fas fa-shopping-cart'></i><span>Cart</span> <sup style="color:white; font-size: 14px"><?php
                        $getdata = $ct->cartqty();
                            if ($getdata) {
                                $qty = Session::get("qty");
                                echo $qty;
                            }else{
                                echo 0;
                            }
                    ?>
                    </sup></button></a>
                </div>
                    
        </div>
    </div> 
<!-- top navbar end -->    
<!-- mid navbar start -->
    <div class="midnav sticky-top ">
        <div class="pcview container ">
            <ul>
                    <?php
                    $getcat =  $cat->limitcat();
                        if ($getcat) {
                        while ($result = $getcat->fetch_assoc()){?>
                <li class="justify-content-around">
                    <a href=""><?php echo $result['catName'] ;?></a>
                        <ul >
                            <?php
                                $getbrand =  $bd->limitbd($result['catId']);
                                if ($getbrand) {
                                    while ($result = $getbrand->fetch_assoc()){?>
                            
                            <li><a href=""><?php echo $result['brandName'] ?></a> </li>
                            <?php
                                }
                            }
                            ?>
                            
                        </ul>
                </li>
                <?php 
					}
				}?>	
                
            </ul>
            
        </div>
        <div class="mobileview container">
            <div  id="mySidepanel" class="sidepanel ">
                    <p>MENU</p>
                    <a href="javascript:void(0)" class="closebtn"  onclick="closeNav()">&times;</a>
                <ul>
                    <?php
                        $cat = new category();
                        $getcat =  $cat->limitcat();
                            if ($getcat) {
                            while ($result = $getcat->fetch_assoc()) {?>   
                    <li>
                        <a class="dropdown-btn" href="" ><?php echo $result['catName'] ; ?></a> 
                        <i class="fas fa-angle-down"></i>
                        <div class="dropdown-container">
                        <?php
                                $getbrand =  $bd->limitbd($result['catId']);
                                if ($getbrand) {
                                    while ($result = $getbrand->fetch_assoc()){?>
                            <a href="#"><?php echo $result['brandName'] ?></a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <?php 
					}
				} ?>	
                </ul>     
                
            </div>
            <button class="openbtn " onclick="openNav()">&#9776; </button>
        </div>
    </div>

<!-- mid navbar end -->