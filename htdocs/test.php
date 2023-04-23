
<?php
function TakeAllBags($A, $D, $E)
{
    for ($i = 0; $i < 3; $i++) {
        for ($j = $i+1; $j < 3; $j++) {
            if ($A[$i] + $A[$j] <= $D) {
                if (array_sum($A) - $A[$i] - $A[$j] <= $E) {
                    return "Yes";
                }
            }
        }
    }
    return "No";
}

$A = array(8, 5, 7);
$D = 15;
$E = 6;

$result = TakeAllBags($A, $D, $E);
echo $result;


// Variables : 
// Read seven integers from user and store in array a
//  Loop through the array to seprate 1 and 0
//      If a is 1, increment sunnyDays by 1
//      If a is 0, increment rainyDays by 1
//  If sunnyDays is greater equal to rainyDays, output "Good"
//     Otherwise, output "Bad"

// <?php

// $a = array(1, 0, 1, 1, 0, 0, 1); 

// $sunnyDays = 0;
// $rainyDays = 0;

// foreach ($a as $day) {
//     if ($day == 1) {
//         $sunnyDays++;
//     } else {
//         $rainyDays++;
//     }
// }

// if ($sunnyDays > $rainyDays) {
//     echo "Nalla Climate Pa :)";
// } else {
//     echo "Ennaa Climate ya ithu :( ";
// }