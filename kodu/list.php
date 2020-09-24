<?php
  //loeme andmebaasi login info muutujad
  require("../../../config.php");
  //kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
  //isset kontrollib kas tal on väärtus.kui on saanud väärtuse "_POST" käest, 
  $database = "if20_kaarel_eel_3";
 
  
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
  
  $username = "Kaarel Eelmäe";
  $fulltimenow = date("d.M.Y. H:i:s");
  $hournow = date("H");
  $partofday = "lihtsalt aeg";
  
  //vaatame, mida vormist serverile saadetakse
  //seda massiivi peab teadma peast (php) form. Ehk $_POST
  var_dump($_POST);
  
  $weekdayNamesET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  
  //[] = tähistavad massiivi 
  //küsime nädala päeva
  $weekdaynow = date("N");
  //echo $weekdaynow;
  
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
  //jälgime semestri kulgu
  $semesterstart = new DateTime("2020-8-31");
  $semesterend = new DateTime("2020-12-13");
  $semesterduration = $semesterstart->diff($semesterend);
  $today = new DateTime("now");
  $fromsemesterstart = $semesterstart->diff($today);
  //saime aja erinevuse objektina, seda niisama näidata ei saa
  //$fromsemesterstartdays $semesterinfo = "semester algab täna"
  //fromsemesterstartdays > 0 and fromsemesterstartdays < semesterdurationdays
  //semesterpercentage = (fromsemesterstartdays / semesterdurationdays) * 100
  //semesterinfo = "semester on käimas, kestab juba". fromsemesterstartdays.
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
  
  //loeng kataloogist piltide nimekirja
  //$allfiles = scandir("../../vp_pics/");
  $allfiles = array_slice(scandir("../vp_pics/"), 2);
  //echo $allfiles; //masiivi nii näidata ei saa
  //var_dump($allfiles);
  //$allpicfiles = array_slice($allfiles, 2);
  //var_dump($allpicfiles);
  $allpicfiles = [];
  $picfiletypes = ["image/jpeg", "image/png"];
  //käin kogu massiivi läbi ja kontrollin iga üksikut elementi kas on sobiv fail ehk pilt
  foreach ($allfiles as $file){
     //how to check if this is a image/jpeg
     $fileinfo = getImagesize("../vp_pics/" .$file);	 
     if(in_array($fileinfo ["mime"], $picfiletypes) == true){
	     array_push($allpicfiles, $file);
	  }
		 //in_array "massivide kontroll", kontrollib kas esimene asi on olemas massiivis
	 //ühe elemendi nimi on "mime", kontrollin kas on olemas selles massiivis
  }
  
  
  //paneme kõik pildid järjest ekraanile
  //uurime, mitu pilti on ehk mitu faili on nimekirjas - masiivis
  $piccount = count($allpicfiles);
  //echo $piccount;
  //$i = $i + 1 (praeguni i + 1 e võta praegune väärtus ja pane 1 otsa);
  //$i +=1;
  //$i ++;
  $imghtml = "";
  $picnum = mt_rand(0, ($piccount - 1));
  for($i = 0; $i < $piccount; $i ++){
	  //<img src="../IMG/vp_banner.png" alt="alt tekst">
	  //jutumärgid jutumärkides saab kirjutada ülakomaga
     $imghtml .= '<img src="../vp_pics/' .$allpicfiles[$i] .'" ';
	 $imghtml .= 'alt="Tallinna Ülikool">';
  }
	  
  require("header.php");
?>

  <img src="../IMG/vp_banner.png" alt="Veebiprogrammeerimise kuruse bänner">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogia
    instituudis</p>
 
	<?php echo $nonsensehtml; ?>
</body>
</html>