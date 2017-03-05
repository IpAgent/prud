<div>
	<form id="timetable-create-form" action="<?php echo site_url('api/timetable/edit'); ?>" method="post">
		<input type="hidden" name="id" value="<?php echo $data['timetable_id']; ?>" />
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Название'; ?></label>
			<input class="form-control" id="lesson-name" name="name" value="<?php echo $data['name']; ?>"/>
		</div>
		<hr/>
		<div class="form-group has-feedback">
			<label for="lesson-type" ><?php echo 'Описание'; ?></label>
			<textarea class="form-control" id="lesson-type" name="description" ><?php echo $data['description']; ?></textarea>
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