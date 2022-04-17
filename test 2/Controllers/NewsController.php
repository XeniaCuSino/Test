<?php
include('..\models\News.php');
namespace Controllers;

class News extends \App\Controller
{
    public function index()
    {
        return $this->render('NewNews');
    }
    public function create()
    {
        $new = new myNews($_POST['title'],$_POST['anons'],$_POST['text'],$_POST['tags']);
        $new -> createNews($cnct);
        return $this->render('NewsTemplate', ['news' => $new]);
    }
    public function delete($id)
    {
        $new = new myNews();
        $new -> deleteNews($cnct, $id);
        return $this->render('NewNews');
    }
    public function news($prm)
    {
        $new = new myNews();
        if($new -> selectNewsById($cnct, $prm)){
        return $this->render('NewsTemplate', ['news' => $new]);
        }
        elseif($new -> selectNewsByTitle($cnct, $prm)){
            return $this->render('NewsTemplate', ['news' => $new]);
        }
        else{
            return $this->render('ERROR');
        }
    }

}