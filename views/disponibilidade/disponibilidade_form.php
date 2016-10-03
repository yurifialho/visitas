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
  <script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery("#data").mask("99/99/9999");
    jQuery("#hora").mask("99:99");
  });
</script>
<?php include      "../../includes/messages.php"; ?>

<?php $dispo = Disponibilidade::find($_GET['id']); ?>

<div class="panel panel-default">
  <div class="panel-heading">Disponibilidade</div>
  <div class="panel-body">
    <form role="form" class="form-horizontal" action="../../controllers/disponibilidadecontroller.php" method="post" >
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
  			<label for="data" class="col-sm-2 control-label">Data</label>
  			<div class="col-sm-10">
	    		<input type="text" class="form-control"
	    			   placeholder="Data" id="data" name="data"
	    			   value="<?php echo $dispo->data->format('d/m/Y') ?>">
    		</div>
  		</div>
  		<div class="form-group">
  			<label for="hora" class="col-sm-2 control-label">Hora</label>
  			<div class="col-sm-10">
	    		<input type="text" class="form-control" required="true"
	    			   placeholder="Hora" id="hora" name="hora"
	    			   value="<?php echo $dispo->hora ?>">
    		</div>
  		</div>
  		<div class="form-group">
  			<div class="col-sm-offset-2 col-sm-10">
		  		<button type="submit" class="btn btn-success">Salvar</button>
	  			<a href="disponibilidade_lista.php">
	  				<button type="button" class="btn btn-danger">Voltar</button>
	  			</a>
  			</div>
  		</div>
    </form>
  </div>
</div>
<?php include "../../includes/footer.php"; ?>