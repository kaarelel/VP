<?php
  require("../../../config.php");
  require("fnc_common.php");
  require("fnc_user.php");
 
  $fulltimenow = date("d.M.Y. H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  

  var_dump($_POST);
  
  $weekdayNamesET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  
 
  $weekdaynow = date("N");

  
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
  
  $semesterstart = new DateTime("2020-8-31");
  $semesterend = new DateTime("2020-12-13");
  $semesterduration = $semesterstart->diff($semesterend);
  $today = new DateTime("now");
  $fromsemesterstart = $semesterstart->diff($today);
  
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
  $totaldaysleft = $semesterduration->format("%a");{
  $percentagecompleted = ($totaldaysleft / 100) * $fromsemesterstartdays;
  }

  $allfiles = array_slice(scandir("../vp_pics/"), 2);
  $allpicfiles = [];
  $picfiletypes = ["image/jpeg", "image/png"];
  foreach ($allfiles as $file){
	$fileinfo = getImagesize("../vp_pics/" .$file);	 
	if(in_array($fileinfo["mime"], $picfiletypes) == true){
		array_push($allpicfiles, $file);
	 }
 }
  $piccount = count($allpicfiles);
  $imghtml = "";
  $picnum = mt_rand(0, ($piccount - 1));
  $imghtml .= '<img src="../vp_pics/' .$allpicfiles[mt_rand(0, ($piccount - 1))] .'" ';
  $imghtml .= 'alt="Tallinna Ülikool">';

 //require("fnc_user.php");
  //kui klikiti nuppu, siis kontrollime ja salvestame
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  $firstname= "";
  $lastname = "";
  $gender = "";
  $birthdate = null;
  $birthday = null;
  $birthmonth = null;
  $birthyear = null;
  $email = "";
    
  $firstnameerror = "";
  $lastnameerror = "";
  $gendererror = "";
  $birthdateerror = "";
  $birthdayerror = ""; 
  $birthmontherror = "";
  $birthyearerror = "";
  $emailerror = "";
  $passworderror = "";
  $confirmpassworderror = "";
    
  $notice = "";
  
  if(isset($_POST["submituserdata"])){
	  
	  if (!empty($_POST["firstnameinput"])){
		$firstname = test_input($_POST["firstnameinput"]);
	  } else {
		  $firstnameerror = "Palun sisesta eesnimi!";
	  }
	  
	  if (!empty($_POST["lastnameinput"])){
		$lastname = test_input($_POST["lastnameinput"]);
	  } else {
		  $lastnameerror = "Palun sisesta perekonnanimi!";
	  }
	  
	  if(isset($_POST["genderinput"])){
		//$gender = $_POST["genderinput"];
		//intval on täisarvuline väärtus, mis kontrollib ta õigsust
		$gender = intval($_POST["genderinput"]);
	  } else {
		  $gendererror = "Palun märgi sugu!";
	  }
	  //!empty (NOTempty, pole tühi; ! = not
	  if(!empty($_POST["birthdayinput"])){
		  $birthday = intval(($_POST["birthdayinput"]));
	  }  else {
		  $birthdayerror = "Palun vali sünnikuupäev!";
	  }
	  if(!empty($_POST["birthmonthinput"])){
		  $birthmonth = intval(($_POST["birthmonthinput"]));
	  }  else {
		  $birthmontherror = "Palun vali sünnikuu!";
	  }
	  if(!empty($_POST["birthyearinput"])){
		  $birthyear = intval(($_POST["birthyearinput"]));
	  }  else {
		  $birthyearerror = "Palun vali sünniaasta!";
	  }
	  //kontrollime, kas sisestati reaalne kuupäev
	  if(!empty($birthday) and !empty($birthmonth) and !empty($birthyear)){
		  if(checkdate($birthmonth, $birthday, $birthyear)){
			  $tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
			  $birthdate = $tempdate->format("Y-m-d");
			  echo $birthdate;
		  } else {
			  $birthdateerror = "Kuupäev on vigane!";
		  }
	  }
	  
	  
	  
	  if (!empty($_POST["emailinput"])){
		$email = test_input($_POST["emailinput"]);
	  } else {
		  $emailerror = "Palun sisesta e-postiaadress!";
	  }
	  
	  if (empty($_POST["passwordinput"])){
		$passworderror = "Palun sisesta salasõna!";
	  } else {
		  if(strlen($_POST["passwordinput"]) < 8){
			  $passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
		  }
	  }
	  
	  if (empty($_POST["confirmpasswordinput"])){
		$confirmpassworderror = "Palun sisestage salasõna kaks korda!";  
	  } else {
		  if($_POST["confirmpasswordinput"] != $_POST["passwordinput"]){
			  $confirmpassworderror = "Sisestatud salasõnad ei olnud ühesugused!";
		  }
	  }
	  //all pool on täielik kontroll erroritest, et kas kõik on korras ja kui on, siis kuvatakse, et kõik on korras
	  if(empty($firstnameerror) and empty($lastnameerror) and empty($gendererror ) and empty($birthdayerror) and empty($birthmontherror) and empty($birthyearerror) and empty($birthdateerror) and empty($emailerror) and empty($passworderror) and empty($confirmpassworderror)){
		$result = signup($firstname, $lastname, $email, $gender, $birthdate, $_POST["passwordinput"]);
		//$notice = "Kõik korras!";
		if($result == "ok"){
			$firstname= "";
			$lastname = "";
			$gender = "";
			$birthdate = null;
			$birthday = null;
			$birthmonth = null;
			$birthyear = null;
			$email = null;
			$notice = "Kasutaja loomine õnnestus!";
		} else {
			$notice = "Kahjuks tekkis tehniline viga: " .$result;
		}
	  }
  }
	function signin($email, $password){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
		echo $conn->error;
		$stmt->bind_param("s", $email);
		$stmt->bind_result($passwordfromdb);
		if($stmt->execute()){
			//andmebaasi pärin õnnestus
			if($stmt->fetch()){
				//password verify = kas see parool mis sisestati ja anti klapivad
				if(password_verify($password, $passwordfromdb)){
					//mis teha, kui saigi õige parooli, sisselogimine
					//kodutöö.HOME hakkab olema sisselogitud kasutaja avaleht. Teha koopia "page.php". Page'le jääb kõik muda ja teha vorm sisselogimine
					$notice = "Olete sisseloginud";
					
					$stmt->close();
					$conn->close();
					header("Location: home.php");
					exit();
					
				} else {
					$notice = "Vale salasõna!";
				}
			} else {
				$notice = "Sellist kasutajat (" .$email .") kahjuks pole";
			}
		} else {
			$notice = "Sisselogimisel tekkis tehniline viga:" .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $notice;
	}




  require("header.php");
?>
<img src="../IMG/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
<h1>Koduleht</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogia
    instituudis</p>
	<ul>
	  <li><a href="mõtteid.php">Mõtete lisamine</a></li>
      <li><a href="kirjutatud_m6tted.php">Mõtete näitamine</a></li>
      <li><a href="listfilms.php">Filmiinfo näitamine</a></li>
      <li><a href="addfilms.php">Filmiinfo lisamine</a></li>
	  <li><a href="home.php">Vana kodulehele</a></li>
	  <br>
    <li><a href="kasutaja1.php">Kasutaja loomine</a></li>

   </ul>	
		
   <!-- kommentaar -->
  <p>Lehe avamise aeg:
    <?php echo $weekdayNamesET[$weekdaynow - 1] .", " .$fulltimenow .", Semestri algusest on möödunud " .$fromsemesterstartdays ." päeva"; ?>.
    <?php echo "Parjasti on " .$partofday ."."; ?></p>
    <?php echo  $semesterstarted; ?></p>
    <?php echo "Õppetööd on jäänud " .$totaldaysleft ." päeva"; ?></p>
    <?php echo "Semestri õppetööst on tehtud " .$percentagecompleted ."%"; ?></p>
	<hr>
	<?php echo $imghtml; ?>
  
	<hr>

	<h1>Sisselogimine</h1>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">>
      <label for="firstnameinput">Eesnimi:</label>
	  <br>
	  <input name="firstnameinput" id="firstnameinput" type="text" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
	  <br>
	  <br>
      <label for="lastnameinput">Perekonnanimi:</label><br>
	  <input name="lastnameinput" id="lastnameinput" type="text" value="<?php echo $lastname; ?>"><span><?php echo $lastnameerror; ?></span>
	  <br>
	  <br>
	  <label for="emailinput">E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	  <br>
	  <br>
	  <label for="passwordinput">Salasõna (min 8 tähemärki):</label>
	  <br>
	  <input name="passwordinput" id="passwordinput" type="password"><span><?php echo $passworderror; ?></span>
	  <br>
	  <br>
	  <label for="confirmpasswordinput">Korrake salasõna:</label>
	  <br>
	  <input name="confirmpasswordinput" id="confirmpasswordinput" type="password"><span><?php echo $confirmpassworderror; ?></span>
	  <br>
	  <br>
	  <input name="submituserdata" type="submit" value="Logi sisse"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
	</form>




</body>
</html>