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
  <?php echo readfilms(); ?>
</body>
</html>