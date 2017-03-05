

<div>
	<form action="<?php echo site_url('lesson/edit/' . $id . '/' . $date . '/' . $position . '/' . $dateS . '/' . $dateF . '/' . $lessonId); ?>" method="post">
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Название'; ?></label>
			<input class="form-control" id="lesson-name" name="name" value="<?php if (isset($lesson[0])) echo $lesson[0]['name']; ?>" disabled/>
		</div>
		<hr/>
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Дата занятия'; ?></label>
			<input class="form-control" id="lesson-name" name="name" value="<?php if (isset($lesson[0])) echo date('Y-m-d', strtotime($lesson[0]['execute_date'])); ?>" disabled/>
		</div>
		<hr/>
		<div class="form-group has-feedback">
			<label for="lesson-type" ><?php echo 'Тип занятия'; ?></label>
			<input class="form-control" id="lesson-type" name="type" value="<?php if (isset($lesson[0])) if ($lesson[0]['type'] == 'lecture') echo 'Лекция';
			else echo 'Практика'; ?>" disabled/>
		</div>
		<hr/>
		<div class="form-group has-feedback">
			<label for="lesson-comment" ><?php echo 'Группы:'; ?></label>
			<?php foreach($lesson as $key => $value): ?>
				<input class="form-control group_name" value="<?php if (isset($lesson[0]['gname'])) {
						   	echo $value['gname'];
						   	if ($value['sub'] != 0) echo "  " . $value['sub'] . " подгруппа.";
					   	}
						?>" disabled/>
				<input type="button" class="viewGroup btn btn-success" id="<?php if (isset($lesson[0])) echo $value['group_id']; ?>" value="Посмотреть">
			<?php endforeach; ?>
		</div>
		<hr/>
		<div class="form-group has-feedback">
			<label for="lesson-type" ><?php echo 'Аудитория'; ?></label>
			<input class="form-control" id="lesson-type" name="type" value="<?php if (isset($lesson[0])) echo $lesson[0]['short_description']; ?>" disabled/>
		</div>
		<hr/>
		<div class="form-group has-feedback">
			<label for="lesson-comment" ><?php echo 'Комментарий'; ?></label>
			<input class="form-control" id="lesson-comment" name="comment" value="<?php if (isset($lesson[0])) echo $lesson[0]['comment']; ?>" />
		</div>
		<input type="submit" value="Сохранить" />
	</form>
	<?php #print_r($lesson);?>
</div>

<script type="text/javascript">
	$('.viewGroup').click(function(){
		$.get('<?php echo site_url('editor/ShowGroupMarks/'); ?>' + $(this).attr('id') + '/'
			+ '<?php echo $lesson[0]['employ_id']; ?>' + '/' + '<?php echo $lesson[0]['sub']; ?>', function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});
	});
</script>