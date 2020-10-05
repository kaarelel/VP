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
  $database = "if20_kaarel_eel_3";
  if(isset($_POST["submitnonsense"])){
	  if(!empty($_POST["nonsense"])){
		  //andmebaasi lisamine
		  //loome andmebaasi ühenduse
		  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
		  //valmistame ette SQL käsu
		  $stmt = $conn->prepare("INSERT INTO nonsense (nonsenseidea) VALUES(?)");
		  echo $conn->error;
		  //s - string, i -integer, d-decimal
		  $stmt->bind_param("s", $_POST["nonsense"]);
		  $stmt->execute();
		  //käsk ja ühendus sulgeda
		  $stmt->close();
		  $conn->close();
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
  
  <form method="POST">
    <label>Sisesta oma tänane mõttetu mõte!</label>
	<input type="text" name="nonsense" placeholder="mõttekoht">
	<input type="submit" value="Saada ära!" name="submitnonsense">
  </form>
  
</body>
</html>



