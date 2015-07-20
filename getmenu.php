<?php

session_start();


if(isset($_SESSION['menuarray']) && !empty($_SESSION['menuarray'])) {
	$menuarray = $_SESSION['menuarray'];
}

// Array with menu items

	
	

// get the q parameter from URL
$q = $_GET["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($menuarray as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint = $hint . ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
 
?>