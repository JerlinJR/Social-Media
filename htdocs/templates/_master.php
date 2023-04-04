<!doctype html>
<html lang="en">

<?php Session::loadTemplate("_head");?>

<body>
	<?php Session::loadTemplate("_header");?>
    
	<main>
        <?php
        if(Session::$isError){
            Session::loadTemplate("_error");
        } else {
           Session::loadTemplate(Session::currentScript());

        } 
	?>
    </main>

    <?php Session::loadTemplate("_footer");?>

	<script src="<?=get_config('base_path')?>assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="/js/app.min.js"></script>
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
        $('#fingerprint').val(visitorId);
        })
    </script>


</body>

</html>