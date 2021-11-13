<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<title>CRUD - PHP</title> 
</head> 
<body class="w3-light-gray">

<?php
// definições de host (servidor onde está o banco), database (nome), usuário e senha 
$host = "153.92.6.43:3306"; 
$db = "u205347630_grupopiunivesp"; 
$user = "u205347630_piuser"; 
$pass= "3@GrupoPI"; 

// padrão do XAMPP 
// conecta ao banco de dados em caso de erro dispara uma mensagem informando o erro 

$con = new mysqli($host, $user, $pass, $db); 

if ($con->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$acao = ((!isset($_GET["acao"]))?"":$_GET["acao"]);

switch($acao) {
	case "buscar":
		$query = "SELECT * FROM clientes WHERE cliente like '%".$_GET["cliente"]."%'"; 
		// executa a query ou mata a conexão 
		$dados = mysqli_query($con, $query); 
		// calcula quantos dados retornaram 
		$total = mysqli_num_rows($dados);
	break;
	case "editar":
		$query = "SELECT * FROM clientes WHERE id = ". $_GET["id"]; 
		// executa a query ou mata a conexão 
		$dados = mysqli_query($con, $query);
		$l = mysqli_fetch_assoc($dados);
	break;
	case "salvar":
		$query = "INSERT INTO clientes(cliente, email, fone) VALUES('".$_GET["cliente"]."','".$_GET["email"]."','".$_GET["fone"]."') "; 
		// executa a query ou mata a conexão 
		$dados = mysqli_query($con, $query);
		//faz o redirecionamento da página para a tela principal após editar
		header("location:crud.php");
	break;
	case "alterar":
		$query = "UPDATE clientes SET cliente='".$_GET["cliente"]."', email='".$_GET["email"]."', fone='".$_GET["fone"]."' WHERE id=". $_GET["id"]; 
		// executa a query ou mata a conexão 
		$dados = mysqli_query($con, $query);
		//faz o redirecionamento da página para a tela principal após editar
		header("location:crud.php");
	break;
	case "excluir":
		$query = "DELETE FROM clientes WHERE id=".$_GET["id"]; 
		// executa a query ou mata a conexão 
		$dados = mysqli_query($con, $query);
		//faz o redirecionamento da página para a tela principal após editar
		header("location:crud.php");
	break;
	default:
		$query = "SELECT * FROM clientes"; 
		// executa a query ou mata a conexão 
		$dados = mysqli_query($con, $query); 
		// calcula quantos dados retornaram 
		$total = mysqli_num_rows($dados);
	break;
}
		if(!isset($_GET["acao"]) || $_GET["acao"] == "buscar"){ 
	?>
			<header class="w3-container w3-blue"> 
				<h1> Meus Cadastros</h1>
			</header>
			<main class="w3-container w3-row">
				<div class="w3-col l6 m8 w3-mobile w3-padding-16">
				<?php
					$login_cookie = $_COOKIE['login'];
					if(isset($login_cookie)){
					echo"Bem-Vindo, $login_cookie <br><br>";
					}
					?>

					<form action="crud.php" method="get" name="frm" class="w3-form">
						<input type="hidden" name="acao" value="buscar">
						<input type="text" placeholder="Digite o cliente..." class="w3-input w3-twothird" name="cliente" />
						<input type="submit" class="w3-button w3-black w3-third  w3-round"  value="Buscar">
					</form>
				</div>
				<div class="w3-col l6 m4 w3-mobile w3-padding-16 w3-right-align">
				<br><br>
					<a href="crud.php?acao=novo" class="w3-button w3-green w3-mobile w3-round">Cadastrar Novo</a>
				</div>
				<ul class="w3-ul w3-card-4 w3-white w3-col l12 s12 m12">
				<?php // se o número de resultados for maior que zero, mostra os dados 
					if($total > 0) {
						// inicia o loop que vai mostrar todos os dados 
						while($l = mysqli_fetch_assoc($dados)){ 
				?> 
						<li class="w3-bar">
							<div class=" w3-right" style="padding:23px;">
							  <a href="crud.php?acao=editar&id=<?=$l['id']?>" class="w3-bar-item w3-button w3-white w3-xlarge"><i class="fas fa-edit"></i></a>
							  <a href="crud.php?acao=excluir&id=<?=$l['id']?>" class="w3-bar-item w3-button w3-white w3-xlarge"><i class="fas fa-trash-alt"></i></a>
						  </div>
						  <div class="w3-bar-item">
							<span class="w3-large"><?=$l['cliente']?></span>
							<br>
							<span class="w3-medium">
								<b>E-mail:</b> <?=$l['email']?>
								<br>
								<b>Fone:</b> <?=$l['fone']?> 
							</span>
						  </div>
						</li>
						
				<?php // finaliza o loop que vai mostrar os dados 
						}
						// fim do if 
					}
					else {
						echo $total . " dados encontrados!";
					}
			
				?> 
				</ul>
			</main>
		
		<?php 
		} 
		elseif($_GET["acao"]=="novo") {
		?>
			<header class="w3-container w3-blue"> 
				<h1> Cadastrar Novo cliente </h1>
			</header>
			
			<main class="w3-container w3-light-gray w3-padding-32">
		
				<form action="crud.php" method="get" class="w3-form">
					<input type="hidden" name="acao" value="salvar">
					<label>Cliente:</label>
					<input class="w3-input" type="text" required name="cliente">
					<br>
					<label>E-mail:</label>
					<input class="w3-input" type="email" required name="email">
					<br>
					<label>Fone:</label>
					<input class="w3-input" type="text" required name="fone">
					
					<br><br>
					<button onclick="this.form.submit();" class="w3-button w3-round w3-green"> Cadastrar </button>
					
					<a href="crud.php" class="w3-button w3-round w3-red w3-right"> Cancelar </a>
				</form>
		
			</main>
		<?php } 
		elseif($_GET["acao"]=="editar") {
		?>
			<header class="w3-container w3-blue"> 
				<h1> Editar cliente </h1>
			</header>
			
			<main class="w3-container w3-light-gray w3-padding-32">
		
				<form action="crud.php" method="get" class="w3-form">
					<input type="hidden" name="acao" value="alterar">
					<input type="hidden" name="id" value="<?=$l['id']?>">
					<label>Cliente:</label>
					<input class="w3-input" type="text" required name="cliente" value="<?=$l['cliente']?>">
					<br>
					<label>E-mail:</label>
					<input class="w3-input" type="email" required name="email" value="<?=$l['email']?>">
					<br>
					<label>Fone:</label>
					<input class="w3-input" type="text" required name="fone" value="<?=$l['fone']?>">
					<br><br>
					<button onclick="this.form.submit();" class="w3-button w3-round w3-green"> Alterar </button>			
					<a href="crud.php" class="w3-button w3-round w3-red w3-right"> Cancelar </a>
				</form>
		
			</main>
		<?php } ?>
		
		<br><br>
		
</body>
</html>