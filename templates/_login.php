<?php

$username=$_POST['username'];
$password = $_POST['password'];

$result = validate_credentials($username,$password);

if($result){
    ?>
    <main class="container">
        <div class="bg-light p-5 rounded mt-3">
            <h1>Login Sucess</h1>
            <p class="lead">This example of login page.</p>
        </div>
    </main>
<?php

} else {

?>

<main class="form-signin w-100 m-auto">
  <form action="login.php" method="post">
    <img class="mb-4" src="docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="email" class="form-control" name="username" placeholder="name@example.com">
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
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  </form>
</main>


<?php
}
?>