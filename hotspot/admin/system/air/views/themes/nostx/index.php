<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
<title>{site-name}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Airlink Admin Controller" />
    <meta name="author" content="Sarto nice" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   

{_styles}
{_scripts}
<script>
  $(function() {
    $( "#menu" ).menu();
  });
  </script>
  <style>
  .ui-menu { <br>
width: 160px;
position: fixed;
top: 125px;
right: 0;}
  </style>
</head>
<body>
{header}
        <div id="msgtest"></div>
     <div class="container" style="margin-top:30px;">

  <div class="row">
				 {left-content}
            </div>
            <div id="push"></div>
    </div>
</div>	

<footer>


       <div class="footer_container">
          
    <p style="margin-left:10px;">{footer}</p>
    </div>
         
        </footer>


</html>
