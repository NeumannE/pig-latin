<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use stdClass;

final class HomepagePresenter extends BasePresenter
{
    /**
     * @return Form
     */
    protected function createComponentPigLatinForm(): Form
    {
        $form = new Form();

        $form->setHtmlAttribute('class', 'ajax');

        $form->addTextArea('text', 'Add text')
            ->setHtmlAttribute('placeholder', 'Add text');

        $form->addSubmit('submit', 'Translate');

        $form->onSuccess[] = [$this, 'pigLatinFormSucceeded'];

        return $form;
    }

    /**
     * @param Form $form
     * @param stdClass $values
     * @return void
     */
    public function pigLatinFormSucceeded(Form $form, stdClass $values): void
    {
        $consonant = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z');
        $vowels = array('a', 'e', 'i', 'o', 'u', 'y');
        $special = array('?', '.', '!', ',');

        $words = explode(' ', trim(strtolower($values->text)));

        $result = array();

        foreach ($words as $word)
        {
            $position = 0;
            $consonantCluster = '';
            $specialCharacters = '';

            for ($i = strlen($word) - 1; $i >= 0; $i--){
                if (in_array($word[$i], $special)){
                    $specialCharacters .= $word[$i];
                    $word = substr_replace($word, '', $i, 1);
                }else break;
            }

            if (preg_match('/[a-zA-Z]/u', $word)) {
                if (!in_array($word[0], $vowels)){
                    foreach (str_split($word) as $char){
                        if (in_array($char, $consonant) && !in_array($char, $special)){
                            $consonantCluster .= $char;
                            $position ++;
                        } else break;
                    }
                }

                $substr = substr($word, $position);
                if ($substr) $result[] =  $substr . '-' . $consonantCluster . 'ay' . $specialCharacters;
                else $result[] = $consonantCluster . '-ay' . $specialCharacters;

            } else {
                $result[] = $word;
            }
        }

        $this->template->result = ucfirst(implode(' ', $result));
        $this->redrawControl();
    }
}
