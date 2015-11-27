<?php
session_start();
$_SESSION['redirectURL'] = $_SERVER["REQUEST_URI"];
require("$_SERVER[DOCUMENT_ROOT]app/config/database.php");
use Cartalyst\Sentinel\Native\Facades\Sentinel;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Static</title>
    <meta name="description" content="This is the Static page">
    <meta name="keywords" content="">
    <meta name="author" content="O Parr">
    <link rel="shortcut icon" href="/public/favicon.ico">
    <link rel="icon" href="/public/favicon.ico">

<!-- CSS links -->
<!-- Main, Owl Carousel, Scrollpane -->
    <!-- CSS -->
    <link href="/public/css/static/style.css" rel="stylesheet">
    <link href="/public/css/static/owl.carousel.css" rel="stylesheet">
    <link href="/public/css/static/owl.theme.css" rel="stylesheet">
    <link href="/public/css/static/owl.transitions.css" rel="stylesheet">
    <link href="/public/css/static/jquery.jscrollpane.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="topbanner">
        <div class="onepcssgrid-1000">
            <div class="onerow">
                <div class="col2">
                    <div id="socialbox">
                        <a href="http://www.facebook.com/" target="_blank"><img src="/public/img/static/Facebookicon.png" alt="Follow us on Facebook" /></a>
                        <a href="http://www.twitter.com/" target="_blank"><img src="/public/img/static/Twittericon.png" alt="Follow us on Twitter" /></a>
                        <a href="http://www.youtube.com/" target="_blank"><img src="/public/img/static/Youtubeicon.png" alt="Follow us on YouTube" /></a>
                    </div>
                </div>
                <div class="col10 last">
                    <div class="search_loginbox">
                        <!-- Login / Register -->
                        <div class="login_register">
                    <?php if (!$user = Sentinel::check()) : ?>
                        <a href="../auth/login">Login</a>
                        <a href="../auth/register">Register</a>
                    <?php else : ?>
                            <a href="#"><?php echo $user['first_name']; ?> <span class="caret"></span></a>
                            <a href="auth/logout">Logout</a>
                    <?php endif; ?>
                        </div>
                        <!-- Search -->
                        <div class="search">                            
                            <form action="/search" method="GET">
                                <input type="text" class="siteSearch" placeholder="Search the website" name="q" />
                                <button type="submit" title="Search the website" value="Search"></button>
                            </form>
                        </div>
                    </div>
                </div>

            </div> <!-- Row Closing -->
        </div> <!-- 1000 Closing -->
    </div>
    <header>
        <div class="onepcssgrid-1000">
            <div class="onerow">
                <div class="col12">
                    <div class="col3">
                        <a href="home"><img src="/public/img/static/logo.png" alt="logo" /></a>
                    </div>
                    <div class="col9 last">
                        <div class="pnumberbox">
                            <span class="pnumberlabel">For Further Enquiries</span>
                            <span class="pnumber">0123 456 789</span>
                        </div>
                    </div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1000 Closing -->
    </header>
    <nav id="navwrapper">
        <nav id="navwrapper2" class="my-sticky-element">
            <div class="onepcssgrid-1000">
                <div class="onerow">
                    <div class="col12">
                        <nav>
                            <ul>
                                <li>
                                    <a href="/">Home</a>
                                    <div class="onerow">
                                        <ul>
                                            <li><a href="">Test A</a></li>
                                            <li><a href="">Test B</a></li>
                                            <li><a href="">Test C</a></li>
                                            <li><a href="">Test D</a></li>
                                            <li><a href="">Test E</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="static"><span>|</span>Static Site</a>
                                    <div class="onerow">
                                        <ul>
                                            <li><a href="">Test A</a></li>
                                            <li><a href="">Test B</a></li>
                                            <li><a href="">Test C</a></li>
                                            <li><a href="">Test D</a></li>
                                            <li><a href="">Test E</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="">Test F</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="blog"><span>|</span>Blog</a>
                                    <div class="onerow">
                                        <ul>
                                            <li><a href="">Test A</a></li>
                                            <li><a href="">Test B</a></li>
                                            <li><a href="">Test C</a></li>
                                            <li><a href="">Test D</a></li>
                                            <li><a href="">Test E</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="">Test F</a></li>
                                            <li><a href="">Test G</a></li>
                                            <li><a href="">Test H</a></li>
                                            <li><a href="">Test I</a></li>
                                            <li><a href="">Test J</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="">Test K</a></li>
                                            <li><a href="">Test L</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="auth/register"><span>|</span>Authenticate</a>
                                    <div class="onerow">
                                        <ul>
                                            <li><a href="">Test A</a></li>
                                            <li><a href="">Test B</a></li>
                                            <li><a href="">Test C</a></li>
                                            <li><a href="">Test D</a></li>
                                            <li><a href="">Test E</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="about-us"><span>|</span>About Us</a>
                                    <div class="onerow">
                                        <ul>
                                            <li><a href="mysqli-query">MySQLi Query</a></li>
                                            <li><a href="blog/search">Search</a></li>
                                            <li><a href="cookie-policy">Cookie Policy</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="contact"><span>|</span>Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> <!-- Row Closing -->
            </div> <!-- 1000 Closing -->
        </nav>
    </nav>
    <div id="slider">
        <div class="onepcssgrid-1000">
            <div class="onerow">
                <div id="mainslider" class="owl-carousel">
                    <div class="item"><img src="/public/img/static/slide1.png" alt="slide 1"><span class="slidertext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget accumsan turpis, a viverra massa. Lorem ipsum dolor sit amet.</span></div>
                    <div class="item"><img src="/public/img/static/slide2.png" alt="slide 2"><span class="slidertext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget accumsan turpis, a viverra massa. Lorem ipsum dolor sit amet.</span></div>
                    <div class="item"><img src="/public/img/static/slide3.png" alt="slide 3"><span class="slidertext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget accumsan turpis, a viverra massa. Lorem ipsum dolor sit amet.</span></div>
                    <div class="item"><img src="/public/img/static/slide4.png" alt="slide 4"><span class="slidertext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget accumsan turpis, a viverra massa. Lorem ipsum dolor sit amet.</span></div>
                    <div class="item"><img src="/public/img/static/slide5.png" alt="slide 5"><span class="slidertext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget accumsan turpis, a viverra massa. Lorem ipsum dolor sit amet.</span></div>
                    <div class="item"><img src="/public/img/static/slide6.png" alt="slide 6"><span class="slidertext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget accumsan turpis, a viverra massa. Lorem ipsum dolor sit amet.</span></div>
                    <div class="item"><img src="/public/img/static/slide7.png" alt="slide 7"><span class="slidertext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget accumsan turpis, a viverra massa. Lorem ipsum dolor sit amet.</span></div>
                    <div class="item"><img src="/public/img/static/slide8.png" alt="slide 8"><span class="slidertext">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eget accumsan turpis, a viverra massa. Lorem ipsum dolor sit amet.</span></div>
                </div>
                <div id="subslider" class="owl-carousel">
                    <div class="one item"><img src="/public/img/static/slide1sync.png" alt="slide 1"></div>
                    <div class="two item"><img src="/public/img/static/slide2sync.png" alt="slide 2"></div>
                    <div class="three item"><img src="/public/img/static/slide3sync.png" alt="slide 3"></div>
                    <div class="four item"><img src="/public/img/static/slide4sync.png" alt="slide 4"></div>
                    <div class="five item"><img src="/public/img/static/slide5sync.png" alt="slide 5"></div>
                    <div class="six item"><img src="/public/img/static/slide6sync.png" alt="slide 6"></div>
                    <div class="seventh item"><img src="/public/img/static/slide7sync.png" alt="slide 7"></div>
                    <div class="eight item"><img src="/public/img/static/slide8sync.png" alt="slide 8"></div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1000 Closing -->
    </div>
    <section>
        <div class="onepcssgrid-1000">
            <div class="onerow">
                <div class="col6">
                    <div class="productone">
                        <h2>Product One</h2>
                        <p>Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus. Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim. Nullam pharetra tempor posuere.</p>
                    </div>
                </div>
                <div class="col6 last">
                    <img src="/public/img/static/product1.jpg" alt="Product1">
                </div>
            </div> <!-- Row Closing -->
            <div class="onerow">
                <div class="col4">
                    <img src="/public/img/static/product2.jpg" alt="Product2">
                </div>
                <div class="col8 last">
                    <h2>Product Two</h2>
                    <p>Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus. Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim. Nullam pharetra tempor posuere.</p>
                </div>
            </div> <!-- Row Closing -->
            <div class="onerow">
                <div class="col4">
                    <div class="product34img">
                        <img src="/public/img/static/product3.jpg" alt="Product3">
                    </div>
                </div>
                <div class="col4">
                    <div class="product34">
                        <h2>Product Three and Four</h2>
                        <p>Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus. Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim. Nullam pharetra tempor posuere.</p>
                    </div>
                </div>
                <div class="col4 last">
                    <div class="product34img">
                        <img src="/public/img/static/product4.jpg" alt="Product4">
                    </div>
                </div>
            </div> <!-- Row Closing -->
            <div class="onerow">
                <div class="col3">
                    <div class="product56">
                        <h2>Product Five</h2>
                        <p>Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus. Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim. Nullam pharetra tempor posuere.</p>
                    </div>
                </div>
                <div class="col3">
                    <div class="product56img">
                        <img src="/public/img/static/product5.jpg" alt="product5">
                    </div>
                </div>
                <div class="col3">
                    <div class="product56">
                        <h2>Product Six</h2>
                        <p>Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus. Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim. Nullam pharetra tempor posuere.</p>
                    </div>
                </div>
                <div class="col3 last">
                    <div class="product56img">
                        <img src="/public/img/static/product6.jpg" alt="Product6">
                    </div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1000 Closing -->
    </section>
    <div id="subwrapper1">
        <div id="productbox1">
            <span class="left">Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus.<br><br>Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim. </span>
            <div id="productimagebox">
                <div id="productimage1">
                    <img src="/public/img/static/product7.jpg" alt="Product 7" />
                </div>
            </div>
            <span class="right">Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus.<br><br>Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim.</span>
        </div>
    </div>
    <div id="subwrapper2">
        <div id="productbox2">
            <span class="left">Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus.<br><br>Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim. Nullam pharetra tempor posuere.</span>
            <div id="productimage2">
                <img src="/public/img/static/product8.jpg" alt="Product 8" />
            </div>
            <span class="right">Suspendisse rhoncus vitae risus nec lobortis. Mauris vehicula nisi ac vehicula dapibus.<br><br>Fusce non diam porta, tristique tortor posuere, tincidunt quam. Mauris ac est rhoncus, volutpat eros at, venenatis enim. Nullam pharetra tempor posuere.</span>
        </div>
    </div>
    <footer>
        <div id="backtotop">
            <div class="onepcssgrid-1000">
                <div class="onerow">
                    <div class="col12">
                        <span>Back to Top</span>
                    </div>
                </div> <!-- Row Closing -->
            </div> <!-- 1000 Closing -->
        </div>
        <div class="onepcssgrid-1000">
            <div class="onerow">
                <div class="col4">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="static">Static Site</a></li>
                        <li><a href="blog">Blog</a></li>
                        <li><a href="auth/register">Authenticate</a></li>
                        <li><a href="">Test E</a></li>
                    </ul>
                </div>
                <div class="col4">
                    <ul class="border">
                        <li><a href="mysqli-query">MySQLi Query</a></li>
                        <li><a href="cookie-policy">Cookie Policy</a></li>
                        <li><a href="blog/search">Search</a></li>
                        <li><a href="about-us">About Us</a></li>
                        <li><a href="contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col4 last">
                    <ul class="border">
                        <li><img src="/public/img/static/firefox.png" alt="Firefox" /><span class="browsersupport">Firefox 3.5 +</span></li>
                        <li><img src="/public/img/static/chrome.png" alt="Chrome" /><span class="browsersupport">Chrome 35</span></li>
                        <li><img src="/public/img/static/ie.png" alt="Internet Explorer" /><span class="browsersupport">Internet Explorer 7 +</span></li>
                        <li><img src="/public/img/static/opera.png" alt="Opera" /><span class="browsersupport">Opera 12 +</span></li>
                        <li><img src="/public/img/static/safari.png" alt="Safari" /><span class="browsersupport">Safari 5.12</span></li>
                    </ul>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1000 Closing -->
        <div class="onepcssgrid-1000">
            <div class="onerow">
                <div class="col12">
                    <div id="copyrightbanner">
                        <span>Copyright &copy; <?php echo (new \DateTime())->format('Y'); ?> - Oliver Parr</span>
                    </div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1000 Closing -->
    </footer>

    <!-- JS links -->
    <script src="/public/js/jquery-1.11.1.min.js" type='text/javascript'></script>
    <script src="/public/js/jquery.validate.min.js" type='text/javascript'></script>
    <script src="/public/js/jquery.cookie.js" type='text/javascript'></script>

    <script src="/public/js/static/jquery.jscrollpane.min.js" type='text/javascript'></script>
    <script src="/public/js/static/jquery.mousewheel.min.js" type='text/javascript'></script>
    <script src="/public/js/static/owl.carousel.min.js" type='text/javascript'></script>
    <script src="/public/js/static/slidesyncandprogressbar.min.js" type='text/javascript'></script>
    <script src="/public/js/static/waypoints.min.js" type='text/javascript'></script>
    <script src="/public/js/static/waypoints-sticky.min.js" type='text/javascript'></script>
    <script src="/public/js/static/TweenMax.min.js" type='text/javascript'></script>
    <script src="/public/js/static/jquery.scrollmagic.min.js" type='text/javascript'></script>

    <!-- Slider Custom Scrollbar - ScrollPane -->
    <script>
        $(document).ready(function () {
            $('#subslider .owl-wrapper-outer').jScrollPane({
                verticalDragMinHeight: 150,
                verticalDragMaxHeight: 150,
                contentWidth: '0px' /* Disable horizontal bar */
            });
        });
    </script>

    <!-- Sticky Navigation -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('.my-sticky-element').waypoint('sticky');
        });
    </script>

    <!-- Product Image and Text - ScrollMagic - IE 8 + -->
    <script>
        $(document).ready(function ($) {
            var controller = new ScrollMagic();
            // Product Image1
            var scene = new ScrollScene({ offset: 1350 }).setTween(new TweenMax.from('#productimage1', 1, { clip: "rect(0px 200px 400px 200px)" })).addTo(controller)
            // Product Text1 .left to 0 position
            var scene = new ScrollScene({ offset: 1350 }).setTween(new TweenMax.to('#productbox1 .left', 1, { left: '0px' })).addTo(controller)
            // Product Text .right (978 - (250+(19.5*2) = 289) = to 689 position from left)
            var scene = new ScrollScene({ offset: 1350 }).setTween(new TweenMax.to('#productbox1 .right', 1, { left: '689px' })).addTo(controller)
            // Product Image2 margin top 50px
            var scene = new ScrollScene({ offset: 1750 }).setTween(new TweenMax.to('#productimage2', 1, { top: '50px' })).addTo(controller)
            // Product Text2    .left .right to 0 position
            var scene = new ScrollScene({ offset: 1750 }).setTween(new TweenMax.to('#productbox2 .left, #productbox2 .right', 1, { bottom: '0px' })).addTo(controller)
        });
    </script>

    <!-- Back to Top -->
    <script>
        $("#backtotop span").click(function () {
            $("html, body").animate({ scrollTop: 0 }, 1000);
        });
    </script>
</body>
</html>







