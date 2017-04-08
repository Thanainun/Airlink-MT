<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$_webhost = array(
              'name'        => 'webhost',
              'id'          => 'webhost',
              'value'       => $webhost,
              'size'        => '50',
              'style'       => 'width:93%',
            );

$_delaypool = array(
              'name'        => 'delaypool',
              'id'          => 'delaypool',
              'value'       => $delaypool,
              'size'        => '50',
              'style'       => 'width:93%',
            );

$_blockfiles = array(
              'name'        => 'blockfiles',
              'id'          => 'blockfiles',
              'value'       => $blockfiles,
              'size'        => '50',
              'style'       => 'width:93%',
            );

$_blockip = array(
              'name'        => 'blockip',
              'id'          => 'blockip',
              'value'       => $blockip,
              'size'        => '50',
              'style'       => 'width:93%',
            );

?>

			<div class="span7">
                <div class="widget_heading"><h4>จำกัดการเข้าใช้งานและความเร็วด้วย Squid</h4></div>
                <div class="widget_container">
							<?=form_open('admin/proxy/saveconfig','id="form_proxy" class="form"')?>
									<table class="full">
										<tr>
											<td><head><h4>บล็อก เว็บ</h4></head><hr/></td>
											<td><head><h4>จำกัดความเร็ว ดาวโหลด (128Kb/s)</h4></head><hr/></td>
										</tr>
										<tr>
											<td><?=form_textarea($_webhost)?></td>
											<td><?=form_textarea($_delaypool)?></td>
										</tr>
									</table>
									<table class="full">
										<tr>
											<td><head><h4>บล็อก ไฟล์</h4></head><hr/></td>
											<td><head><h4>บล็อก ไอพี </h4></head><hr/></td>
										</tr>
										<tr>
											<td><?=form_textarea($_blockfiles)?></td>
											<td><?=form_textarea($_blockip)?></td>
										</tr>
									</table>
								<hr />
                                 <button type="submit" class="button button-blue" >บันทึก</button>
                                </div>
                   			 </div>
                             <div class="span5">
                    <div class="widget_heading"><h4>เกร็ดความรู้</h4></div>
                <div class="widget_container">
              	การตั้งค่าและเปลี่ยนแปลงค่าของ Proxy จะมีผลทันที ที่คุณบันทึกค่าโดยไม่ต้องใช้คำสั่งเพิ่มเติมใดๆ <br/>
                การจำกัดความเร็วดาวน์โหลดไฟล์ที่ 128Kb/s หมายความว่า ผู้ใช้งานของคุณจะสามารถดาวน์โหลดไฟล์นั้นๆ ได้ที่ความเร็วสูงสุด 128Kb/s ต่อ 1 คน จากความเร็วสูงสุดของเน็ตเวิร์คที่ 7Mb/s หากในเวลานั้นมีผู้ใช้งานโหลดข้อมูลพร้อมกันเกินกำหนดระบบจะลดหย่อนความเร็วลงไปเรื่อยๆ ไม่ให้เกิน 7Mb/s  
               
                </div>
                </div>
	
								
                              
							<?=form_close()?>
						
				