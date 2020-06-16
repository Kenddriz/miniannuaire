
<div class="row">
<hr>
  <div class="col-sm-4">
    <h2>Champs de recherche</h2>
    <!-- <form> -->
      <div class="form-group">
        <label for="input-search" class="sr-only">Champs de recherche</label>
        <input type="input" class="form-control" autocomplete="off" id="input-search" placeholder="taper..." value="">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" class="checkbox" id="chk-ignore-case" value="false">
          Ignorer la casse
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" class="checkbox" id="chk-exact-match" value="false">
          exactement
        </label>
      </div>
      <button type="button" class="btn btn-success" id="btn-search">chercher</button>
    <!-- </form> -->
      <hr>
      <a href="javascript:void(0);" id="selected_id" data-toggle="tooltip" title="Edition de la catégorie....">
            <img src="image/editing.jpg"  class="rounded img-fluid img-thumbnail bg-primary" alt="Modification" width="50%">
      </a>
  </div>
  <div class="col-sm-4">
    <h2 class="text-center">Arborescence</h2>
    <div class="input-group input-group-sm mb-3">
      <input type="text" class="form-control" autocomplete="off" placeholder="Entrer le nom de la catégorie" id="add_label" aria-label="Small">
      <div class="input-group-append">
        <span class="input-group-text" id="cat_parent">parente : aucun</span>
        <a href="javascript:void(0);" class="btn btn-outline-secondary btn-sm" id="add_link" type="button">ajouter</a>
      </div>
    </div>
    <div id="tree" class="treeview"></div>
  </div>
  <div class="col-sm-3">
    <h2  class="text-center">Résultats</h2>
    <div id="search-output">
    </div>
  </div>
</div>
<br><hr>
<!--notification--->
<div id="notification"></div>

<script>
  
  $("img").hide();
  var selected_item = 0;/**Global variable, for item wich doesn't have item*/

  $(document).ready(function() {
   
      $.ajax({
          url: "others/tree.php",
          method:"POST",
          dataType: "json",       
          success: function(data)
              {

              $('#tree').treeview({
                  showTags: true,
                  highlightSelected: true,
                  multiSelect:false,
                  data: data,
                  onNodeSelected: function(event, data) {
                      $("#selected_id").attr("href", "index.php?page=categories.edit.php&id=" + data.id);
                      $("#cat_parent").html("parente : " + (data.text.length > 10 ? data.text.substr(0, 10):  data.text));
                      selected_item = data.id;
                      changeAddUrl(selected_item, $("#add_label").val());
                      $("img").show();
                  },
                  onNodeUnselected: function(event, data) {
                      $("img").hide();
                      $("#cat_parent").html("parente : aucun");
                      selected_item = 0;
                      changeAddUrl(selected_item, $("#add_label").val());
                  }

               });
          }
      });
 
      //Deleting result
      var path = new RegExp('[\?&]' + "label" + '=([^&#]*)').exec(window.location.href);
      path = path[1]||null;
      path = path.replace(/%20/g, ' ');
      
      if(path != null) {
        $("#notification").html("<p class='text-center text-primary'>La catégorie <b>" + path + "</b> a été supprimée.</p>");
        window.history.pushState({}, null, 'index.php');
      }
  });
 
  $("#tree").treeview({
      onNodeSelected: function(event, data) {alert('ok'); }
  });
  //search an element
  var search = function(e) {
      var pattern = $("#input-search").val();
      var options = {
          ignoreCase: $('#chk-ignore-case').is(':checked'),
          exactMatch: $('#chk-exact-match').is(':checked'),
          revealresults: true
      };
      var results = $("#tree").treeview('search', [pattern, options]);
      var output = '<p>'+results.length+' correspondants trouvés</p>';
      $.each(results, function(index, result){
          output += '<a href=' + "index.php?page=categories.edit.php&id=" + result.id;
          output += ' class="text-decoration-none text-dark">' + result.text + ' (' + result.id + ')' + '</a><br>';
      });

      $("#search-output").html(output);
  }
  $("#btn-search").on('click', search);
  $("#input-search").on('keyup', search);

  //Add category
  $("#add_label").keyup(function(e){
    label = $(this).val();
    changeAddUrl(selected_item, label);
  });
//Change link href for add
  function changeAddUrl(id, label) {
    label = label.trim();
    if(label != "")
      $("#add_link").attr("href", "index.php?page=categories.add.php&parent_id=" + id+ "&newcat=" + label);
    else 
      $("#add_link").attr("href", "javascript:void(0);");
      
  }

</script>