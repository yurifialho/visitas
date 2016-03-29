<?php 
#--------------------------------------------------------------------------
# reserva_lista.php
#--------------------------------------------------------------------------
#
# @author: Yuri Fialho - 2� TEN FIALHO
# @since: 03/02/2016
# @contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

  include      "../../includes/header.php"; 

?>

<body>
<?php include      "../../includes/messages.php"; ?>
<div class="panel panel-default">
  <div class="panel-heading">Disponibilidades</div>
  <div class="panel-body">
   <div class="panel panel-default">
    
    <div class="panel-body">
    <form class="form-inline" role="form" action="../../controllers/reservacontroller.php" method="post">
      <input type="hidden" id="action" name="action" value="new"/>
      <div class="form-group">
        <select id="ano" name="ano" class="form-control">
          <option value="">Ano</option>
          <?php 
            $anopassado = date('Y') - 1;
            for($i = $anopassado; $i <= $anopassado + 2; $i++) { ?>
              <option value="<?php echo $i ?>" <?php echo $i == date('Y') ? 'selected' : '' ?> ><?php echo $i ?></option>
          <?php } ?>
          </select>
      </div>
      <div class="form-group">
        <select id="mes" name="mes" class="form-control">
          <option value="">M�s</option>
          <?php 
            foreach ($map_mes as $mes_n => $mes_v) { ?>
              <option value="<?php echo $mes_n ?>"><?php echo $mes_v ?></option>
          <?php } ?>
          </select>
      </div>
      <button type="submit" class="btn btn-info" onclick="jQuery('#action').val('index')">
      	<span class="glyphicon glyphicon-search">&nbsp;</span>Buscar</button>
    </form>
    </div>
    </div>
    <table class="table"  cellSpacing=1 cellPadding=4 width="100%" border=0>
      <thead>
      <tr> 
        <th>C�d.</th>
        <th>Data</th>
        <th>Entidade</th>
        <th>Sit.</th>
        <th>A��o</th>
      </tr>
    </thead>
    <tbody>
      <?php
      	$query = "1=1 ";
       
      	if(isset($_GET['data'])) {
      		$patrimonio = $_GET['data'];
      		$query.=" and data = '$data' " ;
      	}
      	if(isset($_GET['hora'])) {
      		$nome = $_GET['hora'];
      		$query.=" and hora = '$hora' ";
      	}
        if (!isset($_GET['data']) && isset($_GET['ano'])) {
          $ano = $_GET['ano'];
          $query.=" and extract(year from data) = $ano ";
        }
        if (!isset($_GET['data']) && isset($_GET['mes'])) {
          $mes = $_GET['mes'];
          $query.=" and extract(month from data) = $mes ";
        }
      	foreach (Disponibilidade::find('all', array('conditions' => $query, 'order' => 'data asc, hora asc')) as $dispo) { ?>
      <tr>
        <td><?php echo $dispo->id ?></td>
        <td><?php echo $dispo->data->format('d/m/Y') ?> <?php echo $dispo->hora ?></td>
        <td><?php echo  $dispo->reserva != NULL && $dispo->reserva->situacao->id != 3 ? $dispo->reserva->entidade : "-" ?></td>
        <td><?php echo  $dispo->reserva != NULL ? $dispo->reserva->situacao->descricao : "Livre" ?></td>
        <td>
          <?php if($dispo->reserva == NULL) { ?>
          <a href="reserva_form.php?action=agendar&id=<?php echo $dispo->id ?>">
          <button type="button" class="btn btn-info btn-xs">
            <span class="glyphicon glyphicon-calendar"></span> Agendar
          </button>
          </a>
          <?php } ?>
          <?php if($dispo->reserva != NULL) { ?>
          <a href="reserva_form.php?action=update&id=<?php echo $dispo->id ?>">
          <button type="button" class="btn btn-info btn-xs">
            <span class="glyphicon glyphicon-eye-open"></span> Visualizar
          </button>
          </a>
          <?php } ?>
          <?php if($dispo->reserva != NULL && $dispo->reserva->situacao->id == 3) { ?>
          <a href="../../controllers/reservacontroller.php?action=confirmar&disponibilidade_id=<?php echo $dispo->id ?>">
          <button type="button" class="btn btn-success btn-xs">
            <span class="glyphicon glyphicon-ok"></span> Confirmar
          </button>
          </a>
          <?php } ?>
          <?php if($dispo->reserva != NULL) { ?>
          <a href="../../controllers/reservacontroller.php?action=delete&disponibilidade_id=<?php echo $dispo->id ?>">
          <button type="button" class="btn btn-danger btn-xs">
            <span class="glyphicon glyphicon-remove"></span> Cancelar
          </button>
          </a>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
    </table>
  </div>
</div>

<?php include "../../includes/footer.php"; ?>