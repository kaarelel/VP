<?php
session_start();
  
  //kui pole sisseloginud
  

  
  if(!isset($_SESSION["userid"])){
	  //jõuga sisselogimise lehele
	  header("Location: page.php");
  }
    	
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: home.php");
		exit();
		
	}
  //loeme andmebaasi login ifo muutujad
  require("../../../config.php");
  require("fnc_user.php");
  //kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
  require ("fnc_film.php");
  //kui klikiti nuppu, siis kontrollime ja salvestame
  $notice = "";
  $description = "";
  //kontrollin, kas on väärtust filmisisestamisel (erinevatel kategooriatel)
  //algatuseks valin vaikimisvärvid
  //$_SESSION["bgcolor"] ="#FFFFFF";
  //$_SESSION["txtcolor"] ="#000000";
  if (isset($_POST["profilesubmit"])){
	  $notice = storeuserprofile($_POST["descriptioninput"], $_POST["bgcolorinput"], $_POST["txtcolorinput"]);
	  $descrption = $_POST["descriptioninput"];
	  $_SESSION["bgcolor"] = $_POST["bgcolorinput"];
	  $_SESSION["txtcolor"] = $_POST["txtcolorinput"];
  }
  
  
  
  

  require("header.php");
?>

  <img src="../IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> kasutaja profiil</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
  <ul>
	<li><a href="home.php">Kodulehele</a></li>
	<li><a href="?logout=1">Logi välja</a>!</li>
 </ul> 
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="descriptioninput">Minu lühitutvustus: </label>
	<br>
	<textarea rows="10" cols="80" name="descriptioninput" id="descriptioninput" placeholder="Minu tutvustus ..."><?php echo $description; ?></textarea>
	<br>
	<label for="bgcolorinput">Minu valitud taustavärv: </label>
	<input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["bgcolor"]; ?>">
	<br>
	<label for="txtcolorinput">Minu valitud tekstivärv: </label>
	<input type="color" name="txtcolorinput" id="txtcolorinput" value=<?php echo $_SESSION["txtcolor"]; ?>">
	<br>
	<input type="submit" name="profilesubmit" value="Salvesta profiil">
  </form>
  <p><?php echo $notice; ?></p>
  
</body>
</html>