<?php require_once('header.php'); ?>

<?php
$title = "About Us - SwissLife Pharmaceuticals";
$description = "Learn more about SwissLife Pharmaceuticals, our commitment to advancing global health.";
?>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $description; ?>">
<meta property="og:title" content="SwissLife Lebanon">
<meta property="og:description" content="Get the best medicines in Lebanon.">
<meta property="og:image" content="assets/uploads/<?php echo $favicon; ?>">
<meta property="og:url" content="https://www.swisslifelb.com">


<?php
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
foreach ($result as $row) {
   $about_title = $row['about_title'];
    $about_content = $row['about_content'];
    $about_banner = $row['about_banner'];
}
?>

<div class="about-page">
    <div class="container">
        <div class="row" style="display:grid;place-items: center;">
            <div class="col-lg-10 offset-lg-1">
                <div class="about-content">
                    <div class="section-header">
                        <h2 class="section-title">Our Story</h2>
                        <div class="underline"></div>
                    </div>
                    <div class="content-wrapper">
                        <?php echo $about_content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
    }

    .page-banner {
        position: relative;
        background-size: cover;
        background-position: center;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-align: center;
    }

    .page-banner .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .page-banner .container {
        position: relative;
        z-index: 1;
    }

    .banner-title {
        font-size: 4rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s forwards 0.5s;
    }

    .about-page {
        padding: 6rem 0;
        background-color: #f8f9fa;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .underline {
        width: 50px;
        height: 3px;
        background-color: #9fcd58;
        margin: 0 auto;
    }

    .about-content {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 4rem;
        transform: translateY(20px);
        opacity: 0;
        animation: fadeInUp 0.8s forwards 0.8s;
    }

    .content-wrapper {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    .content-wrapper p:last-child {
        margin-bottom: 0;
    }

    .features-section {
        background-color: #007bff;
        color: #fff;
        padding: 5rem 0;
    }

    .feature-item {
        text-align: center;
        padding: 2rem;
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-10px);
    }

    .feature-item i {
        font-size: 3rem;
        margin-bottom: 1.5rem;
    }

    .feature-item h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .feature-item p {
        font-size: 1rem;
        line-height: 1.6;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .banner-title {
            font-size: 3rem;
        }

        .about-page {
            padding: 4rem 0;
        }

        .section-title {
            font-size: 2.2rem;
        }

        .about-content {
            padding: 2.5rem;
        }

        .features-section {
            padding: 3rem 0;
        }
    }
</style>

<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

<?php require_once('footer.php'); ?>