<?php
$username = array(
	'name'	=> 'user',
	'id'	=> 'user',
	'value' => set_value('username'),
	'size' 	=> 10,
);
$password = array(
	'name'	=> 'pass',
	'id'	=> 'pass',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 10,
);

?>
<section id="page-wrapper">
        
        	<section id="menu-wrapper">
                <ul class="menu">
                    
                    <li class="icon home">
                        <a href="mobileview">
                            <span class="menu-li-title">Dashboard</span>
                            <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                        </a>
                    </li>
                    
                    <li class="icon box">
                        <a href="mobileview/userdetail">
                            <span class="menu-li-title">User details</span>
                            <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                        </a>
                    </li>
                    
                    <li id="a-submenu-2" class="icon plus">
                    
                        <a href="#">
                            <span class="menu-li-title">Money Refill</span>
                            <img class="menu-li-arrow-submenu" src="<?=$style ?>img/icons/submenu.png" alt="" />
                        </a>
                        
                        <ul id="submenu-2">
                        	<li>
                                <a href="mobileview/cardrefill">
                                    <span class="menu-li-title">WiFi Card</span>
                                    <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                                </a>
                            </li>
                            
                            <li>
                                <a href="mobileview/truerefill">
                                    <span class="menu-li-title">True money</span>
                                    <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                                </a>
                            </li>
                        </ul>
                        
                    </li> <!-- #submenu-1 -->
                    
                    <li class="icon book">
                        <a href="mobileview/package">
                            <span class="menu-li-title">Package</span>
                            <img class="menu-li-arrow" src="img/icons/arrow-forward.png" alt="" />
                        </a>
                    </li>
                    
                    <li id="a-submenu-1" class="icon plus">
                    
                        <a href="#">
                            <span class="menu-li-title">Topup History</span>
                            <img class="menu-li-arrow-submenu" src="<?=$style ?>img/icons/submenu.png" alt="" />
                        </a>
                        
                        <ul id="submenu-1">
                        	<li>
                                <a href="index.html">
                                    <span class="menu-li-title">WiFi topup</span>
                                    <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                                </a>
                            </li>
                            
                            <li>
                                <a href="index.html">
                                    <span class="menu-li-title">True topup</span>
                                    <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                                </a>
                            </li>
                        </ul>
                        
                    </li> <!-- #submenu-1 -->
      
                    <li class="icon book">
                        <a href="typography.html">
                            <span class="menu-li-title">Announced</span>
                            <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                        </a>
                    </li>
                    
                    <li class="icon mail">
                        <a href="index">
                            <span class="menu-li-title">Contact</span>
                            <img class="menu-li-arrow" src="<?=$style ?>img/icons/arrow-forward.png" alt="" />
                        </a>
                    </li>
                  
                
                </ul> <!-- .menu -->
                
            </section> <!-- #menu-wrapper -->
            
        
        	<section id="content-wrapper">
                	
                <section id="header">
                
                    <div id="header-left">
                        <a href="#" id="a-menu"><img src="<?=$style ?>img/icons/menu.png" alt="menu" /></a>
                    </div>
                    
                    <div id="header-title">
                        <h1>mobile user dashboard</h1>
                    </div>
                    
                    <div id="header-right">
                        <a href="mobileview/logoutuser" id="header-search-link"><img src="<?=$style ?>img/icons/share.png" alt="Search" /></a>
                    </div>
                    
                </section> <!-- #header -->
                <article>
                <p class="center"><?=$logo ?></p>
<div class="wrapper">
                    
                    	<span class="post-date"><?=$date?></span>
                        <p> 
                           <div class="wrapper">
                           <div class="annouced">
                           <div class="content">
    <?=$annouced?>
    </div></div>
						<?=form_open('mobileview/loginuser','id="form"')?>
						
							
						
								<?=form_input(array('name'=>'user','type'=>'text','minlength'=>'4'),'',' autocomplete="off" title="ชื่อผู้ใช้เดิมที่จะเติม" placeholder='.$this->lang->line('user_refill_u').' required="required" id="user"' )?>
						   
								<?=form_input(array('name'=>'pass','type'=>'password','minlength'=>'4'),'',' autocomplete="off" title="รหัสเดิมที่จะเติม" placeholder='.$this->lang->line('user_refill_p').' required="required" id="pass"')?>
							    
						 <p>
						<?php echo form_submit('login', $this->lang->line('user_refill_button').'','class="btn btn-2 btn-2a"'); ?></p><br />
                        <span class="center">
                         Select language :  <?=anchor("mobileview/languser/thai","<span>ภาษาไทย</span>");?> &nbsp; <?=anchor("mobileview/languser/english","<span>English</span>");?>
							</span>
 </p>
                        <?php echo form_close(); ?>
                    </div>
                    </div>
                    
                    </div>
                           
        </article> <!-- #post -->                  
      