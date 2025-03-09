<?php require_once('header.php'); ?>

<?php
$title = "Product Name - SwissLife Pharmaceuticals";
$description = "Discover the benefits of Product Name, a breakthrough solution by SwissLife Pharmaceuticals.";
?>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $description; ?>">

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
    $banner_product_category = $row['banner_product_category'];
}
?>

<?php
if( !isset($_REQUEST['id']) || !isset($_REQUEST['type']) ) {
    header('location: index.php');
    exit;
} else {

    if( ($_REQUEST['type'] != 'top-category') && ($_REQUEST['type'] != 'mid-category') && ($_REQUEST['type'] != 'end-category') ) {
        header('location: index.php');
        exit;
    } else {

        $statement = $pdo->prepare("SELECT * FROM tbl_top_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $top[] = $row['tcat_id'];
            $top1[] = $row['tcat_name'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_mid_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $mid[] = $row['mcat_id'];
            $mid1[] = $row['mcat_name'];
            $mid2[] = $row['tcat_id'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_end_category");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $end[] = $row['ecat_id'];
            $end1[] = $row['ecat_name'];
            $end2[] = $row['mcat_id'];
        }

        if($_REQUEST['type'] == 'top-category') {
            if(!in_array($_REQUEST['id'],$top)) {
                header('location: index.php');
                exit;
            } else {

                // Getting Title
                for ($i=0; $i < count($top); $i++) { 
                    if($top[$i] == $_REQUEST['id']) {
                        $title = $top1[$i];
                        break;
                    }
                }
                $arr1 = array();
                $arr2 = array();
                // Find out all ecat ids under this
                for ($i=0; $i < count($mid); $i++) { 
                    if($mid2[$i] == $_REQUEST['id']) {
                        $arr1[] = $mid[$i];
                    }
                }
                for ($j=0; $j < count($arr1); $j++) {
                    for ($i=0; $i < count($end); $i++) { 
                        if($end2[$i] == $arr1[$j]) {
                            $arr2[] = $end[$i];
                        }
                    }   
                }
                $final_ecat_ids = $arr2;
            }   
        }

        if($_REQUEST['type'] == 'mid-category') {
            if(!in_array($_REQUEST['id'],$mid)) {
                header('location: index.php');
                exit;
            } else {
                // Getting Title
                for ($i=0; $i < count($mid); $i++) { 
                    if($mid[$i] == $_REQUEST['id']) {
                        $title = $mid1[$i];
                        break;
                    }
                }
                $arr2 = array();        
                // Find out all ecat ids under this
                for ($i=0; $i < count($end); $i++) { 
                    if($end2[$i] == $_REQUEST['id']) {
                        $arr2[] = $end[$i];
                    }
                }
                $final_ecat_ids = $arr2;
            }
        }

        if($_REQUEST['type'] == 'end-category') {
            if(!in_array($_REQUEST['id'],$end)) {
                header('location: index.php');
                exit;
            } else {
                // Getting Title
                for ($i=0; $i < count($end); $i++) { 
                    if($end[$i] == $_REQUEST['id']) {
                        $title = $end1[$i];
                        break;
                    }
                }
                $final_ecat_ids = array($_REQUEST['id']);
            }
        }
        
    }   
}
?>

<link rel="stylesheet" href="assets/css/newcard.css">

<div class="page-banner" style="background-color:#9fcd58;">
    <div class="inner">
        <h1><?php echo LANG_VALUE_50; ?> <?php echo $title; ?></h1>
    </div>
</div>



<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('sidebar-category.php'); ?> <!-- error -->
            </div>
            <div class="col-md-9">
                
                <h3><?php echo LANG_VALUE_51; ?> "<?php echo $title; ?>"</h3>
                <div class="product product-cat">
                    <div class="row">
                        <?php
                        // Initialize product category IDs array
                        $prod_table_ecat_ids = array(); // Make sure it's initialized as an array

                        // Fetch all products and their category IDs
                        $statement = $pdo->prepare("SELECT ecat_id FROM tbl_product");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $prod_table_ecat_ids[] = $row['ecat_id'];
                        }

                        // Initialize product count
                        $prod_count = 0;

                        // Check if categories in $final_ecat_ids are present in $prod_table_ecat_ids
                        foreach ($final_ecat_ids as $ecat_id) {
                            if (in_array($ecat_id, $prod_table_ecat_ids)) {
                                $prod_count++;
                            }
                        }

                        // Display message if no products found
                        if ($prod_count == 0) {
                            echo '<div class="pl_15">' . LANG_VALUE_153 . '</div>';
                        } else {
                            // Loop through each category ID and fetch products
                            foreach ($final_ecat_ids as $ecat_id) {
                                $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE ecat_id=? AND p_is_active=?");
                                $statement->execute(array($ecat_id, 1));
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <div class="col-md-4 item item-product-cat" style="margin-bottom:10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0);">
    <div class="inner" style="margin-bottom:5px;">
        <div class="thumb" style="box-shadow: 0px 4px 8px rgba(0.2, 0.2, 0.2, 0.2);">
            <div class="photo" style="background-image:url(assets/uploads/<?php echo htmlspecialchars($row['p_featured_photo'], ENT_QUOTES, 'UTF-8'); ?>);"></div>
            <div class="overlay"></div>
        </div>
        <div class="text" style="box-shadow: 0px 4px 8px rgba(0.2, 0.2, 0.2, 0.2);padding-bottom:15px;">
            <h3><a style="color:#c16c19;" href="product.php?id=<?php echo htmlspecialchars($row['p_id'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row['p_name'], ENT_QUOTES, 'UTF-8'); ?></a></h3>
            <div class="rating" style="color:#c16c19;">
                <?php
                $statement1 = $pdo->prepare("SELECT rating FROM tbl_rating WHERE p_id=?");
                $statement1->execute(array($row['p_id']));
                $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                $tot_rating = count($result1);
                if ($tot_rating > 0) {
                    foreach ($result1 as $row1) {
                        $t_rating += $row1['rating'];
                    }
                    $avg_rating = $t_rating / $tot_rating;
                } else {
                    $avg_rating = 0;
                }
                ?>
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $avg_rating) {
                        if ($i - $avg_rating < 1) {
                            echo '<i class="fa fa-star-half-o"></i>';
                        } else {
                            echo '<i class="fa fa-star"></i>';
                        }
                    } else {
                        echo '<i class="fa fa-star-o"></i>';
                    }
                }
                ?>
            </div>
            <?php if ($row['p_qty'] == 0): ?>
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
</div>

                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
   /* General styling for the card container */
.product-cat .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start; /* Align cards to the start */
    margin: -10px; /* Negative margin to counteract item margins */
}

/* Card styling for all screens */
.item-product-cat {
    flex: 0 0 calc(33.333% - 20px); /* Set to roughly 1/3 width minus margins */
    margin: 10px;
    max-width: calc(33.333% - 20px); /* Ensure cards don't grow beyond 1/3 width */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effects for cards */
.item-product-cat:hover {
    transform: scale(1.03);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Text area styling */
.text {
    padding: 15px;
    text-align: center;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 768px) {
    .item-product-cat {
        flex: 0 0 calc(50% - 20px);
        max-width: calc(50% - 20px);
    }
}

@media (max-width: 480px) {
    .item-product-cat {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

/* Containing button styles */
.cont a {
    font-size: 16px;
    border-radius: 8px;
    padding: 10px 20px;
    border: 1px solid #c16c19;
    text-decoration: none;
    color: #c16c19;
    display: inline-flex;
    align-items: center;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.cont a:hover {
    background-color: #c16c19;
    color: #fff;
}

/* Ensure the icon color changes on hover */
.cont a:hover i {
    color: #fff;
}

</style>

<?php require_once('footer.php'); ?>