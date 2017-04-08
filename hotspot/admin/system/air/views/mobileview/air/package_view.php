<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
$user=$profile->row();
$ms="";
?>
   
   <script>
function goBack()
  {
  window.history.back()
  }
</script>

        
        	<section id="content-wrapper">
                	
                <section id="header">
                
                  
                    <div id="header-title">
                        <h1> mobile user dashboard</h1>
                    </div>
                  
                </section> <!-- #header -->
                <article>
                <p class="center"><?=$logo ?></p>
<div class="wrapper">

 <table class="contact">
<thead>
    <tr >
		<th class="center">ลำดับ</th>
		<th class="center">ชื่อเพ็คเก็ต</th>
		<th class="center">จำนวน</th>
		<th class="center">จำนวนวัน</th>
		<th class="center">ความเร็ว</th>
		<th class="center">ราคา</th>
		<th class="center">เลือกชื้อ</th>	
	</tr>
</thead>

<tbody>
	<?php $i=1;
		foreach ($plan->result() as $r):
			if($r->profile=='time'||$r->profile=='timeout'||$r->profile=='daily'||$r->profile=='monthly'||$r->profile=='packets'||$r->profile=='packets_day'||$r->profile=='packets_month')
			{ $r->valid_for=$r->valid_for/1000;
			}else{ $r->valid_for=$r->amount;}		
			$amount = " ".$this->lang->line('group_dis_amount_'.$r->profile);?>
		<tr>
		<td><?=$i++;?></td>
		<td><span class="name"><?=$r->name;?></span></td>
		<td><?=$r->amount.' '.$amount;?></td>
		<td><?=$r->valid_for;?> วัน</td>
		<td><?=$r->bw_download/1048576,"&nbsp;Mb/s" ."&nbsp;:&nbsp;".$r->bw_upload/1024,"&nbsp;Kb/s" ;?></td>
		<td><span class="name"><?=number_format($r->price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?></span></td>
		<td><? if($r->price <= $user->money){?><?=anchor('mobileview/topupplan/'.$r->groupname,'ชื้อเพ็คเก็ตนี้',' onclick="return confirm(\''.$ms.'กรุณายืนยันการชื้อเพ็คเก็ต '.$r->name.'อีกครั้ง !!!\')" class="btn-buy"  info="รายการประจำปี" '); } else{?>
		<button  class="button style2" onClick="lowprice(<?=$r->price-$user->money?>);" type="submit">ขาด <?=$r->price-$user->money?> บาท</button><? }?></td>	
	</tr>
	<? endforeach;?>
	
</tbody>

</table>
</div>
  </div>
                    </div>
                    <input type="button" value="Go Back" onclick="goBack()" class="btn-common btn-back">
                    </div>
                           
        </article> <!-- #post -->    