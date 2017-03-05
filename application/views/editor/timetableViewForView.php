<h1 align="center">Просмотр</h1>
<?php for($_index = 0; $_index < count($data); $_index++): ?>
<div class="col-sm-offset-2 col-md-8">
	<div class="box">
		<input id="<?php echo $data[$_index]['timetable_id']?>" type="button" class="switch-week btn btn-block btn-success btn-lg" value="<?php echo $data[$_index]['name']  ?>"/>
	</div>
</div>
<?php endfor; ?>


<script type="text/javascript">
	$('.switch-week').click(function(){
		$.get('<?php echo site_url('editor/showLessonsForView/'); ?>' + $(this).attr('id'), function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});
	});
</script>
