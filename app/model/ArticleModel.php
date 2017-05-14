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

}