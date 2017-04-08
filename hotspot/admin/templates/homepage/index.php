<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie8 ieold"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html><!--<![endif]-->
<META HTTP-EQUIV="Refresh" CONTENT="<?=$redirecttime ?>;URL=<?=$redirect ?>">
<script type="text/javascript">
function countDown(secs) {
	var btn = document.getElementById('btn');
	btn.value = "<?=$this->lang->line('force_redirect_button') ?> "+secs+" <?=$this->lang->line('force_redirect_button2') ?>";
	if(secs < 1) {
		clearTimeout(timer);
		btn.disabled = false;
		btn.value = 'Let\'s Go!!!!';
	}
	secs--;
	var timer = setTimeout('countDown('+secs+')',1000);
}
</script>
<head>
    <meta charset="utf-8" />

    <!-- Title -->
    <title><?=$title ?></title>

    <!-- Site Meta -->
    <meta name="viewport" content="width=device-width, user-scalable = no" />

    <!-- Icons -->
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" href="img/touch-icon.png" />

    <!-- Win 8 Tiles -->
    <meta name="application-name" content="" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="img/touch-icon.png" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700" />
    <link rel="stylesheet" href="{template_path}css/font-awesome.css" />
    <link rel="stylesheet" href="{template_path}css/responsiveslides.css" />
    <link rel="stylesheet" href="{template_path}css/style.css" />
    <!--[if IE 7]>
        <link rel="stylesheet" href="{template_path}css/font-awesome-ie7.min.css">
    <![endif]-->

   

    <style>
    .deviceshot img{
        display: none;
        }
    .deviceshot img{
        display: none;
        }
    .deviceshot img.active{
        display: display: -moz-inline-stack;
        display: inline-block;
        vertical-align: top;
        zoom: 1;
        *display: inline;
        }
    </style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body class="">
    <section class="top-section section primary">
        <div class="wrap">
            <div class="row cf">
                <div class="col span5 deviceshot">
                    <img class="iphone active" src="{template_path}img/Idea.png" alt="" />
                  
                </div>

                <div class="col col-right span7">
                <p><img src="{template_path}img/fr-logo.png" alt="" /></p>
                    <h1 class="brand top"><?=$this->lang->line('force_redirect_oop') ?> <span>.</span></h1>

                    <h2 class="hero-copy"><?=$this->lang->line('force_redirect_logged') ?></h2>
                    <h2 class="sub-hero-copy"><?=$this->lang->line('force_redirect_wrong') ?></h2>

                    <div class="store-badges">
                        <div class="store-badges-inner pressed-box">
                            <a class="store-badge apple fadein" data-animation-delay="100" href="dashboard">
                                <i class="icon-user"></i>
                                <span><?=$this->lang->line('force_redirect_goto') ?> <strong><?=$this->lang->line('force_redirect_dashboard') ?></strong></span>
                            </a>
                           
                        </div>
                    </div>

                    <p class="social text-right">
                        <form name="form1" method="post" action="<?=$redirect ?>">
    <input disabled type="submit" id="btn" value="Please Wait...." class="btn">
    </form>
                    </p>
                    <p><?=$this->lang->line('force_redirect_help') ?>::   <?=$phone ?></p>
                    <p>Select language :  <?=anchor("forcedirect/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("forcedirect/languser/english","<span>English</span>");?></p>
                 </div>
            </div>

        </div>

        
    </section>
    <!-- /Top Section -->
    <footer class="section tertiary">
        <section class="wrap">
            <div class="col span6 cf social">
                <a href="#" class="facebook"><i class="icon-facebook-sign"></i></a>
                <a href="#" class="twitter"><i class="icon-twitter-sign"></i></a>
                <a href="#" class="instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="pinterest"><i class="icon-pinterest-sign"></i></a>
                <a href="#" class="googleplus"><i class="icon-google-plus-sign"></i></a>
            </div>

            <p class="col span6 copyright cf"><?=$footer ?></p>
        </section>
    </footer>
    <!-- /Footer -->

   <script type="text/javascript">countDown(<?=$redirecttime ?>);</script>


    <!-- JS (CDN jQuery with Local Fallback)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>!window.jQuery && document.write('<script src="{template_path}js/libs/jquery.min.js"><\/script>')</script>
    <script src="{template_path}js/libs/responsiveslides.js"></script>
    <script src="{template_path}js/libs/waypoints.js"></script>
    <script src="{template_path}js/switcher.js"></script>
    <script src="{template_path}js/scripts.js"></script>

</body></html>