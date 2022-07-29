<pre>
<?php

function isDate($value)
{
    if (!$value) {
        return false;
    } else {
        $date = date_parse($value);
        if ($date['error_count'] == 0 && $date['warning_count'] == 0) {
            $result = checkdate($date['month'], $date['day'], $date['year']);
            echo "Result: $result";
            return  $result;
        } else {
            return false;
        }
    }
}

// isDate(25/10/2002);

function filter_mydate($s) {
    if (preg_match('@^(\d\d\d\d)-(\d\d)-(\d\d) (\d\d):(\d\d):(\d\d)$@', $s, $m) == false) {
        return false;
    }
    if (checkdate($m[2], $m[3], $m[1]) == false || $m[4] >= 24 || $m[5] >= 60 || $m[6] >= 60) {
        return false;
    }
    return $s;
}

$date = '2522/12/20';

// if(filter_mydate($date)){
//     // print(filter_mydate($date));
//     echo "valid";
// } else {
//     echo "not valid";
// }

if (strtotime($date) > strtotime(0)) {
    echo 'it is a date';
}


?>
</pre>