<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo $site_name; ?> ยินดีต้อนรับ</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">ยินดีต้อนรับสู่ <?php echo $site_name; ?>!</h2>
ขอบคุณสับหรับการลงทะเบียนกับ <?php echo $site_name; ?>. ให้คุณเก็บ ลายละเอียดการลงทะเบียนอยู่ในรายการด้านล่าง ในที่ปลอดภัย.<br />
เพื่อยืนยันที่อยู่อีเมลของคุณโปรดไปที่ลิงค์นี้:<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/admin/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;">เสร็จสิ้นการลงทะเบียนของคุณ...</a></b></big><br />
<br />
หากไม่สามารถคลิกลิ้งค์นี้ได้ ให้คัดลอกลิ้งค์ ไปวางในแถบ Address ของบราวเซอร์:<br />
<nobr><a href="<?php echo site_url('/admin/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/admin/activate/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
โปรดตรวจสอบอีเมลของคุณภายใน <?php echo $activation_period; ?> ชั่วโมง, มิฉะนั้นการลงทะเบียนของคุณจะถูกยกเลิกและคุณจะต้องลงทะเบียนอีกครั้ง<br />
<br />
<br />
<?php if (strlen($username) > 0) { ?>ชื่อผู้ใช้ของคุณ: <?php echo $username; ?><br /><?php } ?>
ที่อยู่อีเมลของคุณ: <?php echo $email; ?><br />
<?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
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