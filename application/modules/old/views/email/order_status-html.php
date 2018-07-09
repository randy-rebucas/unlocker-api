<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo $site_name; ?> order status!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">
	<?php echo $site_name; ?> order status
</h2>
Your order status is update to <?php echo $order_status;?> amounting of <?php echo $order_amount;?>
<br/>
<br/>
Ref : <?php echo $order_feedback;?>
<br/>
<br/>
This is an auto generated notification to email: <?php echo $email; ?>.
<br />

Have fun!<br />
The <?php echo $site_name; ?> Team
</td>
</tr>
</table>
</div>
</body>
</html>