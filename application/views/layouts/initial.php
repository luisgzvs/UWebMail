<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="index.php"><title>UWebMail</title></a>
</head>
<body>
	<div>
	<?php if($this->session->userdata('logged_in')) : ?>
               Welcome,  <?php echo $this->session->userdata('username'); ?>
    <?php endif; ?>
	</div>

<form name="compose" method="GET" action="<?php echo site_url('emails/index'); ?>">
  <br><br>
  <input class="mailBtn" type="Submit" value="Compose">
  <a class="mails" href="<?php echo base_url(); ?>emails/get_all"> Drafts</a>
  <a class="mails" href="<?php echo base_url(); ?>emails/get_sent">SentMail</a>
  <br><br>
</form>  

<form name="logout" method="GET" action="<?php echo site_url('users/logout'); ?>">
  <input class="mailBtn" type="Submit" value="logout">
  <br><br>
</form>

<form name="cronjob" method="GET" action="<?php echo site_url('mail_cronjob/index'); ?>">
  <input class="mailBtn" type="Submit" value="cronjob">
  <br><br>
</form>  
  


</body>
</html>

