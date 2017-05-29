<?php

try {
  $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=pacifico',
  'postgres', 'jarl');
}
catch(PDOException $e)
{
  echo $e->getMessage();
}
