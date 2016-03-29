<?php 
#--------------------------------------------------------------------------
# internet_reserva_lista.php
#--------------------------------------------------------------------------
#
# @author: Yuri Fialho - 2º TEN FIALHO
# @since: 03/02/2016
# @contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

  include      "../../includes/header_internet.php"; 

?>

<body>
<?php include      "../../includes/messages.php"; ?>
<div class="panel panel-default">
  <div class="panel-heading">Agendar Visitação</div>
  <div class="panel-body">
   <div class="panel panel-default">
    
    <div class="panel-body">
    <form class="form-inline" role="form" action="../../controllers/internetreservacontroller.php" method="post">
      <input type="hidden" id="action" name="action" value="new"/>
      <div class="form-group">
        <select id="ano" name="ano" class="form-control">
          <?php 
            $anopassado = date('Y') - 1;
            for($i = $anopassado; $i <= $anopassado + 2; $i++) { ?>
              <option value="<?php echo $i ?>" <?php echo  isset($_GET['ano']) && ($i == $_GET['ano'] || $i == date('Y')) ? 'selected' : '' ?> ><?php echo $i ?></option>
          <?php } ?>
          </select>
      </div>
      <div class="form-group">
        <select id="mes" name="mes" class="form-control">
          <?php 
            foreach ($map_mes as $mes_n => $mes_v) { ?>
              <option value="<?php echo $mes_n ?>" <?php echo isset($_GET['mes']) && ($mes_n == $_GET['mes'] || $mes_n == date('m')) ? "selected" : "" ?>><?php echo $mes_v ?></option>
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
        <th>Data</th>
        <th>Entidade</th>
        <th>Sit.</th>
        <th>Ação</th>
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
        if (isset($_GET['ano'])) {
          $ano = $_GET['ano'];
          $query.=" and extract(year from data) = $ano ";
        } else {
          $ano = date('Y');
          $query.=" and extract(year from data) = $ano ";
        }
        if (isset($_GET['mes'])) {
          $mes = $_GET['mes'];
          $query.=" and extract(month from data) = $mes ";
        } else {
          $mes = date('m');
          $query.=" and extract(month from data) = $mes ";
        }
      	foreach (Disponibilidade::find('all', array('conditions' => $query, 'order' => 'data asc, hora asc')) as $dispo) { ?>
      <tr>
        <td><?php echo $dispo->data->format('d/m/Y') ?> <?php echo $dispo->hora ?></td>
        <td><?php echo  $dispo->reserva != NULL && $dispo->reserva->situacao->id != 3 ? $dispo->reserva->entidade : "-" ?></td>
        <td><?php echo  $dispo->reserva != NULL ? $dispo->reserva->situacao->descricao : "Livre" ?></td>
        <td>
          <?php if($dispo->reserva == NULL) { ?>
          <a href="internet_reserva_form.php?action=agendar&id=<?php echo $dispo->id ?>">
          <button type="button" class="btn btn-info btn-xs">
            <span class="glyphicon glyphicon-calendar"></span> Agendar
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