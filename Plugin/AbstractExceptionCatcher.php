<?php

namespace Streply\StreplyMagento\Plugin;

use Streply\StreplyMagento\Helper\Data as StreplyHelper;

class AbstractExceptionCatcher
{
    /**
     * @var StreplyHelper;
     */
    protected StreplyHelper $streply;

    /**
     * @param StreplyHelper $streply
     */
    public function __construct(StreplyHelper $streply)
    {
        $this->streply = $streply;
    }

	/**
	 * @return StreplyHelper
	 */
	public function getStreplyClient(): StreplyHelper
	{
		return $this->streply;
	}
}
