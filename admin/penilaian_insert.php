<?php

include '../connection.php';


if (isset($_POST['button']))
  {
     Mysqli_query($connect,"INSERT INTO alternatif_kriteria(id_alternatif, id_kriteria, nilai) VALUES('$_POST[			 id_alternatif]', '$_POST[id_kriteria]', '$_POST[nilai]')");
  }

?>

