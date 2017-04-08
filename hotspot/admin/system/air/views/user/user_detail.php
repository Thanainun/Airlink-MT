<div style="min-height:145px">
	<div style="float:left;">
		<div style="height:48px;whdth:48px;"><img width="110px" height="120px" src="http://s269.photobucket.com/albums/jj72/myem0/001/blythe/blythe-003.gif" /></div>
		<div style="padding-left:140px;margin-top:-50px;width:250px;">
			<table width="100%">
				<tr>
					<td width="15%">ชื่อ</td>
					<td>-</td>
				</tr>
				<tr>
					<td>-</td>
					<td></td>
				</tr>
				<tr>
					<td>-</td>
					<td></td>
				</tr>
				<tr>
					<td>-</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<hr/>
<table width="100%" class="sample">
	<?php $count = 0; foreach($detail as $lb=>$data) : ?>
	<?php $count++; ($count % 2 != 0) ? $bgcolor = "#FFFFFF" : $bgcolor = "#F6F6F6";  ?>
	<tr bgcolor="<?= $bgcolor ?>"><td width="35%"><?=$this->lang->line('popup_'.$lb)?></td><td>:</td><td><?=$data?></td></tr>
	<?php endforeach; ?>
</table>