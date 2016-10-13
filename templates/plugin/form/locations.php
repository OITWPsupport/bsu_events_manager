<div class="panel panel-default location" id="location_<?= $uid; ?>_div">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?= $name ?: 'Location'; ?>
			<button type="button" class="btn btn-sm btn-danger pull-right deleteButtonPosition"
			        onclick='deleteRow("location_<?= $uid; ?>_div")'>X</button>
		</h3>
	</div>
	<div class="panel-body">
		<div class="row form-group col-md-12">
			<label for="locations[<?= $uid; ?>][name]">Name:</label>
			<input type="text" class="form-control" name="<?= $prefix; ?>locations[<?= $uid; ?>][name]" value="<?=
			$name; ?>"/>
		</div>
	</div>
</div>