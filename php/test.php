<?php

    // $d1 = "21-02-2023 03:00:00";
    // $d2 = "02-01-2023 03:00:00";

    // $date = $d1 - $d2;
    // echo $date;
    // echo "<br>";
    // echo strtotime($d1)."<br>"; 
    // echo strtotime($d2)."<br>";
    // echo strtotime($date)."<br>";

    // echo "current: " . date("Y/m/d") . "<br>"; 
    // echo "<hr>";
?>

<?php

    $d1 = "15-10-2024";
    $d2 = "16-10-2024";

    $time1 = strtotime($d1); 
    echo $time1."<br>";
    $time2 = strtotime($d2); 
    echo $time2."<br>";
    echo "<br>";

    $time = $time1 - $time2;
    echo "time diff:".$time."<br><br>";

    $diff = $time / (60*60*24);
    echo "days:".$diff."<br>";

    $diff = $time / (60*60);
    echo "hours:".$diff."<br>";

    $diff = $time / 24;
    echo "minutes:".$diff."<br>";

    echo "<br>";

?>

<?php
    $date1 = '15-10-2023';
    $date2 = '20-10-2023';
    
    
    $time1 = strtotime($date1)."<br>";
    // echo $time1."<br>";
    $time2 = strtotime($date2)."<br>";
    // echo $time2."<br>";
    $time = $time1 - $time2;
    // echo $time ."</br>"; 

    $diff = $time / (60 * 60 * 24);
    echo "Days:".$diff. "<br>";
    
    $hour = $time / (60 * 60);
    echo "Hours:".$hour. "<br>";
    
    $minute = $time / (24);
    echo "Minutes:".$minute."<br>";
    
    $second = ($minute * 60);
    echo "Seconds:".$second;
    
?>
