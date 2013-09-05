define(function(require, exports, module) {
	var $ = require('jquery');
	
$(function(){
	
	$('#msg_sub').click(function(){
		var con = $('#msg_con').val();
		$.getJSON("index.php?_c=msgboard&_a=add&content="+con,function(re,status){
			if(status!=='success') {alert('ÍøÂç·±Ã¦£¡');return false;}
			if(re['status']){
				window.location.href=window.location.href;
			}
			else alert('ÍøÂç·±Ã¦£¡');
		});
		return false;
	});
	
	$('.toEdit').on('click',function(){
		var $this = $(this);
		var $next = $this.next();
		$next.val($this.html());
		$this.hide();
		$next.show();
		$next[0].focus();//Ö÷¶¯»ñÈ¡½¹µã
	});
	
	$('.editable').on('change',function(){
		var id = $(this).attr('data-id');
		var con = $(this).val();
		var $this = $(this);
		$.getJSON("index.php?_c=msgboard&_a=edit&content="+con+"&id="+id,function(re,status){
		if(status!=='success') {alert('ÍøÂç·±Ã¦£¡');return false;}
			if(re['status'])
			{
				$this.prev().html(con);
				$this.hide();
				$this.prev().show();
				
			}
			else alert('ÍøÂç·±Ã¦£¡');
		});
	});
	
	$('.editable').on('blur',function(){
				$(this).hide();
				$(this).prev().show();
	});
	
	$('.msg_del').on('click',function(){
		var id = $(this).attr('data-id');
		var $this=$(this);
		$.getJSON("index.php?_c=msgboard&_a=del"+"&id="+id,function(re,status){
			if(status!=='success') {alert('ÍøÂç·±Ã¦£¡');return false;}
			if(re['status'])
			{
				$this.closest('.com-li').remove();				
			}
			else alert('ÍøÂç·±Ã¦£¡');
		});
	});
	
	
});	
	
});