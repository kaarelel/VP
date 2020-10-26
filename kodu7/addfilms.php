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
  //kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
  require ("fnc_film.php");
  //kui klikiti nuppu, siis kontrollime ja salvestame
  $inputerror = "";
  //kontrollin, kas on väärtust filmisisestamisel (erinevatel kategooriatel)
  if (isset($_POST["filmsubmit"])){
	  if(empty($_POST["titleinput"])){  
		$inputerror .= "Pealkirja väli on sisestamata!";		
	  }
	  if(empty($_POST["genreinput"])){
		 $inputerror .= "Zanri väli on sisestamata!";
	  }
	  if(empty($_POST["studioinput"])){
		 $inputerror .= "Stuudio väli on sisestamata!";
	  }
	  if(empty($_POST["directorinput"])){
		 $inputerror .= "Lavastaja väli on sisestamata!";
	  }
	  if($_POST["yearinput"] > date("Y") or $_POST["yearinput"] < 1895){
		  $inputerror .= "Ebareaalne valmimisaasta!";
	  }
	  if(empty($inputerror)){
		writefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);  
	  }
  }
  
  
  
  $username = "Kaarel Eelmäe";

  require("header.php");
?>

  <img src="../IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  
	<ul>
		<li><a href="home.php">Kodulehele</a></li>
	</ul> 
  <hr>
  <form method="POST">
	<label for="titleinput">Filmi pealkiri: </label>
	<input type="text" name="titleinput" id="titleinput" placeholder="pealkiri">
	<br>
	<label for="yearinput">Filmi valmimisaasta: </label>
	<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
	<br>
	<label for="durationinput">Filmi kestvus minutites: </label>
	<input type="number" name="durationinput" id="durationinput" value="80">
	<br>
	<label for="genreinput">Filmi žanr: </label>
	<input type="text" name="genreinput" id="genreinput" placeholder="žanr">
	<br>
	<label for="studioinput">Filmi tootja/stuudio: </label>
	<input type="text" name="studioinput" id="studioinput" placeholder="stuudio">
	<br>
	<label for="directorinput">Filmi lavastaja: </label>
	<input type="text" name="directorinput" id="directorinput" placeholder="lavastaja">
	<br>
	<input type="submit" name="filmsubmit" value="Salvesta filmiinfo">
  </form>
  <p><?php echo $inputerror; ?></p>
</body>
</html>