<h1>Články
<?php if($user->rights == 'autor') { ?>
    <span class="float-right" style="padding-left:8px"><a href="<?php echo URL; ?>article/add_new"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Nový článek</button></a></span>

<?php } echo "</h1><hr>";
foreach ($articles as $article){ ?>


    <div class="panel panel-default">
        <a href="<?php echo URL; ?>article/article_detail/<?php echo $article->article_id?>">
            <div class="panel-heading"><?php if (isset($article->article_header)) echo htmlspecialchars($article->article_header, ENT_QUOTES, 'UTF-8'); ?></div>
        </a>
  <div class="panel-body article-thumbnail text-justify" id=""><?php if (isset($article->article_text)) echo nl2br($article->article_text); ?></div>
</div>
<?php } ?>