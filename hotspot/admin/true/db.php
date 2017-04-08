<?php if ($_SERVER['REMOTE_ADDR']== '203.146.127.115' || 'www.tmtopup.com' && isset($_GET['request']))
{
$db['hostname'] = 'localhost';
$db['username'] = 'root';
$db['password'] = 'duydui190930';
$db['database'] = 'air_db';
}
else {echo 'No direct script access allowed';}
?>
