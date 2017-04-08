
jQuery(document).ready(function($) {

	$.fn.placeholder = function(options) {
		return this.each(function() {
		  if ( !("placeholder"  in document.createElement(this.tagName.toLowerCase()))) {
			var $this = $(this);
			var placeholder = $this.attr('placeholder');
			$this.val(placeholder);
			$this
			  .focus(function(){ if ($.trim($this.val())==placeholder){ $this.val(''); }; })
			  .blur(function(){ if (!$.trim($this.val())){ $this.val(placeholder); }; });
		  }
		});
	};

	//$('body').bind('contextmenu' , function(e){return false;});
  
	$('#iframe_fancybox').live('hover click', function() {
	
		$(this).fancybox({
			'width'				: '75%',
			'height'			: '100%',
			'overlayShow'		: false,
			'autoScale'			: true,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'type'				: 'iframe'
		});

	});

	$(function() {
		$( ".flashchart" ).tabs();
	});

	if(msg_show){

		$("form#form,form#gen_form").live('hover',function() {
			$(this).validationEngine({promptPosition : "bottomRight"});
		});

		var msgck = 0;
		$.getJSON(base_url+"index.php/admin/message/message_ckecker", function(data) {
			if(data.amount>msgck){
				$("a.message_box").html(data.msg);
				showmessage(data.alert, 'info');
				msgck = data.amount;
			}
		});

		var refreshId = setInterval(function() {
			$.getJSON(base_url+"index.php/admin/message/message_ckecker?randval="+Math.random(), function(data) {
				if((data.amount>msgck)){
					$("a.message_box").html(data.msg);
					showmessage(data.alert, 'info');
					msgck = data.amount;
				} else if((data.amount<msgck)) {
					$("a.message_box").html(data.msg);
					msgck = data.amount;
				}
			});
		}, 10000);

		var serverstatus = setInterval(function() {
			$.getJSON(base_url+'index.php/admin/server/status?randval='+Math.random(), function(data) {
				$('#cpu_load').html(data.cpu_load);
				$('#memory_usage').html(data.memory_usage);
				$('#hdd_free_space').html(data.hdd_free_space);
				
				$('.cpu_perc').attr('style','width:'+data.cpu_perc+'%').parent(this).find('b').html(data.cpu_perc+'%');
				$('.memory_perc').attr('style','width:'+data.memory_perc+'%').parent(this).find('b').html(data.memory_perc+'%');
				$('.hdd_perc').attr('style','width:'+data.hdd_perc+'%').parent(this).find('b').html(data.hdd_perc+'%');

				if(data.cpu_perc < 70) {
					$('div#cpu_color').removeClass('progress-orange').removeClass('progress-red');
					$('div#cpu_color').addClass('progress-green');
				}
				
				if(data.memory_perc < 70) {
					$('div#mem_color').removeClass('progress-orange').removeClass('progress-red');
					$('div#mem_color').addClass('progress-blue');
				}
				
				if(data.hdd_perc < 70) {
					$('div#hdd_color').removeClass('progress-orange').removeClass('progress-red');
					$('div#hdd_color').addClass('progress-pown');
				}

				if(data.cpu_perc > 70 && data.cpu_perc < 90) {
					$('div#cpu_color').removeClass('progress-green').removeClass('progress-red');
					$('div#cpu_color').addClass('progress-orange');
				}
				
				if(data.memory_perc > 70 && data.memory_perc < 90) {
					$('div#mem_color').removeClass('progress-green').removeClass('progress-red');
					$('div#mem_color').addClass('progress-orange');
				}
				
				if(data.hdd_perc > 70 && data.mthdd_perc < 90) {
					$('div#hdd_color').removeClass('progress-green').removeClass('progress-red');
					$('div#hdd_color').addClass('progress-orange');
				}

				if(data.cpu_perc > 90) {
					$('div#cpu_color').removeClass('progress-green').removeClass('progress-orange');
					$('div#cpu_color').addClass('progress-red');
				}
				
				if(data.memory_perc > 90) {
					$('div#mem_color').removeClass('progress-green').removeClass('progress-orange');
					$('div#mem_color').addClass('progress-red');
				}
				
				if(data.hdd_perc > 90) {
					$('div#hdd_color').removeClass('progress-green').removeClass('progress-orange');
					$('div#hdd_color').addClass('progress-red');
				}

			});
		}, 3000);
	}

	var mikrotikstatus = setInterval(function() {
			$.getJSON(base_url+'index.php/admin/server/mt_status?randval='+Math.random(), function(data) {
				$('#mtcpu_load').html(data.mtcpu_load);
				$('#mtmemory_usage').html(data.mtmemory_usage);
				$('#mthdd_free_space').html(data.mthdd_free_space);
				
				$('.mtcpu_perc').attr('style','width:'+data.mtcpu_perc+'%').parent(this).find('b').html(data.mtcpu_perc+'%');
				$('.mtmemory_perc').attr('style','width:'+data.mtmemory_perc+'%').parent(this).find('b').html(data.mtmemory_perc+'%');
				$('.mthdd_perc').attr('style','width:'+data.mthdd_perc+'%').parent(this).find('b').html(data.mthdd_perc+'%');

				if(data.mtcpu_perc < 70) {
					$('div#mtcpu_color').removeClass('progress-orange').removeClass('progress-red');
					$('div#mtcpu_color').addClass('progress-green');
				}
				
				if(data.mtmemory_perc < 70) {
					$('div#mtmem_color').removeClass('progress-orange').removeClass('progress-red');
					$('div#mtmem_color').addClass('progress-blue');
				}
				
				if(data.mthdd_perc < 70) {
					$('div#mthdd_color').removeClass('progress-orange').removeClass('progress-red');
					$('div#mthdd_color').addClass('progress-pown');
				}

				if(data.mtcpu_perc > 70 && data.mtcpu_perc < 90) {
					$('div#mtcpu_color').removeClass('progress-green').removeClass('progress-red');
					$('div#mtcpu_color').addClass('progress-orange');
				}
				
				if(data.mtmemory_perc > 70 && data.mtmemory_perc < 90) {
					$('div#mtmem_color').removeClass('progress-green').removeClass('progress-red');
					$('div#mtmem_color').addClass('progress-orange');
				}
				
				if(data.mthdd_perc > 70 && data.mthdd_perc < 90) {
					$('div#mthdd_color').removeClass('progress-green').removeClass('progress-red');
					$('div#mthdd_color').addClass('progress-orange');
				}

				if(data.mtcpu_perc > 90) {
					$('div#mtcpu_color').removeClass('progress-green').removeClass('progress-orange');
					$('div#mtcpu_color').addClass('progress-red');
				}
				
				if(data.mtmemory_perc > 90) {
					$('div#mtmem_color').removeClass('progress-green').removeClass('progress-orange');
					$('div#mtmem_color').addClass('progress-red');
				}
				
				if(data.mthdd_perc > 90) {
					$('div#mthdd_color').removeClass('progress-green').removeClass('progress-orange');
					$('div#mthdd_color').addClass('progress-red');
				}

			});
		}, 3000);
	

	
	/*
	$('div.clearos_logo').click(function() {
	
		var clear_url = base_url.replace('hotspot/','admin');

		$('<div title="ClearOS Server Webconfig" id="clearos_webconfig" style="text-align:center;"><iframe width="97%" height="97%" src="'+clear_url+'"></iframe></div>').appendTo('body');
		$( "#clearos_webconfig" ).dialog({
			resizable: false,
			height:720,
			width:800,
			modal: true,
			close: function() {
				$(this).remove();
			}
		});

	});
	*/
});

	var clear_bride = true;

	function fnShowHide( iCol ){
		var tid = $('table').attr('id');
		var oTable = $('#'+tid).dataTable();
		var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
		oTable.fnSetColumnVis( iCol, bVis ? false : true );
	}
	
	function showmessage(msg, type){
		$('#flashMessage').remove();
		$('<div id="flashMessage" style="display:none; font-size:13px;" class="message '+type+'" align="center">'+msg+'</div>')
		.appendTo('body')
		.delay(500)
		.slideDown(200)
		.delay(10000)
		.slideUp(200, function() { $(this).remove(); }); 
	}

	function dialog_msg(title, msg, type){
		if(type=='' || type==null) { type = 'highlight'; var icon = 'info'; } else { icon = 'alert'; }
		$('<div id="alert-msg" title="'+title+'"><div id="dialog-confirm" title="'+title+'" class="ui-state-'+type+' ui-corner-all" style="padding: 0 .7em;"> <p><span class="ui-icon ui-icon-'+icon+'" style="float: left; margin-right: .3em;"></span>'+msg+'</p></div></div>').appendTo('body');

		$( "#alert-msg" ).dialog({
			resizable: false,
			height:180,
			width:400,
			modal: true,
			buttons: {
				ปิด: function() {
					$( this ).dialog( "close" ).remove();
				}
			},
			close: function() {
				$(this).remove();
			}
		});
		
		return $( "#alert-msg" );
	}
