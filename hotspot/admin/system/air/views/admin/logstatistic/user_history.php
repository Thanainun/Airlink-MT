<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->helper('number');  ?>
<?php $datauser = $datauser->row(); ?>

                <!-- Left column/section -->

                <section class="grid_6 first">
                    
                    <div class="columns leading">
                        <div class="grid_3 first">

                            <h4>ข้อมูลบัตร : <?=$datauser->billingplan.' - '.$datauser->price?> บาท</h4>

                            <hr/>

                            <table class="no-style full">
                                <tbody>
                                    <tr>
                                        <td width="40%">กลุ่มผู้ใช้</td>
                                        <td class="al"><a href="#"><?=$datauser->billingplan?></a></td>
                                        <td class="al"></td>
                                    </tr>
                                    <tr>
                                        <td>ประเภท</td>
                                        <td class="al"><? if($datauser->profile=='timetofinish') { echo "นับจากวันเริ่มใช้งาน"; } else if($datauser->profile=='packets') { echo "ปริมาณข้อมูล"; } else if($datauser->profile=='time') { echo "ชั่วโมงใช้งาน"; } else { echo "-"; }?></td>
                                        <td class="al"></td>
                                    </tr>
                                    <tr>
                                        <td>จำนวนวัน หรือข้อมูล</td>
                                        <td class="al"><a href="#"><?=$datauser->amount?></a><? if($datauser->profile=='time') { echo ' ชั่วโมง'; } else if($datauser->profile=='timetofinish') { echo  ' วัน'; } else { echo ' MB'; }?></td>
                                        <td class="al"></td>
                                    </tr>
                                    <tr>
                                        <td>ราคา</td>
                                        <td class="al"><a href="#"><?=$datauser->price?></a></td>
                                        <td class="al"></td>
                                    </tr>
                                    <tr>
                                        <td>วันหมดอายุบัตร</td>
                                        <td class="al"><a href="#"><?=$datauser->valid_until?></a></td>
                                        <td class="al"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="grid_3">

                            <h4>ข้อมูลผู้ใช้ : <?=$datauser->username?></h4>

                            <hr/>

                            <table class="no-style full">
                                <tbody>
                                    <tr>
                                        <td width="40%">สถานะ</td>
                                        <td class="al"><div style="color:green"><?=$datauser->valid?></div></td>
                                        <td class="al" width="5%"><a href="#">X</a></td>
                                    </tr>
                                    <tr>
                                        <td>ชื่อผู้ใช้</td>
                                        <td class="al"><a href="#"><?=$datauser->username?></a></td>
                                        <td class="al"></td>
                                    </tr>
                                    <tr>
                                        <td>รหัสผ่าน</td>
                                        <td class="al"><a href="#"><?=$datauser->password?></a></td>
                                        <td class="al"></td>
                                    </tr>
                                    <tr>
                                        <td>วันเริ่มใช้</td>
                                        <td class="al"><a href="#"><?=($datauser->start_time==null) ? '-' : $datauser->start_time?></a></td>
                                        <td class="al"></td>
                                    </tr>
                                    <tr>
                                        <td>วันหมดอายุ</td>
                                        <td class="al"><a href="#"><?=($datauser->start_time==null) ? '-' : unix_to_human(strtotime(date('Y-m-d H:i:s', strtotime($datauser->start_time)) . ' + '.$datauser->amount.' day'), TRUE, 'th')?></a></td>
                                        <td class="al"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="columns leading">
                        <div class="grid_6 first">
                            <h3>ประวัติการเข้าเว็บ</h3>

                            <hr />
							
							<div class="panel">
								<div align="right">
									<button type="button" id="add_group" class="button button-blue">&nbsp;</button>
								</div>
							</div>
						
                            <table id="used_history" class="paginate mypaginate sortable full">
                                <thead>
                                     <tr style="cursor:pointer;">
                                        <th>No.</th>
                                        <th>URL</th>
                                        <th>เวลา/วันที่</th>
                                       <th>ขนาด</th>
                                    </tr>
                                </thead>
                                <tbody>
									<td></td>
                                </tbody>
                            </table>

                        </div>
                    </div>
				</section>
