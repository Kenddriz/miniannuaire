
<?php
  const STYLE = ["badge-success", "badge-info", "badge-primary", "badge-secondary", "badge-danger", "badge-warning"];
?>

<div class="d-flex justify-content-around">

  <div class="card p-2 bd-highlight" style="width: 18rem;">
    <div class="card-header">
      <h5 class="card-title">Opérations</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <td>ID :</td>
              <td id="ID"><?=$categories[0][0]; ?></td>
            </tr>
            <tr>
              <td>Libellé</td>
              <td>
               <input type="text" class="form-control form-control-sm" id="label" value="<?=$categories[0][1]; ?>">
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                    <button type="button" class="btn btn-secondary update_action">sauvegarder</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm">supprimer</button>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>     
    </div>
  </div>

  <div class="card p-2 bd-highlight" style="width: 18rem;">
    <div class="card-header">
      <h5 class="card-title">Catégories enfants</h5>
    </div>
    <div class="card-body">
      <?php foreach($categories[1] as $key => $val) : ?>
        <span class="badge <?php echo STYLE[rand(0, 5)];?>"><?=$key; ?></span>
        <a href="index.php?page=categories.edit.php&id=<?php echo $key; ?>" class="text-decoration-none text-dark"><?=$val; ?></a><br>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="card p-2 bd-highlight" style="width: 18rem;">
    <div class="card-header">
      <h5 class="card-title">Liste des fiches
        <a href="Javascrit::void(0);" class="badge badge-primary" data-toggle="modal" data-target="#plug">+fiche</a>
      </h5>
    </div>
    <div class="card-body">
      <?php foreach($categories[2] as $val) : ?>
        <span class="badge  badge-pill <?php echo STYLE[rand(0, 5)];?>"><?=$val["idPlug"]; ?></span>
        <a href="index.php?page=plugs.index.php&id=<?php echo $val["idPlug"]; ?>" class="text-decoration-none text-dark"><?=$val["label"] ?></a><br>
      <?php endforeach; ?>   
    </div>
  </div>

</div>
<hr>

<!-- The Modal confirmation-->
<div class="modal" tabindex="-1" id="confirm">
  <div class="modal-dialog modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-cnter">Confirmation de suppression</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h5 class="text-center">Etes-vous sûr de vouloir supprimer ?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger update_action">confirmer</button>
      </div>
    </div>
  </div>
</div>

<!-- The Modal for adding new plug-->
<div class="modal" tabindex="-1" id="plug">
  <div class="modal-dialog modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-cnter">Ajout d'une fiche</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td rowspan="2">
              <textarea class="form-control" id="description" placeholder="Décrire le nouveau fiche" rows="4"></textarea>
            </td>
            <td><input type="text" class="form-control form-control-sm" id="plug_lab" placeholder="...libelé...."></td>
          </tr>
          <tr>
            <td><a class="btn btn-outline-primary form-control form-control-sm"id="addPlug" href="javascript:void(0);">Ajouter</a></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  //Reaquest

  $(".update_action").click(function(e){
    switch(e.currentTarget.innerText) {
      case "sauvegarder":
        window.location.replace("index.php?page=categories.update.php&id=" + $("#ID").text() + "&label=" + $("#label").val());
        break;
      case "confirmer":
        window.location.replace("index.php?page=categories.delete.php&id=" + $("#ID").text() + "&label=" + $("#label").val());
        break;
      default: break;
    }
  });
 
</script>