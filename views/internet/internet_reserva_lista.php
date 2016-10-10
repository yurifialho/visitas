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

  if($ano == "") {
    $ano = date('Y');
  }

  if($mes == "") {
    $mes = date('m');
  }
   
?>

<body>
<?php include      "../../includes/messages.php"; ?>
<div class="panel panel-default">
  <div class="panel-heading">Agendar Visitação</div>
  <div class="panel-body">
   <div class="panel panel-default">

    <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('#calendar').fullCalendar({
        defaultDate: '<?php echo $ano."-".str_pad($mes,2,"0",STR_PAD_LEFT)."-01" ?>',
        locale: 'pt-br',
        events: [
          <?php
            $query = 'data >= current_date() and extract(year from data) = ? and extract(month from data) = ? ';

            foreach (Disponibilidade::all(array('conditions' => array($query, $ano, $mes), 'order' => 'data asc, hora asc')) as $dispo) {

          ?>
          { 
            id: '<?php echo $dispo->id; ?>',
            title: 
            '<?php
              if($dispo->reserva != NULL) {
                if($dispo->reserva->situacao->id != 3) {
                  echo $dispo->reserva->entidade;
                } else {
                  echo $dispo->reserva->situacao->descricao;
                }
              } else {
                echo "Livre" ;
              }
            ?>',
            color: 
            '<?php
              if($dispo->reserva != NULL) {
                if($dispo->reserva->situacao->id != 3) {
                  echo "#269900"; #verde
                } else {
                  echo "#ffa366"; #amarelo
                }
              } else if($dispo->data <= new DateTime(date("Y-m-d", time()))){
                echo "#b3b3b3"; #cinza
              } else {
                echo "#99ccff"; #azul
              }
            ?>',
            <?php if($dispo->reserva == NULL && $dispo->data > new DateTime(date("Y-m-d", time()))) { ?>
            url: 'internet_reserva_form.php?action=agendar&id=<?php echo $dispo->id ?>',
            <?php } ?>
            textColor: 'black',
            start: '<?php echo $dispo->data->format('Y-m-d') ?>T<?php echo substr($dispo->hora,0,5) ?>',
            end:   '<?php echo $dispo->data->format('Y-m-d') ?>T<?php echo substr($dispo->hora,0,5) ?>'
          },
          <?php } ?>
        ]
      });
      
      jQuery('.fc-prev-button').click(function(){
        <?php
          if($mes <= 1) {
            $prev_mes = 12;
            $prev_ano = $ano -1;
          } else {
            $prev_mes = $mes - 1;
            $prev_ano = $ano;
          }
        ?>
        location.href = "internet_reserva_lista.php?mes=<?php echo $prev_mes ?>&ano=<?php echo $prev_ano ?>";
      });

      jQuery('.fc-next-button').click(function(){
        <?php
          if($mes >= 12) {
            $prox_mes = 1;
            $prox_ano = $ano + 1;
          } else {
            $prox_mes = $mes + 1;
            $prox_ano = $ano;
          }
        ?>
        location.href = "internet_reserva_lista.php?mes=<?php echo $prox_mes ?>&ano=<?php echo $prox_ano ?>";
      });

      jQuery('.fc-today-button').click(function(){
        location.href = "internet_reserva_lista.php";
      });
    });
    </script>
    <div id="calendar"></div>
    </div>
    
  </div>
</div>

<?php include "../../includes/footer.php"; ?>