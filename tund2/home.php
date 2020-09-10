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
  if($hournow >= 18 and $hournow < 20) {
	  $partofday = "õhtuste tegevuste aeg";
  }
  if($hournow >= 9 and $hournow < 17) {
	  $partofday = "tööl olemise aeg";
  }
  //jälgime semestri kulgu
  $semesterstart = new DateTime("2020-8-31");
  $semesterend = new DateTime("2020-12-13");
  $semesterduration = $semesterstart->diff($semesterend);
  $today = new DateTime("now");
  $fromsemesterstart = $semesterstart->diff($today);
  //saime aja erinevuse objektina, seda niisama näidata ei saa
  $fromsemesterstartdays = $fromsemesterstart->format("%r%a"); 
  $semesterstarted = "";
  if($today>$semesterstart) {
    $semesterstarted = "Semester on alanud";
  }else {
    $semesterstarted = "Semester pole alanud";
  }
  if($fromsemesterstart > $semesterduration){
    $semesterstarted = "Semester on lõppenud";
  }
  $totaldaysleft = $semesterduration->format("%a");
  $percentagecompleted = ($totaldaysleft / 100) * $fromsemesterstartdays;
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
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogia
    instituudis</p>
  <p>Lehe avamise aeg:
    <?php echo $fulltimenow .", Semestri algusest on möödunud " .$fromsemesterstartdays ." päeva"; ?>.
    <?php echo "Parjasti on " .$partofday ."."; ?></p>
    <?php echo  $semesterstarted; ?></p>
    <?php echo "Õppetööd on jäänud " .$totaldaysleft ." päeva"; ?></p>
    <?php echo "Semestri õppetööst on tehtud " .$percentagecompleted ."%"; ?></p>
</body>

</html>