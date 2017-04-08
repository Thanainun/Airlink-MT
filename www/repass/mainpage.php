<?php
if (empty($actions)) {
    $actions = "frmlogin";
}
switch ($actions) {
    case "frmlogin":
        if (!empty($_SESSION["id"])) {
            ?>
            <div class="tabbable  " style="">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">ข้อมูลผู้ใช้งาน</a></li>
                    <li><a href="#tab2" data-toggle="tab">เปลี่ยนรหัสผ่าน</a></li>
                </ul>
                <div class="tab-content" style=" border-bottom: 0px solid #ddd;">
                    <div class="tab-pane active" id="tab1">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th colspan="2">.:: ข้อมูลผู้ใช้งาน ::.</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        ชื่อผู้ใช้งาน
                                    </td>
                                    <td>
                                        <strong><?= $_SESSION["username"] ?> </strong>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        แพ็คเกจ
                                    </td>
                                    <td>
                                        <strong><?= $_SESSION["billingplan"] ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        หมดอายุแพ็คเกจ
                                    </td>
                                    <td>
                                        <strong><?php
                                            list($da, $ta) = explode("T", $_SESSION["valid_until"]);
                                            echo displaydate($da) . " เวลา " . $ta . " น.";
                                            ?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <form name="form1" method="post" class="control-group" action="index.php?actions=savepass">
                            <table class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th colspan="2">.:: แก้ไขรหัสผ่านใหม่ของคุณ! ::.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            UserID
                                        </td>
                                        <td>
                                            <strong>NTP WiFi 10<?= $_SESSION["id"] ?> </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ชื่อผู้ใช้งาน
                                        </td>
                                        <td>
                                            <strong><?= $_SESSION["username"] ?> </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ใส่รหัสผ่านใหม่
                                        </td>
                                        <td>
                                            <strong><input class="input-large" name="txtPassword" type="password" id="txtPassword" value="<?= $_SESSION["password"] ?>"></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ใส่รหัสผ่านใหม่อีกครั้ง
                                        </td>
                                        <td>
                                            <strong><input class="input-large" name="txtConPassword" type="password" id="txtConPassword" value="<?= $_SESSION["password"] ?>"></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            แพ็จเกจของคุณ
                                        </td>
                                        <td>
                                            <strong><?= $_SESSION["billingplan"] ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="submit" name="Submit" value="Save | เปลี่ยนรหัสผ่าน" class="btn btn-success">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
 
            <a href="logout.php" class="btn btn-danger">Logout | ออกจากระบบ</a> <hr>
            <?php
        } else {
            ?>
            <form action="index.php?actions=checklogin" method="post" name="frmmylogin" id="frmmylogin" class="form-horizontal" onsubmit="return Chkfrm();">
                
<table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th colspan="2">.:: ข้อมูลผู้ใช้งาน ::.</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Username : 
                                    </td>
                                    <td>
                                        <input class="input-xlarge" name="txtUsername" type="text" id="txtUsername">
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        Password : 
                                    </td>
                                    <td>
                                        <input class="input-xlarge" name="txtPassword" type="password" id="txtPassword">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="submit" name="Submit" value="Login | ลงชื่อเข้าใช้" class="btn btn-primary">
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
						

				 

            </form>
            <script language="JavaScript">
                <!--
                function resetForm() {
                    document.frmmylogin.reset();
                    var obj6 = document.frmmylogin.username;
                    obj6.focus();
                }

                function Chkfrm()
                {
                    var obj1 = document.frmmylogin.txtUsername;
                    var obj2 = document.frmmylogin.txtPassword;

                    if (obj1.value.length == 0) {
                        alert('กรอก User');
                        obj1.focus();
                        return false;
                    } else if (obj2.value.length == 0) {
                        alert('กรอก Password');
                        obj2.focus();
                        return false;
                    }
                }
                //-->
            </script>

			     <!-- FEATURES -->
                    <ul id="features">
                        <li>เปลี่ยนรหัสผ่านบัญชี LabCom Hotspot ของคุณ</li>
                        <li>ลงชื่อเข้าใช้ เพื่อเปลี่ยนรหัสผ่าน</li>
                        <li>หากจำรหัสผ่านเก่าไม่ได้ จะไม่สามารถเปลี่ยนรหัสได้</li>
                        <li>ติดต่อผู้ดูแลระบบ ครูวรวัฒ กองสิงห์</li>
                    </ul>
            <?php
        }
        break;
    case "checklogin":
        $uname = empty($_REQUEST['txtUsername']) ? "" : mysql_real_escape_string(trim($_REQUEST['txtUsername']));
        $upass = empty($_REQUEST['txtPassword']) ? "" : mysql_real_escape_string(trim($_REQUEST['txtPassword']));

        if (empty($uname) OR empty($upass)) {
            echo"<script>alert('Empty');window.location='index.php';</script>";
            exit();
        }

        $query = mysql_query("SELECT * FROM voucher WHERE username='" . $uname . "' AND password='" . $upass . "'");
        if (!$query) {
            echo mysql_error();
            exit();
        }
        $ns = mysql_num_rows($query);
        if ($ns) {
            $r = mysql_fetch_assoc($query);
            $uid = $r['id']; #id user
            $cn = $r['username']; #username
            $cp = $r['password']; #password
            $cb = $r['created_by']; #password
            $blp = $r['billingplan']; #billingplan
            $vlu = $r['valid_until']; #valid_until
#check if return = 0 is ok
            $valid_user = strcmp($uname, $cn);
            $valid_pass = strcmp($upass, $cp);

            if ($valid_user != 0 || $valid_pass != 0) {
                echo"<script>alert('Username หรือ Password :  ไม่ถูกต้อง!');window.location='index.php';</script>";
                exit();
            } else {
                $_SESSION["id"] = $uid;
                $_SESSION["username"] = $cn;
                $_SESSION["password"] = $cp;
                $_SESSION["created_by"] = $cb;
                $_SESSION["billingplan"] = $blp;
                $_SESSION["valid_until"] = $vlu;
                echo"<script>window.location='index.php';</script>";
                exit();
            }
        } else {
            echo"<script>alert('Username หรือ Password :  ไม่ถูกต้อง!');window.location='index.php';</script>";
        }
        break;
    case "savepass":
        $p1 = empty($_REQUEST['txtPassword']) ? "" : mysql_real_escape_string(trim($_REQUEST['txtPassword']));
        $p2 = empty($_REQUEST['txtConPassword']) ? "" : mysql_real_escape_string(trim($_REQUEST['txtConPassword']));
		if(strcmp($p1, $p2) !=0){
			    echo"<script>alert('พาสเวิร์ดไม่ตรงกัน!');window.location='index.php';</script>";
                exit();
		}else{
		
		$udp = mysql_query("UPDATE voucher SET password='".$p1."' WHERE id='".$_SESSION["id"]."'");
		if(!$udp){
			echo "ไม่สามารถเปลี่ยนพาสเวิร์ดได้ ".mysql_error();
			exit();
		}

		$udp2 = mysql_query("UPDATE radcheck SET value='".$p1."' WHERE username='".$_SESSION["username"]."' AND attribute='Password'");
		if(!$udp2){
			echo "ไม่สามารถเปลี่ยน radcheck ได้ ".mysql_error();
			exit();
		}
	    echo"<script>alert('เปลี่ยนพาสเวิร์ดเรียบร้อย!');window.location='index.php';</script>";
               exit();			  
		}         
        break;
}
?>