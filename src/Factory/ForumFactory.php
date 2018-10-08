<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Forum;

/**
 * Class ForumFactory
 * @package App\Factory
 */
class ForumFactory
{
    /**
     * @return Forum
     */
    public function create(): Forum
    {
        $forum = new Forum();
        $forum->setCreatedAt(new \DateTime());

        return $forum;
    }
}
