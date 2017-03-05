<script type="text/javascript">
	//attach mf_modal as adapter for bootbox component
	$((function($){
		$.MF_modal = function(options){
			var _settings = $.extend({
				title: 'Void title',
				content: 'Void Content',
				buttons: {}
			}, options);
			if(_settings.buttons && !('close' in _settings.buttons)){
				_settings.buttons.close = {
					label: 'Close',
					className: 'btn ajax-btn'
				}
			}
			bootbox.dialog({
				title: _settings.title,
				message: _settings.content,
				buttons: _settings.buttons,
				onEscape: true
			});
		}
	})(jQuery));


</script>