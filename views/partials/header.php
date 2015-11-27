<?php
ob_start();
session_start();
$_SESSION['redirectURL'] = $_SERVER["REQUEST_URI"];
require("$_SERVER[DOCUMENT_ROOT]app/config/database.php");
use Cartalyst\Sentinel\Native\Facades\Sentinel;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
    <title><?php echo $metaTitle; ?><?php if (function_exists('bloginfo')){ bloginfo('name'); wp_title(" - ", true, "left"); } ?></title>
    <meta name="description" content="<?php echo $metaDescription ?>">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="/public/favicon.ico">
    <link rel="icon" href="/public/favicon.ico">
    <!-- Wordpress -->
    <!-- if on blog -->
<?php if(function_exists('is_main_site')) { ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );?>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>
<?php } ?>

    <!-- CSS -->
    <link href="/public/css/styles.css" rel="stylesheet">
    <link href="/public/css/onepcssgrid.css" rel="stylesheet">
    <link href="/public/css/owl.carousel.css" rel="stylesheet">
    <link href="/public/css/owl.theme.css" rel="stylesheet">
    <link href="/public/css/owl.transitions.css" rel="stylesheet">

    <!-- Fonts 
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

            <style>
        .col1, .col2, .col3, .col4, .col4.last, .col5, .col6, .col7, .col8, .col9, .col10, .col11, .col12 {
            padding: 0 0 20px;
        }

        header .col12, header .col4, #cookie_container .col9, #cookie_container .col3.last, footer .col4, footer .col4.last, footer .col5, footer .col7.last, footer .col12, #searchhighlight.col6 {
            padding: 0;
        }

        body {
           background-color:#efeded;
        }

        section {
            padding: 30px;
            text-align: left;
            background-color: #fff;
        }
        </style>

    <!-- Google Analytics -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date(); a = s.createElement(o),
            m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-54546266-1', 'auto'); // Key - Works on LocalHost
        ga('send', 'pageview');
    </script>

</head>
<body>
   <div id="cookie_container">
        <div class="onepcssgrid-1200">
            <div class="onerow">
                <div class="col9">
                    <div id="cookie_text">
                        <span>O.P Website uses cookies and by continuing to browse you agree to our use of cookies. For more details, please see our <a href="/cookie-policy">Cookie Policy</a></span>
                    </div>
                </div>
                <div class="col3 last">
                    <div id="cookie_button_box">
                        <button id="button" class="button" type="submit">Continue</button>
                    </div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1200 Closing -->
    </div>
    <header>
        <div class="onepcssgrid-1200">
            <div class="onerow">
                <div class="col12">
                    <div class="search_loginbox">
                        <!-- Login / Register -->
                        <div class="login_register">
                    <?php if (!$user = Sentinel::check()) : ?>
                        <a href="/auth/login">Login</a>
                        <a href="/auth/register">Register</a>
                    <?php else : ?>
                            <a href="#"><?php echo $user['first_name']; ?> <span class="caret"></span></a>
                            <a href="/auth/logout">Logout</a>
                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="onepcssgrid-600">
            <div class="onerow">
                <div class="col4" id="col4query">
                    <div class="query">For Further Enqueries</div>
                </div>
                <div class="col4" id="col4logo">
                    <!-- Logo -->                    
                    <div id="logo"><a href="/"><img src="/public/img/logo.png" /></a></div>
                </div>
                <div class="col4 last">
                    <!-- phone number -->          
                    <div class="pnumber">012345 67 89</div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1200 Closing -->
    </header>
    <div id="navwrapper">
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/static"><span>/</span>Static Site</a></li>
                <li>
                    <a href="/blog"><span>/</span>Blog<img src="/public/img/navarrow.png" class="navarrow" alt="navarrow" /></a>
                    <ul>
                        <li><a href="">Test A</a></li>
                        <li><a href="">Test B</a></li>
                        <li><a href="">Test C</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/auth/register"><span>/</span>Authenticate<img src="/public/img/navarrow.png" class="navarrow" alt="navarrow" /></a>
                    <ul>
                        <li><a href="">Test D</a></li>
                        <li><a href="">Test E</a></li>
                        <li><a href="">Test F</a></li>
                        <li><a href="">Test G</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/about-us"><span>/</span>About Us<img src="/public/img/navarrow.png" class="navarrow" alt="navarrow" /></a>
                    <ul>
                        <li><a href="/mysqli-query">MySQLi Query</a></li>
                        <li><a href="/blog/search">Search</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                    </ul>
                </li>
                <li><a href="/contact"><span>/</span>Contact</a></li>
            </ul>
            <a href="" id="pull"></a>
        </nav>
    </div>