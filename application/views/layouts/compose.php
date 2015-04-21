<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="index.php"><title>UWebMail</title></a>
</head>
<body>

<form name="compose" method="GET" action="<?php echo site_url('emails/insert'); ?>">
  <a class="mails" href="<?php echo base_url(); ?>">Home</a>
  <a class="mails" href="<?php echo base_url(); ?>emails/get_all">Drafts</a>
  <a class="mails" href="<?php echo base_url(); ?>emails/get_sent">SentMail</a>
  <br><br>

  To:      <input class="to" type="email" name="to">
  <br><br>
  Subject: <input class="subject" name="subject">
  <br><br>
  Message: <textarea name="message" rows="20" cols="100"></textarea>
  <br><br>
  <input class="sendMail" type="Submit" value="Go">
</form>  

</body>
</html>

