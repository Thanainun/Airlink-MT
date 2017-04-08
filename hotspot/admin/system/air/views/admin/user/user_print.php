<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $voucher = $voucher->row(); ?>

<?
		switch ($voucher->profile) {
			case "time":
				$packunit = $this->lang->line('date_hour');
			break;
			case "timetofinish":
				$packunit = $this->lang->line('date_day');
			break;
			case "packets":
				$packunit = $this->lang->line('megabyte_abbr');
			break;
		}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table width=300px bgcolor="#eef8f8">
	<tr><td align='center'>
	<?=$this->config->item('company_name')?><br />
	<?=$this->config->item('company_address_line1')?><br />
	<?=$this->config->item('company_address_line2')?><br />
	<?=$this->config->item('company_address_line3')?><br />
	<?=$this->config->item('company_phone')?><br />
	<?=$this->config->item('company_tax_code')?>
	<hr />
	</td></tr>
	<tr>
		<td>
			<table width=100%>
			<tr><td width=50%><?=$this->lang->line('user_print_username')?></td><td>: <?=$voucher->username?></td></tr>
			<tr><td><?=$this->lang->line('user_print_password')?></td><td>: <?=$voucher->password?></td></tr>	
			<tr><td><?=$this->lang->line('user_print_billing_plans')?></td><td>: <?=$voucher->billingplan?></td></tr>
			<tr><td><?=$this->lang->line('user_print_valid')?></td><td>: <?=$voucher->amount?> <?=$packunit ?></td></tr>
			<tr><td><?=$this->lang->line('user_print_valid_until')?></td><td>: <?=preg_replace('/24:00:00/', '', $voucher->valid_until)?> </td></tr>
			<tr><td><?=$this->lang->line('user_print_price')?></td><td>: <?=number_format($voucher->price,$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?> <?=$this->config->item('currency_symbol_pdf')?></td></tr>
			</table>
		</td>
	</tr>
	<tr>
		<td ><hr /><?=$this->config->item('access_instructions')?></td>
	</tr>
	<tr>
		<td align='center'><hr /><?=unix_to_human(time())?></td>
	</tr>
	<tr>
		<td align='center'><?=$this->lang->line('user_print_thanks')?></td>
	</tr>
</table>
</body>
</html>
		
