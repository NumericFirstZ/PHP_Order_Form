<?php
$con = mysqli_connect("localhost", "root", "", "items_option") or die ("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ")
?>