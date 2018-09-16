<?php

$link = mysqli_connect('localhost', 'root', 'azerty');
if (!$link)
{
  echo 'Unable to connect to the database server.';
  exit();
}

if (!mysqli_set_charset($link, 'UTF8'))
{
  echo 'Unable to set database connection encoding.';
  exit();
}

if(!mysqli_select_db($link, 'gestion_pavc'))
{
  echo 'Unable to locate demo database.';
  exit();  
}
?>