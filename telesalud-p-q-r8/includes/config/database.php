<?php

function conectarDB() : mysqli {
  $db = mysqli_connect('localhost', 'root', '//mI@kLo5&672A&dy@ey//', 'db_telesalud_btemp1_1_3');

  if (!$db) {
    echo "La base de datos NO se ha conectado correctamente";
    exit;
  }

  return $db;
}
 