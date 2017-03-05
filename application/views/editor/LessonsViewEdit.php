<?php
$_days = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота');
$_time = array('8.30-10.05', '10.25-12.00', '12.30-14.05', '14.20-15.55','16.05-17.40','17.45-19.15','19.15-20.30');
$_indexM = 0;
?>
<div class="one">
    <div class="two two1">Сегодня — <?php echo date('d.m.Y'); ?></div>
</div>

<h1>Нижняя неделя</h1>
<div class="col-md-12">
	<?php for($_index = 0; $_index < count($_days); $_index++): ?>
		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $_days[$_index]; ?></h3>
				</div>
				<div class="box-body no-padding">
					<table class="table timetable">
						<tbody>
						<?php for($_row = 0; $_row < count($_time); $_row++): ?>
							<tr id = "<?php echo $data[$_indexM]['employ_id']?>" align="left" data-idTimetable = "<?php echo $data[$_indexM]['timetable_id']?>" class="clickable_row" >
								<td align="left"><?php echo $_time[$_row]; ?></td>
								<td align="left"><?php echo $data[$_indexM]['name']; ?></td>
								<td align="left"><?php echo $data[$_indexM]['short_description']; $_indexM++; ?></td>
								<td></td>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endfor; ?>
</div>

<h1>Верхняя неделя</h1>
<div class="col-md-12">
	<?php for($_index = 0; $_index < count($_days); $_index++): ?>
		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $_days[$_index]; ?></h3>
				</div>
				<div class="box-body no-padding">
					<table class="table timetable">
						<tbody>
						<?php for($_row = 0; $_row < count($_time); $_row++): ?>
							<tr id = "<?php echo $data[$_indexM]['employ_id']?>"   class="clickable_row" data-idTimetable = "<?php echo $data[$_indexM]['timetable_id']?>" >
								<td align="left"><?php echo $_time[$_row]; ?></td>
								<td align="left"><?php echo $data[$_indexM]['name']; ?></td>
								<td align="left"><?php echo $data[$_indexM]['short_description']; $_indexM++; ?></td>
								<td></td>
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
</style>

<script type="text/javascript">
	$('.clickable_row').click(function(){
		$.get('<?php echo site_url('editor/showLessonForEdit/');  ?>'  + $(this).attr('id') + '/' + $(this).attr('data-idTimetable'), function(r){
			if(r.success){
				$('#content').html(r.data);
			}
		});

	});
</script>