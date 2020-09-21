<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>Veebileht</title>
  </head>
  <body> 
  <p>Tagasi saamiseks vajuta <a href="http://localhost:8080/~kaareel/VP/tund3/home.php">koju</a> linki
    </p>
  <?php
  require("../../../config.php");
  //kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
  //isset kontrollib kas tal on väärtus.kui on saanud väärtuse "_POST" käest, 
  $database = "if20_kaarel_eel_3";
  if(isset($_POST["submitnonsense"])){
	  //== on tõene ja != on mitte tõene (nt ei ole tühi ehk !empty)
	  if(!empty($_POST["nonsense"])){
		  //andmebaasi lisamine
		  //loome andmebaasi ühenduse
		  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
		  //valmistame ette SQL käsu
		  //vaja kuhugi minna smt conn->
		  $stmt = $conn->prepare("INSERT INTO nonsense (nonsenseidea) VALUES(?)");
		  //saab lisada ka delete koht sulgudesse (nagu nonsensidea)
		  echo $conn->error;
		  //info serverisse 2te tüüpi infot; tekst, arv või murdarv ja pärisväärtus. 
		  //s- string e tekst, i -integer e arv ja d - decimal ehk murdarv
		  $stmt->bind_param("s", $_POST["nonsense"]);
		  $stmt->execute();
		  //käsk ja ühendus kinni
		  $stmt->close();
		  $conn->close();
		  
	  }
  }
  
  //loeme andmebaasist
  $nonsensehtml= "";
  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
  $stmt = $conn->prepare("SELECT nonsenseidea FROM nonsense");
  echo $conn->error;
  //seome tulemuse mingi muutujaga
  //bind = saada/anna
  $stmt->bind_result($nosensefromdb);
  $stmt->execute();
  //võtan, kuni on
  //while = tee midagi kuni juhtub midagi.. 
  while($stmt->fetch()){
	  //iga nonsens jaoks teeme <p>mõte</p>
	   $nonsensehtml .= "<p>" .$nonsensefromdb ."</p>";
  }
  $stmt->close();
  $conn->close();
  //ongi andmebaasist loetud
  ?>
  	<?php echo $nonsensehtml; ?>
</body>
</html>