<h1>Můj účet</h1>
  <hr> 
<div>
  <div class="row">
    <div class="col-sm-3">
      <img src="Public/img/icon-user-default.png" title="User" alt="user-img" class="img-responsive img-circle" height="200px" width="200px" style="margin:0 auto">
    </div>
    <div class="col-sm-5 device-text-align">
        <h1><?php echo $user->login ?></h1>
        <h3><?php echo "<span style='color: dimgrey'>E-mail: " . $user->email . "<br>" .$user->rights . "</span>" ?></h3>
    </div>
  </div>
</div>
<hr>
<?php if($user->rights == 'recenzent'){ ?>
<h1>Články k recenzi</h1>
    <hr>
    <?php if($reviewsNum->counter > 0){
        echo "<p class='info-message text-center'>Upozornění. Máš <span class='badge'>" . $reviewsNum->counter . "</span>";
        if($reviewsNum->counter == 1) echo " neohodnocený článek</p>";
        elseif($reviewsNum->counter > 1 && $reviewsNum->counter < 5) echo " neohodnocené články</p>";
        elseif($reviewsNum->counter > 4) echo " neohodnocených článků</p>";
        ?><a href="<?php echo URL; ?>review" class='btn btn-primary btn-block' role='button'>Přejít na recenze článků</a>
    <?php }
    else echo "<p class='info-message text-center'>Momentálně nemáš přiděleny žádné články k ohodnocení</p>"; ?>




<?php } elseif($user->rights == 'autor'){ ?>
    <h1>Moje články<span class="float-right"><a href="<?php echo URL; ?>article/add_new"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Nový článek</button></a></span></h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#schvalene">Schválené články<?php if($numApproved->count_approved > 0) echo " <span class='badge'>" . $numApproved->count_approved . "</span>";?></a></li>
        <li><a data-toggle="tab" href="#cekajici">Čekající na schválení<?php if($numDisapproved->count_disapproved > 0) echo " <span class='badge'>" . $numDisapproved->count_disapproved . "</span>";?></a></li>
    </ul>
    <div class="tab-content">
        <div id="schvalene" class="tab-pane fade in active">
            <?php
            if($numApproved->count_approved == 0) echo"<br><p class='info-message text-center'>Nemáš žádné schválené články</p>";
            else {
            foreach($approvedArticles as $approvedArticle){ ?>
                <hr>
                <div class="panel panel-default">
                   <a href="<?php echo URL; ?>article/article_detail/<?php echo $approvedArticle->article_id?>">
                       <div class="panel-heading"><?php if (isset($approvedArticle->article_header)) echo htmlspecialchars($approvedArticle->article_header, ENT_QUOTES, 'UTF-8'); ?></div>
                   </a>
              <div class="panel-body article-thumbnail" id=""><?php if (isset($approvedArticle->article_text)) echo nl2br($approvedArticle->article_text); ?></div>
               </div>
           <?php }
            } ?>
        </div>
        <div id="cekajici" class="tab-pane fade">
        <?php
        if($numDisapproved->count_disapproved == 0) echo"<br><p class='info-message text-center'>Nemáš žádné články čekající na schválení</p>";
        else {
        foreach($disapprovedArticles as $disapprovedArticle){ ?>
            <hr>
            <div class="panel panel-default">
                <a href="<?php echo URL; ?>article/article_detail/<?php echo $disapprovedArticle->article_id?>">
                    <div class="panel-heading"><?php if (isset($disapprovedArticle->article_header)) echo htmlspecialchars($disapprovedArticle->article_header, ENT_QUOTES, 'UTF-8'); ?></div>
                </a>
                <div class="panel-body article-thumbnail" id=""><?php if (isset($disapprovedArticle->article_text)) echo nl2br($disapprovedArticle->article_text); ?></div>
            </div>
        <?php }
        } ?>
        </div>
    </div>

<?php } elseif($user->rights == 'admin'){ ?>
    <a href="<?php echo URL; ?>admin" class="btn btn-primary btn-lg btn-block" role="button">Přejít do administrace článků</a>






<?php }