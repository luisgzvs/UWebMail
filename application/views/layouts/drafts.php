<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="index.php"><title>UWebMail</title></a>
</head>
<body>

  <a class="mails" href="<?php echo base_url(); ?>">Home</a>
  <a class="mails" href="<?php echo base_url(); ?>emails/get_sent">SentMail</a>
  
  <div id="container">
	<div id="body">
		<p>This is the list of drafts:</p>
		<?php foreach ($drafts as $draft) {
			echo "From: {$draft->from} " . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
			echo "To: {$draft->to} " . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
			echo "<a href='get_message/$draft->id'>{$draft->subject}</a>" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";				
			echo "<a href='delete/$draft->id'> delete </a>";
			echo "<br/>";
		} ?>
	</div>	

</body>
</html>
