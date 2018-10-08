<?php declare(strict_types=1);
/**
 * Article: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\Article;

/**
 * Interface ArticleManagerInterface
 * @package App\Manager
 */
interface ArticleManagerInterface extends ManagerInterface
{
    /**
     * @param Article $Article
     * @return ArticleManagerInterface
     */
    public function createArticle(Article $Article): ArticleManagerInterface;

    /**
     * @param Article $article
     * @return ArticleManagerInterface
     */
    public function editArticle(Article $article): ArticleManagerInterface;

    /**
     * @param Article $article
     * @return ArticleManagerInterface
     */
    public function deleteArticle(Article $article): ArticleManagerInterface;

    /**
     * @return Article[]
     */
    public function getAllArticles(): array;
}