<?php
/**
 * Created by PhpStorm.
 * User: Drml
 * Date: 13.5.2017
 * Time: 19:53
 */

namespace App\Model;


use Nette\Database\Context;

class ArticleModel
{

    /**
     * @var Context
     */
    protected $db;

    /**
     * ArticleModel constructor.
     *
     * @param Context $connecion
     */
    public function __construct(Context $connecion)
    {
        $this->db = $connecion;
    }


    /**
     * Vyhleda vsechny clanky. Je mozne dale filtrovat.
     *
     * @return \Nette\Database\Table\Selection
     */
    public function getAllArticles() {
        return $this->db->table('article');
    }

    /**
     * Vyhleda clanek podle jeho primarniho klice.
     *
     * @param $id
     * @return \Nette\Database\Table\IRow
     */
    public function getArticle($id){

        return $this->db->table('article')->get($id);

    }

    /**
     * @param $articleId
     * @param $data
     * @return bool|int|\Nette\Database\Table\IRow
     */
    public function addComment($articleId, $data){

        $data['article_id'] = $articleId;


        return $this->db->table('comment')->insert($data);
    }



}