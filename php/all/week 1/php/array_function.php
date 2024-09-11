<?php
$a=[[1,2],[3,4]];
    print_r($a[1]);
    print_r($a);
    foreach ($a as $k => $v) {}

    echo '<br /><br />';

?>
<h5>CASE_LOWER,CASE_UPPER</h5>
<?php
$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
print_r(array_change_key_case($age,CASE_LOWER));
print_r(array_change_key_case($age,CASE_UPPER));
print_r(array_change_key_case($age));
echo '<br /><br />';
?>

<h4> array_chunk ---index,array</h4>
<!-- array --- split an array small part -->
<!-- and added in to new array -->
<?php
$cars=array("Volvo","BMW","Toyota","Honda","Mercedes","Opel");
print_r(array_chunk($cars,3));
?>

<h4> colunm </h4>
<?php
$a = array(
  array(
    'id' => 5698,
    'first_name' => 'aaa',
    'last_name' => 'parikh',
  ),
  array(
    'id' => 4767,
    'first_name' => 'bbb',
    'last_name' => 'aanchal',
  ),
  array(
    'id' => 3809,
    'first_name' => 'ccc',
    'last_name' => 'enni',
  )
);

$last_names = array_column($a, 'last_name', 'id');
// $last_names = array_column($a, 'last_name');

print_r($last_names);
?>

<h4> array_combine </h4>
<!-- same size OF INDEX -->
<?php
$fname=array("AAA","BBB","CCC");
$age=array("35","37","43");
print_r(array_combine($fname,$age));
?>

<h4> array_count_values </h4>
<!-- count all the char -->
<?php
$a=array("A","Cat","Dog","A","Dog","a","Dog");
print_r(array_count_values($a));
?>

<h4>array_fill</h4>
<!-- index,ln+,value -->
<?php
    $a1=array_fill(3,4,"blue");
    $b1=array_fill(0,1,"red");
    $c1=array_fill(6,3,"color");
    print_r($a1);
    echo "<br>";
    print_r($b1);
    echo "<br>";
    print_r($c1);
?>

<h4>array_fill_keys</h4>
<!-- index set --- value  -->
<!-- index set, every index set value -->
<?php
    $keys=array("a","b","c","d");
    $a1=array_fill_keys($keys,"blue");
    print_r($a1);
?>


<h4>array_keys</h4>
<!-- print all key -->
<?php
    $a=array("Volvo"=>"XC90","BMW"=>"X5","Toyota"=>"Highlander");
    print_r(array_keys($a));
    
?>

<h4>array_merge</h4>
<?php
    $a1=array("red","green");
    $a2=array("blue","yellow");
    $a3=array("blue","yellow");
    print_r(array_merge($a1,$a2,$a3));
?>

<h4>array_pop</h4>
<!-- remove last element -->
<?php
    $a=array("red","green","blue","color");
    array_pop($a);
    print_r($a);
?>

<h4>array_product</h4>
<!-- multiplication *,only allow numeric -->
<?php
    $a=array(10,10);
    echo(array_product($a));
?>

<h4>array_push</h4>
<!-- add data...push data -->
<?php
    $a=array("red","green");
    array_push($a,"blue");
    print_r($a);
?>


<h4>string to array</h4>
<!-- breack a string -->
<?php
    $a="Hello World";
    $b=explode(" ",$a);
    print_r($b);
?>
<h4>array to string </h4>
<!-- inplode join a string  -->
<?php
    $arr = array("good",'morning');
    echo join(" ",$arr);
    echo "<br>";echo "<br>";
    echo implode("",$arr);
?>