<div id="newLocations"></div>

<button class="btn btn-success" type="button" onclick="newLocation()">
	+ New Location
</button>
<script>
	function newLocation() {
		var count = jQuery('.location').length;
		var prefix = "<?= $prefix; ?>";
		var form = [
			'<div class="panel panel-default location" id="location_' + count + '_div">',
			'<div class="panel-heading">',
			'<h3 class="panel-title">New Location',
			'<button type="button" class="btn btn-sm btn-danger pull-right deleteButtonPosition" onclick=\'deleteRow("location_' + count + '_div")\'>X</button>',
			'</h3>',
			'</div>',
			'<div class="panel-body">',
			'<div class="row form-group col-md-12">',
			'<label for="locations[' + count + '][name]">Name:</label>',
			'<input type="text" class="form-control" name="' + prefix + 'locations[' + count + '][name]"/>',
			'</div></div></div>'
		].join('');
		jQuery('#newLocations').append(form);
		jQuery('#location_' + count + '_div').hide().slideToggle(300);
	}
</script>