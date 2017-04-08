<?php echo $site_name; ?> ยินดีต้อนรับ,

<?php echo $site_name; ?> ขอบคุณสับหรับการลงทะเบียน. ให้คุณเก็บ ลายละเอียดการลงทะเบียนอยู่ในรายการด้านล่าง ในที่ปลอดภัย
เพื่อยืนยันที่อยู่อีเมลของคุณโปรด คลิกที่ลิงค์นี้:

<?php echo site_url('/admin/login/'); ?>

<?php if (strlen($username) > 0) { ?>

ชื่อผู้ใช้ของคุณ: <?php echo $username; ?>
<?php } ?>

ที่อยู่อีเมลของคุณ: <?php echo $email; ?>

<?php /* Your password: <?php echo $password; ?>

*/ ?>

ขอขอบคุณ,
จากทีม <?php echo $site_name; ?>