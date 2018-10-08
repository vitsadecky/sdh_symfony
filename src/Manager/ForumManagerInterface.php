<?php declare(strict_types=1);
/**
 * Forum: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\Forum;

/**
 * Interface ForumManagerInterface
 * @package App\Manager
 */
interface ForumManagerInterface extends ManagerInterface
{
    /**
     * @param Forum $Forum
     * @return ForumManagerInterface
     */
    public function createForum(Forum $Forum): ForumManagerInterface;

    /**
     * @param Forum $forum
     * @return ForumManagerInterface
     */
    public function editForum(Forum $forum): ForumManagerInterface;

    /**
     * @param Forum $forum
     * @return ForumManagerInterface
     */
    public function deleteForum(Forum $forum): ForumManagerInterface;

    /**
     * @return Forum[]
     */
    public function getAllForums(): array;
}