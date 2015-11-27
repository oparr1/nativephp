<?php 
    $metaTitle = "Home";
    $metaDescription = "This is the Home page";
    include('partials/header.php');
?>

<div id="mainslider" class="owl-carousel">
    <div class="item">
        <img src="/public/img/slide1.jpg" class="slide1" alt="slide 1">
        <img src="/public/img/slide1_978px.jpg" class="slide1_978px" alt="slide 1">
    </div>
    <div class="item">
        <img src="/public/img/slide2.jpg" class="slide2" alt="slide 2">
        <img src="/public/img/slide2_978px.jpg" class="slide2_978px" alt="slide 2">
    </div>
    <div class="item">
        <img src="/public/img/slide3.jpg" class="slide3" alt="slide 3">
        <img src="/public/img/slide3_978px.jpg" class="slide3_978px" alt="slide 3">
    </div>
</div>
<div id="serviceswrapper">
    <div id="services">
        <div class="one box"><a href="service-one"><img src="/public/img/service1.jpg" alt="service one"></a></div>
        <div class="two box"><a href="service-two"><img src="/public/img/service2.jpg" alt="service two"></a></div>
        <div class="three box"><a href="service-three"><img src="/public/img/service3.jpg" alt="service three"></a></div>
        <div class="four box"><a href="service-four"><img src="/public/img/service4.jpg" alt="service four"></a></div>
    </div>
</div>
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col12">
            <div id="content_one">
                <!-- Main Heading/Body Text -->
                <h1>Main Heading</h1>
                <p>Ut blandit dignissim purus, at aliquam enim. Vivamus suscipit pulvinar egestas. Nam diam nisl, lacinia nec tempor vel, auctor vel tortor. Sed ullamcorper ultrices arcu non dapibus. Phasellus congue elit nulla, ut luctus sem pretium at. Sed bibendum molestie tortor non viverra. Duis vel lacinia lorem, nec fringilla sem. Sed nec metus ac augue suscipit consequat a a orci.</p>
                <div id="moreinfobutton">
                    <a href="home">See More</a>
                </div>
            </div>
        </div>
    </div> <!-- Row Closing -->
    <div id="content_two" class="onerow">
        <div id="product_left">
            <div class="centered"><img src="/public/img/product1.jpg" alt="product1"></div>
        </div>
        <div id="product_right">
            <h2>Product One</h2>
            <p>Ut blandit dignissim purus, at aliquam enim. Vivamus suscipit pulvinar egestas. Nam diam nisl, lacinia nec tempor vel, auctor vel tortor. Sed ullamcorper ultrices arcu non dapibus. Phasellus congue elit nulla, ut luctus sem pretium at. Sed bibendum molestie tortor non viverra.</p>
        </div>
    </div> <!-- Row Closing -->
    <div class="onerow">
        <div class="col8">
            <img src="/public/img/product2.jpg" alt="product2">
            <div id="product2text">
                <p>Product 2 blandit dignissim purus, at aliquam enim. Nam diam nisl, lacinia nec tempor vel, auctor vel tortor.</p>
            </div>
        </div>
        <div id="product3">
            <div class="col4 last">
                <img src="/public/img/product3.jpg" alt="product3">
                <div id="product3text">
                    <p>Product 3 blandit dignissim purus, at aliquam enim. Nam diam nisl, lacinia nec tempor vel, auctor vel tortor.</p>
                </div>
            </div>
        </div>
    </div> <!-- Row Closing -->
    <div class="onerow">
        <div id="product4">
            <div class="col8">
                <img src="/public/img/product4.jpg" alt="product4">
            </div>
        </div>
        <div class="col4 last">
            <div id="product4text">
                <p>Product 4 blandit dignissim purus, at aliquam enim. Nam diam nisl, lacinia nec tempor vel, auctor vel tortor.</p>
            </div>
        </div>
    </div> <!-- Row Closing -->
    <div class="onerow">
        <div class="col4">
            <div class="bundle_one"><a href="bundle-one"><img src="/public/img/bundleone.jpg" alt="bundle one"></a></div>
        </div>
        <div class="col4">
            <div class="bundle_two"><a href="bundle-two"><img src="/public/img/bundletwo.jpg" alt="bundle two"></a></div>
        </div>
        <div class="col4 last">
            <div class="bundle_three"><a href="bundle-three"><img src="/public/img/bundlethree.jpg" alt="bundle three"></a></div>
        </div>
    </div> <!-- Row Closing -->
</div> <!-- 1200 closing -->

<!-- Page specific script -->
<?php 
$scripts = "<script src='/public/js/responsive/owl.carousel.min.js' type='text/javascript'></script>
            <script src='/public/js/responsive/slideandprogressbar.min.js' type='text/javascript'></script>
            <script src='/public/js/responsive/equalheight.min.js' type='text/javascript'></script>"; ?>

<?php include('partials/footer.php'); ?>


