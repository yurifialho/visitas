<?php 
#--------------------------------------------------------------------------
# disponibilidade_form.php
#--------------------------------------------------------------------------
#
# @author: Yuri Fialho - 2º TEN FIALHO
# @since: 03/02/2016
# @contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

  include      "../../includes/header.php"; 

?>

<body>
<?php include      "../../includes/messages.php"; ?>

<?php $usuario = Usuario::find($_GET['id']); ?>

<div class="panel panel-default">
  <div class="panel-heading">Usuario</div>
  <div class="panel-body">
    <form role="form" class="form-horizontal" action="../../controllers/usuariocontroller.php" method="post" >
    	<input type="hidden" id="action" name="action" value="<?php echo $_GET['action']; ?>"/>
    	<input type="hidden" id="id2" name="id" value="<?php echo $_GET['id']; ?>"/>
    	<div class="form-group">
    		<label for="id" class="col-sm-2 control-label">Cod.</label>
    		<div class="col-sm-10">
    			<input type="text"  class="form-control" 
    				   size="4" id="id" name="id"
    				   value="<?php echo $_GET['id'] ?>" 
    				   disabled>
    		</div>
  		</div>
  		<div class="form-group">
  			<label for="login" class="col-sm-2 control-label">Login</label>
  			<div class="col-sm-10">
	    		<input type="text" class="form-control" required="true"
	    			   placeholder="Login" id="login" name="login"
	    			   value="<?php echo $usuario->login ?>">
    		</div>
  		</div>
  		<div class="form-group">
  			<label for="senha" class="col-sm-2 control-label">Senha</label>
  			<div class="col-sm-10">
	    		<input type="password" class="form-control"
	    			   placeholder="Digite a nova senha" id="senha" name="senha"
	    			   value="">
    		</div>
  		</div>
  		<div class="form-group">
  			<div class="col-sm-offset-2 col-sm-10">
		  		<button type="submit" class="btn btn-success">Salvar</button>
	  			<a href="usuario_lista.php">
	  				<button type="button" class="btn btn-danger">Voltar</button>
	  			</a>
  			</div>
  		</div>
    </form>
  </div>
</div>
<?php include "../../includes/header.php"; ?>