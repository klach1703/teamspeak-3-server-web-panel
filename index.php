<!-- CopyRight Florentin Ledy -->

<?php
	include 'init.php';

	$error = "";
	$action = "";

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Panel Teamspeak 3</title>
	</head>
	<body>
		<div align="center">
		<h1>Gérer mon serveur Teamspeak 3</h1>
		<h3>Status du serveur : <?php echo $status; ?></h3>
		<h3>Ip du serveur : <?php echo $IP; ?></h3>
		<form method="post" action="index.php?action=msg">
			<h3>Envoyer un message : </h3><input type="text" name="msg" value="Test"><input type="submit" name="submit" value="Envoyer"/><br><br>
		</form>
		<h3>Controler mon serveur :</h3>
		<a href="index.php?action=start"><input type="button" name="Démarrer" value="Démarrer"/></a><br><br>
		<a href="index.php?action=stop"><input type="button" name="Eteindre" value="Eteindre"/></a><br><br>
		<a href="index.php?action=restart"><input type="button" name="Redémarrer" value="Redémarrer"/></a>
		<h3>Paramètres du serveur :</h3>
		<form method="post" action="index.php?action=server_name">
			<p>Nom du serveur : </p><input type="text" name="server_name" value="<?php echo $vServer_Name ?>"><input type="submit" name="submit" value="Editer"/><br><br>
		</form>
		<form method="post" action="index.php?action=server_password">
			<p>Mot de passe du serveur : </p><input type="text" name="server_password" value="<?php // echo $vServer_Password ?>"><input type="submit" name="submit" value="Editer"/><br><br>
		</form>
		<form method="post" action="index.php?action=server_welcomemessage">
			<p>Message de bienvenue du serveur : </p><input type="text" name="server_welcomemessage" value="<?php echo $vServer_Welcomemessage ?>"><input type="submit" name="submit" value="Editer"/><br><br>
		</form>
		</div>
	</body>
</html>