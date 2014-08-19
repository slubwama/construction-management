<?php

include('functions.php');
if(!loggedin())
{
  header("location:login..php");
}
?>