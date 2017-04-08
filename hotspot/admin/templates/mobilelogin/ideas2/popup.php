
<script>
$(function() {
		$( "#tabs" ).tabs();

	$("#oklungtung").fancybox({
		'width'				: '60%',
		'height'			: '60%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});

	$("#oklove").fancybox({
		'width'				: '95%',
		'height'			: '95%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});

	$("#okhook").fancybox({
		'width'				: '62%',
		'height'			: '72%',
		'autoScale'			: false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});

});
</script>

<div id="tabs" style="height:98%; text-align:left; overflow:auto;">
	<ul>
		<li><a href="#tab1">เวลาใช้งาน</a></li>
		<li><a href="#tab2">ข้อมูล</a></li>
		<li><a href="#tab3">เปลี่ยนรหัส</a></li>
		<li><a href="#tab4">แจ้งปัญหา</a></li>
		<li><a href="#tab5">โปรโมชั่น</a></li>
	</ul>
	<div id="tab5">
			<!--mmo_notice-->
		<div class="popup_notice">
			<h3 class="nodis">news&amp;notice</h3>
			<div rel="reply"></div>
			<div rel="dynamic_content" class="mmo_notice_bd" style="height:65px; padding-top:5px;">
				<!-- ---- ข้อความระบบ ---- -->
			</div>
			
		</div>
	</div>
	
	<div id="tab1">
		<div align="center" style="height:75px;">
			<div class="m_form">
				<table><tr><td align="center">
				<div class="mmo_txt"> 		เพ็คเก็ตปัจจุบัน <div rel="plan_name"> </div>  </div> 
				<div id='time_count' class="mmo_txt countdown_section">กำลังตรวจสอบข้อมูล<br/>..กรุณารอสักครู่..</div></td></tr></table><br/>
				 <div class="mmo_txt"> ใช้ได้ถึงวันที่<div rel="end_time"></div>  </div>  
			<div> การใช้ข้อมูลรวม <a rel="total_traff"></a></div>
			</div>
			
			
			
		</div>
		<!--mmo_notice-->
		<div class="popup_notice">
			<h3 class="nodis">news&amp;notice</h3>
			<div ></div>
			<div  class="mmo_notice_bd" style="height:65px; padding-top:40px;">
				<!-- ---- ข้อความระบบ ---- -->
			</div>
			{popup_content}
		</div>
	</div>
	
	<div id="tab2">
		<div style="min-height:145px">
			<div style="float:left;">
				<div style="height:48px;whdth:48px;"><img width="110px" height="120px" rel="pic_upload" src="" /></div>
				<div style="padding-left:140px;margin-top:-50px;width:250px;">
					<table width="100%">
						<tr>
							<td width="35%">ชื่อผู้ใช้</td>
							<td><div rel="userName"></div></td>
						</tr>
						<tr>
							<td>ชื่อจริง</td>
							<td><div rel="firstname"></div></td>
						</tr>
						<tr>
							<td>นามสกุล</td>
							<td><div rel="lastname"></div></td>
						</tr>
						<tr>
							<td>ชื่อเล่น</td>
							<td><div rel="surename"></div></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<hr/>
		<table width="100%" class="sample">
			<tr>
				<td width="35%">วันเริ่มใช้งาน</td><td><div rel="start_time"></div></td>
			</tr>
			<tr>
				<td>วันหมดอายุ</td><td><div rel="end_time"></div></td>
			</tr>
			<tr>
				<td>ข้อมูลดาวน์โหลด</td><td><div rel="downLoad"></div></td>
			</tr>
			<tr>
				<td>ข้อมูลอัพโหลด</td><td><div rel="upLoad"></div></td>
			</tr>
			<tr>
				<td>ข้อมูลรวม</td><td><div rel="total_traff"></div></td>
			</tr>
		</table>
	</div>
	
	<div id="tab3"> <div rel="passform"></div> </div>
	
	<div id="tab4"> <div rel="contractform"></div> </div>

</div>

<div id="error_msg" rel="error_msg"><img width="16px" height="16px" src="/hotspot/assets/images/alert_msg.jpg"/></div>