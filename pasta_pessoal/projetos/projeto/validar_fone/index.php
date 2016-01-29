
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
	
	

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
  </head>

  <body>
      
	  
	

    <nav class="navbar navbar-inverse navbar-fixed-top">
	
		   
      
    
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Controle de estoque</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse ">

          <ul class="nav navbar-nav navbar-right tipo_esc">
			
            <li id='tela_Produto'>
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					Produto
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Cadastro</a></li>
					<li><a href="#">Lista</a></li>
         
				</ul>
			</li>
			<li id='tela_Cliente'>
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					Cliente
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" >
					<li><a href="#">Cadastro</a></li>
					<li><a href="#">Lista</a></li>
         
				</ul>
			</li>
			<li id='tela_Pedido'>
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					Pedido
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Cadastro</a></li>
					<li><a href="#">Lista</a></li>
         
				</ul>
			</li>
          </ul>
         
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar ">
          <ul class="nav nav-sidebar tipo_esc">
			<li id='tela_Produto'>
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					Produto
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Cadastro</a></li>
					<li><a href="#">Lista</a></li>
         
				</ul>
			</li>
			<li id='tela_Cliente'>
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					Cliente
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Cadastro</a></li>
					<li><a href="#">Lista</a></li>
         
				</ul>
			</li>
			<li id='tela_Pedido'>
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					Pedido
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#">Cadastro</a></li>
					<li><a href="#">Lista</a></li>
         
				</ul>
			</li>
			
			
           
			
			
			
			
			
          </ul>
		  
		  
         
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        


          <h1 class="sub-header" id='text_rs'>Escolha uma tela</h1>
		  
		  
          <div id='tela_rs' class="table-responsive">
          
		  </div>
        </div>
      </div>
    </div>
		
	
	<div class="modal fade bs-example-modal-lg" id="modalEditarCliente" >
	  
	</div><!-- /.modal -->  

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
	 <script src="dist/js/index.js"></script> 
	 <script src="dist/js/intlTelInput.js"></script>
	 <script src="http://formvalidation.io/vendor/formvalidation/js/formValidation.min.js"></script>
	<script src="http://formvalidation.io/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
	 
  </body>
</html>








<form id="contactForm" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">Phone number</label>
        <div class="col-xs-5">
            <input type="tel" class="form-control" name="phoneNumber" />
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $('#contactForm')
        .find('[name="phoneNumber"]')
            .intlTelInput({
                utilsScript: 'dist/js/utils.js',
                autoPlaceholder: true,
                preferredCountries: ['br']
            });

    $('#contactForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                phoneNumber: {
                    validators: {
                        callback: {
                            message: 'The phone number is not valid',
                            callback: function(value, validator, $field) {
                                return value === '' || $field.intlTelInput('isValidNumber');
                            }
                        }
                    }
                }
            }
        })
        ;
});
</script>

