<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Post;
use App\Entity\User;

/**
 * Class PostFactory
 * @package App\Factory
 */
class PostFactory
{
    /**
     * @param User $user
     * @return Post
     */
    public function create(User $user): Post
    {
        $post = new Post($user);
        $post
            ->setPostedAt(new \DateTime())
            ->setAttendance(0);

        return $post;
    }
}
