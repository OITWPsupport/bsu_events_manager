<div id="newEventTypes"></div>

<button class="btn btn-success" type="button" onclick="newEventType()">
	+ New Event Type
</button>
<script>
	function newEventType() {
		var count = jQuery('.eventType').length;
		var prefix = "<?= $prefix; ?>";
		var form = [
			'<div class="panel panel-default eventType" id="eventType_' + count + '_div">',
			'<div class="panel-heading">',
			'<h3 class="panel-title">New Event Type',
			'<button type="button" class="btn btn-sm btn-danger pull-right deleteButtonPosition"',
			'onclick=\'deleteRow("eventType_' + count + '_div")\'>X</button>',
			'</h3></div><div class="panel-body"><div class="row"><div class="col-md-4"><div class="form-group">',
			'<label for="eventTypes[' + count + '][name]">Name:</label>',
			'<input type="text" class="form-control" name="' + prefix + 'eventTypes[' + count + '][name]"/>',
			'</div></div><div class="col-md-4"><div class="form-group">',
			'<label for="eventTypes[' + count + '][title]">Title:</label>',
			'<input type="text" class="form-control" name="' + prefix + 'eventTypes[' + count + '][title]"/>',
			'</div></div><div class="col-md-4"><div class="form-group">',
			'<label for="eventTypes[' + count + '][color]">Color:</label>',
			'<input type="text" class="form-control" name="' + prefix + 'eventTypes[' + count + '][color]"/>',
			'</div></div></div></div></div>'
		].join('');
		jQuery('#newEventTypes').append(form);
		jQuery('#eventType_' + count + '_div').hide().slideToggle(300);
	}
</script>