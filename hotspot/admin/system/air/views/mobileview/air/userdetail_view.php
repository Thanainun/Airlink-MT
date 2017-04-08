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
<div class="wrapper">



                                
                               <div class="right">Hello : <?=$this->session->userdata('user')?></div>
                              
                           
<table class="contact">
                        <tr class="info">
                        	<td colspan="4"> <?=$this->lang->line('user_pages_time_usage') ?> : <span><?=time_data($user_h->time_used,'dhm') ?></span></td>
                        </tr>
                        
                        <tr class="info">
                        	<td colspan="4"><?=$this->lang->line('user_pages_data_usage') ?> : <span><?= (byte_format($user_h->packet_used ) ? byte_format($user_h->packet_used)  : $noprofile);?></span></td>
                        </tr>
                        
                        <tr class="info">
                        	<td colspan="4"><?=$this->lang->line('user_pages_lasted_login') ?> : <span><?= (isset($user_m->acctstarttime ) ? $user_m->acctstarttime  : $noprofile)?></span></td>
                        </tr>
                      
                         <tr class="info">
                        	<td colspan="4"> <?=$this->lang->line('user_details_package') ?> : <span><?=$datauser->billingplan?></span></td>
                        </tr>
                         <tr class="info">
                        	<td colspan="4"><?=$this->lang->line('user_details_package_type') ?> : <span><?=$profile_type?> <?=$unit?></span></td>
                        </tr>
                         <tr class="info">
                        	<td colspan="4"><?=$this->lang->line('user_details_package_price') ?> : <span><?=$datauser->price?></span></td>
                        </tr>
                         <tr class="info">
                        	<td colspan="4"><?=$this->lang->line('user_details_start_time') ?> : <span><?=($datauser->start_time==null) ? '-' : $datauser->start_time?></span></td>
                        </tr>
                         <tr class="info">
                        	<td colspan="4"><?=$this->lang->line('user_details_expire') ?> : <span><?=$datauser->valid_until?></span></td>
                        </tr>
                         <tr class="info">
                        	<td colspan="4"><?=$this->lang->line('user_details_valid_until') ?> : <span><?=$exp_time?></span></td>
                        </tr>
                        
                    </table>
                   
                            <ul>
                                   <li>Firstname-Lastname  :  <?=(isset($profile['firstname']) ? $profile['firstname'] : "--------").$n.(isset($profile['lastname']) ? $profile['lastname'] : "---------") ?></li>
                                   <li>E-mail  :  <?=(isset($profile['email']) ? $profile['email'] : "-------")?></li>
                                   <li>Phone number  :  <?=(isset($profile['phone']) ? $profile['phone'] : "--------")?></li>
                                   <li>Personal ID  :  <?= (isset($profile['personal_id']) ? $profile['personal_id'] : "-----")?></li>
                                   <li>Address  :  <?=(isset($profile['address1']) ? $profile['address1'] : "-------").(isset($profile['address2']) ? $profile['address2'] : "------"). $n . (isset($profile['district']) ? $profile['district'] : "-------").(isset($profile['amphur']) ? $profile['amphur'] : "------").$n.(isset($profile['province']) ? $profile['province'] : "--------")?></li>
                                   
                                   </ul>
                                   
									</div>
                        </div>
                        
<input type="button" value="Go Back" onclick="goBack()" class="btn-common btn-back">
</div>