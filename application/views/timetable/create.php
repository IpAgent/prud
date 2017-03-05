<div>
	<form id="timetable-create-form" action="<?php echo site_url('api/timetable/create'); ?>" method="post">
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Название'; ?></label>
			<input class="form-control" id="lesson-name" name="name" value=""/>
		</div>
		<hr/>
		<div class="form-group has-feedback">
			<label for="lesson-type" ><?php echo 'Описание'; ?></label>
			<textarea class="form-control" id="lesson-type" name="description" value="" />
		</div>
	</form>
</div>
<script type="text/javascript">
	$('#timetable-create-form').ajaxForm(function(r){
		if(r.success){
			$.get('<?php echo site_url('api/timetable/all'); ?>', {}, function(r){
				if(r.success){
					$('#content').html(r.data);
					bootbox.hideAll();
				}
			});
		}
	});
</script>