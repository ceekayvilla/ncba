<?php
$title = urldecode($_GET['title']);
$message = urldecode($_GET['message']);

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo ucwords($title); ?></title>
</head>

<body style="background:#ececef;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ececef">
  <tbody>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">
          <table width="560" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #cfdede; background: #fff; border-radius: 15px;">
            <tbody>
              <tr>
                <td width="20" height="20">&nbsp;</td>
                <td>&nbsp;</td>
                <td width="20">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr>
                      <td align="center">
                      	<a href="https://www.datadirect.co.ke" target="_blank" style="border:none;">
                      		<img src="https://datadirect.co.ke/mail_template/img/datadirect.png" alt="Data Direct" />
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><h1 style="font-family:Arial, sans-serif; text-transform:uppercase; color:#65747a; font-size:24px;"><?php echo ucwords($title); ?></h1></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center">

                        <?php echo $message; ?>
                        </td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                    </tr>
                    
                    <tr>
                      <td align="center"><a href="https://www.datadirect.co.ke/login" target="_blank" style="font-family: Arial, sans-serif; color: #999; font-size:14px;">Back to website</a>  | <a href="https://www.datadirect.co.ke/contact-us" target="_blank" style="font-family: Arial, sans-serif; color: #999; font-size:14px;">Contact Us</a></td>
                    </tr>
                  </tbody>
                </table></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="20">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </tbody>
          </table>
      </td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
  </tbody>
</table>
</body>
</html>
