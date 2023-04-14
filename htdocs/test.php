<pre>
<?php


// print_r($_SERVER);
// print(basename($_SERVER["PHP_SELF"],'.php'));
?>
</pre>

<?

// echo phpinfo();

include 'libs/load.php';


$p = new Post(19);

$del = $p->delete();
if($del){
    echo "Deleted";
} else {
    echo "Not Deleted";
}
















































// print_r($_POST);

// $conn = Database::getConnection();
// $conn = Database::getConnection();
// $conn = Database::getConnection();


// $user = "admin";
// $pass = "1";
// $username ="Jerlin";


// $result = UserSession



//create function with an exception
// function checkNum($number) {
//   if($number>1) {
//     throw new Exception("Value must be 1 or below");
//   }
//   return true;
// }

// //trigger exception in a "try" block
// try {
//   checkNum(2);
//   //If the exception is thrown, this text will not be shown
//   echo 'If you see this, the number is 1 or below';
// }

// //catch exception
// catch(Exception $a) {
//   echo 'Message: ' .$a->getMessage();
// }

// $result = User::__construct($user);

// $object1 = new User($user);

// $object1->Thisoisafunction();
// $object2 = new User($username);

// print($object1->getBio());
// print($object1->getFirstname());
// $a = $object1->setBio("Reset BIo");

// if ($a) {
//     echo "sucess";
// } else {
//     echo "Failed";
// }








?>

</pre>

