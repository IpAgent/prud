<div>
	<form action="<?php if (isset ($data['employ'][0])) echo site_url('editor/showLessonForEditSave/' . $idEmploy . '/' . $idTimetable); else echo site_url('editor/showLessonForEditSave/' . $idEmploy . '/' . $idTimetable); ?>" method="post">
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Название'; ?></label>
			<input class="form-control"  id="lesson-name" name="name" value="<?php if (isset($data['employ'][0])) echo $data['employ'][0]['name']; ?>"/>
		</div>
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Аудитория'; ?></label>
			<input class="form-control"  id="lesson-name" name="short_description" value="<?php if (isset($data['lesson'][0])) echo $data['lesson'][0]['short_description']; ?>"/>
		</div>
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Тип занятия: *Лекция* или *Практика*'; ?></label>
			<input class="form-control"  id="lesson-name" name="type" value="<?php if (isset($data['lesson'][0])) if ($data['lesson'][0]['type'] == "lecture") echo "Лекция"; elseif($data['lesson'][0]['type'] == "practical") echo "Практика"; ?>"/>
		</div>
		<label for="lesson-name" ><?php echo 'Группы, присутствующие на занятии:'; ?></label>
		<?php foreach ($data['groupsOnEmploy'] as $value):?>
			<label for="lesson-name" class="group" data-id = "<?php echo $value['name']; ?>" ><?php echo $value['name']; ?></label>

		<?php endforeach; ?>
		<br>
		<label for="lesson-name" ><?php echo 'Все группы:'; ?></label>
		<?php foreach ($groups as $value):?>
			<label for="lesson-name" class="group" data-id = "<?php echo $value['name']; ?>" ><?php echo $value['name']; ?></label>

		<?php endforeach; ?>
		<br>
		<label for="lesson-name" ><?php echo 'Добавить группы на занятие:'; ?></label>
		<input class="form-control"  id="groups" name="groups" value=""/>
		<input type="submit" value="Сохранить" />
	</form>
</div>

<script type="text/javascript">
	$('.group').click(function(){
		if ($('#groups').val() == "")
		{
			$('#groups').val($(this).attr('data-id'));
		}
		else
		{
			$('#groups').val($('#groups').val() + ":" +  $(this).attr('data-id'));
		}

	});
</script>