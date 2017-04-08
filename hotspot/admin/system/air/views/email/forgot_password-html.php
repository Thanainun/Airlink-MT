<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>เปลี่่่ยนรหัสผ่านใหม่ <?php echo $site_name; ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">เปลี่่่ยนรหัสผ่านใหม่</h2>
หากคุณลืมรหัสผ่าน<br />
เปลี่่่ยนรหัสผ่านใหม่เพียงทำตามลิงค์นี้:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/admin/reset_password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;">เปลี่่่ยนรหัสผ่านใหม่</a></b></big><br />
<br />
หากไม่สามารถคลิกลิ้งค์นี้ได้ ให้คัดลอกลิ้งค์ ไปวางในแถบ Address ของบราวเซอร์:<br />
<nobr><a href="<?php echo site_url('/admin/reset_password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;"><?php echo site_url('/admin/reset_password/'.$user_id.'/'.$new_pass_key); ?></a></nobr><br />
<br />
<br />
คุณได้รับ อีเมล์ ฉบับนี้, เนื่องจากผู้ใช้ในระบบ <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a> ร้องขอการเปลี่ยน ที่อยู่อีเมล์ใหม่. หากคุณได้รับโดยไม่ได้เป็นผู้ร้องขอเปลี่ยนที่อยู่ อีเมล์, กรุณาอย่าคลิก หรือ อย่าทำการยืนยันตามลิ้งค์, และลบอีเมล์นี้ออกจากกล่องจดหมายได้ทันที,และคำขอเปลี่ยนอีเมล์ จะถูกลบออกจากระบบ.<br />
<br />
<br />
ขอขอบคุณ,<br />
จากทีมงาน <?php echo $site_name; ?>
</td>
</tr>
</table>
</div>
</body>
</html>