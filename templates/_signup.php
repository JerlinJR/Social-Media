<?php

$signup = false;
// print_r($_POST);
if (!empty(isset($_POST['username'])) and !empty(isset($_POST['password'])) and !empty(isset($_POST['email'])) and !empty(isset($_POST['phone']))) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $error = User::signup($username, $password, $email, $phone);
    $signup = true;
}
?>
<?php
if ($signup) {
    if (!$error) {
        ?>
<main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Signup sucess</h1>
		<p class="lead">Login from <a href="/login.php">here</a>.</p>
	</div>
</main>
<?php
    } else {
        ?>
<main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Signup fail</h1>
		<p class="lead">Something went wrong, <?=$error?>
		</p>
	</div>
</main>

<?php
    }
} else {
    ?>
<main class="form-signup w-100 m-auto">
	<form action="signup.php" method="post">
		<img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
		<h1 class="h3 mb-3 fw-normal">Please Sign Up</h1>

		<div class="form-floating">
			<input type="text" class="form-control" name="username" placeholder="username">
			<label for="floatingInput">Username</label>
		</div>

		<div class="form-floating">
			<input type="text" class="form-control" name="phone" placeholder="phone">
			<label for="floatingInput">Phone</label>
		</div>

		<div class="form-floating">
			<input type="email" class="form-control" name="email" placeholder="name@example.com">
			<label for="floatingInput">Email address</label>
		</div>

		<div class="form-floating">
			<input type="password" class="form-control" name="password" placeholder="Password">
			<label for="floatingPassword">Password</label>
		</div>

		<div class="checkbox mb-3">
			<label>
				<input type="checkbox" value="remember-me"> Remember me
			</label>
		</div>
		<button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
	</form>
</main>
<?php
}
