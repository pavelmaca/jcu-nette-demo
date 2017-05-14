<?php
/**
 * Created by IntelliJ IDEA.
 * User: Pavel
 * Date: 14.5.2017
 * Time: 11:44
 */

namespace App\Model;


use Nette\Database\Context;

class ArticleModel
{

    /** @var  Context */
    protected $database;

    /**
     * ArticleModel constructor.
     * @param Context $database
     */
    public function __construct(Context $database)
    {
        $this->database = $database;
    }

    /**
     * Vyhledat všechny články
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getAllArticles(){
        return $this->database->table('article');
    }

    /**
     * Vyhledání člnáku podle ID
     * @param $id
     * @return \Nette\Database\Table\|false Vrátí false pokud není článek nalezen
     */
    public function getArticle($id)
    {
        return $this->getAllArticles()->get($id);
    }

    /**
     * Uloží komentář k článku
     *
     * @param $articleId
     * @param $nick
     * @par am $text
     * @return bool|int|\Nette\Database\Table\IRow
     */
    public function addComent($articleId, $nick, $text){
        return $this->database->table('comment')->insert([
            'article_id' => $articleId,
            'nick' => $nick,
            'text' => $text,
        ]);
    }

}