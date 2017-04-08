
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
                <div class="wrapper">
                <img src="<?=$style ?>img/true_money_2.jpg" height="150px" width="250px">&nbsp;<img src="<?=$style ?>img/true_money_4.jpg" height="150px" width="100px">
                <br />
                    <?=form_open('mobileview/topuptrue','class="validate default-form various-content"')?>
									<input name="ref1" value="<?=$this->session->userdata('user')?>" type="hidden" id="ref1" />
									<input name="ref2" type="hidden" id="ref2" value="<?=$this->session->userdata('user')?>" />                                    
								  <?=form_input(array('name'=>'tmn_password','type'=>'text','minlength'=>'4'),'',' title="รหัสบัตรเงินสดทรูมันนี่" required="required" id="tmn_password" autocomplete="off" placeholder='.$this->lang->line('user_refill_true_id').'' )?>
							     <a href="#" onClick="submit_tmnc()" class="btn btn-2"><?=$this->lang->line('user_refill_gorefill') ?></a>							
					 <?=form_close()?>
                  
                    
                    </div>
                    <input type="button" value="Go Back" onclick="goBack()" class="btn-common btn-back">
                    <script>
function goBack()
  {
  window.history.back()
  }
</script>
                    </article>