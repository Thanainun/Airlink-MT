<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
/* @var $link PDO */
//$link->
require_once 'include/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Airlink Clear User</title>

        <!-- Bootstrap -->
        <link href="../../../assetsc/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="padding-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <header>
                        <h1 align='center'>
                           <a href="../../../assetsc/css/bootstrap.min.css">ลบข้อมูลที่หมดอายุตามกลุ่มและเวลาที่กำหนด<br></a>
                            <small>หลักการจะลบ User ที่หมดอายุ และ จำนวนเงินเหลือ 0 บาท เท่านั้น</small>
                        </h1>
                    </header>
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Group Name</label>
                            <div class="col-sm-10">
                                <select name="groupname" id="groupname" class="form-control">
                                    <?php
                                    if (!empty($_POST['groupname'])) {
                                        ?>
                                        <option value="<?php echo $_POST['groupname'] ?>"><?php echo $_POST['groupname'] ?></option>
                                        <?php
                                    }
									//$group = $link->prepare("SELECT billingplan.id, billingplan.`name`, billingplan.groupname FROM billingplan where billingplan.groupname<>20150817000433 AND billingplan.groupname<>20150817000434");
                                    $group = $link->prepare("SELECT billingplan.id, billingplan.`name`, billingplan.groupname FROM billingplan where billingplan.groupname<>20150817000433 ORDER BY billingplan.`name`");
                                    $group->execute();
                                    while ($grouprow = $group->fetch()) { 
                                        if (empty($_POST['groupname'])) { 
                                            ?>
                                            <option value="<?php echo $grouprow['name'] ?>"><?php echo $grouprow['name'] ?></option>
                                            <?php
                                        } else {
                                            if ($_POST['groupname'] != $grouprow['name']) {
                                                ?>
                                                <option value="<?php echo $grouprow['name'] ?>"><?php echo $grouprow['name'] ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">ลบข้อมูลหลังจาก/วัน</label>
                            <div class="col-sm-10">
                                <?php
                                if (!empty($_POST['expire'])) {
                                    ?>
                                    <input type="number" class="form-control" id="expire" name="expire" placeholder="กรุณาใส่จำนวนวัน" value="<?php echo $_POST['expire'] ?>" required="">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" class="form-control" id="expire" name="expire" min="1" placeholder="กรุณาใส่จำนวนวัน" value="90" required="">
                                    <?php
                                }
                                ?>


                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-primary" name="button" value="view"/>
                                <input type="submit" class="btn btn-danger" name="button" value="delete"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if (!empty($_POST['groupname']) && !empty($_POST['expire'])) {
                $success = 0;
                $resultArray = array();                
				$show = $link->prepare("SELECT voucher_list.id,voucher_list.username,voucher_list.stop_time,voucher_list.valid,voucher_list.money,voucher_list.billingplan FROM voucher_list WHERE voucher_list.stop_time IS NOT NULL AND voucher_list.valid = 'exp' AND voucher_list.money = 0 AND voucher_list.billingplan = :BILLING AND  voucher_list.stop_time <= (NOW() - INTERVAL :DATE DAY) ORDER BY voucher_list.stop_time");
                $show->bindValue(":BILLING", $_POST['groupname'], PDO::PARAM_STR);
                $show->bindValue(":DATE", $_POST['expire'], PDO::PARAM_INT);
                $show->execute();
                while ($showrow = $show->fetch()) {
                    switch ($_POST['button']) {
                        case 'delete':
                            try {
                                $link->beginTransaction();
                                $username = $showrow['username'];
                                $link->exec("DELETE FROM radacct WHERE username = '$username'");
                                $link->exec("DELETE FROM radcheck WHERE username = '$username'");
                                $link->exec("DELETE FROM radpostauth WHERE username = '$username'");
                                $link->exec("DELETE FROM radreply WHERE username = '$username'");
                                $link->exec("DELETE FROM radusergroup WHERE username = '$username'");
                                $link->exec("DELETE FROM topup_queue WHERE username = '$username'");
                                $link->exec("DELETE FROM voucher WHERE username = '$username'");
                                $link->commit();
                            } catch (PDOException $e) {
                                $link->rollBack();
                                echo $e->getMessage();
                            }
                            break;
                        case 'view':
                            break;
                    }
                    array_push($resultArray, $showrow);
                }
            }
            ?>
            <?php
            if (!empty($_POST['groupname']) && !empty($_POST['expire'])) {
                //print_r($resultArray);
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-condensed table-hover table-responsive table-striped text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Plan</th>
                                    <th class="text-center">วันที่ใช้งานล่าสุด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($resultArray as $result) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $result['username']; ?></td>
                                        <td><?php echo $result['billingplan']; ?></td>
                                        <td><?php echo date("d/m/Y H:i:s", strtotime($result['stop_time'])); ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../../../assetsc/js/bootstrap.min.js"></script>
    </body>
</html>
