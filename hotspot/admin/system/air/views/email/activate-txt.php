<?php echo $site_name; ?> ยินดีต้อนรับ

<?php echo $site_name; ?> ขอบคุณสับหรับการลงทะเบียน. ให้คุณเก็บ ลายละเอียดการลงทะเบียนอยู่ในรายการด้านล่าง ในที่ปลอดภัย
เพื่อยืนยันที่อยู่อีเมลของคุณโปรด คลิกที่ลิงค์นี้:

<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>


โปรดตรวจสอบอีเมลของคุณภายใน <?php echo $activation_period; ?> ชั่วโมง, มิฉะนั้นการลงทะเบียนของคุณจะถูกยกเลิกและคุณจะต้องลงทะเบียนอีกครั้ง
<?php if (strlen($username) > 0) { ?>

ชื่อผู้ใช้ของคุณ: <?php echo $username; ?>
<?php } ?>

ที่อยู่อีเมลของคุณ: <?php echo $email; ?>
<?php if (isset($password)) { /* ?>

Your password: <?php echo $password; ?>
<?php */ } ?>



ขอขอบคุณ จาก, <?php echo $site_name; ?> Team