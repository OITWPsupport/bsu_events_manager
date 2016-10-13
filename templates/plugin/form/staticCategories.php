<div class="panel panel-default staticCategory" id="staticCategories_<?= $uid; ?>_div">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?= $name ?: 'Static Category'; ?>
			<button type="button" class="btn btn-sm btn-danger pull-right deleteButtonPosition"
			        onclick='deleteRow("staticCategories_<?= $uid; ?>_div")'>X</button>
		</h3>
	</div>
	<div class="panel-body">
		<div class="row form-group col-md-12">
			<label for="staticCategories[<?= $uid; ?>]">Name:</label>
			<input type="text" class="form-control" name="<?= $prefix; ?>staticCategories[<?= $uid; ?>]" value="<?=
			$name; ?>"/>
		</div>
	</div>
</div>