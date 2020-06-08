<?php
	define('ROOT','../');
	require_once(ROOT.'config/constants.php');
	$message=addslashes($_POST['message']);
 ?>
<html>
<head>
<title>Lipa Na MPESA</title>
<style>

</style>
</head>
<body>

<table class='message'>
<tr><th colspan='3'>Reset Request</th></tr>
<tr class='main_message'><td colspan='3'><?php echo $message; ?></td></tr>
<tr class='disclaimer'><td colspan='3'>If you think you received this email by mistake please contact administrator on (<?php echo MAIL_FROM_EMAIL ?>)</td></tr>
</table>
</body>

</html>
