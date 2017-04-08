<?php
// connect to mysql parameters
//$host = 'localhost';
$host = '127.0.0.1';
$username = 'root';
$password = '123456789000';

// connect to mysql server
$connection = mysql_connect($host, $username, $password)
        or die("Unable to connect to the MySQL Server!");
// select database syslogng
mysql_select_db('air_db', $connection) or die(mysql_error($connection));

// Delete statement
$delete_query = 'DELETE FROM logs  WHERE `logs`.`datetime`  < (NOW() - INTERVAL 100 DAY)';
$delete_query = 'DELETE FROM radacct  WHERE `radacct`.`acctstarttime`  < (NOW() - INTERVAL 100 DAY)';
$delete_query = 'DELETE FROM radpostauth  WHERE `radpostauth`.`authdate`  < (NOW() - INTERVAL 100 DAY)';

if (!mysql_query($delete_query, $connection)) {
    echo "Can't delete from logs table: " . mysql_error($connection);
} else {
    echo "You have successfully deleted logs From air_db.logs";
}

// close connection
mysql_close($connection);

?>