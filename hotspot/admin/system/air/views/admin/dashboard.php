{right-content}
<? $this->load->helper('mikrotik'); 

		$global = $this->siteconfigmodel->getConfig('mikrotik_config');
		$data = $this->session->_unserialize($global->value);
		$API = new routeros_api();

		$API->debug = false;

		if ($API->connect($data['ipaddress'], $data['username'], $data['password'])) {

		$data = $API->comm("/system/resource/print");
		}
		$API->disconnect();	
		
		$first = $data['0'];
			?>
 <div class="span3">
    <div class="widget_heading service">
					<h4><i class="icon-random"></i> Mikroik Model</h4></div>
                    <div class="widget_container">
					<?
					echo $first['platform']."-". $first['board-name'];
					?>
                    </div>
                    </div>
                    <div class="span3">
    <div class="widget_heading service">
					<h4><i class="icon-shield"></i> RADIUS SERVER</h4></div>
                    <div class="widget_container">
					Version <? $freeradiusv =shell_exec('/usr/sbin/freeradius -v'); 
							   $v = substr($freeradiusv,16 ,21);
							   $cut = str_replace('Version','',$v);
							   echo $cut;	 ?>
									 <?=$radius ?>
                    </div>
                    </div>
                    <div class="span3">
    <div class="widget_heading service">
					<h4><i class="icon-asterisk"></i> PROXY SERVER</h4></div>
                    <div class="widget_container">
					Version<? $squidv =shell_exec('/usr/sbin/squid3 -v'); 
							   $v = substr($squidv,11 ,17);
							   $cut = str_replace('Version','Squid&nbsp;',$v);
							   echo $cut;	 ?>
									 <?=$proxy ?>
                    </div>
                    </div>
                    <div class="span3">
    <div class="widget_heading service">
					<h4><i class="icon-reorder"></i> WEB SERVER</h4></div>
                    <div class="widget_container">
					<? $web = apache_get_version(); 
echo "$web\n";?> <?=$http ?>
                    </div>
                    </div>
<?php $i=0; $price[0]=0;$price[1]=0;
foreach ($pp->result() as $row): 
$price[$i]=$row->p;
$i++;
 endforeach;?>
    <div class="span7">
    	<div class="widget_heading"><h4>สถิติรายได้-ผู้ใช้งาน</h4></div>
        	<div class="widget_container">
    			<ul id="sortable" class="unstyled" style="padding-left:20px;">
         				<li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#4DB848;"><?=number_format($price[0],$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></h1>
       <p>รายได้ทั้งหมด</p></div>
    </li>
           				<li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#0099FF;"><?=number_format($price[1],$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></h1>
       <p>ลูกค้าเก่า</p></div>
    </li>

     					<li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#ff4056;"><?=number_format($price[0]+$price[1],$this->config->item('decimal_places'),$this->config->item('decimal_separator'),$this->config->item('thousands_separator'))?></h1>
       <p>ลูกค้าใหม่</p></div>
    </li>

        				<li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#ff9900;"><?=$voucher['created']?></h1>
       <p>ผู้ใช้งานทั้งหมด</p></div>
    </li>
           				<li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#FF6320;"><?=$voucher['used']?></h1>
       <p>ใช้งานแล้ว</p></div>
    </li>

     					<li class="span2 ui-state-default"><div class="infoblock shadow "><h1 style="color:#6148B3;"><?=$voucher['expired']?></h1>
       <p>หมดอายุ</p></div>
    </li>
    </ul>

		</div>
</div>

    <? $per = '0'; ?>
   <div class="span5">
		<div class="widget_heading">
					<h4>กราฟแสดงสถิติของกลุ่มผู้ใช้งาน</h4></div>
                    <div class="widget_container">
					<?php if($voucher['created']==0 || $voucher['created']==null) { echo "<div align='center'>ยังไม่มีผู้ใช้ในระบบ</div>"; } else { echo $this->graph->render(); } ?>
						</div>
                   </div>
     <div class="span7">
		<div class="widget_heading">
                            <h4>จำนวนบัตรโดยรวม ที่ใช้แล้ว: <?=$voucher['used']?> ใบ จากทั้งหมด <?=$voucher['created']?> ใบ</h4>
		</div>
<div class="widget_container">
                            ยังไม่ใช้งาน <?=$voucher['created']-$voucher['used']?> จาก <?=$voucher['created']?></td>
                                    
                                        
                                        <div class="progress progress-green"><span style="width: <? if($voucher['created']-$voucher['used'] >0) { $per =($voucher['created']-$voucher['used'])*100; $per = round($per/$voucher['created'],1); echo $per;} else {echo $per = '0';} ?>%;"><b><? echo $per;?>%</b></span></div>
                                    ใช้งานแล้ว <?=$voucher['used']?> จาก <?=$voucher['created']?>
                                    <div id="progress1" class="progress progress-orange"><span style="width: <? if($voucher['used']>0) { $per = $voucher['used']*100; $per = round($per/$voucher['created'],1); echo $per;} else {echo $per = '0';} ?>%;"><b><? echo $per;?>%</b></span></div>
									หมดอายุ <?=$voucher['expired']?> จาก <?=$voucher['created']?><div class="progress progress-red"><span style="width: <? if($voucher['expired']>0) { $per = $voucher['expired']*100; $per = round($per/$voucher['created'],1); echo $per;} else {echo $per = '0';} ?>%;"><b><? echo $per;?>%</b></span></div>
                                   
                        </div>
                    </div>

<div class="span5">
		<div class="widget_heading">
                          <h4>ประวัติการเข้าใช้งาน ผู้ดูแลระบบ</h4>
		</div>
<div class="widget_container">
							<ul class="list-group">
  <li class="list-group-item"><button class="btn btn-small disabled">ชื่อผู้ใช้งาน</button>  :<button class="btn btn-small btn-primary disabled"><?=$user->username ?> </button></li><br/>
  <li class="list-group-item"><button class="btn btn-small disabled">อีเมล์</button>      :<button class="btn btn-small btn-primary disabled"><?=$user->email ?></button></li><br/>
  <li class="list-group-item"><button class="btn btn-small disabled">ไอพีที่เข้าใช้งานล่าสุด</button> :<button class="btn btn-small btn-primary disabled"><?=$user->last_ip?></button></li><br/>
  <li class="list-group-item"><button class="btn btn-small disabled">เข้าใช้งานล่าสุด</button> :<button class="btn btn-small btn-primary disabled"><?=$user->last_login?></button></li>
  
</ul>
                        </div>

                    </div>



<div class="span12">
		<div class="widget_heading">
                          <h4>กราฟแสดงสถิติ การใช้งาน</h4>
		</div>
<div class="widget_container">
								<button chart="daysused" class="btn btn-small btn-primary" id="chart">การเข้าใช้งาน</button>
								<button chart="receipts" class="btn btn-small btn-primary" id="chart">สถิติรายได้</button>
							
                            <div class="flashchart">

                                <div id="statistic_graph" style="padding: 0px; margin:5px 0px 5px 7px ; width: 100%; height: 300px; " ></div>
                        </div>

                    </div>