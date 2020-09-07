<?php
  $username = "Kaarel Eelmäe";
  $fulltimenow = date("d.M.Y. H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  if($hournow < 6){
	  $partofday = "uneaeg";
  }
  if($hournow >= 6 and $hournow < 8) {
	  $partofday = "hommikuste protseduuride aeg";
  }
  if($hournow >= 6 and $hournow < 18) {
	  $partofday = "õppimise aeg";
  }
  
?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>Veebileht</title>

</head>
<body>
  <img src="../IMG/vp_banner.png" alt="Veebiprogrammeerimise kuruse bänner">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogia instituudis</p>
  <p>Lehe avamise aeg: <?php echo $fulltimenow; ?>. 
  <?php echo "Parjasti on " .$partofday ."."; ?></p>
</body>
</html>