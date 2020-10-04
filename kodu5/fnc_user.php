<?php
	$database = "if20_kaarel_eel_3";

	function signup($firstname, $lastname, $email, $gender, $birthdate, $password){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
		echo $conn->error;
		//krüpteerime parooli, turvalisuse jaoks
		//[] - muutujaks on masiiv ehk mitu väärtust
		//salt = parooli soolamine ehk kui parool on kindla eeskirja järgi tehtud, saab parooli järgi uurida (nt soolamine annab mingi muu väärtus ette)
		$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
		//hash = räsiv, parooli räsiv sümbolite jada
		$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options); 
		//bindParam on string(nimi) string(perenimi) ) i(kuup.)
		$stmt->bind_param("sssiss", $firstname, $lastname, $birthdate, $gender, $email, $pwdhash);
		if($stmt->execute()){
			$notice = "ok";
		} else {
			$notice = $stmt->error;
		}			
		$stmt->close();
		$conn->close();
		return $notice;
	}