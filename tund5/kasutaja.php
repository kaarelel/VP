  <?php
  require("../../../config.php");
  $username = "Kaarel Eelmäe";
  require("header.php");
  
  $inputerror = "";
  if (isset($_POST["data"])){
    if(empty($_POST["fname"])){  
		  $inputerror .= "Eesnimi on sisestamata!";		
    }
    if(empty($_POST["lname"])){  
      $inputerror .= "Perekonnanimi on sisestamata!";		
    }
    if(empty($_POST["email"])){  
      $inputerror .= "Meiliaadress on sisestamata!";		
    }
    if(empty($_POST["pwd"])){  
      $inputerror .= "Parool on sisestamata!";		
    }
    if(strlen($_POST["pwd"]) < 8){
      $inputerror .="Parooli pikkus peab olema vähemalt 8 tähte!";
    }
  }
  $fname = "";
  $lname = "";
  $email = "";
  $pw = "";
  $gender ="";





  ?>
  <img src="../IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
    
  <ul>
    <li><a href="home.php">Avalehele</a></li>
  </ul>
  
  <hr>
  <form method="POST">
  <label for="fname">Eesnimi:</label>
    <input type="text" id="fname" name="fname" placeholder="eesnimi" value="<?php echo $fname; ?>">
    <br>
    <label for="lname">Perekonnanimi:</label>
    <input type="text" id="lname" name="lname" placeholder="perekonnanimi" value="<?php echo $lname; ?>">
    <br><br>
    <p>Sisesta sugu:</p>
    <label for="gendermale" >Mees</label>
    <input type="radio" name="genderinput" id="gendermale" value="1" <?php if($gender == "1"){echo " checked";}?>>
    <label for="genderfemale" >Naine</label>
    <input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($gender == "2"){echo " checked";}?>>
    <br><br>
    <label for="email">Sisesta meiliaadress:</label>
    <input type="email" id="email" name="email" placeholder="email" value="<?php echo $email; ?>">
    <br><br>
    <label for="pwd">Salasõna:</label>
    <input type="password" id="pwd" name="pwd" placeholder="salasõna" value="<?php echo $pw; ?>">
	<br><br>
	<label for="pwd">Salasõna uuesti:</label>
    <input type="password" id="pwd" name="pwd" placeholder="salasõna" value="<?php echo $pw; ?>">
    <br><br>
    <input type="submit" name="data" value="Kinnita">
  </form>
  <p><?php echo $inputerror; ?></p>

</body>
</html>
