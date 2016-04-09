<?php
if($article->approved == 0){
    if($_SESSION["id"] != $article->article_author && $user->rights == 'autor') header('location: ' . URL . 'article'); else {?>
        <br><div class="alert alert-info">

            <strong>Tento článek čeká na schválení.</strong> Ostatní autoři tento článek neuvidí, dokud nebude schválen.
        </div>
<?php } }?>

<h1><?php echo $article->article_header;
    if($_SESSION["id"] == $article->article_author){
    ?>
    <span class="float-right">
        <a href="<?php echo URL; ?>article/edit_article/<?php echo $article->article_id ?>">
            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Editovat</button>
        </a>
        <a href="<?php echo URL; ?>article/delete_article/<?php echo $_SESSION["id"] . "/" . $article->article_id ?>">
            <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Smazat</button>
        </a>
    </span>
    <?php } ?>
</h1>
<br>
<?php 
    echo "<span class='article-author'>Autor: " . $article->login . "</span><span class='float-right article-date'> " . $article->date_posted . "</span>";
?>
<hr>
<p class="text-justify">
<?php echo nl2br($article->article_text); ?>
</p>
<hr>
<span class="glyphicon glyphicon-download"></span>
<?php echo "<a href='" . URL . "article/download_file/" . $article->article_id . "'>Stáhnout soubor PDF</a>";
$size = filesize($_SERVER['DOCUMENT_ROOT'] . $article->article_file);
echo ", Velikost: " . number_format($size / 1024, 2) . ' KB';?>
