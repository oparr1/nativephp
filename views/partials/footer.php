<div id="backtotop_subscribe">
        <div class="onepcssgrid-1200">
            <div class="onerow">
                
                <div class="subscribetonews">
                    <!-- partial/_subscribe -->
                    <?php include($_SERVER['DOCUMENT_ROOT']."/views/partials/_subscribe.php"); ?>
                </div>
                <div class="backtotop">
                    <span>Back to Top</span>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
    <footer>
        <div class="onepcssgrid-1200">
            <div class="onerow">
                <div class="col4">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/static">Static Site</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/auth/register">Authenticate</a></li>
                    </ul>
                </div>
                <div class="col4">
                    <ul>
                        <li><a href="/testa">Test A</a></li>
                        <li><a href="/mysqli-query">MySQLi Query</a></li>
                        <li><a href="/blog/search">Search</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                    </ul>
                </div>
                <div class="col4 last">
                    <ul>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
            </div> <!-- Row Closing -->
            <div class="onerow" id="border">
                <div class="col5">
                    <div id="social">
                        <a href="http://www.facebook.com"><img src="/public/img/facebook.png" alt="Facebook" /></a>
                        <a href="http://www.twitter.com"><img src="/public/img/twitter.png" alt="Twitter" /></a>
                        <a href="http://www.youtube.com"><img src="/public/img/youtube.png" alt="YouTube" /></a>
                    </div>
                </div>
                <div class="col7 last">
                    <div id="browser">
                        <img src="/public/img/firefox.png" alt="Firefox" /><span>3.5 +</span>
                        <img src="/public/img/chrome.png" alt="Chrome" /><span>35</span>
                        <img src="/public/img/ie.png" alt="Internet Explorer" /><span>7 +</span>
                        <img src="/public/img/opera.png" alt="Opera" /><span>12 +</span>
                        <img src="/public/img/safari.png" alt="Safari" /><span>5.12</span>
                    </div>
                </div>
            </div> <!-- Row Closing -->
            <div class="onerow">
                <div class="col12">
                    <div id="copyrightbanner">
                        <span>Copyright &copy; <?php echo (new \DateTime())->format('Y'); ?> - Oliver Parr</span>
                    </div>
                </div>
            </div> <!-- Row Closing -->
        </div> <!-- 1200 Closing -->
    </footer>

    <!-- JS -->
    <!-- disable main jquery on wordpress blog -->
    <?php if(!function_exists('is_main_site')) { ?>
    <script src="/public/js/jquery-1.11.1.min.js" type='text/javascript'></script>
    <?php } ?>
    <script src="/public/js/jquery.validate.min.js" type='text/javascript'></script>
    <script src="/public/js/jquery.cookie.js" type='text/javascript'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>

    <!-- Page specific JS -->
    <?php if(isset($scripts)) echo $scripts; ?>

    <!-- Subscribe validation -->
    <script>
    jQuery(document).ready(function($) {

    $("#subscribeForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "An email address is required",
                email: "A valid email address is required"
            }
        }
    });
});
</script>

        <!-- Google Analytics Opt-out and Opt-in -->
    <script>
        // Set to the same value as the web property used on the site
        var gaProperty = 'UA-54546266-1';

        // Disable tracking if the opt-out cookie exists.
        var disableStr = 'ga-disable-' + gaProperty;
        if (document.cookie.indexOf(disableStr + '=true') > -1) {
            window[disableStr] = true;
        }

        jQuery(document).ready(function($) {
            // Opt-out function
            $("#gadisable:radio", $('#cookies')).change(
            function gaOptout() {
                document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
                window[disableStr] = true;
            });

            // Opt-in function
            $("#gaenable:radio", $('#cookies')).change(
            function gaOptin() {
                document.cookie = disableStr + '=true; expires=Thu, 01 Jan 1970 00:00:01; path=/';
            });

            // Opt-out Checked
            if ($.cookie('ga-disable-UA-54546266-1')) {
                $("#gadisable:radio").prop('checked', true);
            }

            // Opt-in Checked
            else if ($.cookie('ga-disable-UA-54546266-1') == null) {
                $("#gaenable:radio").prop('checked', true);
            }
        });
    </script>

<!-- Cookie Hide Bar -->
    <script>
        jQuery(document).ready(function($) {
            // Hide Bar if cookie exists
            // CSS of cookie container set to display:none at first - better for Chrome (slow)
            // Jquery display cookie container unless ck_policy exists
            $("#cookie_container").css({ "display": "block" });
            if ($.cookie("ck_policy")) {
                $("#cookie_container").css({ "display": "none" });
            }

            // Hide Bar on button click
            $('#cookie_container .button ').click(function () {
                $.cookie("ck_policy", true, { expires: 1 });
                $('#cookie_container').hide();
            });
        });
    </script>

    <!-- Reorder Elements -->
    <script>
    jQuery(document).ready(function($) {
        onResize = function () {
            if ($("header").css("position") == "relative") {
                $('header #col4logo').insertBefore('header #col4query');
            } else {
                $('header #col4logo').insertAfter('header #col4query');
            }
        }
        $(document).ready(onResize);
        $(window).bind('resize', onResize);
    });
    </script>

    <!-- Mobile Navigation -->
    <script>
        jQuery(document).ready(function($) {
            var pull = $('#pull');
            var menu = $('nav > ul'); // don't miss the var
            var menuHeight = menu.height();  // don't miss the var

            $(pull).on('click', function (e) {
                e.preventDefault();
                menu.slideToggle(function () {
                    if ($(this).css('display') == 'none') {
                        $("#pull").css({ 'background-image': 'url(../public/img/showmobileicon.png)' });
                    } else {
                        $("#pull").css({ 'background-image': 'url(../public/img/hidemobileicon.png)' });
                    }
                });
            });

            $(window).resize(function () {
                var w = $(window).width();
                if (w > 320 && menu.is(':hidden')) {
                    menu.removeAttr('style');
                }
            });
        }); // close
    </script>

    <!-- Back to Top - works in WP's own jquery -->
    <script>
    jQuery(document).ready(function($) {
        $(".backtotop span").click(function () {
            $("html, body").animate({ scrollTop: 0 }, 1000);
        });
    });
    </script>
</body>
</html>