<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

	function freeradius_disconnectuser($username, $radiuscommand, $radiusserver, $radiussecret)
	{
		$ci =& get_instance();
		$result = "/bin/echo Framed-IP-Address=$username | $radiuscommand $radiusserver disconnect $radiussecret";
		$ci->db->query("UPDATE radacct SET acctstoptime=now(), acctterminatecause='Force Disconnect' WHERE framedipaddress = '$username' and acctstoptime is NULL");
		return shell_exec($result);
	}
	
	function freeradius_auth($options=array(),$user,$pass, $radiuscommand,$radiusserver,$secret,$command="auth",$additional="")
	{

		$user = escapeshellarg($user);
		$pass = escapeshellarg($pass);

		$args = escapeshellarg("$radiusserver")." ".escapeshellarg($command).
			" ".escapeshellarg($secret);
		$query = "User-Name=$user,User-Password=$pass";


		$radclient_options = "-c ".escapeshellarg($options['count']).
					" -n ".escapeshellarg($options['requests']).
					" -r ".escapeshellarg($options['retries']).
					" -t ".escapeshellarg($options['timeout']);

		$cmd = "echo \"$query\" |  $radiuscommand $radclient_options $args 2>&1";
		$print_cmd = "<div class=\"ui-state-highlight ui-corner-all\"><b>Executed:</b><br/>$cmd<br/></div><br/>
		<div class=\"ui-state-highlight ui-corner-all\"><b>Results:</b><br/>";
		$res = shell_exec($cmd);
		

		if ($res == "") {
			return "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\"><b><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span><strong>Error:</strong> Command did not return any results</b></div>";
		}

		// todo better layout
		$output_html = nl2br($res);
		$output_html = str_replace('rad_recv:','</div><br/><div class="ui-state-highlight ui-corner-all"><b>Rad recive:</b><br/>',$output_html).'</div>';
		$output_html = str_replace('Access-Accept',' <span style="color: #7F7FFF;">Access-Accept</span>',$output_html);
		$output_html = str_replace('Access-Reject',' <span style="color: #FF7F7F;">Access-Reject</span>',$output_html);
		
		return $print_cmd . $output_html;
		
	}

?>
