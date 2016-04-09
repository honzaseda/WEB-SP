<link rel="stylesheet" href="Public/fileinput.min.css">
<script src="Public/fileinput.min.js"></script>

<h1>Editace článku</h1><hr>
<form role="form" action="<?php echo URL; ?>article/updateArticle" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="text">Název článku:</label>
        <input type="text" class="form-control" required name="Header" value="<?php echo htmlspecialchars($article->article_header, ENT_QUOTES, 'UTF-8'); ?>">
    </div>
    <div class="form-group">
        <label for="text">Obsah:</label>
        <textarea type="text" rows="15" class="form-control" required name="Text"><?php echo htmlspecialchars($article->article_text, ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>
    <label class="control-label">PDF soubor:</label>
    <input id="input-23" name="newFile" type="file" class="file-loading" data-allowed-file-extensions='["pdf"]'>
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
    <input type="hidden" name="article_id" value="<?php echo $article->article_id ?>">
    <input type="hidden" name="article_author" value="<?php echo $article->article_author ?>">
    <hr>
    <button type="submit" name="submit-article" class="btn btn-primary" style="float:right"><span class="glyphicon glyphicon-edit"></span> Editovat článek</button>
</form>