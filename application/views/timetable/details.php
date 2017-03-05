<?php
	/*
	 $data contains :
	 Array
	(
		[lesson_id] => 8
		[timetable_id] => 1
		[upper_week] => 1
		[day] => 1
		[date] => 2016-09-05 00:00:00
		[position] => 3
		[name] => Б Ж Д  доц. Галюжин А.С.  437
		[type] => Лекция
		[comment] => Бла-бла-бла какой-то комментарий
	)
	 */
?>
<div>
	<span><?php echo 'Название'; ?></span>
	<p><?php echo $data['name']; ?></p>
	<hr/>
	<span><?php echo 'Тип занятия'; ?></span>
	<p><?php echo $data['type']; ?></p>
	<hr/>
	<span><?php echo 'Коммнтарий'; ?></span>
	<p><?php echo $data['comment']; ?></p>
</div>