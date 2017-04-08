<script>
			$(function(){
				// Datepicker
				$('#datepicker').datepicker().children().show();
				// Datepicker
				$('#datepicker2').datepicker().children().show();
			});
		</script>    


		<? 
		$show="แสดงรายการเติมเวลาทั้งหมด";
		if(isset($get))
		{
			
				if($start !='' && $end != '')
				{
					$show = "แสดงรายการเติมเงินตั้งแต่ วันที่ $start เวลา 00:00:00  ถึึง  วันที่ $end เวลา 23:59:59  ";
					if($start == $end)
					{
						$show = "แสดงรายการเติมเงินประจำวันที่  $start ตั้งแต่ เวลา 00:00:00  ถึึง  เวลา 23:59:59  ";
					}
					
				}			
			
			if($get == 'getm')
			{
				$show = "แสดงรายการเติมเงิน ของเดือนนี้ ";
			}
			if($get == 'getd')
			{
				$show = "แสดงรายการเติมเงิน ของวันนี้ ";
			}
			if($get == 'gety')
			{
				$show = "แสดงรายการเติมเงิน ของปีนี้้ ";
			}
		}


		?>
					<div class="span12">   
 <div class="widget_heading">
	<h4>รายได้ของคุณ</h4></div>
    <div class="widget_container">
					
                    <h4>ข้อมูลสถิติรายได้/การเติมเงิน</h4><?=$show;?>

                        <hr />
							<?=form_open('admin/statistic/index/get')?>
						
							<div class="bt-right">
						
ค้นหา จากวันที่ :
<input id="datepicker" value "$start" name="start"  type="text" id="start"/>
ถึง วันที่ :<input id="datepicker2" value "$end" name="end" type="text" id="end"/>
 <button type="submit" id="refresh" class="btn btn-small btn-primary">ค้นหา</button>
						</div>
						<?=form_close()?>

							<div class="bt-left">
 <?=anchor('admin/statistic/index/getd','วันนี้','class="btn btn-small btn-primary" info="รายการประจำวัน" id="add"')?>
 <?=anchor('admin/statistic/index/getm','เดือนนี้','class="btn btn-small btn-primary" info="รายการประจำเดือน" id="add"')?>
 <?=anchor('admin/statistic/index/gety','ปีนี้','class="btn btn-small btn-primary" info="รายการประจำปี" id="add"')?>
							
						</div>
				


                            <table id="used_list" class="paginate full">
                                <thead>
                                    <tr style="cursor:pointer;">
										<th width="5px">ลำดับ</th>
										<th width="70px">ชื่อผู้ใช้</th>
										<th width="90px" >กลุ่ม</th>
										
										<th width="160px">เริ่มใช้</th>
										<th width="80px">เวลารวม</th>
										<th width="80px">ข้อมูลรวม</th>
										<th width="80px">เติมเวลา[ครั้ง]</th>
										<th width="90px">ราคารวม</th>
                                    </tr>
                                </thead>
								 <tfoot>
									<?php $i=0; $price[0]=0;$price[1]=0;
									foreach ($pp->result() as $row): 
									$price[$i]=$row->p;
									$i++;
									 endforeach;?>
									<tr>
										<td colspan="4"align="right" >ลูกค้าเก่า&nbsp; <?=number_format($price[0],$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?></td>
										<td colspan="2" align="right" >รวมลูกค้าใหม่ &nbsp;<?=number_format($price[1],$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?></td>
										<td  colspan="2"align="right">รวมทั้งหมด &nbsp;<?=number_format($price[0]+$price[1],$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?>  <?=$this->config->item('currency_symbol_pdf')?></td>
									</tr>

									
                                </tfoot>
                                <tbody>
									<tr>
										<td></td>
									</tr>
								</tbody>
                            </table>
						
					</div>
</div>
</div>