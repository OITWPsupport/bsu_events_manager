<div id="newCalendars"></div>

<button class="btn btn-success" type="button" onclick="newCalendar()">
	+ New Calendar
</button>
<script>
	function newCalendar() {
		var count = jQuery('.calendar').length;
		var prefix = "<?= $prefix; ?>";
		var form = [
			'<div class="panel panel-default calendar" id="calendar_' + count + '_div">',
			'<div class="panel-heading">',
			'<h3 class="panel-title">New Calendar',
			'<button type="button" class="btn btn-sm btn-danger pull-right deleteButtonPosition" onclick=\'deleteRow("calendar_' + count + '_div")\'>X</button>',
			'</h3></div>',
			'<div class="panel-body"><div class="row"><div class="col-md-4"><div class="form-group">',
			'<label for="calendars[' + count + '][name]">Name:</label>',
			'<input type="text" class="form-control" name="' + prefix + 'calendars[' + count + '][name]"/>',
			'</div></div><div class="col-md-4"><div class="form-group">',
			'<label for="calendars[' + count + '][id]">ID:</label>',
			'<input type="text" class="form-control" name="' + prefix + 'calendars[' + count + '][id]"/>',
			'</div></div><div class="col-md-4"><div class="form-group">',
			'<label for="calendars[' + count + '][visible]">Visible:</label>',
			'<div class="checkbox">',
			'<input type="radio" name="' + prefix + 'calendars[' + count + '][visible]" value="true" /> True <br/>',
			'</div><div class="checkbox">',
			'<input type="radio" name="' + prefix + 'calendars[' + count + '][visible]" value="false" /> False',
			'</div></div></div></div></div></div>'
		].join('');
		jQuery('#newCalendars').append(form);
		jQuery('#calendar_' + count + '_div').hide().slideToggle(300);
	}
</script>