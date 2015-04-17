<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="index.php"><title>UWebMail</title></a>
</head>
<body>

<form name="compose" method="GET" action="<?php echo site_url('emails/index'); ?>">
  <input class="mailBtn" type="Submit" value="Compose">
  <a class="mails" href="<?php echo base_url(); ?>emails/get_all">Drafts</a>
  <a class="mails" href="<?php echo base_url(); ?>emails/load_sent_view">SentMail</a>
  <br><br>
</form>  

<form name="logout" method="GET" action="<?php echo site_url('users/logout'); ?>">
  <input class="mailBtn" type="Submit" value="logout">
  <br><br>
</form>  


</body>
</html>

