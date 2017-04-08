<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
$(function() {
	 $(function() {
    $( "#dialog" ).dialog({
	  height: 800,
	  width: 900,
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
<div class="span12">   
 <div class="widget_heading">
	<h4>จัดการผู้ใช้งาน</h4></div>
    <div class="widget_container">

<div class="bt-right"><?=anchor('admin/'.$this->uri->segment(2).'form/action/add','สร้างผู้ไช้','class="btn btn-small btn-primary" info="ลงทะเบียน ผู้ใช้ใหม่" id="add"')?> <?=anchor('admin/'.$this->uri->segment(2).'form/gform','สร้างบัตร','class="btn btn-small btn-success" id="card_gen"')?>&nbsp; <button id="help" class="btn s2 btn-small btn-warning">ช่วยเหลือ<i class="icon-question-sign"></i></button></div>

<?=$form_open?> 
<table class="paginate display full" id="hotspotuser">

<thead>
	<tr style="cursor:pointer;">
		<th><?=$this->lang->line('user_table_username')?></th>
		<th>ชื่อ</th>
		<th>นามสกุล</th>
		<th><?=$this->lang->line('user_table_group')?></th>
		<th><?=$this->lang->line('user_table_expir')?></th>
		<th><?=$this->lang->line('user_table_time_used')?></th>
		<th><?=$this->lang->line('user_table_time_remain')?></th>
		<th><?=$this->lang->line('user_table_packet_used')?></th>
		<th><?=$this->lang->line('user_table_packet_remain')?></th>
        <th>เงินคงเหลือ</th>
		<th><?=$this->lang->line('user_table_status')?></th>
        
	</tr>
</thead>
<tbody style="cursor:default;">
	<tr>
		<td align='center' colspan='8'><?=img(other_asset_url('loader.gif','','images'))?></td>
	</tr>
</tbody>

</table>
<?=form_close()?>


		
	<div id="context_menu">
		<ul>
			<li id="detail" class="inactive"><div id="main">รายละเอียด</div></li>
			<li id="edit" class="inactive"><div id="main">แก้ไขข้อมูล</div></li>
			<li id="testauth" class="inactive"><div id="main">ทดสอบผู้ใช้</div></li>
			<hr/>
		
			<li id="moveto" class="inactive">
				<div id="main">เติมเวลา<span id="move_allow"><?=nbs()?></span></div>
				<ul id="subcontext">
				<?php foreach($gdata as $gname=>$name) : ?>
					<li id="<?=$gname?>" class="active"><div id="sub"><?=$name?></div></li>
				<?php endforeach; ?>
				</ul>
			</li>
            
			<li id="delete" class="inactive"><div id="main">ลบผู้ใช้ที่เลือก</div></li>
			<hr/>
			<li id="refresh" class="active"><div id="main">รีเฟรชตาราง</div></li>
			<li id="selectall" class="active"><div id="main">เลือกทั้งหมด</div></li>
			<hr/>
			<li id="sellock" class="inactive"><div id="main">ล๊อคผู้ใช้ที่เลือก</div></li>
			<li id="selunlock" class="inactive"><div id="main">ปลดล๊อคผู้ใช้ที่เลือก</div></li>
		</ul>
	
    </div>
</div>
</div>
<div id="dialog" title="เรียนรู้เพิ่มเติม">
<div class="widget_heading"><h4>ช่วยเหลือการเพิ่มผู้ใช้งานและการสร้างบัตร</h4></div>
  <p>
              	<ul class="helptip">
  <li><span class="btn btn-small btn-warning disable">สร้างผู้ใช้</span>: คุณสามารถตั้งชื่อกลุ่มได้ตามความต้องการ สามารถใช้อักษรและตัวเลข ห้ามใช้สัญลักษณ์</li>
  <ul>
  <li><span class="btn btn-small btn-primary disable">ชื่อผู้ใช้</span>ต้องขึ้นต้นด้วย ตัวเลขหรือตัวอักษรภาษาอังกฤษ อย่างน้อย 6ตัว</li>
  <li><span class="btn btn-small btn-primary disable">รหัสผ่าน</span> ต้องขึ้นต้นด้วย ตัวเลขหรืออักษรภาษาอังกฤษอย่างน้อย 6ตัว </li>
  <li><span class="btn btn-small btn-primary disable">กลุ่ม</span>กลุ่มผู้ใช้งานที่กำหนดขึ้นจากการสร้างกลุ่ม </li>
  <li><span class="btn btn-small btn-primary disable">จำนวนเงินคงเหลือ</span> จำนวนเงินที่ให้ผู้ใช้หลังจากสร้างเสร็จ</li>
  <li><span class="btn btn-small btn-primary disable">รายละเอียดอื่นๆ</span> รายละเอียดส่วนอื่นๆไม่มีผลต่อการใช้งานแต่อย่างใดคุณสามารถที่จะใส่หรือไม่ใส่ค่าอะไรก็ได้</li>
  </ul>
  </ul>
  <ul class="helptip">
  <li><span class="btn btn-small btn-warning disable">สร้างบัตร</span>: การกำหนดคุณสมบัติของการสุ่มสร้างบัตรผู้ใช้งานคุณสามารถกำหนดค่าพื้นฐานได้ที่การตั้งค่าทั่วไป</li>
  <ul>
  <li><span class="btn btn-small btn-success disable">คุณสมบัติ</span>: การสร้างบัตรผู้ใช้งานจะสามารถกำหนดชื่อผู้ใช้งานได้สูงสุด 8 ตัวอักษร</li>
  <li><span class="btn btn-small btn-success disable">คุณสมบัติ</span> ชื่อผู้ใช้จะประกอบด้วย อักษรขึ้นต้นสูงสุด 4 ตัวซึ่งกำหนดได้จากหน้าการตั้งค่าทั่วไป</li>
  <li><span class="btn btn-small btn-success disable">คุณสมบัติ</span> การสร้างผู้ใช้งานจะนำตัวอักษรที่กำหนดในหน้าการตั้งค่าทั่วไปมาสุ่มตัวเลขใส่อีก 3ตัวต่อท้าย</li>
  <li><span class="btn btn-small btn-success disable">คุณสมบัติ</span> คุณสามารถกำหนดรูปแบบของรหัสได้จากหน้าการตั้งค่าทั่วไปตามความชอบ</li>
  <li><span class="btn btn-small btn-success disable">รายละเอียดอื่นๆ</span> การสร้างบัตรหากคุณไม่เลือก "สร้างไฟล์ PDF" คุณจะไม่สามารถโหลดไฟล์ pdf ได้หลังจากสร้างเสร็จ</li>
   <li><span class="btn btn-small disable">ข้อสรุป</span> การสร้างบัตรผู้ใช้งานระบบจะสุ่มสร้างชื่อผู้ใช้สูงสุด 8 ตัวอักษรซึ่ง 4 ตัวอักษรแรกคุณสามารถใส่คำขึ้นต้นได้เอง ระบบจะสุ่มอักษรให้อีก 3 ตัวสุดท้ายซึ่งคุณสามารถกำหนดรูปแบบ 3 ตัวสุดท้ายได้จากการตั้งค่าทั่วไป</li>
  </ul>
  </ul>
  
</p>
<hr/>