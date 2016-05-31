<?php 
#--------------------------------------------------------------------------
# messages.php
#--------------------------------------------------------------------------
#
# @author: Yuri Fialho - 2º TEN FIALHO
# @since: 03/02/2016
# @contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------
# Exibe as mensagens de sucesso ou erro na página
#--------------------------------------------------------------------------
if(isset($_GET['msg']) && $_GET['msg'] != "") { ?>  
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert">
    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  </button>
  <strong>Sucesso!</strong> <?php echo htmlspecialchars($_GET['msg'], ENT_COMPAT,'ISO-8859-1', true); ?>
</div>
<?php } ?>
<?php if((isset($_GET['msg_erro']) && $_GET['msg_erro'] != "") || 
		 (isset($_SESSION['msg_erro']) && $_SESSION['msg_erro'] != "")) { ?>  
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert">
    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
  </button>
  <strong>Erro!</strong>
  <?php echo htmlspecialchars(isset($_GET['msg_erro']) ? $_GET['msg_erro'] : "", ENT_COMPAT,'ISO-8859-1', true); ?>
  <?php echo htmlspecialchars(isset($_SESSION['msg_erro']) ? $_SESSION['msg_erro'] : "", ENT_COMPAT,'ISO-8859-1', true); ?>
</div>
<?php 
	unset($_SESSION['msg_erro']);
	} 
?>