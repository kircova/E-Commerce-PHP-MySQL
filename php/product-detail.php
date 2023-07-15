<!DOCTYPE html>


<?php
    require_once "config.php";
?>

<?php
// Initialize the session
session_start();
?>

<?php

$id_err = "";
$comment_err = "";
$rate = 2;
$avg_rating = 0;
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['id'])) {
      $id = $_GET['id'];
      if(isset($_SESSION["pid"]))
      {
        $personid = $_SESSION["pid"];
      }


      $sql_statement = "SELECT prid, pname, artist, genre, description, price, categoryId, productImgUrl, stock, isVisible
                                  FROM `product`
                                  WHERE IsVisible=1 AND prid = '$id'";
      $check = mysqli_query($db, $sql_statement);
      $row = mysqli_fetch_array($check);

      $prid = $row['prid'];
      $pname = $row['pname'];
      $artist = $row['artist'];
      $genre = $row['genre'];
      $description = $row['description'];
      $price = $row['price'];
      $categoryId = $row['categoryId'];
      $productImgUrl = $row['productImgUrl'];
      $stock = $row['stock'];
      $isVisible = $row['isVisible'];

      $sql_statement = "SELECT prid, pname, genre, price, productImgUrl, isVisible
                                  FROM `product`
                                  WHERE IsVisible=1 AND genre = '$genre'";

      $check = mysqli_query($db, $sql_statement);
        $myarr=array();

      while($row = mysqli_fetch_array($check)) {
        array_push($myarr, $row);
      }
      $sql_statement = "SELECT prid, songname, TrackNumber
                                  FROM `songs`
                                  WHERE prid='$prid'
                                  ORDER BY TrackNumber ASC";
      $check = mysqli_query($db, $sql_statement);
      $songs_arr = array();

      while($row = mysqli_fetch_array($check)) {
        array_push($songs_arr, $row);

      }
        $sql_statement = "SELECT cm.com_text, cm.cid, p.pid, p.name, p.surname, cm.rating, cm.time, cm.isVisible
        FROM `comment` cm, customer c, person p
        WHERE p.pid = c.pid and prid='$prid' and c.pid = cm.pid";
        $check = mysqli_query($db, $sql_statement);
        $commentarr=array();


        while($row = mysqli_fetch_array($check)) {
        array_push($commentarr, $row);
        }



        $visibleCommentcounts = 0;
        $comment_count = 0;
        if (count($commentarr) >0 ) {
            $comment_count = count($commentarr);
        }
        for($i=0; $i<$comment_count; $i++)
        {
            if($commentarr[$i]['isVisible'] == 1){
                $visibleCommentcounts ++;
            }
        }

        $sql_statement = "SELECT m.pid
        FROM makes m, orderdetails od
        WHERE m.oid = od.oid and od.prid = '$prid'";
        $check = mysqli_query($db, $sql_statement);
        $persons = array();
        while($row = mysqli_fetch_array($check)) {
            array_push($persons, $row);
            }


        if(isset($_SESSION["pid"]))
        {
            $personid = $_SESSION["pid"];
            $sql_statement = "SELECT *
            From   (SELECT COUNT(*), genre
            FROM   order_table o, orderdetails od, makes m, person p, product pr
            WHERE o.oid = od.oid && o.isActive = 1 && m.oid = o.oid && m.pid = p.pid and od.prid = pr.prid and od.prid = pr.prid and m.pid = 21
            GROUP BY pr.genre
            ORDER BY COUNT(*) DESC
            LIMIT 1) As A, product p
            WHERE p.genre = A.genre";
            $check = mysqli_query($db, $sql_statement);
            $rec_product= array();

            while($rows = mysqli_fetch_array($check)) {
              array_push($rec_product, $rows);
            }

            $rec_product = array_unique($rec_product, SORT_REGULAR);
            $row_number_rec_product=count($rec_product);

        }
        else{
            $row_number_rec_product=0;
        }


        }





    $sql_statement = "SELECT *
    FROM order_table o, orderdetails od, makes m, person p, product pr
    WHERE o.oid = od.oid && o.isActive = 1 && m.oid = o.oid && m.pid = p.pid  && p.pid = '$id'and od.prid = pr.prid and od.prid = pr.prid";



}

?>

<?php
  $sql_statement = "SELECT genre
                              FROM `product`
                              WHERE isVisible=1
                              GROUP BY genre";
  $search_result = mysqli_query($db, $sql_statement);

  $genrecategory= array();

  while($rows = mysqli_fetch_array($search_result)) {
    array_push($genrecategory, $rows);
  }
    $genrecategory = array_unique($genrecategory, SORT_REGULAR);
    $row_number_genre=count($genrecategory);






?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="img/icon.png">
        <title><?php echo $pname?> - The Sound Machine</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="eCommerce HTML Template Free Download" name="keywords">
        <meta content="eCommerce HTML Template Free Download" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <?php include "top-bar.php";?>

        <?php include "nav-bar.php";?>

        <?php include "bottom-bar.php"?>

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product-list.php">Products</a></li>
                    <li class="breadcrumb-item active">Product Detail</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Product Detail Start -->
        <div class="product-detail">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="product-detail-top">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="product-slider-single normal-slider">
                                        <img src="<?php echo $productImgUrl?>" alt="Product Image">
                                    </div>
                                    <div class="product-slider-single-nav normal-slider">
                                        <div class="slider-nav-img"><img src="<?php echo $productImgUrl?>" alt="Product Image"></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <form class="product-content" action="add-to-cart.php" method="POST">
                                    <?php
                                        if((isset($commentarr) && $comment_count != 0)){
                                            $comment_row_number = count($commentarr);
                                            for($i=0; $i<$comment_row_number; $i++) {
                                                $avg_rating = $avg_rating + $commentarr[$i]['rating'];
                                            }
                                            $avg_rating = $avg_rating / $comment_row_number;
                                        }?>
                                        <div class="title"><h1><?php echo $pname?></h1></div>
                                        <div class="title"><h2><?php echo $artist?></h2></div>
                                        <div class="title"><h3><?php
                                        if((isset($commentarr) && $comment_count != 0)){
                                            for($j=0; $j<$avg_rating; $j++) {

                                                ?> <i class="fa fa-star"></i><?php
                                            }
                                        }
                                        else
                                        {
                                            echo "This product has not been reviewed.";
                                        }?></h3></div>
                                        <div class="title"><h4><?php echo ucwords(strtolower($genre))?></h4></div>
                                        <div class="price">
                                            <h5>Price:</h5>
                                            <p><?php echo $price?>₺</p>
                                        </div>
                                        <div class="quantity">
                                            <h5>Quantity:</h5>
                                            <div class="qty">
                                              <button type="button" class="btn-minus"><i class="fa fa-minus"></i></button>
                                              <input type="text" name="quantity" value="1">
                                              <button type="button" class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <input type='hidden' name='prid' value='<?php echo $prid?>' />
                                         <input type='hidden' name='price' value='<?php echo $price?>' />
                                         <button class="btn" ><i class="fa fa-shopping-cart"></i>Add to Cart</button>
                                         <button class="btn" name ="buy-now"><i class="fa fa-shopping-bag"></i>Buy Now</button>

                                   </form>
                                </div>
                            </div>
                        </div>

                        <div class="row product-detail-bottom">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                    </li>
                                    <li class="nav-item">
                                       <a class="nav-link" data-toggle="pill" href="#songs">Songs</a>
                                   </li>
                                   <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#reviews">Reviews (<?php echo $visibleCommentcounts?> of <?php echo $comment_count?>)</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="description" class="container tab-pane active">
                                        <h4>Product description</h4>
                                        <p>
                                            <?php echo $description ?>
                                        </p>
                                    </div>
                                    <div id="songs" class="container tab-pane fade">
                                        <h4>Songs</h4>
                                        <ul>
                                          <?php
                                            $songs_row_number = count($songs_arr);
                                            for($i=0; $i<$songs_row_number; $i++) {
                                                $song_name = $songs_arr[$i]['songname'];
                                                $trackNo = $songs_arr[$i]['TrackNumber'];
                                              ?><li><?php echo $trackNo?>. <?php echo $song_name?></li><?php
                                            }
                                          ?>
                                        </ul>
                                    </div>
                                    <div id="reviews" class="container tab-pane fade">
                                        <div class="reviews-submitted">
                                        <?php
                                            $comment_row_number = count($commentarr);
                                            for($i=0; $i<$comment_row_number; $i++) {
                                                $commentername= $commentarr[$i]['name'];
                                                $commentersurname = $commentarr[$i]['surname'];
                                                $comment = $commentarr[$i]['com_text'];
                                                $rating = $commentarr[$i]['rating'];
                                                $date_time = $commentarr[$i]['time'];
                                                $isVisible =  $commentarr[$i]['isVisible'];

                                                if ( $isVisible == 1 ){
                                                    $visibleCommentcounts++;
                                          ?>

                                            <div class="reviewer"> <?php echo $commentername?> <?php echo $commentersurname?> - <span><?php echo $date_time ?></span></div>
                                            <div class="ratting">

                                            <?php
                                            for($j=0; $j<$rating; $j++) {

                                                ?> <i class="fa fa-star"></i><?php
                                            }?>


                                            </div>

                                            <p>
                                            <?php echo $comment?>
                                            <?php
                                            if(isset($_SESSION["pid"]))
                                            {
                                                if($commentarr[$i]['pid'] == $personid)
                                                {

                                                    ?><form action="product-detail-post.php?id=<?php echo $id?>" method = 'POST'>
                                                    <input type='hidden' name='prid' value='<?php echo $prid?>' />
                                                    <input type='hidden' name='commentid' value='<?php echo $commentarr[$i]['cid']?>' />
                                                    <input type='hidden' name='id' value='<?php echo $id?>'/>
	                                            	<button cls='btn' name= 'comment-delete'>
	                                            		<i class="fa fa-trash"></i>
	                                            	</button>
                                                    </form><?php
                                                }
                                            }

                                            ?>

                                            </p>

                                        <?php
                                        }
                                        }
                                        ?>

                                        </div>
                                        <div class="reviews-submit">
                                            <h4>Give your Review:</h4>

                                            <form class="comment-form" action='product-detail-post.php?id=<?php echo $id?>' method="POST">
                                            <div class="stars">
                                                <input id="star-5" type="radio" name="star"value="<?php echo  $rate = 5?>"/>
                                                <label for="star-5"></label>
                                                <input id="star-4" type="radio" name="star"value="<?php echo  $rate = 4?>"/>
                                                <label for="star-4"></label>
                                                <input id="star-3" type="radio"  name="star"value="<?php  echo $rate = 3?>"/>
                                                <label for="star-3"></label>
                                                <input id="star-2" type="radio" name="star"value="<?php echo  $rate = 2?>"/>
                                                <label for="star-2"></label>
                                                <input id="star-1" type="radio"  name="star"value="<?php  echo $rate = 1?>"/>
                                                <label for="star-1"></label>

                                            </div>

                                            <div class="row form"<?php 
                                                                                    function function_alert($message) {

                                                                                        // Display the alert box
                                                                                        echo "<script>alert('$message');</script>";

                                                                                    }
                                                                                    ?>>

                                                <div class="col-sm-12">

                                                <?php
                                                if(isset($_SESSION["pid"]))
                                                {
                                                  $personid = $_SESSION["pid"];

                                                $person_row_number = count($persons);
                                                $flag = false;
                                                for($i=0; $i<$person_row_number; $i++) {
                                                    if($persons[$i]['pid'] == $personid)
                                                    {
                                                        $flag = true;
                                                    }
                                                }
                                                }
                                                ?>

                                                    <input type='hidden' name='personid' value='<?php echo  $personid?>'/>
                                                    <input type='hidden' name='prid' value='<?php echo $prid?>' />
                                                    <input type='hidden' name='rate' value='<?php echo $rate?>' />
                                                        <textarea placeholder="Review" name="submitted_comment"></textarea>
                                                        <span class="help-block">

                                                        </span>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <button name = 'comment-submit' 
                                                        <?php 
                                                            if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $flag === true ))
                                                            {
                                                                    echo "disabled";
                                                            }

                                                        ?>>Submit</button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(count($myarr) != 1) {?>
                        <div class="product">
                            <div class="section-header">
                                <h1>Related Products</h1>
                            </div>
                            <div class="row align-items-center product-slider product-slider-3">
                              <?php
                                $row_number=count($myarr);

                                for($i=0;$i<$row_number;$i++)
                                {
                                     $slider_id = $myarr[$i]['prid'];
                                     if($prid != $slider_id) {
                                     $slider_name = $myarr[$i]['pname'];
                                     $slider_price = $myarr[$i]['price'];
                                     $slider_productImgUrl = $myarr[$i]['productImgUrl'];
                                ?>
                                  <div class="col-lg-3">
                                      <div class="product-item">
                                          <div class="product-title">
                                              <a href="product-detail.php?id=<?php echo $slider_id?>"><?php echo $slider_name?></a>
                                          </div>
                                          <div class="product-image">
                                              <a href="product-detail.php">
                                                  <img src="<?php echo $slider_productImgUrl?>" alt="Product Image">
                                              </a>
                                              <form class="product-action" action="add-to-cart.php" method="POST">
                                                  <input type='hidden' name='quantity' value=1 />
                                                  <input type='hidden' name='prid' value='<?php echo $slider_id?>' />
                                                  <input type='hidden' name='price' value='<?php echo $slider_price?>' />
                                                  <button class="btn"><i class="fa fa-cart-plus"></i></button>

                                              </form>
                                          </div>
                                          <form class="product-action" action="add-to-cart.php" method="POST">
                                            <div class="product-price">
                                                <h3><?php echo $slider_price?><span>₺</span></h3>
                                                <input type='hidden' name='quantity' value=1 />
                                                <input type='hidden' name='prid' value='<?php echo $slider_id?>' />
                                                <input type='hidden' name='price' value='<?php echo $slider_price?>' />
                                                <button class="btn" name='buy-now' ><i class="fa fa-shopping-cart"></i>Buy Now</button>
                                            </div>
                                          </form>
                                      </div>
                                  </div>
                                <?php
                                    }

                                 }

                                 ?>

                            </div>
                        </div>
                        <?php }?>
                    </div>
                                        <!-- Side Bar Start -->
                                        <div class="col-lg-4 sidebar">
                        <div class="sidebar-widget category">
                            <h2 class="title">Category</h2>
                            <nav class="navbar bg-light">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                    <?php
                                          for($a=0;$a<$row_number_genre - 1;$a++)
                                          {
                                           $genres = $genrecategory[$a]['genre'];

                                             ?>
                                             <a class="nav-link" href='product-list.php?genres=<?php echo $genres?>'> <i class="fa fa-music"></i><?php echo ucwords(strtolower($genres))?> </a>
                                            <?php
                                            }
                                          ?>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <?php if ($row_number_rec_product != 0 ) { ?>
                            <div class="section-header">
                                <h2>Recommended for you</h2>

                        <div class="sidebar-widget widget-slider">
                            <div class="sidebar-slider normal-slider">

                              <?php
                                $row_number=count($rec_product);

                                for($i=0;$i<$row_number;$i++)
                                {
                                     $slider_id = $rec_product[$i]['prid'];
                                     if($prid != $slider_id) {
                                     $slider_name = $rec_product[$i]['pname'];
                                     $slider_price = $rec_product[$i]['price'];
                                     $slider_productImgUrl = $rec_product[$i]['productImgUrl'];
                                ?>
                                  <div class="col-lg-3">
                                      <div class="product-item">
                                          <div class="product-title">
                                              <a href="product-detail.php?id=<?php echo $slider_id?>"><?php echo $slider_name?></a>
                                          </div>
                                          <div class="product-image">
                                              <a href="product-detail.php">
                                                  <img src="<?php echo $slider_productImgUrl?>" alt="Product Image">
                                              </a>
                                              <form class="product-action" action="add-to-cart.php" method="POST">
                                                  <input type='hidden' name='quantity' value=1 />
                                                  <input type='hidden' name='prid' value='<?php echo $slider_id?>' />
                                                  <input type='hidden' name='price' value='<?php echo $slider_price?>' />
                                                  <button class="btn"><i class="fa fa-cart-plus"></i></button>

                                              </form>
                                          </div>
                                          <form class="product-action" action="add-to-cart.php" method="POST">
                                            <div class="product-price">
                                                <h3><?php echo $slider_price?><span>₺</span></h3>
                                                <input type='hidden' name='quantity' value=1 />
                                                <input type='hidden' name='prid' value='<?php echo $slider_id?>' />
                                                <input type='hidden' name='price' value='<?php echo $slider_price?>' />
                                                <button class="btn" name='buy-now' ><i class="fa fa-shopping-cart"></i>Buy Now</button>
                                            </div>
                                          </form>
                                      </div>
                                  </div>
                                <?php
                                    }

                                 }

                                 ?>

                            </div>

                            </div>
                        </div>
                        <?php } ?>


                    <!-- Side Bar Start -->



                    <!-- Side Bar End -->
                </div>
            </div>
        </div>
        <!-- Product Detail End -->

        <!-- Brand Start -->
        <div class="brand">
            <div class="container-fluid">
                <div class="brand-slider">
                    <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
                </div>
            </div>
        </div>
        <!-- Brand End -->

        <?php include "footer.php";?>

        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 copyright">
                        <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
                    </div>

                    <div class="col-md-6 template-by">
                        <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->

        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
