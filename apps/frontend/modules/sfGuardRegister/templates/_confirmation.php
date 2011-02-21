<body style="border:0;margin:0;">
  <div style="background:#4F85BB;width:100%;height:40px;border:0;padding:10px;position:relative;">
    <img src="http://balloonup.com/images/balloonlogo.png" width="110"/>
  </div>
    
  <div style="float:left;height:100%;">
    Bienvenue sur votrequestion.com
    <br />
    Cliquer sur <a href="<?php echo url_for('@confirm_mail?token='.$token, array('absolute' => true)) ?>"> pour confirmer votre email</a>
    <br /><br />
    <strong>L'équipe Balloon</strong>
  </div>
</body>