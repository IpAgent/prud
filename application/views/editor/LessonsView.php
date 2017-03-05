
<?php
$_days = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота');
$_time = array('8.30-10.05', '10.25-12.00', '12.30-14.05', '14.20-15.55','16.05-17.40','17.45-19.15','19.15-20.30');

?>

<?php if(isset($employ[0]))
{
	#print_r($employ);
	$week = array();
	for ($i = 0; $i < count($_days); $i++)
	{
		$dateDay = new DateTime($date['startWeek']);
		date_add($dateDay, date_interval_create_from_date_string( $i . ' days'));
		foreach ($employ as $key => $value) {
			if (substr($value['execute_date'], 0 ,strpos($value['execute_date']," ")) == $dateDay->format('Y-m-d'))
			{
				for ($lesson = 0; $lesson < count($_time); $lesson++)
				{
					if ($value['position'] == $lesson + 1)
					{

						$week[$i][$lesson]['position'] = $lesson;
						$week[$i][$lesson]['type'] = $value['type'];
						$week[$i][$lesson]['short_description'] = $value['short_description'];
						$week[$i][$lesson]['comment'] = $value['comment'];
						$week[$i][$lesson]['name'] = $value['name'];
						$week[$i][$lesson]['lesson_id'] = $value['lesson_id'];
						$week[$i][$lesson]['gname'] = $value['gname'];
						$week[$i][$lesson]['employ_id'] = $value['employ_id'];
						$week[$i][$lesson]['sub'] = $value['sub'];
					}
				}
			}
		}
	}
};?>
<div class="one">
    <div class="two two1">Сегодня — <?php echo date('d.m.Y'); ?></div>
    <div class="two two2">Диапазон дат текущей недели - <?php echo date('d.m.Y', strtotime('Mon this week')) . ' — ' . date('d.m.Y', strtotime('Sun this week')); ?></div>
</div>

<div class="one">
	<div class="two two1">Диапазон дат расписания - &nbsp;</div>
	<div class="two two1" id = "start"><?php echo $date['startWeek']; ?></div>
	<div class="two two1">&nbsp; — &nbsp;</div>
	<div class="two two1" id = "finish"><?php echo  $date['finishWeek']; ?></div>
</div>
<div class="one">
	<div class="two two1"><input  type="button" id = "weekBefore" class="switch-week btn btn-block btn-success btn-lg" value="Предыдущая"/></div>
	<div class="two two2"><input  type="button" id = "weekAfter" class="switch-week btn btn-block btn-success btn-lg" value="Следующая"/></div>
</div>

<div class="col-md-12">
	<?php for($_index = 0; $_index < count($_days); $_index++): ?>
		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $_days[$_index]; ?></h3>
					<h4 class="data"><?php $dateDay = new DateTime($date['startWeek']);
						date_add($dateDay, date_interval_create_from_date_string( $_index . ' days'));
						echo  $dateDay->format('Y-m-d');?></h4>
				</div>
				<div class="box-body no-padding">
					<table class="table timetable">
						<thead>
						<th>Часы</th><th>Название</th><th>Занятие</th><th>Аудитория</th><th>Группа</th>
						</thead>
						<tbody>
						<?php for($_row = 0; $_row < count($_time); $_row++): ?>

							<tr align="left" data-lessonId = "<?php if (isset($week[$_index][$_row])) echo $week[$_index][$_row]['lesson_id'] ?>" id="<?php echo $_row?>" data-date = "<?php echo $dateDay->format('Y-m-d');?>" class="clickable_row" >
								<td align="left"><?php echo $_time[$_row]; ?></td>
								<td align="left">
									<?php if (isset($week[$_index][$_row])) {
										echo trim($week[$_index][$_row]['name']);
										$employ_id = $week[$_index][$_row]['employ_id'];
										}
									?>
								</td>
								<td align="left"><?php if (isset($week[$_index][$_row]))
									{
										if ($week[$_index][$_row]['type'] == 'practical')
											echo 'Лаб. работа';
										else
											if ($week[$_index][$_row]['type'] == 'lecture')
											echo 'Лекция';
											else
												echo ' ';
									}?></td>
								<td><?php if (isset($week[$_index][$_row]))
									{
										echo  $week[$_index][$_row]['short_description'] ;

									}
								?></td>
								<td align="left">
									<?php
									$str = ' ';
									if (isset($week[$_index][$_row])) {

										foreach ($employ as $key => $value) {

											if ($value['employ_id'] == $employ_id) {
												$str .= trim($value['gname']) . ' ';
											}
										}
										if ($week[$_index][$_row]['sub'] != 0)
											$str .= "/" . $week[$_index][$_row]['sub'];
									}
									echo $str;


									?>
								</td>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endfor; ?>
</div>

<style>
    .one {  overflow:hidden;}
    .two { }
    .two1 {float:left;}
    .two2 {float:right;}
	.data {font-weight: bold;}
</style>

<script type="text/javascript">

	$('#weekBefore').click(function(){

		$.get('<?php echo site_url('editor/showLessonsWeekBefore');  ?>' + '/' + '<?php echo $date['startWeek']; ?>' + '/' + '<?php echo $date['finishWeek']; ?>' + '/' + '<?php echo $date['id']; ?>', function(r){
		 if(r.success){
		 	$('#content').html(r.data);
		 }
		 });

	});
	$('#weekAfter').click(function(){
		$.get('<?php echo site_url('editor/showLessonsWeekAfter');  ?>' + '/' + '<?php echo $date['startWeek']; ?>' + '/' + '<?php echo $date['finishWeek']; ?>' + '/' + '<?php echo $date['id']; ?>', function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});
	});
	$('.clickable_row').click(function(){
		$.get('<?php echo site_url('editor/showLesson');  ?>' + '/' + '<?php echo $date['id']; ?>' + '/' + $(this).attr('data-date') + '/' + $(this).attr('id') + '/' + '<?php echo $date['startWeek']; ?>' + '/' + '<?php echo  $date['finishWeek']; ?>' + '/' + $(this).attr('data-lessonId'), function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});

	});
</script>