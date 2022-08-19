<?php
include 'libs/load.php';

?>

<!doctype html>
<html lang="en">

<!-- Head -->

<?php load_template("_head");?>

<!-- Head -->


<body>
	
	<!-- Header -->

	<?php load_template("_header");?>

	<!-- Header -->

	<main>

		<?php load_template("_section");?>

		<?php load_template("_main");?>

	</main>
	<?php load_template("_footer");?>

	<script src="<?=get_config('base_path')?>assets/dist/js/bootstrap.bundle.min.js"></script>


	<script>
	// Initialize the agent at application startup.
	const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
		.then(FingerprintJS => FingerprintJS.load())

	// Get the visitor identifier when you need it.
	fpPromise
		.then(fp => fp.get())
		.then(result => {
		// This is the visitor identifier:
		const visitorId = result.visitorId
		console.log(visitorId)
		alert(visitorId)
		})
	</script>

</body>

</html>