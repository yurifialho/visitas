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

<?php 
  
  $id = preg_replace('/[^[:digit:]_]/', '',isset($_GET['id']) ? $_GET['id'] : '');
  if($id!='') {
    $usuario = Usuario::find($id); 
  }

?>
<script type="text/javascript">
$(function () {
  $("#senha").complexify({}, function (valid, complexity) {
      if(complexity <= 30) {
        clazz = "";
        valor = 0;
        if(complexity <= 5) {
          valor = 0;
          $("#label_progress").html('');
        } else if(complexity <= 10) {
          clazz = "progress-bar progress-bar-danger";
          valor = 30;
          $("#label_progress").html('FRACA');
        } else if (complexity <= 20) {
          clazz = "progress-bar progress-bar-info";
          valor = 60;
          $("#label_progress").html('MEDIA');
        } else {
          clazz = "progress-bar progress-bar-success";
          valor = 100;
          $("#label_progress").html('FORTE');
        }

        $("#progressbar").attr('class', clazz);
        $("#progressbar").attr('aria-valuenow', valor);
        $("#progressbar").attr('style', "width: " + valor + "%");
      }
  });
});
</script>

<div class="panel panel-default">
  <div class="panel-heading">Usuario</div>
  <div class="panel-body">
    <form role="form" class="form-horizontal" action="../../controllers/usuariocontroller.php" method="post" >
    	<input type="hidden" id="action" name="action" value="<?php echo $_GET['action']; ?>"/>
    	<input type="hidden" id="id2" name="id" value="<?php echo $id!='' ? $id : '' ?>"/>
    	<div class="form-group">
    		<label for="id" class="col-sm-2 control-label">Cod.</label>
    		<div class="col-sm-10">
    			<input type="text"  class="form-control" 
    				   size="4" id="id" name="id"
    				   value="<?php echo $id!='' ? $id : '' ?>" 
    				   disabled>
    		</div>
  		</div>
  		<div class="form-group">
  			<label for="login" class="col-sm-2 control-label">Login</label>
  			<div class="col-sm-10">
	    		<input type="text" class="form-control" required="true"
	    			   placeholder="Login" id="login" name="login"
	    			   value="<?php echo $id!='' && $usuario != null ? $usuario->login : '' ?>">
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
        <label for="senha" id="label_progress" class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
          <div class="progress">
            <div id="progressbar" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="30" style="width: 0%">
            </div>
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
<?php include "../../includes/footer.php"; ?>

