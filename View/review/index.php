


<h1>Články k ohodnocení</h1><hr>
<?php if ($reviewsNum->counter == 0) echo "<p class='info-message text-center'>Momentálně nemáš přiděleny žádné články k ohodnocení</p>";
else {?>
<div class="panel-group" id="accordion">

<?php
foreach ($reviews as $review){ ?>
    <div class="well">
        <a href="<?php echo URL; ?>review/review_article/<?php echo $review->comment_article_id?>"><?php echo $review->article?></a>
        <span class="float-right"><a href="<?php echo URL; ?>review/review_article/<?php echo $review->comment_article_id?>" class="btn btn-primary btn-sm" style="vertical-align: middle">Přejít na hodnocení</a></span>
    </div>
<?php } ?>

</div>
<?php } ?>


