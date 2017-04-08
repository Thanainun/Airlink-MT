<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
$(function() {
		$( "#tabs" ).tabs();

	$("#show-option").fancybox({
		'width'				: '60%',
		'height'			: '60%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});
	 $(function() {
    $( "#dialog" ).dialog({
	  height: 800,
	  width: 800,
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500,
		
      },
      hide: {
        effect: "blind",
        duration: 500
      }
    });
 
    $( "#help" ).click(function() {
      $( "#dialog" ).dialog( "open" );
	  
    });
  });
});
</script>

 
 
<div class="span7">
	
<div class="widget_heading">
  <h4>Mikrotik Setup</h4>
</div>
<div class="widget_container">
  <div id="tabs" style="height:98%; text-align:left; overflow:auto;">
    <ul>
      <li><a href="#tab1">การเชื่อมโยง Mikrotik</a></li>
     
    </ul>
    
<div id="tab1">
 <div class="widget_container">
								<head><h3>Network interface</h3><p>IP-RADIUS</p></head>
								<hr />
                                <?=form_open('admin/network','id="form_network" class="form"')?>
									<table class="full">
                                    <tr>
											<td width="25%"><?=form_label('IP Address','ipaddress')?></td>
											<td><?=form_input('ipaddress',$ipaddress,'id="ipaddress"')?></td>
										</tr>
										<tr>
											<td width="25%"><?=form_label('Incoming Port','incoming_port')?></td>
											<td><?=form_input('incoming_port',$incoming_port,'id="incoming_port"')?></td>
										</tr>
										<tr>
											<td><?=form_label('Radius Secret','radius_sc')?></td>
											<td><?=form_input('radius_sc',$radius_sc,'id="radius_sc"')?></td>
										</tr>
                                        </table>
                                        <head><h3>Mikrotik Authorize</h3></head>
								<hr />
									<table class="full">
                                    <tr>
											<td width="25%"><?=form_label('Username','username')?></td>
											<td><?=form_input('username',$username,'autocomplete="off"')?></td>
										</tr>
										<tr>
											<td width="25%"><?=form_label('Password','password')?></td>
											<td><?=form_password('password',$password,'autocomplete="off"')?></td>
										</tr>
									</table>
                                    
                                    </div>
                                    </div>
                                    
                         
									<button type="submit" class="btn btn-small btn-primary ">บันทึกการตั้งค่า</button>
							<?=form_close()?>
						
                     </div>
                    </div>
				</div> 
                
                <div class="span4">
                    <div class="widget_heading"><h4>เกร็ดความรู้</h4></div>
                <div class="widget_container">
              	<strong>การตั้งค่าเน็ตเวิร์ค</strong>คุณจะต้องล็อกอินเข้าสู่ระบบผ่านทางฝั่ง Local network หากคุณเชื่อมต่อและเข้าจัดการ การตั้งค่าผ่านทาง WiFi network ระบบจะไม่ยินยอมให้คุณตั้งค่าสิ่งใดๆเกี่ยวกับ Network ได้ นั่นเพราะว่าเมื่อคุณเปลี่ยนแปลงค่าต่างๆของ Coova Chilli ระบบจะหยุดการทำงานและคุณจะถูกตัดออกจากระบบโดยที่การตั้งค่าใหม่ยังไม่สมบูรณ์ <hr/>

                <div id="dialog" title="เรียนรู้เพิ่มเติม">
  
  
  <div class="widget_heading"><h4>ช่วยเหลือ การตั้งค่า Network Interface</h4></div>
              <br/>
              <p class="btn s2 btn-small btn-primary disabled">Network interface</p>
              	<ul class="helptip">
  <li><span class="btn btn-small btn-warning disable">Wan Interface</span>: ชื่อการ์แลนสำหรับเชื่อมต่ออินเทอร์เน็ต</li>
  <li><span class="btn btn-small btn-warning disable">Wireless Interface</span>: ชื่อการ์ดแลนสำหรับบริการ WiFi Hotspot</li>
  <li><span class="btn btn-small btn-warning disable">Server Address</span>: Ip address ของเซิฟเวอร์สำหรับบริการ WiFi Hotspot </li>
  <li><span class="btn btn-small btn-warning disable">Netmask</span>: ซับเน็ตมาส์คของเน็ตเวิร์ค การกำหนดเลขชุดนี้จะสามารถควบคุมจำนวนเครื่องลูกข่ายได้แนะนำ "255.255.252.0" สามารถรองรับได้สูงสุด 1022 โฮส</li>
</ul>
<hr/>
 <p class="btn s2 btn-small btn-primary disabled">Proxy Support</p>
	<ul class="helptip">
    <li><span class="btn btn-small btn-warning disable">สนับสนุน Proxy </span>:  เปิดการทำงานร่วมกับ Squid proxy server (แนะนำ)</li>
    <li><span class="btn btn-small btn-warning disable">Proxy Server</span>: หมายเลขไอพีของ Squid proxy server หากไม่มีระบบ cache_peer อย่าเปลี่ยนแปลง</li>
    <li><span class="btn btn-small btn-warning disable">Proxy Server Client</span>: หมายเลขไอพีของ Squid Client หากไม่มีระบบ cache_peer อย่าเปลี่ยนแปลง</li>
    <li><span class="btn btn-small btn-warning disable">Proxy Port</span>: หากกำหนดให้ squid ทำงานแบบ Tranparent ห้ามเปลี่ยนแปลง</li>
    <li><span class="btn btn-small btn-warning disable">Proxy Secret</span>: Secret Key คือค่าเดียวกับ Radius secret key ระบบกำหนดให้อัติโนมัติ</li>
    </ul>
<hr/>
<p class="btn s2 btn-small btn-primary disabled">การตั้งค่าส่วนกลางทางกายภาพ</p>
<ul class="helptip">
<li>(*)<span class="btn btn-small btn-warning disable">เวลาของ session</span>: กำนหดเวลาของ Session ต่อผู้ใช้งานจะมีผลเมื่อผู้ใช้งานไม่ได้ถูกกำหนดค่าใน Radius (ค่าเป็นวินาที)</li>
<li>(*)<span class="btn btn-small btn-warning disable">Idle Timeout</span>: กำหนดเวลาการตัดการเชื่อมต่อเมื่อผู้ใช้งานไม่ใช้งานในเวลาที่กำหนด(ค่าเป็นวินาที)</li>
<li>(*)<span class="btn btn-small btn-warning disable">Max Download</span>: กำหนดความดาวน์โหลดสูงสุดต่อผู้ใช้งาน (ค่าเป็น บิต)</li>
<li>(*)<span class="btn btn-small btn-warning disable">Max upload</span>: กำหนดความเร็วอัพโหลดสูงสุดต่อผู้ใช้งาน (ค่าเป็น บิต)</li>
<li>(*)<span class="btn btn-small btn-warning disable">Default Port</span>: พอร์ตมาตรฐานในการทำงานของระบบ</li>
<li>(*)<span class="btn btn-small btn-warning disable">Register by Defualt</span>: ไม่มีผลใดๆต่อการตั้งค่า</li>
<li>(*)<span class="btn btn-small btn-warning disable">Radius Protocol</span>: โปรโตคอลตรวจสอบความถูกต้องของข้อมูล คุณสามารถเลือกใช้ได้ดังนี้ PAP,CHAP,MS-CHAP การใช้โปรโตคอล CHAP เป็นที่ยอมรับว่าปลอดภัยกว่า</li>
</ul>
<p>* การกำหนดการตั้งค่าส่วนกลางทางกายภาพ จะมีผลบังคับใช้งานก็ต่อเมื่อผู้ใช้งานนั้นๆไม่ได้ถูกกำหนดค่าข้อมูลใน Radius เมื่อระบบไม่พบข้อมูลใน Radius การทำงานของส่วนนี้จะถูกบังคับใช้กับผู้ใช้งานนั้นๆ</p>
<hr/>
<p class="btn s2 btn-small btn-primary disabled">การตั้งค่าลูกข่ายและเกตเวย์</p>
<ul class="helptip">
<li><span class="btn btn-small btn-warning disable">อนุญาตให้ตั้งค่าไอพี</span>: เปิดใช้งาน Static IP อนุญาตให้ลูกข่ายสามารถตั้งค่าไอพีแอดเดรสได้ด้วยตัวเอง</li>
<li><span class="btn btn-small btn-warning disable">Static Domain</span>: โดเมนเนมสำหรับ Static IP</li>
<li><span class="btn btn-small btn-warning disable">Static IP Start</span>: ไอพีเริ่มต้นในการอนุญาตให้ใช้งาน Static IP</li>
<li><span class="btn btn-small btn-warning disable">Static Netmask</span>: ค่าอัตโนมัติเปลี่ยนแปลงตามการตั้งค่า Subnetmask ของคุณ</li><hr/>
<p class="btn s2 btn-small btn-primary disabled">DHCP Option กำหนดการจ่ายไอพีอัตโนมัติ</p>
<li><span class="btn btn-small btn-warning disable">IP Address Start</span>: ไอพีเริ่มต้นในกายจ่ายสำหรับลูกข่าย</li>
<li><span class="btn btn-small btn-warning disable">Netmask</span>: ค่า Subnetmask ของเน็ตเวิร์คเปลี่ยนแปลงตามการตั้งค่าของเมนูเน็ตเวิร์คและพร๊อกซี่</li>
<li>(*)<span class="btn btn-small btn-warning disable">Name Server1</span>: Dns Server1 คุณสามารถเลือกใช้ Public dns ของ Google ได้(8.8.8.8)</li>
<li>(*)<span class="btn btn-small btn-warning disable">Name Server2</span>: Dns Server2 คุณสามารถเลือกใช้ Public dns ของ Google ได้(8.8.4.4)</li>
</ul>
<p>* หาก 3BB คือผู้ใช้บริการอินเทอร์เน็ตของคุณ คุณจะต้องใช้ Name server ของ 3BB เท่านั้น 110.164.252.222,110.164.252.223 หาก Server ไม่สามารถเชื่อมต่ออินเทอร์เน็ตได้ ให้ตรวจสอบความถูกต้องของ DNS </p>
<hr/>
<p class="btn s2 btn-small btn-primary disabled">การตั้งค่า Radius</p>
<ul class="helptip">
<li><span class="btn btn-small btn-warning disable">NAS ID</span>: NAS(Network access server) ไม่จำเป็นต้องเปลี่ยนแปลง</li>
<li><span class="btn btn-small btn-warning disable">Radius server 1</span>: Radius Server ที่ 1 จะเปลี่ยนแปลงได้ในกรณีที่คุณมี Radius Server มากกว่า 1 เครื่อง</li>
<li><span class="btn btn-small btn-warning disable">Radius server 2</span>: Radius Server ที่ 2 จะเปลี่ยนแปลงได้ในกรณีที่คุณมี Radius Server มากกว่า 1 เครื่อง</li>
<li><span class="btn btn-small btn-warning disable">UAM Secret</span>: รหัสลับของ Coova chilli ที่ใช้ในระบบ (กรุณาอย่าเปลี่ยนแปลงหากคุณไม่มีความชำนาญ)</li>
<li><span class="btn btn-small btn-warning disable">Radius secret</span>: รหัสลับของ Radius ที่ใช้ในระบบ (กรุณาอย่าเปลี่ยนแปลงหากคุณไม่มีความชำนาญ)</li>
</ul>

<hr/>
<p class="btn s2 btn-small btn-primary disabled">การเข้าถึงเครือข่ายละเลยการยืนยัน</p>
<ul class="helptip">
<li><span class="btn btn-small btn-warning disable">Provider</span>: ชื่อให้บริการ WiFi ของคุณ</li>
<li><span class="btn btn-small btn-warning disable">Provider link</span>: ที่อยู่เว็บไซต์ของคุณ</li>
<li><span class="btn btn-small btn-warning disable">UAM Allow</span>: อนุญาตให้ลูกข่ายเข้าเว็บไซต์ดังกล่าวได้โดยไม่ต้องยืนยันตัวตน(คั่นด้วย คอมม่า ,)</li>
<li><span class="btn btn-small btn-warning disable">MAC Allow</span>: เปิดใช้งานการอนุญาต Mac Address </li>
<li><span class="btn btn-small btn-warning disable">MAC Key</span>: รายการ Mac Address ที่อนุญาตให้เข้าใช้งานโดยไม่ต้องยีนยันตัวตน (คั่นด้วย คอมม่า ,)</li>
<li><span class="btn btn-small btn-warning disable">UAM Format</span>: URL หน้าล็อกอิน</li>
<li><span class="btn btn-small btn-warning disable">UAM Homepage</span>: URL Redirect ไปหน้าล็อกอิน</li>
</ul>
<hr/>
<div align="right"><a href="http://facebook.com/sartonice" class="btn btn-small btn-info disable" target="_blank">ผู้พัฒนา Sarto nice</a></div>
</div>
 
<button id="help" class="btn s2 btn-small btn-warning">ช่วยเหลือสิ่งนี้ <i class="icon-question-sign"></i></button>&nbsp;<a href="#" class="btn s2 btn-small btn-success">การใช้งานและแก้ปัญหา<i class="icon-question-sign"></i></a>
        <div class="widget_heading"><h4>ปัญหาที่อาจพบ</h4></div>
                <div class="widget_container">
                เนื่องจากการตั้งค่านี้ต้องใช้คำสั่งจัดการโปรแกรมต่างๆมากมาย การสั่งหยุดโปรแกรมบางอย่างอาจไม่สำเร็จเนื่องจากสคริปหยุดการทำงาน หากระบบแจ้งว่า "ไม่สามารถหยุดการทำงาน ..." ให้รอสักครู่แล้วกดบันทึกข้อมูลอีกครั้งหนึ่ง
                
         
              	<hr/>        
                </div>
                
                
               
                </div>
                </div>
		