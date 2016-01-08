
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SHIELD - Free Bootstrap 3 Theme">
    <meta name="author" content="Carlos Alvarez - Alvarez.is - blacktie.co">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title> Loctweet - find tweets easily</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link href="assets/css/animate-custom.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico"/>


    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/modernizr.custom.js"></script>

    <!-- Map -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script src="assets/js/loctweet.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-offset="0" data-target="#navbar-main">


<div id="navbar-main">
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-shield" style="font-size:30px; color:#3498db;"></span>
                </button>
                <a class="navbar-brand hidden-xs hidden-sm" href="#home"><span class="icon icon-shield"
                                                                               style="font-size:18px; color:#3498db;"></span></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#home" class="smoothScroll">Home</a></li>
                    <li><a href="#about" class="smoothScroll"> About</a></li>
                    <li><a href="#map" class="smoothScroll"> Map</a></li>
                    <li><a href="#locations" class="smoothScroll"> Locations</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- ==== HEADERWRAP ==== -->
<div id="headerwrap" id="home" name="home">
    <header class="clearfix">
        <h1><span class="icon"><img src="assets/img/tweet.JPG"></span></h1>

        <p>Loctweet</p>

        <p>Recent tweets from your location</p>
    </header>
</div>
<!-- /headerwrap -->

<!-- ==== GREYWRAP ==== -->
<div id="greywrap">
    <div class="row">
        <div class="col-lg-4 callout">
            <span class="icon"><img src="assets/img/tweet.JPG" style="height: 100px;width: 100px;"></span>

            <h2>Twitter</h2>
        </div>
        <!-- col-lg-4 -->

        <div class="col-lg-4 callout">
            <span class="icon"><img src="assets/img/google.PNG" style="height: 100px;width: 100px;"></span>

            <h2>Google Maps</h2>
        </div>
        <!-- col-lg-4 -->

        <div class="col-lg-4 callout">
            <span class="icon"><img src="assets/img/cvut.PNG" style="height: 100px;width: 100px;"></span>

            <h2>CTU Prague</h2>
        </div>
        <!-- col-lg-4 -->
    </div>
    <!-- row -->
</div>
<!-- greywrap -->

<!-- ==== ABOUT ==== -->
<div class="container" id="about" name="about">
    <div class="row white">
        <br>

        <h1 class="centered">About project</h1>
        <hr>

        <div class="col-lg-6">
            <p>This website was created as a semestral project for a subject VIA at CTU Prague. It displays tweets based
                on location on the map and set time.</p>
        </div>
        <!-- col-lg-6 -->

        <div class="col-lg-6">
            <p>It uses Twitters API for getting particular tweets from Twitters database. Then they are shown in a map,
                which is created by Google maps API. For a part of project, which has to use some own API, it uses API
                sparks, where databse of the last locations is stored.</p>
        </div>
        <!-- col-lg-6 -->
    </div>
    <!-- row -->
</div>
<!-- container -->

<!-- ==== SECTION DIVIDER1 -->
<section class="section-divider textdivider divider1">
    <div class="container">
        <h1>Locate nearby tweets</h1>
        <hr>
        <p>All you have to do is just a one click.</p>
    </div>
    <!-- container -->
</section>
<!-- section -->


<!-- ==== MAP ==== -->
<div class="container" id="map" name="map">
    <br>
    <br>

    <div class="row">
        <h2 class="centered">Map</h2>
        <hr>
        <br>

        <div class="col-lg-12 ">
            <div id="googleMap" style="width:100%;height:700px;"></div>
        </div>
    </div>
    <!-- row -->

</div>
<!-- container -->


<!-- ==== SECTION DIVIDER2 -->
<section class="section-divider textdivider divider2" style="background: #222">
    <div class="container" id="lcations" name="locations">
        <h1>Previous locations</h1>
        <hr>
        <div class="MyTweets">
            <div class="tweets"></div>
        </div>
        <?php

        require_once("api/twitteroauth/twitteroauth.php"); //Path to twitteroauth library you downloaded in step 3

        $twitteruser = "w3resource"; //user name you want to reference
        $notweets = 2; //how many tweets you want to retrieve
        $consumerkey = "MeXUDma7eV0R3ePExgFH8SAXy";
        $consumersecret = "2hZG6X26CRd1zVOQwJHwreXRRmD5me3VwZ0Kl09uZSPwhchjD3";
        $accesstoken = "4737100353-3AuAYS9CsqNDh8aINkELwAUrl1hBJHyBcBqDWsA";
        $accesstokensecret = "1MtPAf9Ov0f59na3smDlof2JRt1czTAYZQfoHPCxjlPwQ";
        function getToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret)
        {
            $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
            return $connection;
        }
        echo "0";
        $connection = getToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
        echo "1";
        $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $twitteruser . "&count=" . $notweets);
        echo "2";
        ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="tweetie.js"></script>
        <script type="text/javascript">
            $('.MyTweets .tweets').twittie({
                username: 'schwarzenbergk',
                list: 'sql',
                dateFormat: '%b. %d, %Y',
                template: '<strong class="date">{{date}}</strong> - {{screen_name}} {{tweet}}',
                count: 10
            }, function () {
                setInterval(function() {
                    var item = $('.example2 .tweet ul').find('li:first');

                    item.animate( {marginLeft: '-220px', 'opacity': '0'}, 500, function() {
                        $(this).detach().appendTo('.example2 .tweet ul').removeAttr('style');
                    });
                }, 5000);
            });
        </script>
    </div>
    <!-- container -->
</section>
<!-- section -->

<div id="footerwrap">
    <div class="container">
        <h4>Created by rychljir, designed by <a href="http://blacktie.co">BlackTie.co</a></h4>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/retina.js"></script>
<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/jquery-func.js"></script>
</body>
</html>
