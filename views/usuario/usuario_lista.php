<?php 
#--------------------------------------------------------------------------
# usuario_lista.php
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
<div class="panel panel-default">
  <div class="panel-heading">Usuário</div>
  <div class="panel-body">
   <div class="panel panel-default">
    
    <div class="panel-body">
      <a href="usuario_form.php?action=new">
          <button type="button" class="btn btn-success btn-xs">
            <span class="glyphicon glyphicon-plus"></span> Novo
          </button>
      </a>
    </div>
    </div>
    <table class="table"  cellSpacing=1 cellPadding=4 width="100%" border=0>
      <thead>
      <tr> 
        <th>Cód.</th>
        <th>Login</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php
      	foreach (Usuario::find('all', array('order' => 'login asc')) as $usuario) { ?>
      <tr>
        <td><?php echo $usuario->id ?></td>
        <td><?php echo $usuario->login ?></td>
        <td>
          <a href="usuario_form.php?action=update&id=<?php echo $usuario->id ?>">
          <button type="button" class="btn btn-default btn-xs">
            <span class="glyphicon glyphicon-pencil"></span> Editar
          </button>
          </a>
          <a href="../../controllers/usuariocontroller.php?action=delete&id=<?php echo $usuario->id ?>"
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