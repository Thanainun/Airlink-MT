<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

						<div style="height:200px">
                            <?=form_open('admin/userform/gen','id="gen_form" class="form"')?>
                                <table>
                                    <tr>
                                        <td><label><?=$this->lang->line('user_form_gen_number')?></label></td><td><?=form_input(array('name'=>'numberofvoucher','class'=>'validate[required,custom[onlyNumberSp],maxSize[4],max['.$max.']] text-input','id'=>'numberofvoucher'))?></td>
										<td></td>
									</tr>
									<tr>
                                        <td><label><?=$this->lang->line('user_form_gen_group')?></label></td><td><?=form_dropdown("billingplan", $plan, '','id="billingplan" class="validate[required]"')?></td>
                                         
										<td></td>
									</tr>
                                    
                                   
                                    <tr>
										<td><label>&nbsp;</label></td><td><?=form_checkbox('exp_pdf', '1',TRUE) . ' &nbsp;'.$this->lang->line('user_form_gen_export')?></td>
										<td></td>
									</tr>
									
                                </table>
							<?=form_close()?>
						</div>