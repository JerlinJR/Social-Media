<!doctype html>
<html lang="en">

<?php load_template("_head");?>

<body>
	<?php load_template("_header");?>
	<main>

        <?load_template(Session::currentScript());?>
	
    </main>

    <?php load_template("_footer");?>

	<script src="<?=get_config('base_path')?>assets/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>