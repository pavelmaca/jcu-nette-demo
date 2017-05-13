<?php
/**
 * Created by PhpStorm.
 * User: Drml
 * Date: 13.5.2017
 * Time: 19:51
 */

namespace App\Presenters;


use App\Model\ArticleModel;
use Nette\Application\BadRequestException;
use Nette\Application\UI\Form;
use Nette\Utils\Paginator;

class ArticlePresenter extends BasePresenter
{

    /** @var  ArticleModel */
    protected $articleModel;

    protected $id;

    /**
     * ArticlePresenter constructor.
     *
     * @param ArticleModel $articleModel
     */
    public function __construct(ArticleModel $articleModel)
    {
        parent::__construct();
        $this->articleModel = $articleModel;
    }


    public function renderDefault($page = null){

        $articles = $this->articleModel->getAllArticles();

        $paginator = new Paginator();
        $paginator->itemCount = $articles->count();
        $paginator->itemsPerPage = 2;
        $paginator->page = $page;

        $this->template->allArticles = $articles->limit($paginator->getLength(), $paginator->getOffset());
        $this->template->paginator = $paginator;

    }

    public function actionShow($id){
        $this->id = $id;
    }

    public function renderShow($id){

        $article = $this->articleModel->getArticle($id);
        if (!$article) {
            throw new BadRequestException();
        }

        $this->template->article = $article;
    }

    public function createComponentCommentForm(){
        $form = new Form;

        $form->addText('nick', 'Prezdivka: ')
            ->setRequired(true);

        $form->addTextArea('text','Komentar: ')
            ->setRequired(true);

        $form->addSubmit('Odeslat');

        $form->onSuccess[] = function (Form $form){
            $vals = $form->getValues();

            $success = $this->articleModel->addComment($this->id, $vals);

            if ($success){
                $this->flashMessage("Vas komentar byl ulozen.");
            } else {
                $this->flashMessage("Vas komentar nebyl ulozen, smula.");
            }

            $this->redirect('show', $this->id);

        };

        return $form;

    }

}