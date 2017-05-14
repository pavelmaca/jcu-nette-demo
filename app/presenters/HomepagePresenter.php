<?php

namespace App\Presenters;

use Nette;
use App\Model;


class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$this->template->welcome = 'Vítej Franto';

		/** @var Model\ArticleModel $articleModel */
		$articleModel = $this->context->getByType(Model\ArticleModel::class);
		$this->template->allArticles = $articleModel->getAllArticles();
	}

}
