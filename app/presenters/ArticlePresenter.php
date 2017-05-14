<?php
/**
 * Created by IntelliJ IDEA.
 * User: Pavel
 * Date: 14.5.2017
 * Time: 11:55
 */

namespace App\Presenters;


use App\Model\ArticleModel;
use Nette\Application\BadRequestException;
use Nette\Application\UI\Form;

class ArticlePresenter extends BasePresenter
{
    /** @var  ArticleModel */
    protected $articleModel;

    /**
     * ArticlePresenter constructor.
     * @param ArticleModel $articleModel
     */
    public function __construct(ArticleModel $articleModel)
    {
        parent::__construct();
        $this->articleModel = $articleModel;
    }


    public function renderShow($id)
    {

        //$id = $this->getParameter('id');
        $article = $this->articleModel->getArticle($id);
        if (!$article) {
            throw new BadRequestException('Článek neexistuje.');
        }
        $this->template->article = $article;
    }

    public function createComponentComentForm()
    {
        $form = new Form();

        $form->addText('nick', 'Přezdívka')
            ->setRequired(true);

        $form->addTextArea('text', 'Komentář')
            ->setRequired(true);

        $form->addSubmit('Odeslat');

        return $form;
    }
}