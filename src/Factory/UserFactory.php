<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class PostFactory
 * @package App\Factory
 */
class UserFactory
{
    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;

    /**
     * UserFactory constructor.
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    /**
     * @return User
     */
    public function create(): User
    {
        $user = new User();
        $user->setLanguage($this->parameterBag->get('locale'));

        return $user;
    }
}
