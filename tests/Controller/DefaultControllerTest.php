<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 29. 9. 2018
 * Time: 18:28
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PostControllerTest
 * @package App\Tests\Controller
 */
class DefaultControllerTest extends WebTestCase
{
    public function testShowPost(): void
    {
        $client = static::createClient();

        $client->request('GET', '/post/hello-world');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}