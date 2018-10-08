<?php

namespace App;

use App\Manager\Exception\InvalidDataException;
use Doctrine\ORM\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Session\{Flash\FlashBagInterface, SessionInterface};
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * Class Application
 * @package App
 */
class Application implements ApplicationInterface
{
    /** @var SessionInterface $session */
    private $session;

    /** @var LoggerInterface */
    private $logger;

    /** @var TranslatorInterface */
    private $translator;

    /** @var string */
    private $flashName;


    /**
     * ExceptionHandler constructor.
     * @param SessionInterface $session
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     * @param FlashBagInterface $flashBag
     */
    public function __construct(SessionInterface $session,
                                LoggerInterface $logger,
                                TranslatorInterface $translator,
                                FlashBagInterface $flashBag)
    {
        $this->session = $session;
        $this->logger = $logger;
        $this->translator = $translator;

        $this->flashName = $flashBag->getName();
    }

    /**
     * @param \Throwable $throwable
     * @return Application
     */
    public function handleError(\Throwable $throwable): Application
    {
        switch (true) {
            case $throwable instanceof InvalidDataException:
                /** @var ConstraintViolation $constraint */
                foreach ($throwable->getViolationList() as $constraint) {
                    $this->addFlashMessage($constraint->getMessage(), 'info');
                }
                break;
            case $throwable instanceof ORMException:
                $this->translator->trans('A Database error has occurred, please try again later');
                $this->logger->error($throwable->getMessage());
                break;
            default:
                $this->logger->alert($throwable->getMessage(), ['cause' => 'unexpected']);
                $this->translator->trans('AN Unexpected error has occurred, please try again later');
        }

        return $this;
    }

    /**
     * @param string $type
     * @param string $message
     * @return Application
     */
    private function addFlashMessage(string $message, $type = 'warning'): Application
    {
        /** @var FlashBagInterface $flashBag */
        $flashBag = $this->session->getBag($this->flashName);
        $flashBag->add($type, $message);

        return $this;
    }
}
