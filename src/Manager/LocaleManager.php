<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Manager;

use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class LocaleManager
 * @package App\Manager
 */
class LocaleManager
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * LocaleManager constructor.
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getLocales(): array
    {
        return [
            $this->translator->trans('Czech') => 'CS',
            $this->translator->trans('English') => 'EN'
        ];
    }
}
