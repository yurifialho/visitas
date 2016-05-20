<?php 
#--------------------------------------------------------------------------
# reserva_form.php
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
    jQuery("#telefone").mask("(99)9999-9999");
    jQuery("#celular").mask("(99)99999-9999");
    jQuery("#quantidade").mask("999");
  });
</script>
<?php include      "../../includes/messages.php"; ?>

<?php 
  $dispo = Disponibilidade::find($_GET['id']); 
  if($dispo->reserva != null) {
    $reserva=$dispo->reserva;
  } else {
    $reserva=new Reserva();
  }
?>

<div class="panel panel-default">
  <div class="panel-heading">Reservar</div>
  <div class="panel-body">
    <div class="alert alert-warning" role="alert">
      A reserva está sujeita à análise e aprovação, verifique a confirmação da reserva no site. Obrigado por nos visitar!
    </div>
    <form role="form" class="form-horizontal" action="../../controllers/reservacontroller.php" method="post" >
    	<input type="hidden" id="action" name="action" value="<?php echo $_GET['action']; ?>"/>
    	<input type="hidden" id="disponibilidade_id" name="disponibilidade_id" value="<?php echo $_GET['id']; ?>"/>
      <input type="hidden" id="id" name="id" value="<?php echo $reserva->id != NULL ? $reserva->id : "" ?>"/>
    	<div class="form-group">
    		<label for="id" class="col-sm-2 control-label">Data Pretendida</label>
    		<div class="col-sm-10">
    			<?php echo $dispo->data->format('d/m/Y') ?> <?php echo $dispo->hora ?>
    		</div>
  		</div>
  		<div class="form-group">
  			<label for="data" class="col-sm-2 control-label">Entidade</label>
  			<div class="col-sm-10">
	    		<input type="text" class="form-control" required="true"
	    			   placeholder="Nome da Entidade" id="entidade" name="entidade"
	    			   value="<?php echo $reserva->entidade ?>" />
    		</div>
  		</div>
  		<div class="form-group">
  			<label for="hora" class="col-sm-2 control-label">Responsável</label>
  			<div class="col-sm-10">
	    		<input type="text" class="form-control" required="true"
	    			   placeholder="Nome do Responsável" id="nome" name="nome"
	    			   value="<?php echo $reserva->nome ?>" />
    		</div>
  		</div>
      <div class="form-group">
        <label for="hora" class="col-sm-2 control-label">Telefone</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required="true"
               placeholder="Informe o telefone do responsável" id="telefone" name="telefone"
               value="<?php echo $reserva->telefone ?>" />
        </div>
      </div>
      <div class="form-group">
        <label for="hora" class="col-sm-2 control-label">Celular</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required="true"
               placeholder="Informe o número do celular do responsável." id="celular" name="celular"
               value="<?php echo $reserva->celular ?>" />
        </div>
      </div>
      <div class="form-group">
        <label for="hora" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required="true"
               placeholder="Informe o email do responsável." id="email" name="email"
               value="<?php echo $reserva->email ?>" />
        </div>
      </div>
      <div class="form-group">
        <label for="hora" class="col-sm-2 control-label">Nr. Pessoas</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required="true"
               placeholder="Quantas pessoas virão?" id="quantidade" name="quantidade"
               value="<?php echo str_pad($reserva->quantidade, 3, "0", STR_PAD_LEFT) ?>" />
        </div>
      </div>
      <div class="form-group">
        <label for="hora" class="col-sm-2 control-label">Transporte</label>
        <div class="col-sm-10">
          <select id="transportetipo" name="transportetipo" class="form-control" required="true">
          <option value="">Selecione o transporte que a entidade virá.</option>
          <?php 
            $tipo_transporte = TransporteTipo::find('all');
            foreach($tipo_transporte as $transp) { ?>
              <option value="<?php echo $transp->id; ?>" <?php echo $transp->id == $reserva->transporte_tipo_id ? 'selected' : ''; ?> ><?php echo $transp->descricao; ?></option>
          <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="nrtransp" class="col-sm-2 control-label">Nr. Transporte</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required="true"
               placeholder="Quantas veículos virão?" id="nrtransp" name="nrtransp"
               value="<?php echo str_pad($reserva->transporte_numero, 3, "0", STR_PAD_LEFT) ?>" />
        </div>
      </div>
      <div class="form-group">
        <label for="escolaridadetipo" class="col-sm-2 control-label">Escolaridade</label>
        <div class="col-sm-10">
          <select id="escolaridadetipo" name="escolaridadetipo" class="form-control" required="true">
          <option value="">Selecione a escolaridade do grupo que virá.</option>
          <?php 
            $tipo_escolaridade = EscolaridadeTipo::find('all');
            foreach($tipo_escolaridade as $escola) { ?>
              <option value="<?php echo $escola->id; ?>" <?php echo $escola->id == $reserva->escolaridade_tipo_id  ? 'selected' : ''; ?> ><?php echo $escola->descricao; ?></option>
          <?php } ?>
          </select>
        </div>
      </div>
  		<div class="form-group">
  			<div class="col-sm-offset-2 col-sm-10">
		  		<button type="submit" class="btn btn-success">Salvar</button>
	  			<a href="reserva_lista.php">
	  				<button type="button" class="btn btn-danger">Voltar</button>
	  			</a>
  			</div>
  		</div>
    </form>
  </div>
</div>
<?php include "../../includes/footer.php"; ?>