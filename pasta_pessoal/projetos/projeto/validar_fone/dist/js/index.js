tela = '';
link = '';
sub_tela = '';
nova = '';

$(document).ready(function() {
	
	$('.tipo_esc').on('click', 'a', function(e) {
	   tela = $(this).text();
	   nova = $(this).text();
	
	   
	}); 
	
	$('.dropdown-menu').on('click', 'a', function(e) {
		sub_tela = $(this).text();	
		tela = tela.toLowerCase();
		$("#text_rs").text(sub_tela+' '+tela);
	
		if(sub_tela == 'Lista'){
			$("#text_rs").append('<form class="navbar-form navbar-right"><input id=\'pesquisa\' type="text" class="form-control" placeholder="Search..."><button type="button" class="btn btn-primary" onclick="carregarPagina()">Pesquisar</button></form>');
		}
	 
		$('.navbar-toggle').click();	
		link = tela+'/'+tela+'_'+sub_tela+'.php';
		link = link.toLowerCase();
    
		$.get(link, 
			function(data) {
				$("#tela_rs").html(data);
			}
		);
	});  
}); 

function carregarPagina (){

	var pesquisa = ($('#pesquisa').val());
	var link_novo = link.replace("cadastro", "lista"); 
	$.get(link_novo,{pesquisa: pesquisa }, 
		function(data) {
			$("#tela_rs").html(data);
		}
	);;
		
} 

function janelaEditar(id_cliente,pagina){
		$.post('cliente/cliente_cadastro.php', function (data){
		$("#tela_rs").html(data);
			 
		//antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
		carregaDadosClienteJSon(id_cliente);
		
		
		
		 
	});
	
	
}  

function carregaDadosClienteJSon(id_cliente){
	$.post('cliente/cliente_json.php', {
		id_cliente: id_cliente
	}, function (data){
		$('#nome').val(data.nome);
		$('#email').val(data.email);
		$('#id_cliente').val(data.id_cliente);//aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente. 
	}, 'json');
}

function alterar_dados_salva(pagina){
	var pesquisa 	= ($('#pesquisa').val());
	var link_novo 	= link.replace("cadastro", "lista"); 
	var dados 		= $('#formulario_'+pagina).serialize();
	sub_tela 		= 'Lista';
	tela			= pagina;
	
	if (! $("#pesquisa").length ){
		$("#text_rs").append('<form class="navbar-form navbar-right"><input id=\'pesquisa\' type="text" class="form-control" placeholder="Search..."><button type="button" class="btn btn-primary" onclick="carregarPagina()">Pesquisar</button></form>');
	}
	
	$.post(pagina+'/'+pagina+'_salvar.php?'+dados, 
	function (data){
		
		if(data.msg == 'OK'){
			alert("dados gravados com sucesso");
			
			$.get(link_novo, {
				pesquisa: pesquisa
			},
              function(data) {
				  
				$("#text_rs").text(sub_tela+' '+tela);
                $("#tela_rs").html(data);
              }
			);	
			$('#modalEditarCliente').click();
		}else{
			alert(data.msg);
		}
	},'json');

	
}






		
		
	
