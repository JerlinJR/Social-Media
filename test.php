<pre>
<?php
include 'libs/load.php';



// print_r($_POST);

// signup("jerlidn", "sdaf" ,"dsaf" ,"dsafsadfds");




$mic1 = new Mic('Sony');
print($mic1->brand);
// $mic2 = new Mic();

// $mic1->brand = "Mic1_brand";
// $mic2->brand = "Mic2_brand";


// $mic1->setlight("green");
// $mic2->setlight("RGB");

print($mic1->getlight());
// print($mic2->getlight());



?>
</pre>