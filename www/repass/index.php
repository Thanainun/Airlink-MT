<?php
session_start();
require_once 'includes/config.inc.php';
$ctrl = (empty($_REQUEST['ctrl'])) ? "" : $_REQUEST['ctrl'];
$actions = empty($_REQUEST['actions']) ? "" : trim($_REQUEST['actions']);

function displaydate($x) {
    $thai_m = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $date_array = explode("-", $x);
    $y = $date_array[0];
    $m = $date_array[1] - 1;
    $d = (int) $date_array[2];
    $m = $thai_m[$m];
    $y = $y + 543;
    $displaydate = "$d $m $y";
    return $displaydate;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= $title ?></title>

        <!-- media-queries.js -->
        <!--[if lt IE 9]>
                <script src="js/css3-mediaqueries.js"></script>
        <![endif]-->
        <!-- html5.js -->
        <!--[if lt IE 9]>
                <script src="js/html5.js"></script>
        <![endif]-->

        <link href="font/stylesheet.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="css/media-queries.css" rel="stylesheet" type="text/css" />

        <meta name="viewport" content="width=device-width" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link href='css/ideas.css' rel='stylesheet' type='text/css'>
        <script src="js/jquery-2.1.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-collapse.js"></script>
        <script src="js/bootstrap-scrollspy.js"></script>
 
        <style>
            .nav {
                margin-bottom :0px;
            }
            .nav-tabs > li > a {
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 4px 4px 0 0;
                line-height: 18px;
                padding-bottom: 8px;
                padding-top: 8px;
            }
            .content {
                background-color: #fff;
                border-radius: 10px;
                padding: 5px;
                padding-top: 30px;
            }
        </style>
        <script src="js/init.js"></script>
    </head>

    <body data-spy="scroll">

        <!-- TOP MENU NAVIGATION -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">

                   
					<a class="brand pull-left" href="http://172.0.0.1/"> <font color="#ffffff"><span class="glyphicon glyphicon-sort"></span>
					LogIn WiFi</font>
                    </a>
					<a class="brand pull-left" href="<?=$actual_link ?>/hotspot/index.php/dashboard"><font color="#ffffff"><span class="glyphicon glyphicon-user"></span>
					LogIn สมาชิก</font>
					</a>

                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="nav-collapse collapse">
                        <ul id="nav-list" class="nav pull-right">
                            <!--li class="active"><a href="<?=$actual_link ?>/hotspot/index.php/dashboard">จัดการผู้ใช้งาน</a></li>
                            <li><a href="http://172.0.0.1/">LogIn WiFi</a></li-->
                        </ul>
                    </div>

                </div>
            </div>
        </div>


        <!-- MAIN CONTENT -->
        <div class="container content container-fluid" id="home">
            <!-- HOME -->
            <div class="row-fluid">
                <!-- PHONES IMAGE FOR DESKTOP MEDIA QUERY -->
                <div class="span5 visible-desktop">
                    <img src="img/phones.png">
                </div>
                <!-- APP DETAILS -->
                <div class="span7">
                    <!-- APP NAME -->
                    <div class="visible-desktop" id="app-name">
                        <img src="img/blueair_logo_key.png" />
                    </div>
                    <!-- PHONES IMAGE FOR TABLET MEDIA QUERY -->
                    <div class="hidden-desktop" id="phones">
                        <img src="img/blueair.png">
                    </div>
                    <div class="clearfix"></div>

                    <?php
                    if (empty($ctrl)) {
                        require_once("mainpage.php");
                    }
                    switch ($ctrl) {
                        default:
                            require_once("mainpage.php");
                            break;
                        case "mainpage" : require_once "mainpage.php";
                            break;
                        case "logout" : require_once "logout.php";
                            break;
                    }
                    ?>              
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <div class="footer container container-fluid">
            <div id="copyright">
                Copyright &copy; 2015 LabCom WiFi Hotspot, Inc.<br>
                Licensed under <a rel="license" href="#">CC BY 3.0</a>. Built on <a href="#">iDeas</a>.
            </div>
        </div>
    </body>
</html>
