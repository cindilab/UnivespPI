<?php

//variáveis do login
$login = $_POST['login'];
$senha = md5($_POST['senha']);
$entrar = null;
$entrar = $_POST['entrar'];


//variáveis conexão banco
$connect = mysqli_connect('153.92.6.43:3306','u205347630_piuser','3@GrupoPI');
$db = mysqli_select_db($connect, 'u205347630_grupopiunivesp');

//variáveis query
$query_select = "SELECT login_str FROM usuario WHERE login_str = '$login'";
$select = mysqli_query($connect,$query_select);
$array = mysqli_fetch_array($select);
$logarray = $array['login_str'];

    //lógica login
    if (isset($entrar)) {
        
        $verifica = mysqli_query($connect,"SELECT * FROM usuario WHERE login_str = '$login' AND senha_str = '$senha'") or die("erro ao selecionar");
        
        if (mysqli_num_rows($verifica)<=0){
            
            echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='../index/index.html';</script>";
            die();
        }
        else {
            
            //setcookie("login",$login);
            //header("Location:crud.php");
            echo"<script language='javascript' type='text/javascript'>alert('Login ok!');window.location.href='../index/index.html'</script>";
              
        }
    }

?>
