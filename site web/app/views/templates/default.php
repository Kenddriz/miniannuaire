
<!Doctype html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="RANDRIAMANAJA Charlin, développeur des applications de gestion">
    <meta name="generator" content="rc v4.0.1">
    <title>Gestionnaire de catégories</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/bootstrap-treeview.css" rel="stylesheet">
    <link href="css/bootstrap-treeview.min.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="js/bootstrap-treeview.js"></script>
    <script src="js/bootstrap-treeview.min.js"></script>
 </heade>
<body>
  <div id="page-container">
    <div id="content-wrap">

      <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand">Human Cart'Office</a>
        <div class="form-inline" method="GET" action="index.php?page=categories.edit.php">
          <input class="form-control mr-sm-2" type="text" placeholder="ID catégorie" id="search" autocomplete="off">
            <a href="Javascrit::void(0);" class="btn btn-outline-success my-2 my-sm-0" id="link_search">Chercher</a>
        </div>
      </nav>

      <div>
        <?= $content ?>
      </div>

    </div>
    <footer id="footer" class="d-flex justify-content-around">
      <div class="bd-highlight">
        <h6 class="text-success">Gestion des catégories et des fiches</h6>
      </div>
      <div class="bd-highlight">
         <a href="index.php?page=plugs.index.php" class="text-decoration-none text-dark" data-toggle="tooltip" title="Liste des fiches">
          <img src="image/fiche.ico" width="15">
            <h6>Fiche</h6>
          </a>
      </div>
      <div class="bd-highlight">
         <a href="index.php" class="text-decoration-none text-dark" data-toggle="tooltip" title="Accueil">
            <img src="image/back.ico" width="15"><h6 class="text-success">Accueil</h6>
          </a>
      </div>
    </footer>
  </div>
</body>
<script>
  $('#search').keyup(function(e){

    var id = parseInt($(this).val());
    id = Number.isInteger(id) ? id : null;

    if(id != null) {
       $("#link_search").attr("href", "index.php?page=categories.edit.php&id=" + id);
       if(e.keyCode === 13)
        window.location.replace($("#link_search").attr("href"));//to execute search
      }
    else 
      $("#link_search").attr("href", "Javascrit::void(0);");

  });

   /**Plug operation */

   $("#addPlug").click(function(e){
    var label = $("#plug_lab").val().trim();
    switch(label) {
      case '': 
        $("#addPlug").attr('href', "javascript:void(0);");
        break;
      default: 
        var href = "index.php?page=plugs.";
        href += (e.currentTarget.innerText == "Ajouter") ? "addPlug.php&id=" + $("#ID").text() : "update.php&id=" + $("#ID").val();
        href += "&label=" + label + "&description=" + $("#description").val();

        $("#addPlug").attr('href', href);
      break;
    }
  });

</script>
</html>
