<?php

class Model{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Nelze se připojit k databázi.');
        }
    }

    //----------------------------------------USER----------------------------------------------------------------------

    public function registerCheck($login, $email){
        $sql = "SELECT COUNT(id) AS same_user FROM users WHERE login = :login OR email = :email";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login, ':email' => $email);
        $query->execute($parameters);
        return $query->fetch()->same_user;
    }
    
    public function registerNewUser($login, $password, $email){
        $sql = "INSERT INTO users(login,password,email) VALUES (:login, :password, :email)";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login, ':password' => $password, ':email' => $email);
        
        $query->execute($parameters);
    }
    
    public function loginUser_sameRows($login, $password){
        $sql = "SELECT COUNT(id) AS user_count from users where login = :login AND password = :password";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login, ':password' => $password);
        $query->execute($parameters);
        return $query->fetch()->user_count;
    }
    
    public function loginUser($login, $password){
        $sql = "SELECT id from users where login = :login AND password = :password";
        $query = $this->db->prepare($sql);
        $parameters = array(':login' => $login, ':password' => $password);
        $query->execute($parameters);
        return $query->fetch(); 
    }

    public function getUserInfo($id){
        $sql = "SELECT login, email, rights from users where id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function getUserByLogin($login){
        $sql = "SELECT id FROM users WHERE login = :user_login";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_login' => $login);
        $query ->execute($parameters);
        return $query->fetch();
    }

    //----------------------------------------ARTICLE-------------------------------------------------------------------

    public function getAllApprovedArticles()
    {
        $sql = "SELECT * FROM article WHERE approved = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    
    public function getArticleDetail($article_id)
    {
        $sql = "SELECT article.*, users.login FROM article INNER JOIN users on article.article_author = users.id WHERE article_id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':article_id' => $article_id);
        $query->execute($parameters);
        return $query->fetch();    
    }

    public function getArticleRatings($article_id)
    {
        $sql = "SELECT rating.*, users.login FROM rating INNER JOIN users on rating.user_commenting = users.id WHERE comment_article_id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':article_id' => $article_id);
        $query->execute($parameters);
        return $query->fetchAll();    
    }
    
    public function getNumOfRatings($article_id)
    {
        $sql = "SELECT COUNT(rating_id) AS amount from rating where comment_article_id = :comment_article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':comment_article_id' => $article_id);
        $query->execute($parameters);
        return $query->fetch()->amount;
    }
    
    public function postNewArticle($author, $header, $text){
        $sql = "INSERT INTO article(date_posted, article_author, article_header, article_text) VALUES (NOW(), :author, :header, :text)";
        $query = $this->db->prepare($sql);
        $parameters = array(':author' => $author, ':header' => $header, ':text' => $text);
        $query->execute($parameters);
    }

    public function uploadFile($filePath, $id){
        $sql = "UPDATE article SET article_file = :filePath WHERE article_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':filePath' => $filePath, ':id' => $id);
        $query->execute($parameters);
    }
    
    public function getApprovedArticlesByAuthor($user_id){
        $sql = "SELECT article.*, users.login FROM article INNER JOIN users on article.article_author = users.id WHERE article_author = :user_id AND approved = 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);
        $query ->execute($parameters);
        return $query->fetchAll();
    }

    public function getNumOfApproved($user_id){
        $sql = "SELECT COUNT(article_id) as count_approved FROM article WHERE article_author = :user_id AND approved = 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);
        $query ->execute($parameters);
        return $query->fetch();
    }

    public function getNumOfDisapproved($user_id){
        $sql = "SELECT COUNT(article_id) as count_disapproved FROM article WHERE article_author = :user_id AND approved = 0";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);
        $query ->execute($parameters);
        return $query->fetch();
    }

    public function getDisapprovedArticlesByAuthor($user_id){
        $sql = "SELECT article.*, users.login FROM article INNER JOIN users on article.article_author = users.id WHERE article_author = :user_id AND approved = 0";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);
        $query ->execute($parameters);
        return $query->fetchAll();
    }

    public function getDisapprovedArticles(){
        $sql = "SELECT article.*, users.login FROM article INNER JOIN users on article.article_author = users.id WHERE approved = 0";
        $query = $this->db->prepare($sql);
        $query ->execute();
        return $query->fetchAll();
    }

    public function getAllArticleRatings(){
        $sql = "SELECT rating.*, users.login FROM rating INNER JOIN users on rating.user_commenting = users.id";
        $query = $this->db->prepare($sql);
        $query ->execute();
        return $query->fetchAll();
    }

    public function editArticleWithFile($id, $header, $text, $file){
        $sql = "UPDATE article SET article_header = :header, article_text = :text, article_file = :file WHERE article_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':header' => $header, ':text' => $text, ':file' => $file, ':id' => $id);
        $query ->execute($parameters);
    }

    public function editArticle($id, $header, $text){
        $sql = "UPDATE article SET article_header = :header, article_text = :text WHERE article_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':header' => $header, ':text' => $text, ':id' => $id);
        $query ->execute($parameters);
    }

    public function deleteArticle($id){
        $sql = "DELETE FROM article WHERE article_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query ->execute($parameters);
    }

    public function deleteArticleReviews($id){
        $sql = "DELETE FROM rating WHERE comment_article_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query ->execute($parameters);
    }

    public function getFilePath($id){
        $sql = "SELECT article_file FROM article WHERE article_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query ->execute($parameters);
    }

    //---------------------------------------REVIEW---------------------------------------------------------------------

    public function getReviewers(){
        $sql = "SELECT users.id, users.login FROM users WHERE rights = 'recenzent'";
        $query = $this->db->prepare($sql);
        $query ->execute();
        return $query->fetchAll();
    }

    public function addReviewer1($reviewer, $article){
        $sql = "UPDATE article SET reviewer1 = :reviewer WHERE article_id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':reviewer' => $reviewer, ':article_id' => $article);
        $query->execute($parameters);
    }

    //-----
        public function addReviewer2($reviewer, $article){
            $sql = "UPDATE article SET reviewer2 = :reviewer WHERE article_id = :article_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':reviewer' => $reviewer, ':article_id' => $article);
            $query->execute($parameters);
        }

        public function addReviewer3($reviewer, $article){
            $sql = "UPDATE article SET reviewer3 = :reviewer WHERE article_id = :article_id";
            $query = $this->db->prepare($sql);
            $parameters = array(':reviewer' => $reviewer, ':article_id' => $article);
            $query->execute($parameters);
        }
    //-----

    public function addReview($article, $reviewer){
        $sql = "INSERT INTO rating(user_commenting, comment_article_id, rate, comment) VALUES (:reviewer, :article, -1, NULL)";
        $query = $this->db->prepare($sql);
        $parameters = array(':reviewer' => $reviewer, ':article' => $article);
        $query->execute($parameters);
    }

    public function removeReview($article, $reviewer){
        $sql = "DELETE FROM rating WHERE comment_article_id = :article AND user_commenting = :reviewer";
        $query = $this->db->prepare($sql);
        $parameters = array(':reviewer' => $reviewer, ':article' => $article);
        $query->execute($parameters);
    }

    public function removeReviewer1($article){
        $sql = "UPDATE article SET reviewer1 = NULL WHERE article_id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':article_id' => $article);
        $query->execute($parameters);
    }

    public function removeReviewer2($article){
        $sql = "UPDATE article SET reviewer2 = NULL WHERE article_id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':article_id' => $article);
        $query->execute($parameters);
    }

    public function removeReviewer3($article){
        $sql = "UPDATE article SET reviewer3 = NULL WHERE article_id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':article_id' => $article);
        $query->execute($parameters);
    }

    public function approveArticle($id){
        $sql = "UPDATE article SET approved = 1 WHERE article_id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query ->execute($parameters);
    }

    //-------------------------------------REVEIWER---------------------------------------------------------------------

    public function getArticlesToReview($reviewer){
        $sql = "SELECT rating.*, article.article_header AS article FROM rating INNER JOIN article on article.article_id = rating.comment_article_id WHERE user_commenting = :reviewer AND rate = -1";
        $query = $this->db->prepare($sql);
        $parameters = array(':reviewer' => $reviewer);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getNumOfReviews($reviewer){
        $sql = "SELECT COUNT(rating_id) AS counter FROM rating WHERE user_commenting = :reviewer AND rate = -1";
        $query = $this->db->prepare($sql);
        $parameters = array(':reviewer' => $reviewer);
        $query->execute($parameters);
        return $query->fetch();
    }

    public function addNewReview($rate, $comment, $reviewer, $article){
        $sql = "UPDATE rating SET rate = :rate, comment = :comment WHERE user_commenting = :reviewer AND comment_article_id = :article";
        $query = $this->db->prepare($sql);
        $parameters = array(':rate' => $rate, ':comment' => $comment, ':reviewer' => $reviewer, ':article' => $article);
        $query->execute($parameters);

    }
}