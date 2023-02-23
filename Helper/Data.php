<?php

namespace Streply\StreplyMagento\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\Context;
use Streply\Exceptions\StreplyException;
use Streply\Store\Providers\RequestProvider;

class Data extends AbstractHelper
{
    private const XML_PATH_ACTIVE = 'streply/general/active';
	private const XML_PATH_API_KEY = 'streply/general/dsnurl';

    /**
     * @var StoreManagerInterface
     */
    protected StoreManagerInterface $storeManager;

	/**
	 * @var \Magento\Framework\App\Config\ScopeConfigInterface
	 */
	protected $scopeConfig;

    /**
     * Data constructor.
     *
     * @param Context               $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $context->getScopeConfig();

        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->getConfigValue(self::XML_PATH_ACTIVE);
    }

    /**
     * @param      $field
     * @param null $storeId
     *
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null): mixed
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        try {
			$dsn = $this->getConfigValue(self::XML_PATH_API_KEY);

			if(null !== $dsn) {
				\Streply\Initialize(
					$dsn,
					[
						'storeProvider' => new RequestProvider()
					]
				);
			}
        } catch (StreplyException $e) {
            throw new \Exception($e);
        }
    }

	/**
	 * @param \Throwable $exception
	 * @return void
	 */
	public function exception(\Throwable $exception): void
	{
		try {
			\Streply\Exception($exception);
		} catch (\Throwable $exception) { }
	}
}
