<section id="content-wrapper">
                	
                <section id="header">
                  <div id="header-title">
                        <h1>mobile user dashboard</h1>
                    </div>
                    
                    <div id="header-right">
                        <a href="mobileview/logoutuser" id="header-search-link"><img src="<?=$style ?>img/icons/share.png" alt="Search" /></a>
                    </div>
                    
                </section> <!-- #header -->                
                <article>
                        <div class="span6"><img src="<?=$style ?>img/wifi-card.jpg" height="200px" width="350px"></div>
                        	<div class="span4">
                      		<?=form_open('mobileview/topupcard','id="form" class="validate default-form various-content"')?>
							
									<?=form_input(array('name'=>'user_card','type'=>'text','minlength'=>'4'),'',' title="ชื่อผู้ใช้บนบัตร" required="required" id="user_card" autocomplete="off" placeholder='.$this->lang->line('user_refill_card_name').'')?>
								   
									<?=form_input(array('name'=>'pass_card','type'=>'text','minlength'=>'4'),'',' title="ชื่อผู้ใช้บนบัตร" required="required" id="pass_card" autocomplete="off" placeholder='.$this->lang->line('user_refill_card_pass').'')?>
									<?php echo form_submit('topupcard', $this->lang->line('user_refill_gorefill'),'class="btn btn-2"'); ?>
							<?=form_close()?>
                            </div>
                           
                           
                    </div>
                    <br />
                    <input type="button" value="Go Back" onclick="goBack()" class="btn-common btn-back">
                     </div>
                     
 </article>
 <script>
function goBack()
  {
  window.history.back()
  }
</script>