<div class="panel panel-default calendar" id="calendar_<?= $uid; ?>_div">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?= $name ?: 'Calendar'; ?>
			<button type="button" class="btn btn-sm btn-danger pull-right deleteButtonPosition"
			        onclick='deleteRow("calendar_<?= $uid; ?>_div")'>X</button>
		</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="calendars[<?= $uid; ?>][name]">Name:</label>
					<input type="text" class="form-control" name="<?= $prefix; ?>calendars[<?= $uid; ?>][name]" value="<?= $name; ?>"/>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="calendars[<?= $uid; ?>][id]">ID:</label>
					<input type="text" class="form-control" name="<?= $prefix; ?>calendars[<?= $uid; ?>][id]" value="<?= $id; ?>"/>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="calendars[<?= $calendar['id']; ?>][visible]">Visible:</label>
					<div class="checkbox">
						<input type="radio" name="<?= $prefix; ?>calendars[<?= $uid; ?>][visible]" value="true" <?= $visible == 'true' || $visible ? 'checked="checked"' : ''; ?>/> True <br/>
					</div>
					<div class="checkbox">
						<input type="radio" name="<?= $prefix; ?>calendars[<?= $uid; ?>][visible]" value="false" <?= $visible == 'false' || !$visible ? 'checked="checked"' : ''; ?>/> False
					</div>
				</div>
			</div>
		</div>

	</div>
</div>