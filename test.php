<pre>
<?php
include 'libs/load.php';



// print_r($_POST);

// $conn = Database::getConnection();
// $conn = Database::getConnection();
// $conn = Database::getConnection();


$user = "admin";
// $pass = "1";
$username ="Jerlin";


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
$object2 = new User($username);


if ($object1) {
    // print_r($object1->id);
    echo "object1 = $object1->id"."\n";
// print_r($object1->id);
} else {
    echo "Something went wrong"."\n";
}

if ($object2) {
    // print_r($object2->id);
    echo "object2 = $object2->id"."\n";
    

// print_r($object1->id);
} else {
    echo "Something went wrong"."\n";
}


//----------------------- Working of getbio() and setbio()------------------------------
// if ($object2->setbio("Updated Bsdfdasio")) {
//     echo "sucess";
// } else {
//     echo 'failed';
// }

// if ($object2->getbio()) {
//     echo $object2->getbio();
// } else {
//     echo "Nothing returned";
// }

//------------------Working of getavatar() and setavatar()--------------------------------

// if ($object2->setavatar("Updated avatar")) {
//     echo "sucess";
// } else {
//     echo 'failed';
// }

// if ($object2->getavatar()) {
//     echo $object2->getavatar();
// } else {
//     echo "Nothing returned";
// }

//------------------- working with getfirstname() getsecondname()------------------------------

if ($object2->setLastName("Updated firsftname")) {
    echo "sucess";
} else {
    echo 'failed';
}

if ($object2->getLastName()) {
    echo $object2->getLastName();
} else {
    echo "Nothing returned";
}













?>

</pre>