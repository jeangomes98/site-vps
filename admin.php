<?php

//by jean gomes

require('includes/core.php');


if(isset($_POST['login'])){

	$passwd = $_POST['passwd'];
	$msg = [];
	
	if($passwd == ""){
				
			$msg['msg'] = "Por Favor preenche os campos!";	
	}else{
		
		if($passwd == $passw){
			
			$_SESSION['passwd'] = $passw;
		}else{
			
			$msg['msg'] = "Senha invalido!!";
		}
	}
	
}


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

    <title>Admin </title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

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

    <div class="container">

	<?php if(!isset($_SESSION['passwd'])){ ?>
	
      <form class="form-signin" method="POST" action="admin.php">
        <h2 class="form-signin-heading">Login Admin</h2>
		<br>
        <h4 class="form-signin-heading"><?php if(isset($_POST['login'])){ echo $msg['msg'];  } ?></h4>
		<br>
      <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="passwd" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>
      </form>
	<?php }else{ ?>
	

<nav class="navbar navbar-inverse">
   <div class="container-fluid">
      <div class="navbar-header"> <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a href="#" class="navbar-brand"><?php echo $conf[1]['com']; ?></a> </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
         <ul class="nav navbar-nav">
            <li><a href="admin.php">Home</a></li>
            <li><a href="?add">Add Server</a></li>
            <li><a href="?config">Config</a></li>

         </ul>
      </div>
   </div>
</nav>
	
	<div class="container">
	
	
	<?php  if(isset($_GET['add'])){ ?>
		
		
		<?php

		if(isset($_POST['addserver'])){
		
          $id = $_POST['id'];		
          $ip = $_POST['ip'];		
          $paisserver = $_POST['paisserver'];		
          $password = $_POST['password'];		
          $img = $_POST['img'];		
          $portassh = $_POST['portassh'];		
          $torrent = $_POST['torrent'];		
          $trafego = $_POST['trafego'];		
          $login = $_POST['login'];		
          $velocidade = $_POST['velocidade'];	
		  
			
			if($id == "" || $ip == "" || $password == "" || $img == "" || $portassh == "" || $torrent == "" || $login == "" || $velocidade == ""){
				
                 $msg['msg'] = "Por Favor campos não pode ficar vazio";
			}else{
				
				$conn->query("INSERT INTO `serves`(server, ip, pass, img, paisserver, portassh, torrent, trafego, login, velocidade) VALUES ('$id','$ip','$password','$img','$paisserver','$portassh','$torrent','$trafego','$login', '$velocidade')");
			
			    $msg['msg'] = "Servidor adicionado";
				
				header("location: admin.php?add");
			}
			
		}  
		
		
		if(isset($_GET['delete'])){
			
			$id = $_GET['delete'];
			
			$del = $conn->query("DELETE FROM `serves` WHERE id='$id'");
			
			if($del){
			   header("location: admin.php?add");	
			}

		}
		
		
		
		?>
		
		<h2>Add server</h2>
		 <h4 class="form-signin-heading"><?php if(isset($_POST['addserver'])){ echo $msg['msg'];  } ?></h4>
	<form method="POST" action="?add">
	    <div class="form-group">
		  <label for="addserver">ID Server:</label>
		  <input type="number" name="id" class="form-control" id="usr">
		</div>	    
		
		<div class="form-group">
		  <label for="paisserver">De qual país e o servidor:</label>
		  <input type="text" name="paisserver" class="form-control" id="usr">
		</div>		
		
		<div class="form-group">
		  <label for="portassh">Porta SSH:</label>
		  <input type="text" name="portassh" class="form-control"  value="22 e 443" id="usr">
		</div>		
		
		<div class="form-group">
		  <label for="torrent">Torrent:</label>
		  <input type="text" name="torrent" class="form-control" value="Permitido" id="usr">
		</div>		
		
		<div class="form-group">
		  <label for="trafego">Tráfego:</label>
		  <input type="text" name="trafego" class="form-control" value="Ilimitado" id="usr">
		</div>		
		
		<div class="form-group">
		  <label for="login">Login:</label>
		  <input type="text" name="login" class="form-control" value="Individual" id="usr">
		</div>		
		
		<div class="form-group">
		  <label for="velocidade">Velocidade:</label>
		  <input type="text" name="velocidade" class="form-control" value="Ilimitado" id="usr">
		</div>
		
		<div class="form-group">
		  <label for="ip">IP:</label>
		  <input type="text" name="ip" class="form-control" id="pwd">
	    </div>		
		
		<div class="form-group">
		  <label for="senha">Senha do Server:</label>
		  <input type="password" name="password" class="form-control" id="pwd">
	    </div>	
		
		<div class="form-group">
		  <label for="link">Link da image do server:</label>
		  <input type="text" name="img" class="form-control" id="pwd">
	    </div>
		
		 <button type="submit" name="addserver" class="btn btn-default">Add</button>
		<form>
		
		 
 <table class="table">
    <thead>
      <tr>
        <th>ID Server</th>
        <th>Pais server</th>
        <th>Ip</th>
        <th>Senha</th>
        <th>IMG</th>
        <th>Velocidade</th>
        <th>Login</th>
        <th>Tráfego</th>
        <th>Torrent</th>
        <th>Porta SSH</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    
	<?php  

    $query = $conn->query("SELECT * FROM `serves` WHERE 1");
	
    while($row = $query->fetch_array()){; ?>
		
	  <tr class="info">
        <td><?php echo $row['server']; ?></td>
        <td><?php echo $row['paisserver']; ?></td>
        <td><?php echo $row['ip']; ?></td>
        <td><?php echo $row['pass']; ?></td>
        <td><?php echo $row['img']; ?></td>
        <td><?php echo $row['velocidade']; ?></td>
        <td><?php echo $row['login']; ?></td>
        <td><?php echo $row['trafego']; ?></td>
        <td><?php echo $row['torrent']; ?></td>
        <td><?php echo $row['portassh']; ?></td>
        <td><a href="?add&delete=<?php echo $row['id'];  ?>"> Apagar </a></td>
      </tr>
	  
	<?php } ?>


    </tbody>
  </table>
</div>
		
		
	<?php }else if(isset($_GET['config'])){
		
		
		if(isset($_POST['conf'])){
			
			
           $s = $conn->query("SELECT * FROM `conf` WHERE 1");
		   
		   while($row = $s->fetch_array()){
			   
			   $com = $_POST[$row['id']];
			   
			   $conn->query("UPDATE `conf` SET `com`='$com' WHERE id='$row[id]'");
			   
			  
		   }
			 echo "<center><b style='color: green'>Dados Salvo Com sucesso!!!</b></center>";
		}
		
		
		
		
		?>
		
		<form method="POST" action="?config&conf">
		<?php 
		
		  $r = $conn->query("SELECT * FROM `conf` WHERE 1");
		 
	 while($row = $r->fetch_array()){ ?>
			  
			<div class="form-group">
			  <label for="<?php echo $row['nome']; ?>"><?php echo $row['nome']; ?>:</label>
			  <input type="text" class="form-control" name="<?php echo $row['id']; ?>" value="<?php echo $row['com']; ?>" id="usr">
			</div>
			  
		  <?php } ?>

          <button type="submit" name="conf" class="btn btn-default">Salvar</button>
	
			</form>
		
		
	<?php }else{ ?>
	
  <h2>Conta de Usuários</h2>
 <table class="table">
    <thead>
      <tr>
        <th>Data</th>
        <th>Nome</th>
        <th>senha</th>
        <th>Ip</th>
      </tr>
    </thead>
    <tbody>
    
	<?php  

    $query = $conn->query("SELECT * FROM `sshfree` WHERE 1");
	
    while($row = $query->fetch_array()){  $server = serves($row['iphost']); ?>
		
	  <tr class="success">
        <td><?php echo $row['tempo']; ?></td>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['senha']; ?></td>
        <td><?php echo $server['ip']; ?></td>
      </tr>
	  
	<?php } ?>


    </tbody>
  </table>
</div>

	
	
	
	<?php } } ?>
    </div> <!-- /container -->


       <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
