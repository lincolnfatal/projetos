<?php
session_start();
include "funcoes.php";

	$produto_nome = $_POST['produto_nome'];
	$produto_descricao = $_POST['produto_descricao'];
	$produto_preco  = $_POST['produto_preco'];


	$sql = mysql_query("INSERT INTO produto(produto_nome,produto_descricao,produto_preco) VALUES ('$produto_nome','$produto_descricao','$produto_preco')");
	$linha = mysql_num_rows($query);
	
	
	
	if($linha !=0)
	{
		session_start();
		
		$dados= mysql_fetch_assoc($query);

		$_SESSION['produto_nome'] = $dados['produto_nome'];
		$_SESSION['produto_descricao'] = $dados['produto_descricao'];
		$_SESSION['produto_preco'] = $dados['produto_preco'];
		
		
	}else{
		header("Location:  processaProduto.php?status=erro")
	}

?>