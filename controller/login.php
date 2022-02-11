<?php

if(isset($_POST['user']) and isset($_POST['pw'])) {
	$loginError = '';
	if(strlen($_POST['user']) == 0) $loginError .= "Nem írtál be felhasználónevet<br>";
	if(strlen($_POST['pw']) == 0) $loginError .= "Nem írtál be jelszót<br>";
	if($loginError == '') {
		$sql = "SELECT id FROM felhasznalok WHERE felhasznalonev = '".$_POST['user']."' ";

		if(!$result = $conn->query($sql)) echo $conn->error;

		if ($result->num_rows > 0) {
			
			if($row = $result->fetch_assoc()) {
				$felhasznalo->set_user($row['id'], $conn);
				if(md5($_POST['pw']) == $felhasznalo->get_jelszo()) {
					$_SESSION["id"] = $row['id'];
					$_SESSION["felhasznalonev"] = $felhasznalo->get_felhasznalonev();
                    header('Location: index.php?page=page');
                    exit();
				}
				else $loginError .= 'Érvénytelen jelszó<br>';
			}
		}
		else $loginError .= 'Érvénytelen felhasználónév<br>';
	}
}

include 'view/login.php';
?>