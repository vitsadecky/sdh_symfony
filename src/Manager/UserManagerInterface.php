<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\User;

/**
 * Interface UserManagerInterface
 * @package App\Manager
 */
interface UserManagerInterface extends ManagerInterface
{
    /**
     * @param User $user
     * @param bool $validation
     * @return UserManagerInterface
     */
    public function createUser(User $user, bool $validation = true): UserManagerInterface;

    /**
     * @param User $user
     * @param bool $validation
     * @return UserManagerInterface
     */
    public function editUser(User $user, bool $validation = true): UserManagerInterface;

    /**
     * @param User $user
     * @return UserManagerInterface
     */
    public function deleteUser(User $user): UserManagerInterface;

    /**
     * @return array
     */
    public function getAllUsers(): array;

    /**
     * @return array|User[]
     */
    public function getAllActiveUsers(): array;

    /**
     * @param User $user
     * @return UserManagerInterface
     */
    public function logOutUser(User $user): UserManagerInterface;
}