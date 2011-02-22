<body style="border:0;margin:0;">
  <div style="background:#4F85BB;height:60px;border:0;position:relative;">
    <div style="margin-top:10px;margin-left:10px;width:110px;float:left;">
 		<img src="http://balloonup.com/images/balloonlogo.png" width="110" alt="Balloon"/>
	</div>
  </div>

  <div style="float:left">
    Bienvenue sur votrequestion.com
    <br />
    Cliquer sur <a href="<?php echo url_for('@confirm_mail?token='.$token, array('absolute' => true)) ?>"> pour confirmer votre email</a>
    <br /><br />
    <strong>L'équipe Balloon</strong>
  </div>
</body>