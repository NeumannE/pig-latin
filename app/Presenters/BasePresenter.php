<?php

declare(strict_types=1);

namespace App\Presenters;

use Contributte\Translation\LocalesResolvers\Session;
use Nette;


class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var @persistant */
    public $locale = null;

    /** @var Nette\Localization\Translator @inject */
    public Nette\Localization\Translator $translator;

    /** @var Session @inject */
    public Session $translatorSessionResolver;

    /**
     * @return void
     */
    public function startup(): void
    {
        parent::startup();
        $this->startupLocale();
    }

    /**
     * @return void
     */
    public function startupLocale(): void
    {
        if($this->locale === null){
            $this->locale = $this->translator->getLocale();
        }

        $this->template->locale = $this->locale;
        $this->translatorSessionResolver->setLocale($this->locale);
    }

    /**
     * @param string $locale
     * @return void
     * @throws Nette\Application\AbortException
     */
    public function handleChangeLocale(string $locale): void
    {
        $this->translatorSessionResolver->setLocale($locale);
        $this->locale = $locale;
        $this->redirect('this');
    }

    /**
     * @return void
     */
    public function beforeRender(): void
    {
        parent::beforeRender();
        $this->redrawControl('title');
        $this->redrawControl('content');
    }

}
