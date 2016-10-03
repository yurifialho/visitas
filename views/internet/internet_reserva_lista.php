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

  #processamento de requisicoes
  $ano = preg_replace('/[^[:digit:]_]/', '',$_GET['ano']);
  $mes = preg_replace('/[^[:digit:]_]/', '',$_GET['mes']);

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
            $anopassado = date('Y');
            for($i = $anopassado; $i <= $anopassado + 1; $i++) { ?>
              <option value="<?php echo $i ?>" <?php echo  ($ano != '' && $i == $ano) || $i == date('Y') ? 'selected' : '' ?> ><?php echo $i ?></option>
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
        
      	$query = 'data > current_date() and extract(year from data) = ? and extract(month from data) = ? ';
               
        if (!isset($ano) || $ano == "") {
          $ano = date('Y');
        }
        if (!isset($mes) || $mes == "") {
          $mes = date('m');
        }

      	foreach (Disponibilidade::all(array('conditions' => array($query, $ano, $mes), 'order' => 'data asc, hora asc')) as $dispo) { ?>
      <tr>
        <td><?php echo $dispo->data->format('d/m/Y') ?> <?php echo substr($dispo->hora,0,5) ?> <?php echo strftime(' (%A)', $dispo->data->getTimestamp()); ?></td>
        <td><?php echo $dispo->reserva != NULL && $dispo->reserva->situacao->id != 3 ? $dispo->reserva->entidade : "-" ?></td>
        <td><?php echo $dispo->reserva != NULL ? $dispo->reserva->situacao->descricao : "Livre" ?></td>
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