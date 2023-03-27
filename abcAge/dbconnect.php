<?php

function OpenCon()
 {
    // insert your data here
 $dbhost = "fdb1027.royalwebhosting.net";
 $dbuser = "4224587_db";
 $dbpass = "Weed4Good!";
 $db = "4224587_db";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
?>