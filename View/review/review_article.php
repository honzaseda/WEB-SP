<style>
    .rating-stars,
    .rating-stars label::before
    {
        font-family: "Glyphicons Halflings";
        display: inline-block;
    }

    .rating-stars label:hover,
    .rating-stars label:hover ~ label
    {
        color: dimgrey;
    }

    .rating-stars *
    {
        margin: 0;
        padding: 0;
    }

    .rating-stars input
    {
        display: none;
    }

    .rating-stars
    {
        unicode-bidi: bidi-override;
        direction: rtl;
    }

    .rating-stars label
    {
        color: darkgrey;
    }

    .rating-stars label::before
    {
        content: "\e006";
        width: 20px;
        line-height: 20px;
        text-align: center;
        font-size: 20px;
        cursor: pointer;
    }

    .rating-stars input:checked ~ label
    {
        color: #f5b301;
    }
</style>

<h1>Recenze článku</h1>
<div>
<form action="<?php echo URL; ?>review/addReview" method="POST">
    <label for="rating-stars">Hodnocení:</label><br>
    <div class="rating-stars">

        <input type="radio" name="Rating" id="group-1-0" value="5" required/><label for="group-1-0"></label>
        <input type="radio" name="Rating" id="group-1-1" value="4" /><label for="group-1-1"></label>
        <input type="radio" name="Rating" id="group-1-2" value="3" /><label for="group-1-2"></label>
        <input type="radio" name="Rating" id="group-1-3" value="2" /><label for="group-1-3"></label>
        <input type="radio" name="Rating" id="group-1-4"  value="1" /><label for="group-1-4"></label>
    </div>
    <hr>
    <div class="form-group">
        <label for="text">Komentář:</label>
        <textarea type="text" rows="4" class="form-control" required name="Comment"></textarea>
    </div>
    <input type="hidden" name="article" value="<?php echo $article->article_id; ?>">
    <input type="hidden" name="reviewer" value="<?php echo $_SESSION["id"]; ?>">
    <button type="submit" name="submit-review" class="btn btn-primary" style="float:right">Přidat ohodnocení</button>
</form>
    <br>
</div>
<hr>
<h1>
    <?php echo $article->article_header; ?>
</h1>
<br>
<?php
echo "<span class='article-author'>Autor: " . $article->login . "</span><span class='float-right article-date'> " . $article->date_posted . "</span>";
?>
<hr>
<?php echo nl2br($article->article_text); ?>
<hr>
<span class="glyphicon glyphicon-download"></span>
<?php echo "<a href='" . URL . "article/donwload_file/" . $article->article_id . "' target='_blank'>Stáhnout soubor PDF</a>";
$size = filesize($_SERVER['DOCUMENT_ROOT'] . $article->article_file);
echo ", Velikost: " . number_format($size / 1024, 2) . ' KB';?>


