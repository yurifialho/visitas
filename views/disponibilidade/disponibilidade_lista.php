<?php 
#--------------------------------------------------------------------------
# disponibilidade_lista.php
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
<div class="panel panel-default">
  <div class="panel-heading">Disponibilidades</div>
  <div class="panel-body">
   <div class="panel panel-default">
    
    <div class="panel-body">
    <form class="form-inline" role="form" action="../../controllers/disponibilidadecontroller.php" method="post">
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
          <option value="">Mês</option>
          <?php 
            foreach ($map_mes as $mes_n => $mes_v) { ?>
              <option value="<?php echo $mes_n ?>"><?php echo $mes_v ?></option>
          <?php } ?>
          </select>
      </div>
      <div class="form-group">
          <input type="text"
               placeholder="Data" id="data" name="data"
               value="" size="12" class="form-control">
      </div>
      <div class="form-group">
          <input type="text"
               placeholder="Hora" id="hora" name="hora"
               value="" size="8" class="form-control">
      </div>
      <button type="submit" class="btn btn-info" onclick="jQuery('#action').val('index')">
      	<span class="glyphicon glyphicon-search">&nbsp;</span>Buscar</button>
      <button type="submit" class="btn btn-success" onclick="jQuery('#action').val('new')">
      	<span class="glyphicon glyphicon-floppy-disk">&nbsp;</span>Salvar</button>
      <button type="submit" class="btn btn-warning" onclick="jQuery('#action').val('gerarDisponibilidadeMensal')">
        <span class="glyphicon glyphicon-flash">&nbsp;</span>Preencher Mês</button>
    </form>
    </div>
    </div>
    <table class="table"  cellSpacing=1 cellPadding=4 width="100%" border=0>
      <thead>
      <tr> 
        <th>Cód.</th>
        <th>Data</th>
        <th>Hora</th>
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
        <td><?php echo $dispo->data->format('d/m/Y') ?></td>
        <td><?php echo $dispo->hora ?></td>
        <td>
          <a href="disponibilidade_form.php?action=update&id=<?php echo $dispo->id ?>">
          <button type="button" class="btn btn-default btn-xs">
            <span class="glyphicon glyphicon-pencil"></span> Editar
          </button>
          </a>
          <a href="../../controllers/disponibilidadecontroller.php?action=delete&id=<?php echo $dispo->id ?>"
            onclick="return confirm('Deseja realmente remover?');">
          <button type="button" class="btn btn-danger btn-xs">
            <span class="glyphicon glyphicon-trash"></span> Excluir
          </button>
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
    </table>
  </div>
</div>

<?php include "../../includes/footer.php"; ?>