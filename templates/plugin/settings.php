<?= $this->includes(1); ?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>
<div class="wrap">

	<?php settings_errors(); ?>
	<form method="POST" action="options.php" class="col-md-12">
		<?php settings_fields( 'boise_state_events_settings' ); ?>
		<?php do_settings_sections( 'boise_state_events_settings_options' ); ?>
		<?php submit_button(); ?>
	</form>

</div>

<script>
	function deleteRow(id){
		var elem = jQuery('#' + id);
		elem.slideToggle(400, function(){
			elem.remove();
		});
	}
</script>