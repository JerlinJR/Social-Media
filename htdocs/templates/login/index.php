<?php

$login_page = true;

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = UserSession::authenticate($username, $password);
    $login_page = false;

}

if (!$login_page) {
    if ($result) {
        $should_redirect = Session::get('_redirect');
		// echo Session::get('_redirect');
        $redirect_to = get_config('base_path');
        if (isset($should_redirect)) {
            $redirect_to = $should_redirect;
			Session::set('_redirect', false);
		}
        ?>
<script>
	window.location.href = "<?=$redirect_to?>"
</script>

<?php
    } else {
		?>
		<script>
			window.location.href = "/login.php?error=1"
		</script>
		
		<?php
    }
} else {
    ?>

<main class="form-signin w-100 m-auto">
	<form method="post" action="login.php">
		<img class="mb-4" src="" alt=""
			height="50">
		<input name="fingerprint" type="hidden" id="fingerprint" value="">
		<h1 class="h3 mb-3 fw-normal">Please sign in</h1>
		<?
		if(isset($_GET['error'])){
			?>
			<div class="alert alert-danger" role="alert">
				Invalid Credentials
			</div>
			<?
		}
		?>
		<div class="form-floating">
			<input name="username" type="text" class="form-control" id="floatingInput"
				placeholder="name@example.com">
			<label for="floatingInput">Email address or Username</label>
		</div>
		<div class="form-floating">
			<input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
			<label for="floatingPassword">Password</label>
		</div>

		<div class="checkbox mb-3">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="w-100 btn btn-lg btn-primary hvr-grow-rotate" type="submit">Sign in</button>
		<a href="/signup.php" class="w-100 btn btn-link">Not registered? Sign up</a>
	</form>
</main>

<?php
}
?>




