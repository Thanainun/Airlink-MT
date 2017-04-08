<? if ($complete) { ?>
<!-- header section-->
<h1 class="intro-title"><img src=<?=base_url().'templates/common/images/logo.png />'?></h1>
<!-- /header section -->
<div class="screenshots-section">
  <div class="container">
    <div class="row sixteen columns title-row">
      <h3 class="white-title-alt"> <i class="title-icon icon-angle-right"></i>Ok! Congratulation :) now we disconnect your session out of system see your detail below<i class="title-icon icon-angle-left"></i> </h3>
    </div>
    <div class="row"> </div>
    <div class="six columns news-col"><img src=<?=base_url().'templates/common/images/professer.png />'?></div>
    <div class="five columns news-col">
      <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
      <p>Username และ Password ของท่านคือ</p>
      <li>Username 	=
        <?=$user?>
      </li>
      <li>Password 	=
        <?=$pass?>
      </li>
      <p>Username และ Password นี้สามารถใช้งานได้ทันที่ครับ</p>
      <p><a href="http://172.0.0.1" class="button">Go! login</a></p>
    </div>
  </div>
</div>
<? }?>