<?php

namespace App;

/**
 * Interface ApplicationInterface
 * @package App
 */
interface ApplicationInterface
{
    /**
     * @param \Throwable $throwable
     * @return Application
     */
    public function handleError(\Throwable $throwable): Application;
}
