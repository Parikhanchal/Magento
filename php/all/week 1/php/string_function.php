<!-- echo print statement as it is -->
<?php
    echo "Hello world!";
    print 'hello';
?>
<br><br>

<!-- join--join two string -->
<!-- join,implode two statement,word etc  -->
<?php
    $arr = array("good",'morning');
    echo join(" ",$arr);
    echo "<br>";echo "<br>";
    echo implode("",$arr);
?>
<br><br>

<!-- str_shaffle -->
<!-- word chage every time when refesh the page....lenth same but index number chage in simple world chage every time  -->
<?php
    echo str_shuffle ("hello");
?>
<br><br>

<!-- strstrtolower & strtoupper -->
<?php
    echo strtolower("Hello WORLD.")."<br>";echo "<br>";
    echo strtoupper("Hello WORLD.")
?>

<br><br>
<?php
    $a = "goodbye";
    echo chunk_split($a,1,"_");
    // split the string to samll parts...
    //string,parts,end 
    echo "<br>";
    $b
?>
<br>
<br>
<?php
    // replace 
    // str_replace --- case-sensitive
    echo str_replace("Hi","Hello","Hello World");
    // first - replace 
    // sec - replace which (first replace with second)    
    // last - string main
    // hello world
    echo "<br>";echo "<br>";
    echo str_replace("Good","Good World","World");
    echo "<br>";echo "<br>";
    // str_ireplace --- case-insensitive
    // first - replace 
    // sec - replace which (first replace with second)    
    // last - string main
    // hello world---change full string
    echo str_ireplace("HeLLo","Enni","Hello world!");
    echo "<br>";
    echo str_ireplace("Hello","Peter","Hello world!");
    echo "<br>";
    // strtr
    // chage only characters
    echo strtr("Hilla Warld","ial","eok");
    echo "<br>";
    echo strtr("Hilll Warld","ial","eo");
    echo "<br>";

?>
<br><br>

<?php
    // split 
    // string first and sec length
    
    print_r(str_split("Hello world",3));
    echo "<br>";
    echo str_split("Hello world",1); //not use

    echo "<br>";
    
?>
<br><br>

<?php
    // sab_string
    // string,start,length
    //  count string

    echo sab_string("Hello world",6);
    echo "<br>";
    echo sab_string("Hello world",6,3);
    echo "<br>";

    $arr = array("Hello world");
    echo join(" ",$arr);

    

?>



