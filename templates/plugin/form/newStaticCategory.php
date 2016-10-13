<div id="newStaticCategories"></div>

<button class="btn btn-success" type="button" onclick="newStaticCategory()">
	+ New Static Category
</button>
<script>
	function newStaticCategory() {
		var count = jQuery('.staticCategory').length;
		var prefix = "<?= $prefix; ?>";
		var form = [
			'<div class="panel panel-default staticCategory" id="staticCategory_' + count + '_div">',
			'<div class="panel-heading">',
			'<h3 class="panel-title">New Static Category',
			'<button type="button" class="btn btn-sm btn-danger pull-right deleteButtonPosition" onclick=\'deleteRow("staticCategory_' + count + '_div")\'>X</button>',
			'</h3>',
			'</div>',
			'<div class="panel-body">',
			'<div class="row form-group col-md-12">',
			'<label for="staticCategories[' + count + ']">Name:</label>',
			'<input type="text" class="form-control" name="' + prefix + 'staticCategories[' + count + ']"/>',
			'</div></div></div>'
		].join('');
		jQuery('#newStaticCategories').append(form);
		jQuery('#staticCategory_' + count + '_div').hide().slideToggle(300);
	}
</script>