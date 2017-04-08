<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
$user=$profile->row();
$datauser = $datauser->row(); 
$ms="";
$status = 'ใช้งานได้'; $color = "#00BF00";
if($exp=="exp") { $status = 'หมดอายุ'; $color = "#FF6666"; }  else if($exp == "lock") { $status = 'รอตรวจสอบ..'; $color = "#FFC000"; }
else if($exp == "ok") { $ms="เพื่อผลประโยชน์ของท่าน\\nเนื่องจากเพ็คเก็ตเดิมของท่านยังไม่หมดอายุการใช้งาน\\nเพ็คเก็ตของท่านจะถูกแทนที่ด้วยเพ็คเก็ตใหม่ทันที่หลังจากท่านกดยืนยััน\\n";
$status = 'ใช้งานได้'; $color = "#00BF00";
 }
$profile = $this->session->_unserialize($user->profile);
$n = "&nbsp;";
$noprofile = "ยังไม่มีการใช้งาน";

$this->load->helper('number');


$profile_type = "";
$exp_time = "<em style='color:green;'>ตามวันหมดอายุบัตร</em>";

switch ($datauser->profile) {

	case "timetofinish" : 	
		$profile_type = $this->lang->line('group_dis_timetofinish');
		$unit = $datauser->amount." ".$this->lang->line('date_day');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.$datauser->amount.' day'), TRUE, 'th');
	break;
	
	case "packets" : 		
		$profile_type = $this->lang->line('group_dis_packets');
		$unit = $datauser->amount." MB";
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "packets_day" : 		
		$profile_type = $this->lang->line('group_dis_packets_day');
		$unit = $datauser->amount." MB";
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "packets_month" : 		
		$profile_type = $this->lang->line('group_dis_packets_month');
		$unit = $datauser->amount." MB";
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;

	case "time" :
		$profile_type = $this->lang->line('group_dis_time');
		$unit = $datauser->amount." ".$this->lang->line('date_hour');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "timeout" :
		$profile_type = $this->lang->line('group_dis_timeout');
		$unit = $datauser->amount." ".$this->lang->line('date_hour');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "daily" :
		$profile_type = $this->lang->line('group_dis_daily');
		$unit = $datauser->amount." ".$this->lang->line('date_hour');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;
	
	case "monthly" :
		$profile_type = $this->lang->line('group_dis_monthly');
		$unit = $datauser->amount." ".$this->lang->line('date_hour');
		$exp_time = ($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.($datauser->valid_for/1000).' day'), TRUE, 'th');
	break;

	default : $profile_type = "-";
	
}
?>
<script>
function lowprice(price)
{
alert("ยอดเงินในระบบ ของท่านมี <?=number_format($user->money,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?>ไม่พอ  กรุณาเติมเงินเข้าระบบให้มากกว่าหรือเท่ากับ "+price+" บาท \n1.");
}
</script>
<? // แก้ไข ตรง 20061 เป็นของท่าน ?>
<script type="text/javascript" src='http://www.tmtopup.com/topup/3rdTopup.php?uid=<?=$true_setting ?>'></script>

<?=$datauser->billingplan?>
<?=$profile_type?> <?=$unit?>
<?=$datauser->price?>
<?=($datauser->start_time==null) ? '-' : $datauser->start_time?>
<?=$datauser->valid_until?> <?=$exp_time?>




			<div class="clear">&nbsp;</div>

                <div class="columns">
                    <div class="column grid_5 first">
					
						<div class="panel">
							<head><h4>ระบบเติมเงิน และ เติมเวลา</h4>
							<div align="right">
                           <? if($this->session->userdata('user')){
								  
								  echo $this->session->userdata('user');
			
		}else{
					echo '6666';
		}
		
							  ?>
							  </head>
						  </div>
          <hr />
							<a href="dashboard/logoutuser"><img src="/images/logout.png" alt="" width="30" height="30" border="0" /></a>
						
						
							<? if ($complate) { ?>
					<div class="clear">&nbsp;</div>
                    <div class="columns leading"> 
                        <div class="grid_5 first">
						
							<div  class="message info" align="center">
                                <h3>ท่านเติมเวลาสำเร็จแล้ว</h3>
								<p>ท่านเติมเวลาด้วยเพ็คเก็ต <?=$plan?> </p>
                                <p>ท่านสามารถนำ Username และ Password ไปใช้ได้ทันที </p>
								<p>Username และ Password ของท่านคือ</p>
                                
                                    <li>Username 	= 	<?=$user?></li>
                                    <li>Password 	= 	<?=$pass?></li>
									<p>Username และ Password นี้สามารถใช้งานได้ทันที่ครับ</p>    
                                   <p>ใช้แทนรหัสด้านล่างนี้ เวลาการใช้งานขึ้นอยู่กับบัตรที่เอามาเติม</p>
									
                                    <li>Username 	= 	<?=$user_card?></li>
                                    <li>Password 	= 	<?=$pass_card?></li>
                                <p>หากมีปัญหาการเติมเวลาติดต่อ .</p>
							</div>
                        </div>
                    </div>

	<? } else {?>
					<div class="clear">&nbsp;</div>

                    <div class="columns">
                        <div class="column grid_5 first">
						<?=form_open($this->uri->segment(1).'/','id="form" class="login-box-top"')?>
						
												
						<header><div class="login-hd">ระบบเติมเงินด้วยบัตร  WIFI</div></header>
						<hr />
							<center><p>ท่านสามารถ เติมเวลาให้ รหัสเก่าของท่าน ด้วยบัตร  WIFI ท่านสมมารถหาซื้อได้ที่ ร้านค้าใกล้บ้าน </p></center>
						
						    <hr />
							
						<table width="25%" class="full">
							<tr>
							  <td width="2%" ></td>
								<td width="37%" ></td>
								<td width="61%" align="left"><div style="color:red;" rel="reply" class="total_members"><img src="https://172.0.0.1/admin/upload/card/user.jpg" width="109" height="38" />
							    <?=$error?></div></td>
						    </tr>
							<tr>
							  <td  rowspan="2">&nbsp;</td>
								<td ><label>ชื่อผู้ใช้ (ของคุณ)</label></td>
								<td><?=form_input(array('name'=>'user','type'=>'text','minlength'=>'4'),'',' title="ชื่อผู้ใช้เดิมที่จะเติม" required="required" id="user"')?></td>
						    </tr>

							<tr>
							  <td ><label>รหัสผ่าน(ของคุณ)</label></td>
								<td><?=form_input(array('name'=>'pass','type'=>'text','minlength'=>'4'),'',' title="รหัสเดิมที่จะเติม" required="required" id="pass"')?></td>
							    </tr>
							</table>
						  <hr />
						<table width="25%" class="full">
                              <tr>
                                <td width="2%" ></td>
                                <td width="37%" ></td>
                                <td width="61%" align="left"><div style="color:red;" rel="reply" class="total_members"><span class="total_members" style="color:red;"><img src="https://10.0.0.1/admin/upload/card/cardred.png" alt="" width="109" height="38" /></span><span class="total_members" style="color:red;">
                                  <?=$error2?>
                                </span></div></td>
                          </tr>
                              <tr>
                                <td  rowspan="2">&nbsp;</td>
                                <td ><label>ชื่อผู้ใช้ (บัตร)</label></td>
                                <td><?=form_input(array('name'=>'user_card','type'=>'text','minlength'=>'4'),'',' title="รหัสบัตร User  WIFI ที่จะใช้เติม" required="required" id="user_card"')?></td>
                              </tr>
                              <tr>
                                <td ><label>รหัสผ่าน(บัตร)</label></td>
                                <td><?=form_input(array('name'=>'pass_card','type'=>'text','minlength'=>'4'),'',' title="รหัสบัตร Password  WIFI ที่จะใช้เติม" required="required" id="pass_card"')?></td>
                              </tr>
                            </table>
					      <hr />
						<div class="clear"></div>	
						<div align="center">
						<?php echo form_submit('topup', 'เติมเวลาจากบัตร','class="button button-blue"'); ?></div>
<div class="clear"><p><center>หลังจากทำการเติมเวลาจะถูกแทนที่ด้วยเวลาตามบัตรที่ท่านเติม</center> </p></div>	
						<div class="clear">&nbsp;</div>		
						<?php echo form_close(); ?>

						</div>
					</div>
					<? }?>
                            	<hr />
                                <h1><? ?></h1>
                                <div>                           
                         
                           
                                test =<?=$profile['firstname'].$n.$profile['lastname'] ?> | <?=$profile['email']?> | <?=$profile['phone']?> | <?=$profile['personal_id']?> | <?=$profile['address1'].$profile['address2']. $n . $profile['district'].$profile['amphur'].$n.$profile['province'] ?> | <?=$user_h->start_time?> | <?=$user_h->valid_until?> | 
								<?= (byte_format($datauser->packet_used ) ? byte_format($datauser->packet_used)  : $noprofile);?> | <?= (isset($datauser->acctstarttime ) ? $datauser->acctstarttime  : $noprofile)?> <strong>online</strong><?=time_data($user_h->time_used,'dhm') ?>
<table class="paginate  full">
<thead>
    <tr style="cursor:pointer;">
		<th>ลำดับ</th>
		<th>เริ่มใช้งาน</th>
		<th>สิ้นสุด</th>
		<th>เลขที่เครื่องใช้งาน</th>
		<th>ปิดการใช้งานโดย</th>
		<th>ไอพีของเครื่อง</th>
        <th>ข้อมูล</th>
		
	</tr>
</thead>

<tbody style="cursor:default;">
	<?php $i=1;
		foreach ($user_r->result() as $m):	?>
			<tr>
		<td><?=$i++;?></td>
		<td><?=$m->acctstarttime;?></td>
		<td><?=$m->acctstoptime;?></td>
		<td><?=$m->callingstationid;?></td>
		<td><? if ($m->acctterminatecause=='') { echo 'Server Error';  }
		else if($m->acctterminatecause=='User-Request') {
			echo str_replace("User-Request","ผู้ใช้งาน",$m->acctterminatecause);   
			}
			else if($m->acctterminatecause=='Idle-timeout') {
			echo str_replace("Idle-timeout","หมดเวลาเชื่อมต่อ",$m->acctterminatecause);   
			}
			else if($m->acctterminatecause=='Force Disconnect') {
			echo str_replace("Force Disconnect","ผู้ดูแลระบบ",$m->acctterminatecause);   
			}
		 ?></td>
		<td><?=$m->framedipaddress ?></td>
		<td><?=byte_format($m->acctinputoctets+$m->acctoutputoctets)?></td>	
	</tr>
	 <? endforeach; ?>
</tbody>

</table>

                                
                                </div>
                             
                           
                                <head>
                                <h4>เติมเงินเข้าระบบด้วย ( บัตรทรูมันนี่ มีจำหน่ายตาม ร้านค้าทั่วไป, 7- eleven <img src="/images/711.jpg" alt="" width="29" height="29" />ทุกสาขา )</h4>
              </head>
                            <?=form_open('dashboard/topuptrue')?>
							<table width="41%" class="paginate  full">
				  <tr>
									<td>ชื่อผู้ใช้</td>
									<td><?=$this->session->userdata('user')?></td>
									<td width="22%" align="right">สถานะ</td>
				    <td width="19%" align="right"><?='<div id="status" style="background:'.$color.';color:#545454;">'.$status.'</div>'; ?></td>
							  </tr>
								<tr>
								  <td>ยอดเงินคงเหลือ</td>
								  <td><?=number_format($user->money,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?> <a href="topups"><img src="/images/refresh.png" alt="" width="18" height="18" border="0" /></a></td>
								  <td align="right">เพ็คเก็ตปัจจุบัน</td>
							      <td align="right"><?=$user->billingplan;?> </td>
                                  
							  </tr>
								<tr>
									<td width="36%">
									<?=form_label('รหัสบัตรเงินสดทรูมันนี่ 14 หลัก','user_pass')?>
									<input name="ref1" value="<?=$this->session->userdata('user')?>" type="hidden" id="ref1" />
									<input name="ref2" type="hidden" id="ref2" value="<?=$this->session->userdata('user')?>" />                                    </td>
								  <td width="23%"><?=form_input(array('name'=>'tmn_password','type'=>'text','minlength'=>'4'),'',' title="รหัสบัตรเงินสดทรูมันนี่" required="required" id="tmn_password"')?></td>
								  <td colspan="2" align="right"> </td>
							    </tr>
								<tr>
									<td></td>
									<td colspan="3"><a href="#" onclick="submit_tmnc()"><img src="/images/topup_bt.jpg" width="180" height="35" border="0" /></a>								     </td>
							  </tr>
							</table>
						  <?=form_close()?>
						  <hr />
		<head>
		<h4>เลือกซื้อชื้อเพ็คเก็ตด้วยเงินที่มีในระบบ <img src="/images/buy.png" width="146" height="16" /></h4>
		</head>
                        
							
<table class="paginate  full">
<thead>
    <tr style="cursor:pointer;">
		<th>ลำดับ</th>
		<th>ชื่อเพ็คเก็ต</th>
		<th>จำนวน</th>
		<th>จำนวนวัน</th>
		<th>ความเร็ว</th>
		<th>ราคา</th>
		<th>เลือกชื้อ</th>	
	</tr>
</thead>

<tbody style="cursor:default;">
	<?php $i=1;
		foreach ($plan->result() as $r):
			if($r->profile=='time'||$r->profile=='timeout'||$r->profile=='daily'||$r->profile=='monthly'||$r->profile=='packets'||$r->profile=='packets_day'||$r->profile=='packets_month')
			{ $r->valid_for=$r->valid_for/1000;
			}else{ $r->valid_for=$r->amount;}		
			$amount = " ".$this->lang->line('group_dis_amount_'.$r->profile);?>
		<tr>
		<td><?=$i++;?></td>
		<td><?=$r->name;?></td>
		<td><?=$r->amount.' '.$amount;?></td>
		<td><?=$r->valid_for;?> วัน</td>
		<td><?="<a>".$r->bw_download/1000 ."</a>/<a style='color:red;'>".$r->bw_upload/1000 ."</a> Kbs";?></td>
		<td><?=number_format($r->price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?></td>
		<td><? if($r->price <= $user->money){?><?=anchor('topups/topupplan/'.$r->groupname,'ชื้อเพ็คเก็ตนี้',' onclick="return confirm(\''.$ms.'กรุณายืนยันการชื้อเพ็คเก็ต '.$r->name.'อีกครั้ง !!!\')" class="button button-blue" info="รายการประจำปี" id="selectplan"'); } else{?>
		<button  class="button button-green" onclick="lowprice(<?=$r->price-$user->money?>);" type="submit">ขาด <?=$r->price-$user->money?> บาท</button><? }?></td>	
	</tr>
	<? endforeach;?>
	
</tbody>

</table>
						  <hr />

						</div>
                    </div>
				</div>
