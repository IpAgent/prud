<?php
$_days = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота');
$_time = array('8.30-10.05', '10.25-12.00', '12.30-14.05', '14.20-15.55','16.05-17.40','17.45-19.15','19.15-20.30');
?>

<div class="col-sm-offset-2 col-md-8">
	<div class="box">
		<input id="week-<?php echo (3 - $idx); ?>" type="button" class="switch-week btn btn-block btn-success btn-lg" value="Сменить неделю"/>
	</div>
</div>

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
							<?php
							$_t = array();
							if(isset($data[$_index + 1][$_row + 1]))
							{
								$_t = $data[$_index + 1][$_row + 1];
							}
							?>
							<?php
								$_id = '';
								if(isset($_t['lesson_id']))
								{
									$_id = 'row-' . $_t['lesson_id'];
								}
								else
								{
									$_id = 'void-' . ($_index + 1) . '-'. ($_row + 1);
								}
							?>
							<tr id="<?php echo $_id; ?>" class="clickable_row" >
								<td><?php echo $_time[$_row]; ?></td>
								<td><?php if($_t) echo $_t['name']; ?></td>

								<td><?php if($_t) echo $_t['type']; ?></td>
							</tr>
						<?php endfor; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endfor; ?>
</div>
<script type="text/javascript">
	$('.timetable tr').click(function(){
		var _seq = $(this).attr('id').split('-');
		var _type = _seq[0];
		if(_type === 'row'){
			var _index = _seq[1];
			$.get('<?php echo site_url('lesson/edit/'); ?>' + _index, function(r){
				if(r.success){
					$.MF_modal({
						title: null,
						content: r.data,
						buttons: {
							success: {
								label : '<?php echo 'Сохранить'; ?>',
								className : 'btn-success',
								callback: function() {
									$('.bootbox.modal .modal-body form').submit();
									$.get('<?php echo site_url('editor/timetable/'); ?>' + <?php echo $idx; ?>, function(r){
										if(r.success){
											$('#content').html(r.data);
										}
									});
									return true;
								}
							}
						}
					});
				}
			})
		}
		else if(_type == 'void')
		{
			_week = _seq[1];
			_day = _seq[2];
			_pos = _seq[3];
		}
	});

	$('.switch-week').click(function(){
		var idx = $(this).attr('id').split('-')[1];
		$.get('<?php echo site_url('editor/timetable/'); ?>' + idx, function(r){
			if(r.success){

				$('#content').html(r.data);
			}
		});
	});
</script>