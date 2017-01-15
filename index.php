<?php

//by jean gomes

require('includes/core.php');
include('Net/SSH2.php');


$query_rm_user = $conn->query("SELECT * FROM `sshfree` WHERE 1");

 while($row = $query_rm_user->fetch_array()){
	 
	  if(currentTimeW($row['id']) == "ok"){
		  
		  
		  	$server = serves($row['iphost']);
	
			$ssh = new Net_SSH2(''.$server['ip']);
			if (!$ssh->login('root', ''.$server['pass'])) {
				exit('Login Failed');
			}
		     
			 $ssh->exec("userdel ".$row['nome']);
		  
		  $conn->query("DELETE FROM `sshfree` WHERE id='$row[id]'");
	  }
 }
 
 $server = serves(1);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $conf[1]['com']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand"><?php echo $conf[1]['com']; ?></h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="admin.php">Admin</a></li>
                </ul>
              </nav>
            </div>
          </div>
		  <br>
		  <br>
		  
<div class="row inner">
<div class="panel panel-info"> <div class="panel-heading"> 
<h3 class="panel-title">Grupo Telegram</h3> 

</div> <div class="panel-body"> <a href="<?php echo $conf[4]['com']; ?>">Entrar</a> </div> </div>

  <?php 
  
  if(isset($_SESSION['id'])){
	  
	 
	  
	  $query1 = $conn->query("SELECT * FROM `sshfree` WHERE id='$_SESSION[id]'");
$fetch = $query1->fetch_array(MYSQLI_ASSOC);
	  
	  ?>
	  
	   <input type="hidden" class="time" value="<?php echo currentTimeW($_SESSION['id']);?>">
	
	    <div class="col-md-12">
    <div class="thumbnail">
    
      <div class="caption sshbr1">
<h3>SSH Criado</h3>
<br>Host IP Addr : <?php echo serves($fetch['iphost'])['ip']; ?>
<br>Squid proxy :  <?php echo serves($fetch['iphost'])['ip']; ?>:8080
<br>Port SSH: 443,22
<br>Username SSH: <?php echo $fetch['nome'];  ?>
<br>Password SSH: <?php echo $fetch['senha'];  ?>
<br>
Tempo de expiração : <span class="label label-default time-show"></span>
<br>
		
      </div>
    </div>
  </div> 
	  
  <?php } ?>
  
  
  <?php 
  
  
  
  $query2 = $conn->query("SELECT * FROM `serves` WHERE 1");
  
   while($r = $query2->fetch_array()){?>
	   

  <div class="col-md-6">
    <div class="thumbnail">
      <img src="<?php echo $r['img']; ?>" alt="...">
      <div class="caption sshbr<?php echo $r['server']; ?>">
        <h3><?php echo $r['paisserver']; ?></h3>		  
					  	 <br>   
							<b>Protocolo:</b> TCP/UDP<br>
							<b>Porta SSH:</b> 22 e 443<br>
							<b>Torrent:</b> Permitido<br>
							<b>Login:</b> individual<br>
							<b>Tráfego:</b> ilimitado<br>
							<b>Velocidade:</b> ilimitado<br>
							<b>Validade:</b> <?php echo $conf[3]['com']; ?> horas<br>
							<br>

			
        <p><a href="#" onclick="criarSshFree('sshbr<?php echo $r['server']; ?>',<?php echo $r['server']; ?>)" class="btn btn-primary" role="button">Gerar SSH Free</a></p>
      </div>
    </div>
  </div>  
  
   <?php } ?>
  
 
  
  </div>
		  
		  <br>
		  <br>
		  <br>
		    <div class="mastfoot">
            <div class="inner">
              <p>by <a href="https://twitter.com/mdo">Jean Gomes</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
    <script src="js/site.js"></script>
	
	
	  <script>

 var time = $(".time").val();


     var interaval;
    clearInterval(interaval);
    interaval = setInterval(function () {
    if(time == 0){
        location.reload()
    }
    var h = Math.floor(Math.floor(time/60)/60);
    var d = Math.floor(h/24);
    var minute = Math.floor(Math.floor(time/60) - (h*60)) ;


    var sec =(time - (minute*60+(h*3600)));
    if(sec < 10){
        sec = "0"+sec;
    }
    $(".time-show").text(h+" horas e "+minute+ " minutos " +sec+" segundos")

     //$(".time-show").attr("disabled","disabled");

        time--;
    } ,1000)



</script>
	  
  </body>
</html>
