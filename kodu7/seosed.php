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
  require("fnc_film.php");
  require("fnc_seosed.php");
  
  //kui klikiti nuppu, siis kontrollime ja salvestame
  $inputerror = "";
  //kontrollin, kas on väärtust filmisisestamisel (erinevatel kategooriatel)
  
  $genrenotice = "";
  $studionotice = "";
  $selectedfilm = "";
  $selectedgenre = "";
  $selectedstudio = "";
  
  if(isset($_POST["filmstudiosubmit"])){
	if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	  } else {
		  $studioNotice = " Vali film ";
	  }
	 if(!empty($_POST["filmstudioinput"])){
		$selectedstudio = intval($_POST["filmstudioinput"]);
	  } else {
		 $studionotice = " Vali stuudio ";
	  }
	  if(!empty($selectedfilm) and !empty($selectedstudio)){
		  $studionotice = storenewstudiorelation($selectedfilm, $selectedstudio);
	  }
  }
  
  if(isset($_POST["filmgenresubmit"])){

	//$selectedfilm = $_POST["filminput"];
	if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$genrenotice = " Vali film!";
	}
	if(!empty($_POST["filmgenreinput"])){
		$selectedgenre = intval($_POST["filmgenreinput"]);
	} else {
		$genrenotice .= " Vali žanr!";
	}
	if(!empty($selectedfilm) and !empty($selectedgenre)){
		$genrenotice = storenewgenrerelation($selectedfilm, $selectedgenre);
	}
  }
  
  $filmselecthtml = readmovietoselect($selectedfilm);
  $filmgenreselecthtml = readgenretoselect($selectedgenre);
  $filmstudioselecthtml = readstudiotoselect($selectedstudio);
  
  
  
  
  
  
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
  <h2> Määrame filmile stuudio</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<?php
	  echo $filmselecthtml;
	  echo $filmstudioselecthtml;
	?>
    <input name="filmstudiosubmit" type="submit" value="Salvesta andmed">
  </form>
 
  <hr>
  <h2>Määrame filmile žanri</h2>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php
		echo $filmselecthtml;
		echo $filmgenreselecthtml;
	?>
	
	<input type="submit" name="filmrelationsubmit" value="Salvesta filmiinfo"><span><?php echo $studionotice; ?></span>
  </form>


  </form>
  <p><?php echo $inputerror; ?></p>
</body>
</html>