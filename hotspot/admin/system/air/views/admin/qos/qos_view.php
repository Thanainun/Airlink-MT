<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

		
              
              
<div class="span7">
                <div class="widget_heading"><h4>ตั้งค่าและควบคุมความเร็วอินเทอร์เน็ตของคุณ</h4></div>
                <div class="widget_container">
					
						<div class="panel">
							<?=form_open('admin/qos/saveconfig','id="form_qos" class="form"')?>
								<head><h3>Quality Of Service</h3></head>
								<hr />
									<table class="full">
										<tr>
											<td width="25%"><?=form_label('เปิดใช้งาน QOS','qoscontrol')?></td>
											<td><?=form_dropdown('qoscontrol',array('QOSCONTROLLON'=>'ไช่','QOSCONTROLLOFF'=>'ไม่'),$qoscontrol,'disabled="disabled"')?></td>
										</tr>
                                        <tr>
											<td width="25%"><?=form_label('เปิดใช้งาน SQUID','squid')?></td>
											<td><?=form_dropdown('squid',array('SQUIDON'=>'ไช่','SQUIDOFF'=>'ไม่'),$squid,'disabled="disabled"')?></td>
										</tr>
                                        <tr>
											<td width="25%"><?=form_label('Block Bittorent','bit')?></td>
											<td><?=form_dropdown('bit',array('BITDROP'=>'ไช่','BITON'=>'ไม่'),$bit,'disabled="disabled"')?></td>
										</tr>
										<tr>
											<td><?=form_label('Max Download','download')?></td>
											<td><?=form_input('download',$download,'id="download" disabled="disabled"')?></td>
										</tr>
										<tr>
											<td><?=form_label('Max Upload','upload')?></td>
											<td><?=form_input('upload',$upload,'id="upload" disabled="disabled"')?></td>
										</tr>
                                        <tr>
											<td><?=form_label('HTTP Max Speed','http')?></td>
											<td><?=form_input('http',$http,'id="http" disabled="disabled"')?></td>
										</tr>
                                        
									</table>
                                 
								<hr />
								
								<div align="right">
									<button type="submit" class="btn btn-small btn-primary ">บันทึก</button>
								</div>
							<?=form_close()?>
						</div>
                       
                    </div>
                    
                    
				</div> 
                <div class="span5">
                    <div class="widget_heading"><h4>เกร็ดความรู้</h4></div>
                <div class="widget_container">
              การตั้งค่า QOS Control คุณสามารถกำหนดความเร็วสูงสุดสำหรับอินเทอร์เน็ตของคุณได้ทันที โดยไม่จำเป็นต้องแก้ไขค่า Firewall 
              <ul>
              <li>เปิดใช้งาน QOS : หากคุณเปิดใช้งานส่วนนี้ระบบจะเปิดใช้งานการจำกัดความเร็วตามที่คุณระบบ หากไม่ระบบจะใช้ความเร็วสูงสุด</li><br/>
              <li>เปิดใช้งาน SQUID : หากคุณเปิดใช้งานส่วนนี้ระบบจะให้ลูกข่ายวิ่งผ่านพอร์ต 3128 ของ squid หากเกิดปัญหาหรือ squid ไม่สามารถทำงานได้ให้คุณปิดส่วนนี้เพื่อให้ลูกข่ายละเลย squid ตามการ routing ของระบบไปได้ทันที</li><br/>
              <li>Block Bittorent : ระบบจะไม่ปล่อยให้ดาวน์โหลดบิตทอเร้นท์ แต่ไม่สามารถควบคุมได้หากเข้ารหัสข้อมูล</li><br/>
              <li>Max Download : ความเร็วดาวน์โหลดสูงสุดของอินเทอร์เน็ตคุณ หน่วยเป็น Mb/s</li><br/>
              <li>Max Upload : ความเร็วอัพโหลดสูงสุดของอินเทอร์เน็ตคุณ หน่วยเป็น Mb/s</li><br/>
              <li>HTTP Max Speed : ความเร็วการใช้งานสูงสุดของ HTTP หน่วยเป็น Mb/s</li>
              </ul><br/>
              * ห้ามใส่ค่าความเร็วในแต่ละช่องเหมือนกัน ต้องแตกต่างกันเท่านั้น
				             
                
               
                </div>
                </div>
		