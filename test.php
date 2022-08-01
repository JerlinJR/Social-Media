<pre>
<?php
include 'libs/load.php';



// print_r($_POST);

// $conn = Database::getConnection();
// $conn = Database::getConnection();
// $conn = Database::getConnection();


$user = "Jerlin";
// $pass = "1";
// $username ="Jerlin";


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

$object1 = new User($user);
// $object2 = new User($username);

print($object1->getBio());
print($object1->getFirstname());
$a = $object1->setBio('bio',"__call function implementation");

if($a){
echo "sucess";
} else {
echo "Failed";
}








?>

</pre>