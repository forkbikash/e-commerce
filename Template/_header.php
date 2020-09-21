<?php
ob_start();//it was fine without this line on my localhost(xampp) but not on 000webhost server
if(!defined('_header')){
    header("HTTP/1.0 404 Not Found");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecommerce</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">

    <?php
    define('dbfunctions', true);
    require './dbfunctions.php';
    define('settoken',true);
    include './googlelogin/settoken.php';

    if(isset($token['access_token'])){
        $user_id=strlen($_SESSION['user_email_address']);

        if(count($user->getUser($user_id))==0){//change it after making user_id unique
            $params = array(
                'user_id' => $user_id,//make user_id unique later
                'first_name' => $_SESSION['user_first_name'],
                'last_name' => $_SESSION['user_last_name'],
            );
            $result = $user->insertUser($params);
            if(!$result){
                header("location: ./googlelogin/logout.php");
            }
        }

        $_SESSION['user_id'] = $user_id;
    }

    ?>

</head>
<body>

<!-- start #header -->
<header id="header">

    <!-- Primary Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
        <a class="navbar-brand" href="#">ecommerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto font-rubik">
                <?php if(isset($_SESSION['access_token'])){ ?>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Hi, <?php echo $_SESSION['user_first_name']; ?>!</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products <i class="fas fa-chevron-down"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Category <i class="fas fa-chevron-down"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Coming Soon</a>
                </li>
                <?php
                    if(!isset($_SESSION['access_token'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href=<?php echo $google_client->createAuthUrl(); ?> >LoginWithGoogle</a>
                </li>
                <?php }else{ ?>
                <li class="nav-item">
                    <a class="nav-link" href="./googlelogin/logout.php">Logout</a>
                </li>
                <?php } ?>
            </ul>
            <form action="#" class="font-size-14 font-rale">
                <a href="./cart.php" class="py-2 rounded-pill color-primary-bg">
                    <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                    <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php echo count($cart->getUserCart($_SESSION['user_id'] ?? 1)); ?></span>
                </a>
            </form>
        </div>
    </nav>
    <!-- !Primary Navigation -->

</header>
<!-- !start #header -->

<!-- start #main-site -->
<main id="main-site">