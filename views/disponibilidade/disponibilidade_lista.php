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

  #processamento de requisicoes
  $ano  = preg_replace('/[^[:digit:]_]/', '',$_GET['ano']);
  $mes  = preg_replace('/[^[:digit:]_]/', '',$_GET['mes']);
  $data = $_GET['data'];#preg_replace('/[^[:digit:]_]/', '',$_GET['data']);
  $hora = $_GET['hora'];#preg_replace('/[^0-9\/_]/', '',$_GET['hora']);
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
              <option value="<?php echo $i ?>" <?php echo ($ano != '' && $i == $ano) || $i == date('Y') ? 'selected' : '' ?> ><?php echo $i ?></option>
          <?php } ?>
          </select>
      </div>
      <div class="form-group">
        <select id="mes" name="mes" class="form-control">
          <?php 
            foreach ($map_mes as $mes_n => $mes_v) { ?>
              <option value="<?php echo $mes_n ?>"
               <?php 
                  if($mes != '') echo($mes_n == $mes ? "selected" : "");
                  else echo($mes_n == date('m') ? "selected" : "");
               ?>>
                <?php echo $mes_v ?>
              </option>
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
        $conditions = array();
      	$query = "";
        $param = array();
       
      	if($data != '') {
          if(sizeof($param) > 0) $query .= " and ";
      		$query.=" data = '?' " ;
          array_push($param, array($data));
      	}
      	if($hora != '') {
      		if(sizeof($param) > 0) $query .= " and ";
          $query.=" hora = '?' " ;
          array_push($param, array($hora));
      	}
        if ($data == '' && $ano != '') {
          if(sizeof($param) > 0) $query .= " and ";
          $query.=" extract(year from data) = ? " ;
          array_push($param, array($ano));
        }
        if ($data == '' && $mes != '') {
          if(sizeof($param) > 0) $query .= " and ";
          $query.=" extract(month from data) = ? " ;
          array_push($param, array($mes));
        }

        array_push($conditions, $query);
        foreach ($param as $value) {
          array_push($conditions, $value);
        }

      	foreach (Disponibilidade::all(array('conditions' => $conditions, 'order' => 'data asc, hora asc')) as $dispo) { ?>
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