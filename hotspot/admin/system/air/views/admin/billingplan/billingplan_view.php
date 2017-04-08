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
	<h4>จัดการกลุ่ม/แพ็คเกจอินเทอร์เน็ต</h4></div>
    <div class="widget_container">
<div class="bt-right"><button type="button" id="add_group" rel="form_groups" class="btn btn-small btn-primary">สร้างกลุ่ม</button>&nbsp; <button id="help" class="btn s2 btn-small btn-warning">ช่วยเหลือ<i class="icon-question-sign"></i></button></div>


                            <table id="group_table" class="paginate full">
                                <thead>
                                    <tr style="cursor:pointer;">
										<th><?=$this->lang->line('onlineuser_table_no')?></th>
										<th><?=$this->lang->line('group_thead_name')?></th>
                                     
										<th><?=$this->lang->line('group_thead_profile')?></th>
										<th><?=$this->lang->line('group_thead_amount')?></th>
										<th><?=$this->lang->line('group_thead_invalid')?></th>
										<th><?=$this->lang->line('group_thead_price')?></th>
										<th><?=$this->lang->line('group_thead_banwidth')?></th>
										<th><?=$this->lang->line('group_thead_action')?></th>
                                    </tr>
                                </thead>
                                <tbody>
									<tr>
										<td align='center' colspan='11'><?=img(other_asset_url('loader.gif','','images'))?></td>
									</tr>
                                </tbody>
                        </table>
</div></div> 
<div id="dialog" title="เรียนรู้เพิ่มเติม">
<div class="widget_heading"><h4>ช่วยเหลือสร้างกลุ่มผู้ใช้งาน</h4></div>
  <p>
              	<ul class="helptip">
  <li><span class="btn btn-small btn-warning disable">ชื่อกลุ่ม</span>: คุณสามารถตั้งชื่อกลุ่มได้ตามความต้องการ สามารถใช้อักษรและตัวเลข ห้ามใช้สัญลักษณ์</li>
  <li><span class="btn btn-small btn-warning disable">โปรไฟล์</span>: โปรไฟล์การใช้งานจะเป็นการกำหนดการใช้งานของผู้ใช้งาน โปรไฟล์การใช้งานแบ่งได้ตามนี้</li>
  <ul>
  <li><span class="btn btn-small btn-primary disable">จำนวนวันใช้งาน</span><p> นับจริงเป็นวินาทีระบบจะคำนวณจากเวลาการใช้งานจริงของผู้ใช้ ไม่ใช่วันเวลาปัจจุบันและเริ่มนับทันทีที่เข้าระบบเป็นครั้งแรก สมมุติคุณกำหนดวันใช้งาน 5 วันเมื่อผู้ใช้งานเข้าระบบ วันที่ 1 ของเดือนและใช้งานไป 1 ชั่วโมง หากผู้ใช้งานเริ่มกลับมาใช้งานใหม่ในวันที่ 6 ก็ยังเหลือเวลาอีก "4 วัน 23 ชั่วโมง"</p></li>
  <li><span class="btn btn-small btn-primary disable">ข้อมูล(MB)</span><p>
  นับจริงเป็น Byte(B) การกำหนดส่วนนี้ระบบจะนับการดาวน์โหลดข้อมูล + การอัพโหลดข้อมูลของผู้ใช้งานโดยไม่สนใจวันเวลาการใช้งาน หากครบจำนวนตามที่ระบุระบบจะตัดผู้ใช้งานออกจากระบบโดยอัตโนมัติ
  </p> </li>
  <li><span class="btn btn-small btn-primary disable">ข้อมูล(MB)/วัน</span>
  <p>นับจริงเป็น Byte(B) การกำหนดส่วนนี้ระบบจะนับการดาวน์โหลดข้อมูล + การอัพโหลดข้อมูลของผู้ใช้งานต่อ 24 ชั่วโมง หากครบกำหนดก่อน 24 ชั่วโมงผู้ใช้งานจะถูกตัดออกจากระบบและจะใช้งานได้อีกครั้งต่อเมื่อเลยกำหนด 24 ชั่วโมงไปแล้ว และจะไม่สามารถใช้งานได้หาอายุบัตรสิ้นสุดลง</p> </li>
  <li><span class="btn btn-small btn-primary disable">ข้อมูล(MB)/เดือน</span>
  <p>นับจริงเป็น Byte(B) การกำหนดส่วนนี้ระบบจะนับการดาวน์โหลดข้อมูล + การอัพโหลดข้อมูลของผู้ใช้งาน หากใช้งานครบตามที่ตั้งใว้ก่อนครบ 30 วัน จะไม่สามารถเข้าใช้งานได้และจะไม่สามารถใช้งานได้หากอายุของบัตรสิ้นสุดลง</p> </li>
  <li><span class="btn btn-small btn-primary disable">ชั่วโมง</span>
  <p>นับจริงเป็นวินาทีระบบจะคำนวณณเวลาการใช้งานของผู้ใช้งานตามจริงของผู้ใช้งานและไม่สนใจวันเวลาในปัจจุบันไม่ว่าผู้ใช้งานนั้นจะใช้งานต่อเนื่องหรือไม่</p> </li>
  <li><span class="btn btn-small btn-primary disable">ชั่วโมง/ครั้ง</span>
  <p>นับจริงเป็นวินาทีระบบจะคำนวณเวลาการใช้งานของผู้ใช้งานตามค่าที่ตั้งใว้ต่อการเข้าใช้งานในแต่ละครั้ง หากผู้ใช้งานออกจากระบบก็ยังสามารถเข้าใช้งานได้ใหม่ในครั้งต่อไปจนกว่าอายุบัตรจะหมดลง</p> </li>
  <li><span class="btn btn-small btn-primary disable">ชั่วโมง/วัน</span>
  <p>นับจริงเป็นวินาทีระบบจะคำนวณเวลาการใช้งานของผู้ใช้งานตามค่าที่ตั้งใว้ หากค่าที่กำหนดหมดลงก่อน 24 ชั่วโมงผู้ใช้งานจะไม่สามารถเข้าสู่ระบบได้จนกว่าจะเลยกำหนด 24 ชั่วโมงและจะไม่สามารถเข้าใช้งานได้หากเลยกำหนดของอายุบัตร</p> </li>
  <li><span class="btn btn-small btn-primary disable">ชั่วโมง/เดือน</span>
  <p>นับจริงเป็นวินาทีระบบจะคำนวณเวลาการใช้งานของผู้ใช้งานตามค่าที่ตั้งใว้ หากผู้ใช้งานใช้เวลาเลยกำหนดก่อน 30 วันจะไม่สามารถเข้าใช้งานได้จนกว่าจะเลยกำหนด 30 วันหรือหากหมดอายุของบัตรก็จะไม่สามารถเข้าใช้งานได้เช่นเดียวกัน</p>
  </li>
  </ul>
  <li><span class="btn btn-small btn-warning disable">เวลาเข้าใช้งาน</span>: ค่าปกติคือ Al (All=ทุกวันไม่จำกัด)
  <p class="important-hlp">การกำหนดวันเวลาใช้งานจะใช้ UUCP(Unix-to-Unix Copy) ซึ่งเป็นอักษรย่อของระบบปฎิบัติการ Unix ข้อบังคับการกำหนดวันเวลาของผู้ใช้งานจะต้องขึ้นต้นด้วยวันหรือวันของสัปดาห์เสมอ Radius จะอ่านวลาจากค่าซ้ายมือไปยังขวามือและบันทึกค่าเวลาที่ได้ลงใน แอททริบิวต์ Session-Timeout ค่ากำหนดของ UUCP คือ <span style="color:red">วันจันทร์= Mo,วันอังคาร= Tu,วันพุธ= We,วันพฤหัสบดี= Th,วันศุกร์= Fr,วันเสาร์= Sa,วันอาทิตย์= Su และวันจันทร์ถึงศุกร์ ค่า = Wk และค่า Any หรือ Al หมายถึง ทุกวัน</span>
  <p>ตัวอย่างการตั้งค่าที่1 หากต้องการให้เข้าใช้งานทุกวันจันทร์-ศุกร์ เวลา 08.00-17.00 และวันเสาร์,อาทิตย์ ไม่จำกัด จะได้:<br/> "Wk0800-1700,Sa,Su" (หากผู้ใช้งานเข้าใช้วันจันทร์เวลา 15.00 จะถูกตัดออกจากระบบตอน 17.00)</p>
  <p>ตัวอย่างการตั้งค่าที่2 หากต้องการให้เข้าใช้งาน วันจันทร์,พุธเวลา 09.00-18.00,วันศุกร์เวลา 06.00-12.00 จะได้:<br/> "Mo,We0900-1800,fr0600-1200"</p>
  <p>ตัวอย่างการตั้งค่าที่3 หากต้องการให้เข้าใช้งานวันจัทร์เวลา 08.00-12.00 และ 15.10-17.30 จะได้:<br/> "Mo0800-1200|1510-1730"</p>
  </p>
  </li>
  <li><span class="btn btn-small btn-warning disable">กำหนดค่า</span>: ค่านี้จะสอดคล้องกับ <span class="btn btn-small btn-warning disable">โปรไฟล์</span> ที่ท่านเลือกสร้างขึ้นมา</li>
	  <ul>
      <li>หากคุณกำหนดค่านี้เป็น <span class="btn btn-small btn-primary disable">จำนวนวันใช้งาน</span> ค่านี้จะหมายถึงวันใช้งานที่ผู้ใช้งานในกลุ่มนี้ได้รับ</li>
      <li>หากคุณกำหนดค่านี้เป็น <span class="btn btn-small btn-primary disable">"ข้อมูล(MB)"</span>  ค่านี้จะหมายถึงจำนวนค่าอัพโหลด+ดาวน์โหลด สูงสุดที่ผู้ใช้งานจะได้รับ</li>
      <li>หากคุณกำหนดค่านี้เป็น <span class="btn btn-small btn-primary disable">"ข้อมูล(MB)/วัน"</span> ค่านี้จะหมายถึงจำนวนค่าอัพโหลด+ดาวน์โหลดสูงสุดที่ผู้ใช้งานจะได้รับและมีเวลาใช้งาน 24 ชั่วโมงคิดตามจริงเป็นวินาที</li>
      <li>หากคุณกำหนดค่านี้เป็น <span class="btn btn-small btn-primary disable">"ข้อมูล(MB)/เดือน"</span> ค่านี้จะหมายถึงจำนวนค่าอัพโหลด+ดาวน์โหลดสูงสุดที่ผู้ใช้งานจะได้รับและมีเวลาใช้งาน 30 วันคิดตามจริงเป็นวินาที</li>
      <li>หากคุณกำหนดค่านี้เป็น <span class="btn btn-small btn-primary disable">"ชั่วโมง"</span> ค่านี้จะหมายถึงจำนวนชั่วโมงที่ผู้ใช้งานจะได้รับและใช้งานได้จนกว่าจะหมดเวลาการใช้งาน</li>
      <li>หากคุณกำหนดค่านี้เป็น <span class="btn btn-small btn-primary disable">"ชั่วโมง/ครั้ง"</span> ค่านี้จะหมายถึงจำนวนชั่วโมงที่ผู้ใช้งานจะได้รับและใช้งานได้จนกว่าจะหมดเวลาการใช้งานต่อการเข้าระบบ 1 ครั้ง</li>
      <li>หากคุณกำหนดค่านี้เป็น <span class="btn btn-small btn-primary disable">"ชั่วโมง/วัน"</span> ค่านี้จะหมายถึงจำนวนชั่วโมงที่ผู้ใช้งานจะได้รับต่อวัน(24 ชั่วโมง)</li>
      <li>หากคุณกำหนดค่านี้เป็น <span class="btn btn-small btn-primary disable">"ชั่วโมง/เดือน"</span> ค่านี้จะหมายถึงจำนวนชั่วโมงที่ผู้ใช้งานจะได้รับต่อเดือน(30 วัน)</li>
      </ul>
  <li><span class="btn btn-small btn-warning disable">ราคา</span>: ราคาของแพ็คเกจนี้</li>
  <li><span class="btn btn-small btn-warning disable">ดาวน์โหลด</span>: ค่าดาวน์โหลดสูงสุดของกลุ่มนี้ ค่า 0 ไม่จำกัด</li>
  <li><span class="btn btn-small btn-warning disable">อัพโหลด</span>: ค่าอัพโหลดของกลุ่มนี้ ค่า 0 ไม่จำกัด</li>
  <li><span class="btn btn-small btn-warning disable">ตัดการเชื่อมต่อเมื่อไม่ใช้งาน</span>: หรือ Idle Timeout เมื่อผู้ใช้งานไม่มีการเชื่อมต่อหรือไม่มีการร้องขอสิ่งใดๆระบบจะตัดการเชื่อมต่อผู้ใช้งานตามเวลาที่กำหนด</li>
  <li><span class="btn btn-small btn-warning disable">จำนวนเครื่องที่ใช้งาน</span>: จำนวนเครื่องที่ผู้ใช้งานกลุ่มนี้จะสามารถใช้งานได้พร้อมกัน </li>
  <li><span class="btn btn-small btn-warning disable">ลำดับวางขาย</span>: ลำดับการแสดงชื่อแพ็คเกจในหน้า User Dashboard สำหรับให้ผู้ใช้งานเลือกซื้อ</li>
  <li><span class="btn btn-small btn-warning disable">รีไดเเร็ค URL </span>: ให้ไปที่ URl ที่ระบุเมื่อเข้าสู่ระบบสำเร็จ</li>
</ul>
</p>
<hr/>
</div>