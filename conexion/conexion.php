<?php

try {
  $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=pacific',
  'postgres', 'jarl');
}
catch(PDOException $e)
{
  echo $e->getMessage();
}