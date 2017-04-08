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

<script type="text/javascript" src='http://www.tmtopup.com/topup/3rdTopup.php?uid=<?=$true_setting ?>'></script>

<section id="page-wrapper">
        
        	<section id="menu-wrapper">
                <ul class="menu">
                    
                    <li class="icon home">
                        <a href="mobileview">
                            <span class="menu-li-title">Dashboard</span>
                            <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                        </a>
                    </li>
                    
                    <li class="icon box">
                        <a href="mobileview/userdetail">
                            <span class="menu-li-title">User details</span>
                            <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                        </a>
                    </li>
                    
                    <li id="a-submenu-2" class="icon plus">
                    
                        <a href="#">
                            <span class="menu-li-title">Money Refill</span>
                            <img class="menu-li-arrow-submenu" src="<?=$style ?>img/icons/submenu.png" alt="" />
                        </a>
                        
                        <ul id="submenu-2">
                        	<li>
                                <a href="mobileview/cardrefill">
                                    <span class="menu-li-title">WiFi Card</span>
                                    <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                                </a>
                            </li>
                            
                            <li>
                                <a href="mobileview/truerefill">
                                    <span class="menu-li-title">True money</span>
                                    <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                                </a>
                            </li>
                        </ul>
                        
                    </li> <!-- #submenu-1 -->
                    
                    <li class="icon book">
                        <a href="mobileview/package">
                            <span class="menu-li-title">Package</span>
                            <img class="menu-li-arrow" src="img/icons/arrow-forward.png" alt="" />
                        </a>
                    </li>
                    
                    <li id="a-submenu-1" class="icon plus">
                    
                        <a href="#">
                            <span class="menu-li-title">Topup History</span>
                            <img class="menu-li-arrow-submenu" src="<?=$style ?>img/icons/submenu.png" alt="" />
                        </a>
                        
                        <ul id="submenu-1">
                        	<li>
                                <a href="mobileview">
                                    <span class="menu-li-title">WiFi topup</span>
                                    <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                                </a>
                            </li>
                            
                            <li>
                                <a href="mobileview">
                                    <span class="menu-li-title">True topup</span>
                                    <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                                </a>
                            </li>
                        </ul>
                        
                    </li> <!-- #submenu-1 -->
                
                </ul> <!-- .menu -->
                
            </section> <!-- #menu-wrapper -->
            
        
        	<section id="content-wrapper">
                	
                <section id="header">
                
                    <div id="header-left">
                        <a href="#" id="a-menu"><img src="<?=$style ?>img/icons/menu.png" alt="menu" /></a>
                    </div>
                    
                    <div id="header-title">
                        <h1>mobile user dashboard</h1>
                    </div>
                    
                    <div id="header-right">
                        <a href="mobileview/logoutuser" id="header-search-link"><img src="<?=$style ?>img/icons/share.png" alt="Search" /></a>
                    </div>
                    
                </section> <!-- #header -->                
                <article>
                <p class="center"><?=$logo ?></p>
                <div class="annouced">
    <?=$annouced?>
    </div>
<div class="wrapper">
	
 
                        	<div class="featured blue"><span><?=$this->lang->line('user_pages_time_usage') ?></span>
                            <br />
                            
							<?=time_data($user_h->time_used,'dhm') ?>
                           
                            </div>
                            
                            
                            <div class="featured green"><span><?=$this->lang->line('user_pages_data_usage') ?></span>
                            <br />
							<?= (byte_format($user_h->packet_used ) ? byte_format($user_h->packet_used)  : $noprofile);?>
                            </div>
                            
                            
                            
                            <div class="featured orange"><span><?=$this->lang->line('user_pages_lasted_login') ?></span>
                            <br />
							<?= (isset($user_m->acctstarttime ) ? $user_m->acctstarttime  : $noprofile)?>
                            </div>
                            
                            <div class="featured yellow"><span><?=$this->lang->line('user_amount'); ?> </span>
                            <br />
							<?=number_format($user->money,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></div>
                           
                       
                        </div>
                    <div class="wrapper">
 
                        	<div class="featured commone"><span><?=$this->lang->line('user_details_package') ?></span>
                            <br />
							<?=$datauser->billingplan?>
                            </div>
                            
                            
                            <div class="featured commone"><span><?=$this->lang->line('user_details_start_time') ?></span>
                            <br />
							<?=($datauser->start_time==null) ? '-' : $datauser->start_time?>
                            </div>
                            
                            <div class="featured commone"><span><?=$this->lang->line('user_details_expire') ?></span>
                            <br /><?=$datauser->valid_until?>
                            </div>
                            
                            <div class="featured commone"><span><?=$this->lang->line('user_details_valid_until') ?></span>
                             <br />
							 <?=$exp_time?>
                             </div>
                            
                       

 </div>
 </article>