<link rel="stylesheet" href="Public/fileinput.min.css">
<script src="Public/fileinput.min.js"></script>

<h1>Přidání nového článku</h1><hr>
<form role="form" action="<?php echo URL; ?>article/newArticle" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="text">Název článku:</label>
    <input type="text" class="form-control" required name="Header">
  </div>
  <div class="form-group">
    <label for="text">Obsah:</label>
    <textarea type="text" rows="15" class="form-control" required name="Text"></textarea>
  </div>

  <label class="control-label">PDF soubor:</label>
  <input id="input-23" name="File" type="file" class="file-loading" data-allowed-file-extensions='["pdf"]' required>
  <script>
    $(document).on('ready', function() {
      $("#input-23").fileinput({
        showUpload: false,
        layoutTemplates: {
          main1: "{preview}\n" +
          "<div class=\'input-group {class}\'>\n" +
          "   <div class=\'input-group-btn\'>\n" +
          "       {browse}\n" +
          "       {upload}\n" +
          "       {remove}\n" +
          "   </div>\n" +
          "   {caption}\n" +
          "</div>"
        }
      });
    });
  </script>

  <hr>
  <button type="submit" name="submit-article" class="btn btn-primary" style="float:right">Přidat článek</button>
</form>