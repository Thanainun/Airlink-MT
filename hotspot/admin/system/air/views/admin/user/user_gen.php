<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

							<div class="panel">
                            <table class="paginate sortable full">
                                <thead>
                                    <tr>
										<th class="ckbox">No.</th>
										<th><?=$this->lang->line('user_table_username')?></th>
										<th><?=$this->lang->line('user_print_password')?></th>
										<th><?=$this->lang->line('user_table_group')?></th>
										<th><?=$this->lang->line('user_table_expir')?></th>
                                    </tr>
                                </thead>
                                <tbody id="username_table">
									<?  $count = 1;
										foreach ($stack as $value): ?>
										<tr>
											<td align="center"><?=$count++?></td>
											<td align="center"><?=$value['username']?></td>
											<td align="center"><?=$value['password']?></td>
											<td align="center"><?=$value['group']?></td>
											<td align="center"><?=$value['expir']?></td>
										</tr>
										<?php endforeach;?>
                                </tbody>
                            </table>
							</div>
