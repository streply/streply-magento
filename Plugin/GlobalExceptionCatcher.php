<?php

namespace Streply\StreplyMagento\Plugin;

use Magento\Framework\AppInterface;

class GlobalExceptionCatcher extends AbstractExceptionCatcher
{
    /**
     * @param AppInterface $subject
     * @param callable $proceed
     * @return mixed
     * @throws \Throwable
     */
    public function aroundLaunch(AppInterface $subject, callable $proceed): mixed
    {
        if (
			$this->getStreplyClient()->isModuleOutputEnabled() === false &&
			$this->getStreplyClient()->isActive() === false
		) {
            return $proceed();
        }

        $this->getStreplyClient()->initialize();

        try {
            return $proceed();
        } catch (\Throwable $exception) {
            $this->getStreplyClient()->exception($exception);

            throw $exception;
        }
    }
}
