<?php

// Define the salt value
$salt = "SUDO";

// Function to generate the hash code
function generate_hash($input){
    global $salt;
    $hash = md5($input . $salt);
    return $hash;
}

?>
