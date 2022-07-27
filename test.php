<pre>
<?php
include 'libs/load.php';



// print_r($_POST);


// if(signup("JElasjdkfrisda", "addsafsfd", "JfdsErlin@jelkr.ds", "131111")){
//     echo "sucess";
// } else {
//     echo "fail;";
// }

$error = validate_credentials('jerlin', "jerlin");

if($error){

    echo "true";

} else {
    echo "false";
}

// $conn = Database::getConnection();
// $conn = Database::getConnection();
// $conn = Database::getConnection();


?>

</pre>