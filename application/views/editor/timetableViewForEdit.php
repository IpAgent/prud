<h1 align="center">Редактирование</h1>
<?php for($_index = 0; $_index < count($data); $_index++): ?>
<div class="col-sm-offset-2 col-md-8">
	<div class="box one">
		<div class="two two1"><input id="week" type="button" data-id="<?php echo $data[$_index]['timetable_id']?>" class="editEmploy switch-week btn btn-block btn-success btn-lg" value="<?php echo $data[$_index]['name']  ?>"/></div>
		<div class="two two2"><input id="" data-id="<?php echo $data[$_index]['timetable_id']?>" type="button" class="changeName switch-week btn btn-block btn-success btn-lg" value="Изменить название"/></div>
		<div class="two two3"><input id="" data-id="<?php echo $data[$_index]['timetable_id']?>" type="button" class="deleteTimetable switch-week btn btn-block btn-danger btn-lg" value="X"/></div>
	</div>
</div>
<?php endfor; ?>
<div class="col-sm-offset-2 col-md-8">
	<div class="box">
		<input id="addTimetable" type="button" class="switch-week btn btn-block btn-success btn-lg" value="+"/>
	</div>
</div>

<style>
	.one {  overflow:hidden;}
	.two { }
	.two1 {float:left; width: 70%}
	.two2 {float:right;  width: 27%}
	.two3 {float:right;  width: 3%}
</style>

<script type="text/javascript">
	$('.changeName').click(function(){
		$.get('<?php echo site_url('editor/changeNameTimetable/'); ?>' + $(this).attr('data-id'), function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});
	});

	$('#addTimetable').click(function(){
		$.get('<?php echo site_url('editor/AddNewTimetable/'); ?>', function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});
	});

	$('.deleteTimetable').click(function(){
		$.get('<?php echo site_url('editor/deleteTimetable/'); ?>' + $(this).attr('data-id'), function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});
	});
	$('.editEmploy').click(function(){
		$.get('<?php echo site_url('editor/showLessonEdit/'); ?>' + $(this).attr('data-id'), function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});
	});
</script>