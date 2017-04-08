<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>



			<div class="span7">
                <div class="widget_heading"><h4>จำกัดการเข้าใช้งานและความเร็วด้วย Squid</h4></div>
                <div class="widget_container">
                <?
							$first = $trt['0'];
$memperc = ($first['free-memory']/$first['total-memory']);
$hddperc = ($first['free-hdd-space']/$first['total-hdd-space']);
$mem = ($memperc*100);
$hdd = ($hddperc*100);
echo "Mikrotik RouterOs 4.16 Resources";
echo "<br />";
echo "<table width=550 border=0 align=center>";

echo "<tr><td>Platform, board name and Ros version is:</td><td>" . $first['platform'] . " - " . $first['board-name'] . " - "  . $first['version'] . " - " . $first['architecture-name'] . "</td></tr><br />";
echo "<tr><td>Cpu and available cores:</td><td>" . $first['cpu'] . " at " . $first['cpu-frequency'] . " Mhz with " . $first['cpu-count'] . " core(s) "  . "</td></tr><br />";
echo "<tr><td>Uptime is:</td><td>" . $first['uptime'] . " (hh/mm/ss)" . "</td></tr><br />";
echo "<tr><td>Cpu Load is:</td><td>" . $first['cpu-load'] . " %" . "</td></tr><br />";
echo "<tr><td>Total,free memory and memory % is:</td><td>" . $first['total-memory'] . "Kb - " . $first['free-memory'] . "Kb - " . number_format($mem,3) . "% </td></tr><br />";
echo "<tr><td>Total,free disk and disk % is:</td><td>" . $first['total-hdd-space'] . "Kb - " . $first['free-hdd-space'] . "Kb - " . number_format($hdd,3) . "% </td></tr><br />";
echo "<tr><td>Sectors (write,since reboot,bad blocks):</td><td>" . $first['write-sect-total'] . " - " . $first['write-sect-since-reboot'] . " - " . $first['bad-blocks'] . "% </td></tr><br />";

echo "</table>";

echo "<br />";
echo "<br />";
echo "<br />";



   ?>
								<hr />
                                </div>
                   			 </div>
                             <div class="span5">
                    <div class="widget_heading"><h4>เกร็ดความรู้</h4></div>
                <div class="widget_container">
              	การตั้งค่าและเปลี่ยนแปลงค่าของ Proxy จะมีผลทันที ที่คุณบันทึกค่าโดยไม่ต้องใช้คำสั่งเพิ่มเติมใดๆ <br/>
                การจำกัดความเร็วดาวน์โหลดไฟล์ที่ 128Kb/s หมายความว่า ผู้ใช้งานของคุณจะสามารถดาวน์โหลดไฟล์นั้นๆ ได้ที่ความเร็วสูงสุด 128Kb/s ต่อ 1 คน จากความเร็วสูงสุดของเน็ตเวิร์คที่ 7Mb/s หากในเวลานั้นมีผู้ใช้งานโหลดข้อมูลพร้อมกันเกินกำหนดระบบจะลดหย่อนความเร็วลงไปเรื่อยๆ ไม่ให้เกิน 7Mb/s  
                
                </div>
                </div>
		
								<div class="span7">
                                 <div class="widget_heading"><h4>บล็อกเว็บ Bittorrent</h4></div>
                                <div class="widget_container">
								<button type="submit" class="button button-blue" >บันทึก</button>
                                </div>
                                </div>
								
						
				

