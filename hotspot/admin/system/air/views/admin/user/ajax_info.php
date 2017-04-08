<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$this->load->helper('number');
$datauser = $datauser->row(); 

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

	<!-- Left column/section -->

                <section style="font-size:90%" class="grid_6 first">

                    <div>
                            <h4>ข้อมูลผู้ใช้ : <?=$datauser->username?></h4>

                            <hr/>

                            <table class="paginate full">
                                <tbody>
                                    <tr>
                                        <td width="15%">กลุ่มผู้ใช้</td>
										<td width="30%"><?=$datauser->billingplan?></td>
										<td width="5%" style="background:#FFFFC0">&nbsp;</td> 
										<td width="15%">ชื่อ - นามสกุล</td>
										<td><?=(isset($userprofile['firstname']) ? $userprofile['firstname'] : '-')?> <?=(isset($userprofile['lastname']) ? $userprofile['lastname'] : '')?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>โปรไฟล์</td>
										<td><?=$profile_type?></td>
                                        <td style="background:#FFFFC0">&nbsp;</td>
										<td>ชื่อผู้ใช้</td>
										<td><?=$datauser->username?></td>
                                        <td width="5%"><div style="width:16px; height:16px;" id="user_status"></div></td>
                                    </tr>
                                    <tr>
                                        <td>วัน/เวลา หรือ ข้อมูล</td>
										<td><?=$unit?></td>
                                        <td style="background:#FFFFC0">&nbsp;</td>
										<td>รหัสผ่าน</td>
										<td><?=$datauser->password?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>ราคา</td>
										<td><?=$datauser->price?></td>
                                        <td style="background:#FFFFC0">&nbsp;</td>
										<td>วันเริ่มใช้</td>
										<td><?=($datauser->start_time==null) ? '-' : $datauser->start_time?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>วันหมดอายุบัตร</td>
										<td><?=$datauser->valid_until?></td> 
                                        <td style="background:#FFFFC0">&nbsp;</td>
										<td>วันหมดอายุ</td>
										<td><?=$exp_time?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>

                    </div>
                    <div>
                        <div class=" first">
                            <h3>ประวัติการใช้งาน</h3>

                            <hr />

                            <table class="paginate full">
                                <thead>
                                    <tr>
                                        <th  width="5%">ลำดับ</th>
                                        <th>เริ่มใช้</th>
                                        <th>หยุดใช้</th>
                                        <th>ข้อมูล</th>
                                        <th>IP</th>
                                        <th>MAC</th>
                                        <th>หยุดเชื่อมต่อ</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php $count = 1; foreach ($history->result() as $row): ?>
                                    <tr>
                                        <td align="center"><?=$count++?></td>
                                        <td><?=$row->acctstarttime?></td>
                                        <td><?=$row->acctstoptime?></td>
                                        <td align="right"><?=byte_format($row->acctinputoctets+$row->acctoutputoctets)?></td>
                                        <td><?=$row->framedipaddress?></td>
                                        <td><?=$row->callingstationid?></td>
                                        <td><?=$row->acctterminatecause?></td>
                                    </tr>
								<?php endforeach;?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                                        
                    <div class="clear">&nbsp;</div>
                       
                </section>
