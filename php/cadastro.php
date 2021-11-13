<?php

//variáveis do login
$login = $_POST['login'];
$senha = md5($_POST['senha']);
$cadastrar = null;
$cadastrar = $_POST['cadastrar'];

//variáveis conexão banco
$connect = mysqli_connect('153.92.6.43:3306','u205347630_piuser','3@GrupoPI');
$db = mysqli_select_db($connect, 'u205347630_grupopiunivesp');

//variáveis query
$query_select = "SELECT login_str FROM usuario WHERE login_str = '$login'";
$select = mysqli_query($connect,$query_select);
$array = mysqli_fetch_array($select);
$logarray = $array['login_str'];

    //lógica cadastro
    
    if (isset($cadastrar)) {
	    
        if(preg_replace("/\s+/", "", $string) || $login == ""|| $login == null ) {
	    
                echo"<script language='javascript' type='text/javascript'>alert('Campo login inválido.');window.location.href='../index/index.html';</script>";
	    }
        else {
	        
            if($logarray == $login){
	            
                echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');window.location.href='../index/index.html';</script>";
	            die();
	        }
            else {
	        
                $query = "INSERT INTO usuario (login_str,senha_str) VALUES ('$login','$senha')";
                $insert = mysqli_query($connect,$query);
                
                if($insert) {
                
                    echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='index.html'</script>";
                } 
                else {
                    echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='../index/index.html'</script>";
                }
            }
        }
    }

?>

