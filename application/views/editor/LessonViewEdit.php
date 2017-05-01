<div>
	<form action="<?php if (isset ($data['employ'][0])) echo site_url('editor/showLessonForEditSave/' . $idEmploy . '/' . $idTimetable); else echo site_url('editor/showLessonForEditSave/' . $idEmploy . '/' . $idTimetable); ?>" method="post">
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Название'; ?></label>
			<input class="form-control"  id="lesson-name" name="name" value="<?php if (isset($data['employ'][0])) echo $data['employ'][0]['name']; ?>" required/>
		</div>
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Аудитория'; ?></label>
			<input class="form-control"  id="lesson-name" name="short_description" value="<?php if (isset($data['lesson'][0])) echo $data['lesson'][0]['short_description']; ?>" required/>
		</div>
		<div class="form-group has-feedback">
			<label for="lesson-name" ><?php echo 'Тип занятия:'; ?></label><br>
			<div><input type="radio" name="type" value="Лекция" <?php if (isset($data['lesson'][0])) if ($data['lesson'][0]['type'] == "lecture") echo "checked"; ?>/>  <label for="lesson-name" ><?php echo 'Лекция'; ?></label></div>
			<div><input type="radio"name="type" value="Лабораторная" <?php if (isset($data['lesson'][0])) if ($data['lesson'][0]['type'] == "practical") echo "checked"; ?>/> <label for="lesson-name" ><?php echo 'Лабораторная работа'; ?></label></div>
			<!--
			<input class="form-control"  id="lesson-name" name="type" value="<?php // if (isset($data['lesson'][0])) if ($data['lesson'][0]['type'] == "lecture") echo "Лекция"; elseif($data['lesson'][0]['type'] == "practical") echo "Практика"; ?>"/>
		-->
		</div>

		<input type="button" value="Добавить"  class="add"/>

			<div  class="menu" style="display:none; position:absolute;">

			<?php foreach ($data['groupsOnEmploy'] as $value):?>
				<div class="menuadd"><label for="lesson-name" class="group" data-id = "<?php echo $value['name']; ?>" ><?php echo $value['name']; ?></label></div>

			<?php endforeach; ?>
			</div>


		<br>
		<br>
		<label for="lesson-name" ><?php echo 'Добавить группы на занятие:'; ?></label>
		<input class="form-control"  id="groups" name="groups" value="" disabled/>
		<input type="button"  value="Очистить"  class="clear" style="dispay:inline-block;"/>
		<input type="submit" value="Сохранить" />

		

	</form>
</div>

<script type="text/javascript">
	$( ".add" ).click(function() {

		$(".menu").attr("style",function() {
			var value = "display:inline-block; position: absolute; width: 100px;background: rgba(229,229,229,1);-webkit-box-shadow: 3px 2px 1px 0 rgba(0,0,0,0.3) ;	box-shadow: 3px 2px 1px 0 rgba(0,0,0,0.3) ;	text-shadow: 1px 1px 1px rgba(0,0,0,0.2) ;"

			return value;

		})

	});
	$( ".menuadd" ).click(function() {

		$(".menu").attr({"style":"display:none;"})
	});


	$( ".clear" ).click(function() {

		$("#groups").prop({"value":""})
	});


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