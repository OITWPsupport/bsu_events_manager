<?= $this->includes($id); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.1.2/angular-strap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.1.2/angular-strap.tpl.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.12/angular-animate.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>


<h2>Bsu Events Manager Shortcode Creator</h2>

<div
	ng-controller="MainCtrl"
	id="<?= $id; ?>"
	ng-init="init('<?= $params ; ?>')"
	ng-cloak>

	<shortcode-form categories="categories"></shortcode-form>

</div>

<script src="<?= $dashboard; ?>" onload="initBsuEventsApp('eventsAdminApp')"></script>