<div class="panel panel-default eventType" id="eventType_<?= $uid; ?>_div">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?= $name ?: 'Event Type'; ?>
			<button type="button" class="btn btn-sm btn-danger pull-right deleteButtonPosition"
			        onclick='deleteRow("eventType_<?= $uid; ?>_div")'>X</button>
		</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="eventTypes[<?= $uid; ?>][name]">Name:</label>
					<input type="text" class="form-control" name="<?= $prefix; ?>eventTypes[<?= $uid; ?>][name]"
					       value="<?=
					$name; ?>"/>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="eventTypes[<?= $uid; ?>][title]">Title:</label>
					<input type="text" class="form-control" name="<?= $prefix; ?>eventTypes[<?= $uid; ?>][title]" value="<?= $title; ?>"/>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="eventTypes[<?= $uid; ?>][color]">Color:</label>
					<input type="text" class="form-control" name="<?= $prefix; ?>eventTypes[<?= $uid; ?>][color]" value="<?= $color; ?>"/>
				</div>
			</div>
		</div>

	</div>
</div>