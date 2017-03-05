<div>
	<form action="<?php if (isset ($data[0])) echo site_url('editor/changeNameTimetable/' . $data[0]['timetable_id']); else echo site_url('editor/addNewTimetable/'); ?>" method="post">
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Название'; ?></label>
			<input class="form-control" pattern=".{1,}" id="lesson-name" name="name" value="<?php if (isset($data[0])) echo $data[0]['name']; ?>"/>
		</div>
		<hr/>
		<input type="submit" value="Сохранить" />
	</form>
</div>