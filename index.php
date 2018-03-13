<?php
// memasukan file lain, dan file harus ada, kalau tidak ya eror
require_once 'include/config.php';
?>
<!DOCTYPE html>
<html>
<header>
    <title>Short Url</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="http://www.bigto.in/static/css/bootstrap.min.css" rel="stylesheet">
    <!-- Component CSS -->
    <link rel="stylesheet" type="text/css" href="http://www.bigto.in/themes/infinity/style.css">
    <link rel="stylesheet" type="text/css" href="http://www.bigto.in/themes/infinity/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="http://www.bigto.in/themes/infinity/css/snackbar.min.css">
    <link rel="stylesheet" type="text/css" href="http://www.bigto.in/static/css/components.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" />
    <!-- Required Javascript Files -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js?v=2.0.3"></script>

</header>
<body class='light' id="body">
<?php

// ketika tombolnya singkat di klik dan link tidak kosong
if(isset($_POST['submit']) && !empty($_POST['url'])){
    // Programnya di Escape stringnya , agar tidak terkna SQL injection.
    $url = mysqli_real_escape_string($conn, $_POST['url']);

    // password linknya
    if(isset($_POST['password'])){
        $password= mysqli_real_escape_string($conn,$_POST['password']);
    }else{
        $password= "";
    }

    // untuk mendapatkan teks unik & costum teks
    if(isset($_POST['custom'])){
        $id = mysqli_real_escape_string($conn,$_POST['custom']);
    }else{
        $id = md5($url); // mengenkripsi data
        $id = md5($url.date("Ymdhisa")); // mengenkripsi data
        $id = substr($id,0,_LONG); // mengambil kata pada index ke 0 sampai _LONG
    }

    //die("ID: ".$id."<hr>PASSWORD : ".$password);

    // Query untuk memasukan data ke DB
    $sql = "INSERT INTO links(link_id,link_ori,link_password) VALUES ('$id','$url','$password')";

    // Apakah sukses menyimpan data ke DB
    if ($conn->query($sql) === TRUE) {
        // ketika sukses , maka akan menampilkan popup
        echo '
            <div class="overlaylink" style="display: block;">
        <div class="link-shared" id="modal">
            <!-- close trigger -->
            <div class="closelink">
                <span><i class="zmdi zmdi-close"></i></span>
            </div>
            <!-- modal content -->
            <div class="modal-contentlink">
                <div class="panel-body">
                    <div class="copy-link-block">
                        <span class="short-url">'._URL.$id.'</span>
                        <button class="btn btn-primary" id="copyurlmodal" type="button" data-clipboard-text="'._URL.$id.'"><i class="zmdi zmdi-copy"></i></button>
                    </div>
                    <div class="qr">
                        <img src="./lib/?url='._URL.$id.'">
                        <a href="./lib/?url='._URL.$id.'" target="_blank" class="mdbtn btn btn-primary copy" data-value="'._URL.$id.'">Copy QR Code</a>
                    </div>
                    <hr>
                    <p>Anda bisa membagikan link tersebut keteman teman anda.</p>
                    <div class="share-message"><p>Share this on</p>
                        <div class="share">
                            <a href="http://www.facebook.com/sharer.php?u='._URL.$id.'" target="_blank" class="btn btn-facebook u_share" title="Facebook"><i class="zmdi zmdi-facebook"></i></a>
                            <a href="https://twitter.com/share?url='._URL.$id.'" target="_blank" class="btn btn-twitter u_share" title="Twitter"><i class="zmdi zmdi-twitter"></i></a>
                            <a href="https://plus.google.com/share?url='._URL.$id.'" target="_blank" class="btn btn-danger u_share" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url='._URL.$id.'" target="_blank" class="btn btn-linkedin u_share" title="LinkedIn"><i class="zmdi zmdi-linkedin"></i></a>
                            <a href="https://pinterest.com/pin/create/button/?url='._URL.$id.'" target="_blank" class="btn btn-pinterest u_share" title="Pinterest"><i class="zmdi zmdi-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        ';
    } else {
        // ketika gagal memasukan data ke database
        die("Gagal memasukan data ke database.");
    }
}
?>

<header class="activeheadmenu other-header">
    <div class="navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" onclick="In_headerFunction()">
                    <i class="zmdi zmdi-menu"></i>
                </button>
                <a class="navbar-brand" href="">
                    <img src="http://www.bigto.in/content/auto_site_logo.png" alt="Infinity - Premium URL Shortener Theme">
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#why" class="active">Kenapa Kami</a></li>
                    <li><a href="./admin.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<style>.other-header{display:none}</style>
<header>
    <div class="navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" onclick="In_headerFunction()">
                    <i class="zmdi zmdi-menu"></i>
                </button>
                <a class="navbar-brand" href="">
                    <img src="http://www.bigto.in/content/auto_site_logo.png" alt="Infinity - Premium URL Shortener Theme">
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#why" class="active">Kenapa Kami</a></li>
                    <li><a href="./admin.php">Admin</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<section class="under-head-cont main-index-top" style="background-image:url(http://www.bigto.in/themes/infinity/img/back.jpg);">

    <svg preserveAspectRatio="xMidYMax meet" viewBox="0 0 1600 100" style="background: transparent;position: absolute;bottom: 0;" data-height="100">
        <path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M1040,56c0.5,0,1,0,1.6,0c-16.6-8.9-36.4-15.7-66.4-15.7c-56,0-76.8,23.7-106.9,41C881.1,89.3,895.6,96,920,96C979.5,96,980,56,1040,56z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M1699.8,96l0,10H1946l-0.3-6.9c0,0,0,0-88,0s-88.6-58.8-176.5-58.8c-51.4,0-73,20.1-99.6,36.8c14.5,9.6,29.6,18.9,58.4,18.9C1699.8,96,1699.8,96,1699.8,96z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M1400,96c19.5,0,32.7-4.3,43.7-10c-35.2-17.3-54.1-45.7-115.5-45.7c-32.3,0-52.8,7.9-70.2,17.8c6.4-1.3,13.6-2.1,22-2.1C1340.1,56,1340.3,96,1400,96z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M320,56c6.6,0,12.4,0.5,17.7,1.3c-17-9.6-37.3-17-68.5-17c-60.4,0-79.5,27.8-114,45.2c11.2,6,24.6,10.5,44.8,10.5C260,96,259.9,56,320,56z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M680,96c23.7,0,38.1-6.3,50.5-13.9C699.6,64.8,679,40.3,622.2,40.3c-30,0-49.8,6.8-66.3,15.8c1.3,0,2.7-0.1,4.1-0.1C619.7,56,620.2,96,680,96z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M-40,95.6c28.3,0,43.3-8.7,57.4-18C-9.6,60.8-31,40.2-83.2,40.2c-14.3,0-26.3,1.6-36.8,4.2V106h60V96L-40,95.6z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M504,73.4c-2.6-0.8-5.7-1.4-9.6-1.4c-19.4,0-19.6,13-39,13c-19.4,0-19.5-13-39-13c-14,0-18,6.7-26.3,10.4C402.4,89.9,416.7,96,440,96C472.5,96,487.5,84.2,504,73.4z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M1205.4,85c-0.2,0-0.4,0-0.6,0c-19.5,0-19.5-13-39-13s-19.4,12.9-39,12.9c0,0-5.9,0-12.3,0.1c11.4,6.3,24.9,11,45.5,11C1180.6,96,1194.1,91.2,1205.4,85z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M1447.4,83.9c-2.4,0.7-5.2,1.1-8.6,1.1c-19.3,0-19.6-13-39-13s-19.6,13-39,13c-3,0-5.5-0.3-7.7-0.8c11.6,6.6,25.4,11.8,46.9,11.8C1421.8,96,1435.7,90.7,1447.4,83.9z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M985.8,72c-17.6,0.8-18.3,13-37,13c-19.4,0-19.5-13-39-13c-18.2,0-19.6,11.4-35.5,12.8c11.4,6.3,25,11.2,45.7,11.2C953.7,96,968.5,83.2,985.8,72z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M743.8,73.5c-10.3,3.4-13.6,11.5-29,11.5c-19.4,0-19.5-13-39-13s-19.5,13-39,13c-0.9,0-1.7,0-2.5-0.1c11.4,6.3,25,11.1,45.7,11.1C712.4,96,727.3,84.2,743.8,73.5z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M265.5,72.3c-1.5-0.2-3.2-0.3-5.1-0.3c-19.4,0-19.6,13-39,13c-19.4,0-19.6-13-39-13c-15.9,0-18.9,8.7-30.1,11.9C164.1,90.6,178,96,200,96C233.7,96,248.4,83.4,265.5,72.3z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M1692.3,96V85c0,0,0,0-19.5,0s-19.6-13-39-13s-19.6,13-39,13c-0.1,0-0.2,0-0.4,0c11.4,6.2,24.9,11,45.6,11C1669.9,96,1684.8,96,1692.3,96z"></path><path style="opacity: 1;fill: rgba(255, 255, 255, 0.6);" d="M25.5,72C6,72,6.1,84.9-13.5,84.9L-20,85v8.9C0.7,90.1,12.6,80.6,25.9,72C25.8,72,25.7,72,25.5,72z"></path><path style="fill: #ffffff;" d="M-40,95.6C20.3,95.6,20.1,56,80,56s60,40,120,40s59.9-40,120-40s60.3,40,120,40s60.3-40,120-40s60.2,40,120,40s60.1-40,120-40s60.5,40,120,40s60-40,120-40s60.4,40,120,40s59.9-40,120-40s60.3,40,120,40s60.2-40,120-40s60.2,40,120,40s59.8,0,59.8,0l0.2,143H-60V96L-40,95.6z"></path>
    </svg>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="promo">
                    <h1>
                        <?php echo _TITLE." - "._SLUG; ?>
                    </h1>
                    <span><?php echo _DESCRIPTION; ?></span>
                </div>
                <div class="overlaylink">
                    <div class="link-shared" id="modal">
                        <!-- close trigger -->
                        <div class="closelink">
                            <span><i class="zmdi zmdi-close"></i></span>
                        </div>
                        <!-- modal content -->
                        <div class="modal-contentlink">
                        </div>
                    </div>
                </div>
                <div class="share-this"></div>
                <div class="ajax"></div>
                <div class="p-relative">
                    <form action="" id="main-form" role="form" method="post">
                        <div class="main-form">
                            <div class="row" id="single">
                                <div class="col-md-9 shortfieldz">
                                    <i class="zmdi zmdi-link"></i>
                                    <input type="text" class="form-control main-input" onclick="In_ShowPosInfo()" name="url" value="" placeholder="Paste url yang panjang disini." />
                                    <a href="#" class="advanced short-adv-sett" data-toggle="tooltip" title="Advanced Options"><i class="zmdi zmdi-settings"></i></a>

                                </div>
                                <div class="col-md-3 shortbtnz">
                                    <input name="submit" class="btn btn-default btn-block main-button" id="shortenurl" type="submit" value="Singkat"></input>
                                </div>
                            </div>
                        </div>
                        <!-- /.main-form -->

                        <div class="main-advanced slideup">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Custom Alias (Optional)</h3>
                                    <p>Anda bisa membuat costum url sesuka anda, pastikan anda bisa membuat hasil yang bagus.</p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-edit"></i></span>
                                        <input type="text" class="form-control" name="custom" placeholder="Ketik costum alias anda disini." >
                                    </div>
                                </div>
                                <!-- /.col-md-4 -->
                                <div class="col-md-6">
                                    <h3>Password (Optional)</h3>
                                    <p>Dengan menambahkan password maka yang ingin melewati link harus mengetahui password ini.</p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-dialpad"></i></span>
                                        <input type="text" class="form-control" name="password" id="pass" placeholder="Masukan password disini.">
                                    </div>
                                </div>
                            </div><!--/.row -->
                        </div><!-- /.main-advanced -->
                    </form><!--/.form-->
                </div>        <div class="call-to-action">
                    <a href="#" class="mdbtn btn btn-primary btn-lg">Get Started</a>
                    <a href="#more" class="learn-more-index">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="light">
    <div class="container">
        <div class="row featurette">
            <h2 class="center">Kenapa Kami</h2>

            <div class="col-sm-4">
                <div class="feature-img" style="background-image:url(http://www.bigto.in/themes/infinity/img/lock.png)"></div>
                <h3>Password Protect</h3>
                <p>Set a password to protect your links from unauthorized access.</p>
            </div>
            <div class="col-sm-4">
                <div class="feature-img" style="background-image:url(http://www.bigto.in/themes/infinity/img/globe.png)"></div>
                <h3>Geotarget</h3>
                <p>Geotarget your links to redirect visitors to specialized pages and increase your conversion.</p>
            </div>
            <div class="col-sm-4">
                <div class="feature-img" style="background-image:url(http://www.bigto.in/themes/infinity/img/case.png)"></div>
                <h3>Bundle</h3>
                <p>Bundle your links for easy access and share them with the public on your public profile.</p>
            </div>
        </div>
    </div>
</section>

<footer class="main nousrfoot">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                2018 &copy; Infinity - Premium URL Shortener Theme.
            </div>
            <div class="col-md-7 text-right">

                <a href='http://www.bigto.in/page/terms' title='Terms and Conditions'>Terms and Conditions</a>

                <a href='http://www.bigto.in/page/developer' title='Developer'>Developer</a>
                <a href='http://www.bigto.in/contact' title='Contact'>Contact</a>
                <div class="languages">
                    <a href="#lang" class="active" id="show-language"><i class="zmdi zmdi-globe"></i> Language</a>
                    <div class="langs">
                        <a href='?lang=en'>English</a><a href='?lang=th'>Thai</a><a href='?lang=po'>Português</a><a href='?lang=de'>Deutsch</a><a href='?lang=es'>Español</a><a href='?lang=ru'>Pусский</a><a href='?lang=fr'>Francais</a>                </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="http://www.bigto.in/themes/infinity/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.bigto.in/themes/infinity/js/application.js"></script>
<script type="text/javascript" src="http://www.bigto.in/themes/infinity/js/snackbar.min.js"></script>
<script type="text/javascript">
    $(window).on("scroll", function() {
        if($(window).scrollTop() > 50) {
            $("header").addClass("activehead");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $("header").removeClass("activehead");
        }
    });

    function In_headerFunction() {
        var element = $("header");
        element.toggleClass("activeheadmenu2");
    }

    function In_ShowPosInfo() {
        $(".short-adv-sett").fadeIn(100);
        $(".main-index-top #main-form .main-options").slideDown(100);
    }

    //Custom Link Modal
    var $modallink = $('.link-shared'),
        $overlaylink = $('.overlaylink'),
        $showModallink = $('.show-modal'),
        $closelink = $('.closelink');

    function In_ShowLinkModal(){
        e.preventDefault();

        var windowHeight = $(window).height(),
            windowWidth = $(window).width(),
            modalWidth = windowWidth/2; //50% of window

        $overlaylink.show();
        $modallink.css({
            'width' : modalWidth,
            'margin-left' : -modalWidth/2
        });
    }

    $closelink.on('click', function(){
        $overlaylink.hide();
    });

    //Sidebar Menu
    $(document).on('click','.quicklinks-toggle__btn',function(){

        $('#focus-overlay').fadeIn(100);
        $('section .sidebar').css('zIndex',999999);
        $('section .sidebar').fadeIn(100);
    });

    $('#focus-overlay').on('click',function (){
        $(this).fadeOut(200);
        $('section .sidebar').css('display','none');

    });

    $(document).ready(function(){
        $("#widget_news h3").append(" <i class='zmdi zmdi-info' style='color: #00BCD4;'></i>");
        $("#widget_activities h3").append(" <i class='zmdi zmdi-swap-vertical-circle' style='color: #ff9800;'></i>");
        $("#widget_top_urls h3").append(" <i class='zmdi zmdi-trending-up' style='color: #4caf50;'></i>");
        $("#splash h3, #splash_create h3").append(" <i class='zmdi zmdi-info' style='color: #673ab7;'></i>");
        $("#overlay h3").append(" <i class='zmdi zmdi-info' style='color: #4CAF50;'></i>");
        $("#widget_tools h3").append(" <i class='zmdi zmdi-wrench' style='color: #9c27b0;'></i>");
        $("#widget_export h3").append(" <i class='zmdi zmdi-hourglass-alt' style='color: #4CAF50;'></i>");
    });

    //Smooth Scroll
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(t){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var e=$(this.hash);(e=e.length?e:$("[name="+this.hash.slice(1)+"]")).length&&(t.preventDefault(),$("html, body").animate({scrollTop:e.offset().top},1e3,function(){var t=$(e);if(t.focus(),t.is(":focus"))return!1;t.attr("tabindex","-1"),t.focus()}))}})
</script>
</body>
</html>
<?php
// close connection from mysql database
mysqli_close($conn);