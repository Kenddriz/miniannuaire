
<div class="row row-cols-2" style="margin-left: 1em;">
  <table class="table table-bordered table-hover col-sm-4 col-md-7" id="plug_list">
    <thead class="thead-light">
      <tr><td colspan="3"><h3 class="text-center text-primary">LISTE DES FICHES</h3></td></tr>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">LABEL</th>
        <th scope="col">CATEGORIE</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($lists as $fiche): ?>
        <tr class="select">
          <td><?=$fiche->idPlug; ?></td>
          <td><?=$fiche->label; ?></td>
          <td><?=$fiche->catLab; ?></td>
        </tr>
        <?php $DESC[$fiche->idPlug] = utf8_encode($fiche->description); ?>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class=" col-6 col-md-4 ">
      <br><h4 class="text-secondary text-center text-monospace"><b><u>MISE A JOUR:</u></b></h4><br>
      <table class="table">
          <tr>
            <td rowspan="2">
              <textarea class="form-control" id="description" placeholder="Décrire le nouveau fiche" rows="5"></textarea>
            </td>
            <td><input type="text" class="form-control form-control-sm" id="plug_lab" placeholder="...libelé...."></td>
          </tr>
          <tr>
            <td><a class="btn btn-outline-primary form-control form-control-sm"id="addPlug" href="javascript:void(0);">sauvegarder</a></td>
          </tr>
      </table><br><hr>
      <a class="btn btn-outline-warning form-control form-control-sm" data-toggle="modal" data-target="#confirm" href="javascript:void(0);">sauvegarder</a>
      <br><br>
      <h5 class="text-info text-center text-monospace">Cliquer sur le tableau pour pouvoir mettre à jour une fiche</h5>
      <input type="hidden" id="ID"/><br>
      <div id="des_actuel"></div>
  </div>
</div>
<!---confimation -->
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

<script>

$('#plug_list').on('click', '.select', function(event) {
  if($(this).hasClass('bg-info'))
    $(this).removeClass('bg-info'); 
  else 
    $(this).addClass('bg-info').siblings().removeClass('bg-info');

    var description = <?php echo json_encode($DESC); ?>;

    $("#description").val(description[$(this).find('td').eq(0).text()]);
    $("#plug_lab").val($(this).find('td').eq(1).text());
    $("#des_actuel").html(description[$(this).find('td').eq(0).text()]);
    $("#ID").val($(this).find('td').eq(0).text());
});

$(".update_action").click(function(){
  window.location.replace("index.php?page=plugs.delete.php&id=" + $("#ID").val());
})
</script>