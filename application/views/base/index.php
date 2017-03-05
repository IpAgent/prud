<div >
</div>
<script type="text/javascript">
	$(function(){
		$.get('<?php echo site_url('api/timetable/all'); ?>', {}, function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});
	});
</script>