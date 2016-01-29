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

function janelaEditar(id_dado,pagina){
		$.post(pagina+'/'+pagina+'_cadastro.php', function (data){
		$("#tela_rs").html(data);		 
		
		carregaDadosJSon(id_dado,'editar',pagina);		
		 
	});
	
	
}  



function carregaDadosJSon(id_valor,tipo,pagina){
	$.post(pagina+'/'+pagina+'_json.php', {
		id_valor: id_valor
	}, function (data){
		if(tipo == 'editar'){
			$.each(data, function(index, value) {
				$('#'+index).val(value);
			});
		}else{
			$.each(data, function(index, value) {
				$('#'+index).html(value);
			});
		}
	}, 'json');
}


function alterar_dados_salva(pagina){
	var pesquisa 	= ($('#pesquisa').val());
	var link_novo 	= link.replace("cadastro", "lista"); 
	var dados 		= $('#formulario_'+pagina).serialize();
	sub_tela 		= 'Lista';
	tela			= pagina;
	
	
	
	$.post(pagina+'/'+pagina+'_salvar.php?'+dados, 
	function (data){
		
		if(data.resposta == 'OK'){
			
			$("#msg_alert").html(data.msg);
			$('#confirm-alert').modal({
				show: 'false'
			});
			
			$.get(link_novo, {
				pesquisa: pesquisa
			},
              function(data) {
				  
				$("#text_rs").text(sub_tela+' '+tela);
                $("#tela_rs").html(data);
				if (! $("#pesquisa").length ){
					$("#text_rs").append('<form class="navbar-form navbar-right"><input id=\'pesquisa\' type="text" class="form-control" placeholder="Search..."><button type="button" class="btn btn-primary" onclick="carregarPagina()">Pesquisar</button></form>');
					$('#pesquisa').val(pesquisa);
				}
              }
			);	
			$('#modalEditarCliente').click();
		}else{
			/*			
			$('button').removeAttr('disabled');
			$('#btn_gravar').removeClass('disabled');
			*/
			$("#msg_alert").html(data.msg);
			$('#confirm-alert').modal({
				show: 'false'
			});
			
		}
	},'json');

	
}

function excluir_dado(id_dado,pagina){
	var pesquisa 	= ($('#pesquisa').val());
	var link_novo 	= link.replace("cadastro", "lista"); 	
	sub_tela 		= 'Lista';
	tela			= pagina;
	
	
	
	$.post(pagina+'/'+pagina+'_excluir.php?id_excluir='+id_dado, 
	function (data){
		
		if(data.resposta == 'OK'){
			

			if( $("#confirm-delete").length ){
				$('#confirm-delete').modal('toggle');
			}
			$("#msg_alert").html(pagina+' excluido(a) com sucesso! ');
			$('#confirm-alert').modal({
				show: 'false'
			});
		
			
			$.get(link_novo, {
				pesquisa: pesquisa
			},
              function(data) {
				  
				$("#text_rs").text(sub_tela+' '+tela);
                $("#tela_rs").html(data);
				if (! $("#pesquisa").length ){
					$("#text_rs").append('<form class="navbar-form navbar-right"><input id=\'pesquisa\' type="text" class="form-control" placeholder="Search..."><button type="button" class="btn btn-primary" onclick="carregarPagina()">Pesquisar</button></form>');
					$('#pesquisa').val(pesquisa);
				}
              }
			);	
			$('#modalEditarCliente').click();
		}else{
			$("#msg_alert").html(data.msg);
			$('#confirm-alert').modal({
				show: 'false'
			});
			
		}
		
		
	},'json');

	
}
	
function janelaVisualizar(id_dado,pagina){
		$.post(pagina+'/'+pagina+'_visualizar.php', function (data){
		$("#tela_rs").html(data);			 
		
		carregaDadosJSon(id_dado,'visualizar',pagina);
		
		 
	});
	
	
}  
  

function login(){
	var email = $('#email_login').val();
	var senha = $('#senha_login').val();
	$.post('login.php',{
		email ,email,
		senha, senha
	}, function (data){
		
		if(data.msg == 'OK'){
			$('#login-modal').addClass('hide');
			$('#fundo_escuro').modal('show');
		}else{
			alert('erro');
		}
			
		 
	},'json');
}


	


$(document).ready(function() {
	
    

    $('#form_login').formValidation({
        
    }).on('success.form.fv', function(e) {
		
		e.preventDefault();
		login();
		
		 //return("dados gravados com sucesso");
				//	alterar_dados_salva('pedido');
                   
        });;
});





		
		
	
