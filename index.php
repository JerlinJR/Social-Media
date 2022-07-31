<?php
include 'libs/load.php';
print_r($_SERVER);


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

	<script src="/app/assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>