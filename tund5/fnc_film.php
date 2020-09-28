<?php
//funktsioonid, mida või kuidas kasutada
  $database = "if20_kaarel_eel_3";
//funktsiooni taga alati sulud
  function readfilms(){
	  //loeme andmebaasist
	  //var_dump($GLOBALS); //globals on masiiv
  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  //valmistame ette SQL käsu
	  //$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
	  $stmt = $conn->prepare("SELECT * FROM film");
	  echo $conn->error; //väljasta meile viga
	  //seome tulemuse mingi muutujaga
	  $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
	  $stmt->execute();
	  //võtan, kuni on
	  $filmshtml = "\t <ol> \n";
	  while($stmt->fetch()){
		  //<p>suvaline mõte </p>
		  $filmshtml .= "\t \t <li>" .$titlefromdb ."\n";
		  $filmshtml .= "\t \t \t <ul> \n";
		  $filmshtml .= "\t \t \t \t <li>Valmimiaasta: " .$yearfromdb ."</li> \n";	  
		  $filmshtml .= "\t \t \t \t <li>Kestvus: " .$durationfromdb ." minutit</li> \n";	
		  $filmshtml .= "\t \t \t \t <li>Žanr: " .$genrefromdb ."</li> \n";
		  $filmshtml .= "\t \t \t \t <li>Tootja/Stuudio: " .$studiofromdb ."</li> \n";	
		  $filmshtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";	     	  
		  $filmshtml .= "\t \t \t </ul> \n";
		  $filmshtml .= "\t \t </li> \n";
		  
	  }
	  $filmshtml .= "\t </ol> \n";
	  
	  $stmt->close();
	  $conn->close();
	  return $filmshtml; 
  }//readfilms lõppeb
  //require ("fnc_film.php");
  //<?php echo readfilms(); ? > 
  //neid kahte on vaja, et panna need 2 tööle.
  
  function writefilm($title, $year, $duration, $genre, $studio, $director){
	   $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	   $stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
	   echo $conn->error;
	   $stmt->bind_param("siisss", $title, $year, $duration, $genre, $studio, $director);
	   $stmt->execute();
	   $stmt->close();
	   $conn->close();
  }//writefilm lõppeb
  //prepare andme tabelis olevad lahtri nimed
  //sql keeles peavad asjad "" vahel olema
  //s=string i=arv