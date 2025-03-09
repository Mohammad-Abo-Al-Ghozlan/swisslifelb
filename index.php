<?php require_once('header.php'); ?>

<?php
$title = "Home - SwissLife";
$description = "Welcome to SwissLife Pharmaceuticals, your trusted partner in healthcare and wellness.";
?>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $description; ?>">
<meta property="og:title" content="SwissLife Lebanon">
<meta property="og:description" content="Get the best medicines in Lebanon.">
<meta property="og:image" content="assets/uploads/<?php echo $favicon; ?>">
<meta property="og:url" content="https://www.swisslifelb.com">

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $featured_product_title = $row['featured_product_title'];
    $featured_product_subtitle = $row['featured_product_subtitle'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $total_featured_product_home = $row['total_featured_product_home'];
    $total_latest_product_home = $row['total_latest_product_home'];
    $total_popular_product_home = $row['total_popular_product_home'];
    $home_service_on_off = $row['home_service_on_off'];
    $home_welcome_on_off = $row['home_welcome_on_off'];
    $home_featured_product_on_off = $row['home_featured_product_on_off'];
    $home_latest_product_on_off = $row['home_latest_product_on_off'];
    $home_popular_product_on_off = $row['home_popular_product_on_off'];

}


?>
<link rel="stylesheet" href="assets/css/newcard.css">

<style>
    .cont a {
    font-size: 24px;
    border-radius: 15px;
    padding: 10px 20px;
    border: 1px #c16c19 solid;
    text-decoration: none;
    color: #c16c19;
    display: flex;
    align-items: center;
}

.cont a:hover {
    background-color: #c16c19;
    color: #fff;
}

/* Ensure the icon color changes on hover */
.cont a:hover i {
    color: #fff;
}
#carousel-img {
  width: 100%;
  height: 600px; /* Set the original height for larger screens */
  background-size: contain; /* Ensure the image covers the entire container */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Ensure the image doesn't repeat */
}
.carousel {
  height: 600px;
}

/* Adjust height and positioning for phone screens */
@media (max-width: 767px) {
  #carousel-img {
    height: 500px; /* Set height to 400px for smaller screens */
    background-size: cover; /* Ensure the image covers the entire container */
    background-position: center; /* Center the image vertically and horizontally */
  }
  .carousel {
    height: 500px; /* Match the carousel height to 400px */
  }
}


</style>
<style>
@media (max-width: 480px) {
    .indicators-line > .carousel-indicators {
        display: block;
        right: 42%;
    }
}
@media (max-width: 767px) {
    /* Styles for phones */
    .carousel-indicators {
        right: 42%;
    }
}
.carousel-indicators {
    right: 50%;
}
</style>
<div id="bootstrap-touch-slider" class="carousel bs-slider fade control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="false">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        $i=0;
        $statement = $pdo->prepare("SELECT * FROM tbl_slider");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {            
            ?>
            <li data-target="#bootstrap-touch-slider" data-slide-to="<?php echo $i; ?>" <?php if($i==0) {echo 'class="active"';} ?>></li>
            <?php
            $i++;
        }
        ?>
    </ol>

    <!-- Wrapper For Slides -->
    <div class="carousel-inner" role="listbox">

        <?php
        $i=0;
        $statement = $pdo->prepare("SELECT * FROM tbl_slider");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {            
            ?>
            <div id="carousel-img" class="item <?php if($i==0) {echo 'active';} ?>" style="background-image:url(assets/uploads/<?php echo $row['photo']; ?>);">
                <!--<div class="bs-slider-overlay"></div>-->
                <div class="container">
                    <div class="row">
                        <div class="slide-text <?php if($row['position'] == 'Left') {echo 'slide_style_left';} elseif($row['position'] == 'Center') {echo 'slide_style_center';} elseif($row['position'] == 'Right') {echo 'slide_style_right';} ?>">
                            <h1 data-animation="animated <?php if($row['position'] == 'Left') {echo 'zoomInLeft';} elseif($row['position'] == 'Center') {echo 'flipInX';} elseif($row['position'] == 'Right') {echo 'zoomInRight';} ?>"><?php echo $row['heading']; ?></h1>
                            <p data-animation="animated <?php if($row['position'] == 'Left') {echo 'fadeInLeft';} elseif($row['position'] == 'Center') {echo 'fadeInDown';} elseif($row['position'] == 'Right') {echo 'fadeInRight';} ?>"><?php echo nl2br($row['content']); ?></p>
                            <!-- <a href="<?php echo $row['button_url']; ?>" target="_blank"  class="btn btn-primary" data-animation="animated 
                            <?php if($row['position'] == 'Left') {echo 'fadeInLeft';} elseif($row['position'] == 'Center') {echo 'fadeInDown';} elseif($row['position'] == 'Right')
                             {echo 'fadeInRight';} ?>"><?php echo $row['button_text']; ?></a> -->
                             

<script>
function handleButtonClick(url) {
  window.open(url, '_blank'); // Opens the URL in a new tab
  // Alternatively, you can perform any other action you desire here
}
</script>

                             
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>

    <!-- Slider Left Control -->
    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <!-- Slider Right Control -->
    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>




<div class="mid-cat-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5">Our Brands</h2>
    <div class="row">
      <?php
      $statement = $pdo->prepare("SELECT * FROM tbl_mid_category ORDER BY mcat_id ASC LIMIT 3");
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $row) {
      ?>
        <div class="col-lg-4 col-md-6 col-12 mb-4">
          <div class="mid-cat-item">
            <div class="image-wrapper">
              <img src="<?php echo $row['mcat_img']; ?>" alt="<?php echo $row['mcat_name']; ?>" class="img-fluid" style="object-fit: cover;">
              <div class="overlay">
                <a href="product-category.php?id=<?php echo $row['mcat_id']; ?>&type=mid-category" class="btn btn-primary">View Products</a>
              </div>
            </div>
            <div class="content">
              <h3><?php echo $row['mcat_name']; ?></h3>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>

<style>
.mid-cat-section {
  background-color: #f8f9fa;
  padding: 60px 0;
}

.section-title {
  font-size: 2.5rem;
  color: #333;
  margin-bottom: 40px;
  position: relative;
}

.section-title::after {
  content: '';
  display: block;
  width: 60px;
  height: 3px;
  background-color: #c16c19;
  margin: 20px auto 0;
}

.mid-cat-item {
  background-color: #ffffff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.mid-cat-item:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

.image-wrapper {
  position: relative;
  overflow: hidden;
}

.mid-cat-item img {
  width: 100%;
  height: 250px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.mid-cat-item:hover img {
  transform: scale(1.1);
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(193, 108, 25, 0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.mid-cat-item:hover .overlay {
  opacity: 1;
}

.content {
  padding: 20px;
  text-align: center;
}

.mid-cat-item h3 {
  font-size: 1.5rem;
  color: #333;
  margin-bottom: 0;
  transition: color 0.3s ease;
}

.mid-cat-item:hover h3 {
  color: #c16c19;
}

.btn-primary {
  background-color: #ffffff;
  color: #c16c19;
  border: 2px solid #ffffff;
  padding: 10px 20px;
  font-weight: bold;
  text-transform: uppercase;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background-color: transparent;
  color: #ffffff;
}

@media (max-width: 991px) {
  .mid-cat-section {
    padding: 40px 0;
  }
  
  .section-title {
    font-size: 2rem;
  }
}

@media (max-width: 767px) {
  .mid-cat-section {
    padding: 30px;
  }
  
  .section-title {
    font-size: 1.8rem;
  }
  
  .mid-cat-item {
    margin-bottom: 30px;
  }
}
</style>



<?php if($home_featured_product_on_off == 1): ?>
<div class="product pt_70 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?php echo $featured_product_title; ?></h2>
                    <h3 class="section-title"><?php echo $featured_product_subtitle; ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="product-carousel" style="margin-bottom: 5px;">
                    
                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_featured=? AND p_is_active=? LIMIT ".$total_featured_product_home);
                    $statement->execute(array(1,1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>
                        <div class="item" style="margin:5px;">
                            <div class="thumb" style="box-shadow: 0px 4px 8px rgba(0.2, 0.2, 0.2, 0.2);">
                                <div class="photo" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                <div class="overlay"></div>
                            </div>
                            <div class="text" style="box-shadow: 0px 4px 8px rgba(0.2, 0.2, 0.2, 0.2);">
                                <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                                
                                <div class="rating">
                                    <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
                                    if($avg_rating == 0) {
                                        echo '';
                                    }
                                    elseif($avg_rating == 1.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    } 
                                    elseif($avg_rating == 2.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 3.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 4.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                    }
                                    else {
                                        for($i=1;$i<=5;$i++) {
                                            ?>
                                            <?php if($i>$avg_rating): ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php else: ?>
                                                <i class="fa fa-star"></i>
                                            <?php endif; ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <div class="cont" style="display: flex; gap: 20px; justify-content: center; align-items: center;">
                    <a href="tel:+96103155211"><i class="fa fa-phone"></i></a>
                    <a href="http://wa.me/+96103155211?text=Hello%20there!" target="_blank" rel="noopener noreferrer""><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if($home_latest_product_on_off == 1): ?>
<div class="product bg-gray pt_70 pb_30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?php echo $latest_product_title; ?></h2>
                    <h3 class="section-title"><?php echo $latest_product_subtitle; ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="product-carousel" style="margin:5px;">

                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT ".$total_latest_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>
                        <div class="item" style="margin:5px;">
                            <div class="thumb" style="box-shadow: 0px 4px 8px rgba(0.2, 0.2, 0.2, 0.2);">
                                <div class="photo" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                <div class="overlay"></div>
                            </div>
                            <div class="text" style="box-shadow: 0px 4px 8px rgba(0.2, 0.2, 0.2, 0.2);">
                                <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                                
                                <div class="rating">
                                    <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
                                    if($avg_rating == 0) {
                                        echo '';
                                    }
                                    elseif($avg_rating == 1.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    } 
                                    elseif($avg_rating == 2.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 3.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 4.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                    }
                                    else {
                                        for($i=1;$i<=5;$i++) {
                                            ?>
                                            <?php if($i>$avg_rating): ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php else: ?>
                                                <i class="fa fa-star"></i>
                                            <?php endif; ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <div class="cont" style="display: flex; gap: 20px; justify-content: center; align-items: center;">
                    <a href="tel:+96103155211"><i class="fa fa-phone"></i></a>
                    <a href="http://wa.me/+96103155211?text=Hello%20there!" target="_blank" rel="noopener noreferrer""><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>


            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if($home_popular_product_on_off == 1): ?>
<div class="product pt_70 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?php echo $popular_product_title; ?></h2>
                    <h3 class="section-title"><?php echo $popular_product_subtitle; ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="product-carousel" style="margin:5px;">

                    <?php
                    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_is_active=? ORDER BY p_total_view DESC LIMIT ".$total_popular_product_home);
                    $statement->execute(array(1));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                    foreach ($result as $row) {
                        ?>
                        <div class="item" style="margin:5px;">
                            <div class="thumb" style="box-shadow: 0px 4px 8px rgba(0.2, 0.2, 0.2, 0.2);">
                                <div class="photo" srcset="image-small.jpg 600w, image-medium.jpg 1200w, image-large.jpg 1800w" 
     sizes="(max-width: 600px) 100vw, (max-width: 1200px) 50vw, 33vw" style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);"></div>
                                <div class="overlay"></div>
                            </div>
                            <div class="text" style="box-shadow: 0px 4px 8px rgba(0.2, 0.2, 0.2, 0.2);">
                                <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a></h3>
                                
                                <div class="rating">
                                    <?php
                                    $t_rating = 0;
                                    $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                    $statement1->execute(array($row['p_id']));
                                    $tot_rating = $statement1->rowCount();
                                    if($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            $t_rating = $t_rating + $row1['rating'];
                                        }
                                        $avg_rating = $t_rating / $tot_rating;
                                    }
                                    ?>
                                    <?php
                                    if($avg_rating == 0) {
                                        echo '';
                                    }
                                    elseif($avg_rating == 1.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    } 
                                    elseif($avg_rating == 2.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 3.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                    }
                                    elseif($avg_rating == 4.5) {
                                        echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                    }
                                    else {
                                        for($i=1;$i<=5;$i++) {
                                            ?>
                                            <?php if($i>$avg_rating): ?>
                                                <i class="fa fa-star-o"></i>
                                            <?php else: ?>
                                                <i class="fa fa-star"></i>
                                            <?php endif; ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php if($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <div class="cont" style="display: flex; gap: 20px; justify-content: center; align-items: center;">
                    <a href="tel:+96103155211"><i class="fa fa-phone"></i></a>
                    <a href="http://wa.me/+96103155211?text=Hello%20there!" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($home_service_on_off == 1): ?>
<div class="service bg-gray">
    <div class="container">
        <div class="row">
            <?php
                $statement = $pdo->prepare("SELECT * FROM tbl_service");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
                foreach ($result as $row) {
                    ?>
                    <div class="col-md-3">
                        <div class="item">
                            <div class="photo"><img src="assets/uploads/<?php echo $row['photo']; ?>" width="150px" alt="<?php echo $row['title']; ?>"></div>
                            <h3><?php echo $row['title']; ?></h3>
                            <p><?php echo nl2br($row['content']); ?></p>
                        </div>
                    </div>
                    <?php
                }
            ?>
                        <div class="item">
                            <div class="photo">
                                <img src="assets/img/qrcode.png" width="150px" alt="Swisslife QR-Code">
                                <h3>Scan the QR-Code</h3>
                                <p>Learn more about our services and products.</p>
                            </div>
                        </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php require_once('footer.php'); ?>