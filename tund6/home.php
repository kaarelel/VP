<?php
  //$username = "Andrus Rinde";
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
  
  require("header.php");
?>

  <img src="../IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p><a href="?logout=1">Logi välja</a></p>
  <ul>
	<li><a href="mõtteid.php">Mõtete lisamine</a></li>
    <li><a href="kirjutatud_m6tted.php">Mõtete näitamine</a></li>
    <li><a href="listfilms.php">Filmiinfo näitamine</a></li>
    <li><a href="addfilms.php">Filmiinfo lisamine</a></li>
	<li><a href="userprofile.php">Oma profiili haldamine</a></li>
  </ul>
  
</body>
</html>