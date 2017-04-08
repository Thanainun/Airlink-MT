<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>ที่อยู่อีเมลใหม่ของคุณใน <?php echo $site_name; ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">ที่อยู่อีเมลใหม่ของคุณใน <?php echo $site_name; ?></h2>
คุณมีการเปลี่ยนแปลงที่อยู่อีเมลของคุณใน <?php echo $site_name; ?>.<br />
ทำตามที่ลิงค์นี้เพื่อยืนยันที่อยู่อีเมลใหม่ของคุณ:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">ยืนยันอีเมลใหม่ของคุณ</a></b></big><br />
<br />
หากไม่สามารถคลิกลิ้งค์นี้ได้ ให้คัดลอกลิ้งค์ ไปวางในแถบ Address ของบราวเซอร์:<br />
<nobr><a href="<?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
<br />
ที่อยู่อีเมลของคุณ: <?php echo $new_email; ?><br />
<br />
<br />
คุณได้รับ อีเมล์ ฉบับนี้, เนื่องจากผู้ใช้ในระบบ  <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo $site_name; ?></a> ร้องขอการเปลี่ยน ที่อยู่อีเมล์ใหม่. หากคุณได้รับโดยไม่ได้เป็นผู้ร้องขอเปลี่ยนที่อยู่ อีเมล์, กรุณาอย่าคลิก หรือ อย่าทำการยืนยันตามลิ้งค์, และลบอีเมล์นี้ออกจากกล่องจดหมายได้ทันที,และคำขอเปลี่ยนอีเมล์ จะถูกลบออกจากระบบ<br />
<br />
<br />
ขอขอบคุณ<br />
จากทีมงาน <?php echo $site_name; ?>
</td>
</tr>
</table>
</div>
</body>
</html>