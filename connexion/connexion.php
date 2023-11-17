<?php

include_once('cnx.inc.php');
require_once('user.php');
?>
<?php

	if (isset($_SESSION['User']))
		header('location:../index.php');
	if (isset($_POST['valider']))
	{
		$loginName = $_POST['logUser'];
		$mdp = $_POST['passwordUser'];
		$SqlCnx = "SELECT COUNT(*) FROM user WHERE loginName = '$loginName' AND mdp = '$mdp'";

		$sql = $cnx->query( $SqlCnx );
		$count = $sql->fetchColumn();
		if($count == 0)
		{
			include_once('connexion.html');
			echo 'Mauvais log-in / Password';
		}
		else
		{
			
			$SqlAcces = "SELECT idUser, loginName, mdp FROM user WHERE loginName = '$loginName' AND mdp = '$mdp'";

			$sql = $cnx->prepare( $SqlAcces );
			$ResAcces=$sql->execute();
			foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $User)
			{

				$idUser = $User['idUser'];
				$loginName = $User['loginName'];
				$mdp = $User['mdp'];
			}

				session_start();
				
				$User = new user( $idUser , $loginName , $mdp);
				
				$_SESSION['User'] = $User;
				
				
				header('location:../index.php');
		}
	}
	else 
	{
		include_once('connexion.html');
	}
?>