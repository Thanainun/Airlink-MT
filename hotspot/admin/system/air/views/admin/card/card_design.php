					<div class="clear">&nbsp;</div>

                    <div class="columns leading">
                        <div class="column grid_5 first">
						
						<?=form_open('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(3),'id="form"')?>
						
							<table class="paginate full">
								<thead>
									<tr>
										<th colspan="2" >เทมเพลตบัตร : <?=$template_name?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center" width="150px">ขนาดบัตร : <?=form_dropdown('paper',array('1'=>'2 X 4[8 ใบ]','2'=>'3 X 7[21 ใบ]'),$page,'id="paper_page"')?></td>
										<td align="right">
											<button name="send" class="button button-orange" type="submit">บันทึก</button>
											<?=anchor('admin/design/example/'.$this->uri->segment(3),'ตัวอย่าง','class="button button-orange go_example" title="แสดงบัตรตัวอย่าง ก่อนพิมพ์" id="iframe_fancybox"')?>
										</td>
									</tr>
									<tr align="center">
										<td style="text-align: top;"  colspan="2" >	
										
										<div id="parent">

											<div id="parent_image">
												<span title="เพิ่มข้อความ" id="addnew" style="position:absolute; background-color:#FFFFFF; opacity: 0.7; cursor:pointer;" class="ui-icon ui-icon-circle-plus"></span>
												<img width="100%" height="100%" id="card_bg" src="<?=$img_url?>" />
												
												<div id="static" class="positionable" style="left: -1000px; top: 0px;">
													<span id="text_tool" class="ui-icon  ui-icon-circle-triangle-e"></span>
													<div class="tooltip" title="กรอบข้อความนี้ ไม่สามารถแก้ไขได้" id="example_text">%USER%</div>
													<input type="hidden" readonly="readonly" class="hidden" value="%USER%" id="text_msg" name="username" size="15"/>
													<?=$username_html?>
												</div>

												<div id="static" class="positionable" style="left: -1000px; top: 0px;">
													<span id="text_tool" class="ui-icon  ui-icon-circle-triangle-e"></span>
													<div class="tooltip" title="กรอบข้อความนี้ ไม่สามารถแก้ไขได้" id="example_text">%PASS%</div>
													<input type="hidden" readonly="readonly" class="hidden" value="%PASS%" id="text_msg" name="password" size="15"/>
													<?=$password_html?>
												</div>

												<?=$custom_html?>

											</div>
											
												<input type="hidden" id="image_input" value="<?=$img_name?>" name="image"/>
											
										</div>

										</td>
									</tr>
								</tbody>
								</tfoot>
									<tr>
										<td width="150px">
											<div id="moniter">ตำแหน่ง X:0, Y:0</div>
										</td>
										<td>
										</td>
									</tr>
								</tfoot>
							</table>	
							
						<?=form_close()?>
						</div>
					</div>

                    <div class="columns leading">
                        <div class="column grid_5 first">
							<head><h3>รูปพื้นหลังบัตร</h3></head> 

							<hr />
							<!-- root element for scrollable -->
							<div class="scroll-pane ui-widget ui-widget-header ui-corner-all">
								<div class="scroll-content">
									<?=$all_img?>
								</div>
								<div class="scroll-bar-wrap ui-widget-content ui-corner-bottom">
									<div class="scroll-bar"></div>
								</div>
							</div>

						</div>
					</div>
