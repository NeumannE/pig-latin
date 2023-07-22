<?php declare(strict_types = 1);

namespace App\Model;

use Nette;

class Translator
{

    /** @var Nette\Localization\ITranslator */
    private $translator;


    public function __construct(Nette\Localization\ITranslator $translator)
    {
        $this->translator = $translator;
    }

}