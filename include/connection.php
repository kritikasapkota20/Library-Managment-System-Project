<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_select_db($link, "digital_library");
if (!$link) {
   die('Could not connect: ');
}