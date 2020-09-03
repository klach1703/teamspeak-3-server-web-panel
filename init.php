

<?php
	
	include 'config.php';

	/* Connexion */
	$socket = fsockopen($ip, $port);
	if (!$socket) {
		$error = '<p style="font-size:24px;"><font color="#CB1515">ERREUR, connexion impossible, veuillez vérifier les informations de connexions.</font></p';
	} else {
		fwrite($socket, "login $username_query $password_query\r\n");
	}

?>

<?php

	// variable paramètres et msg
	$msg = $_POST['msg'];
	$msg = str_replace(' ', '\s', $msg);

	$server_name = $_POST['server_name'];
	$server_name = str_replace(' ', '\s', $server_name);

	$server_password = $_POST['server_password'];
	$server_password = str_replace(' ', '\s', $server_password);

	$server_welcomemessage = $_POST['server_welcomemessage'];
	$server_welcomemessage = str_replace(' ', '\s', $server_welcomemessage);

		if (!empty($_GET['action'])) {
			// start server
			if ($_GET['action'] == "start") {
				fwrite($socket, "use $id_server\r\n");
				fwrite($socket, "serverstart sid=$id_server\r\n");
				sleep(0.5);
				$action = "Serveur démarré";
				$status_fichier = fopen('status.txt', 'r+');
				fputs($status_fichier, '<p><font color="green">Allumé</font></p>');
				fclose($status_fichier);
			}
			// stop server
			if ($_GET['action'] == "stop") {
				fwrite($socket, "use $id_server\r\n");
				fwrite($socket, "serverstop sid=$id_server\r\n");
				sleep(0.5);
				$action = "Serveur éteint";
				$status_fichier = fopen('status.txt', 'r+');
				fputs($status_fichier, '<p><font color="red">Eteint</font></p>   ');
				fclose($status_fichier);
			}
			// restart server
			if ($_GET['action'] == "restart") {
				fwrite($socket, "use $id_server\r\n");
				fwrite($socket, "serverstop sid=$id_server\r\n");
				sleep(1);
				fwrite($socket, "use $id_server\r\n");
				fwrite($socket, "serverstart sid=$id_server\r\n");
				sleep(1);
				$action = "Serveur redémarré";
				$status_fichier = fopen('status.txt', 'r+');
				fputs($status_fichier, '<p><font color="green">Allumé</font></p>');
				fclose($status_fichier);
			}

			// msg server
			if ($_GET['action'] == "msg") {
				fwrite($socket, "use $id_server\r\n");
				fwrite($socket, "clientupdate client_nickname=Panel\r\n");
				fwrite($socket, "sendtextmessage targetmode=3 target=$id_server msg=$msg\r\n");
				sleep(0.5);
				$action = "Message envoyé";
			}

			// edit name server
			if ($_GET['action'] == "server_name") {
				fwrite($socket, "use $id_server\r\n");
				fwrite($socket, "clientupdate client_nickname=Panel\r\n");
				fwrite($socket, "serveredit virtualserver_name=$server_name\r\n");
				sleep(0.5);
				$action = "Nom du serveur édité";
			}

			// edit password server
			if ($_GET['action'] == "server_password") {
			fwrite($socket, "use $id_server\r\n");
			fwrite($socket, "clientupdate client_nickname=Panel\r\n");
			fwrite($socket, "serveredit virtualserver_password=$server_password\r\n");
			sleep(0.5);
			$action = "Mot de passe du serveur édité";
			}

			// edit welcomemessage server
			if ($_GET['action'] == "server_welcomemessage") {
			fwrite($socket, "use $id_server\r\n");
			fwrite($socket, "clientupdate client_nickname=Panel\r\n");
			fwrite($socket, "serveredit virtualserver_welcomemessage=$server_welcomemessage\r\n");
			sleep(0.5);
			$action = "Message de bienvenue du serveur édité";
			}
		}

	echo $action;
	echo $error;

	$IP = "$ip:$server_port";

?>

<?php
	$status_fichier = fopen('status.txt', 'r+');
	$status = fgets($status_fichier);
	fclose($status_fichier);
?>
