<?php 
include("./inc/header.inc.php"); 
echo $_SESSION["user_login"];
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION["user_login"]; ?> </title>
</head>
<body>
	<a href="logout.php"><button> LogOut? </button>
		<?php include("./inc/footer.inc.php") ?>

