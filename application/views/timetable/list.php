<?php foreach($list as $key => $value): ?>
	<div class="row">
		<div class="col-lg-5 col-xs-6">
			<div id="timetable-<?php echo $value['timetable_id']; ?>" class="small-box bg-aqua">
				<div class="inner">
					<h3><?php echo $value['name']; ?></h3>
				</div>
				<div class="icon">
					<i class="fa fa-shopping-cart"></i>
				</div>
				<a href="#" class="small-box-footer">
					Просмотреть <i class="fa fa-arrow-circle-right"></i>
				</a>
				<a href="#" class="timetable-edit-button small-box-footer">
					Редактировать <i class="fa fa-arrow-circle-right"></i>
				</a>
				<a href="#" class="timetable-remove-button small-box-footer">
					Удалить <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<div class="row">
	<div class="col-lg-5 col-xs-6">
		<div class="small-box bg-green">
			<div class="icon">
				<i class="fa fa-shopping-cart"></i>
			</div>
			<a id="timetable-add-button" href="#" class="small-box-footer">
				Добавить <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#timetable-add-button').on('click', function(event){
		event.preventDefault();
		$.get('<?php echo site_url('api/timetable/form') ?>', {type: 'create'}, function(r){
			if(r.success){
				$.MF_modal({
					title: null,
					content: r.data,
					buttons: {
						success: {
							label : '<?php echo 'Сохранить'; ?>',
							className : 'btn-success',
							callback: function(event) {
								event.preventDefault();
								$('.bootbox.modal .modal-body form').submit();
								return false;
							}
						}
					}
				});
			}
		});
		return false;
	});

	$('.timetable-remove-button').on('click', function(r){
		var $this = $(this);
		var _id = $this.parent().attr('id').split('-')[1];
		$.get('<?php echo site_url('api/timetable/remove'); ?>', {id: _id}, function(r){
			if(r.success){
				$.get('<?php echo site_url('api/timetable/all'); ?>', {}, function(r){
					if(r.success){
						$('#content').html(r.data);
					}
				});
			}
		});
	});
	$('.timetable-edit-button').on('click', function(r){
		var $this = $(this);
		var _id = $this.parent().attr('id').split('-')[1];
		$.get('<?php echo site_url('api/timetable/form'); ?>', {type: 'edit',  id: _id}, function(r){
			if(r.success){
				$.MF_modal({
					title: null,
					content: r.data,
					buttons: {
						success: {
							label : '<?php echo 'Сохранить'; ?>',
							className : 'btn-success',
							callback: function(event) {
								event.preventDefault();
								$('.bootbox.modal .modal-body form').submit();
								return false;
							}
						}
					}
				});
			}
		});
	});
</script>