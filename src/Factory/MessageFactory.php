<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;


namespace App\Factory;

/**
 * Class MessageFactory
 * @package App\Factory
 */
class MessageFactory
{
    /**
     * @param null|string $subject
     * @param null|string $body
     * @param null|string $contentType
     * @param null|string $charset
     * @return \Swift_Message
     */
    public function create(
        ?string $subject = null, ?string $body = null, ?string $contentType = null, ?string $charset = null): \Swift_Message
    {
        return new \Swift_Message($subject, $body, $contentType, $charset);
    }
}
