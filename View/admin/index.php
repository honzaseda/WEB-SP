<h1>Administrace článků</h1>
<hr>
<table class="table table-hover">
    <thead>
    <tr>
        <th style="text-align:center">Článek</th>
        <th style="text-align:center" class="table-separator">Autor</th>
        <th style="text-align:center">Recenzent</th>
        <th style="text-align:center">Hodnocení</th>
        <th style="text-align:center" class="table-separator">Odebrat</th>
        <th style="text-align:center">Rozhodnutí</th>
    </tr>
    </thead>
    <tbody style="text-align:center; border-bottom: 1px solid #ddd;">
        <?php foreach ($disapprovedArticles as $disapprovedArticle){ ?>
        <tr style="border-top: 3px solid #ddd">
            <td rowspan="3" style="vertical-align: middle">
                <a href="<?php echo URL; ?>article/article_detail/<?php echo $disapprovedArticle->article_id; ?>"><?php echo $disapprovedArticle->article_header; ?></a>
            <td rowspan="3" style="vertical-align: middle" class="table-separator"><?php echo $disapprovedArticle->login; ?>
            <td><?php
                if ($disapprovedArticle->reviewer1 == NULL) { ?>
                <form action="<?php echo URL; ?>admin/add_reviewer" method="POST" role="form" style="margin-bottom: 0">
                    <select class="form-control input-sm" name="selRev">
                        <?php foreach ($reviewers as $reviewer) {
                            echo "<option>" . $reviewer->login . "</option >";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="article" value="<?php echo $disapprovedArticle->article_id; ?>">
                    <input type="hidden" name="reviewer" value="reviewer1">
                    <td style="text-align:center" colspan="2" class="table-separator">
                    <button type="submit" class="btn btn-link">Přidělit k recenzi</button>
                </form>
                <?php }
                else{
                    foreach ($ratings as $rating) {
                        if ($rating->user_commenting == $disapprovedArticle->reviewer1 && $rating->comment_article_id == $disapprovedArticle->article_id) {
                        echo $rating->login;
                        echo "<td>";

                        if ($rating->rate == -1) {
                            echo "Čeká na ohodnocení";
                        }
                        else {
                            for ($i = 0; $i < $rating->rate; $i++) {
                                echo "<span class='glyphicon glyphicon-star'></span>";
                            }
                        } ?>
                        <td class="table-separator">
                            <a href="<?php echo URL . 'admin/remove_reviewer/' . $disapprovedArticle->article_id . '/' . $rating->user_commenting . '/1'; ?>">
                                <span class="glyphicon glyphicon-remove" style="color:red"></span>
                            </a>
                    <?php
                        }
                    }
                }
            ?>
        <td rowspan="3" style="vertical-align: middle">
            <a href="<?php echo URL . 'admin/approve_article/' . $disapprovedArticle->article_id; ?>">
                <span class="label label-success">Přijmout</span>
            </a>
        <tr>
            <td><?php
                if ($disapprovedArticle->reviewer2 == NULL) { ?>
                    <form action="<?php echo URL; ?>admin/add_reviewer" method="POST" role="form" style="margin-bottom: 0">
                        <select class="form-control input-sm" name="selRev">
                            <?php foreach ($reviewers as $reviewer) {
                            echo "<option>" . $reviewer->login . "</option >";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="article" value="<?php echo $disapprovedArticle->article_id; ?>">
                        <input type="hidden" name="reviewer" value="reviewer2">
                        <td style="text-align:center" colspan="2">
                        <button type="submit" class="btn btn-link">Přidělit k recenzi</button>
                    </form>
                <?php }
                else{
                    foreach ($ratings as $rating) {
                        if ($rating->user_commenting == $disapprovedArticle->reviewer2 && $rating->comment_article_id == $disapprovedArticle->article_id) {
                            echo $rating->login;
                            echo "<td>";

                            if ($rating->rate == -1) {
                                echo "Čeká na ohodnocení";
                            }
                            else {
                                for ($i = 0; $i < $rating->rate; $i++) {
                                    echo "<span class='glyphicon glyphicon-star'></span>";
                                }
                            } ?>
                            <td class="table-separator">
                                <a href="<?php echo URL . 'admin/remove_reviewer/' . $disapprovedArticle->article_id . '/' . $rating->user_commenting . '/2'; ?>">
                                    <span class="glyphicon glyphicon-remove" style="color:red"></span>
                                </a>
                        <?php }
                    }
                } ?>
    <tr>
        <td><?php
            if ($disapprovedArticle->reviewer3 == NULL) { ?>
            <form action="<?php echo URL; ?>admin/add_reviewer" method="POST" role="form" style="margin-bottom: 0">
                <select class="form-control input-sm" name="selRev">
                    <?php foreach ($reviewers as $reviewer) {
                        echo "<option>" . $reviewer->login . "</option >";
                    }
                    ?>
                </select>
                <input type="hidden" name="article" value="<?php echo $disapprovedArticle->article_id; //<?php echo $disapprovedArticle->article_id .'/' . $_POST["selRev2"] . '/reviewer2';?>">
                <input type="hidden" name="reviewer" value="reviewer3">
                <td style="text-align:center" colspan="2">
                <button type="submit" class="btn btn-link">Přidělit k recenzi</button>
            </form>
            <?php }
            else{
                foreach ($ratings as $rating) {
                    if ($rating->user_commenting == $disapprovedArticle->reviewer3 && $rating->comment_article_id == $disapprovedArticle->article_id) {
                        echo $rating->login;
                        echo "<td>";

                        if ($rating->rate == -1) {
                            echo "Čeká na ohodnocení";
                        }
                        else {
                            for ($i = 0; $i < $rating->rate; $i++) {
                                echo "<span class='glyphicon glyphicon-star'></span>";
                            }
                        } ?>
                        <td class="table-separator">
                            <a href="<?php echo URL . 'admin/remove_reviewer/' . $disapprovedArticle->article_id . '/' . $rating->user_commenting . '/3'; ?>">
                                <span class="glyphicon glyphicon-remove" style="color:red"></span>
                            </a>
                    <?php }
                }
            } ?>
        <?php } ?>
    </tbody>
</table>