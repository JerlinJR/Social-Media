<pre>
<?php

include 'libs/load.php';

echo "_FILES\n";
// print_r($_FILES);


$a = new Post(1);
// print($a->getOwner());
print($a->getPostText());

?>
</pre>