<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Comment;
use App\Entity\User;

/**
 * Class CommentFactory
 * @package App\Factory
 */
class CommentFactory
{
    /**
     * @param User $user
     * @return Comment
     */
    public function create(User $user): Comment
    {
        $comment = new Comment($user);
        $comment->setCommentedAt(new \DateTime());

        return $comment;
    }
}
