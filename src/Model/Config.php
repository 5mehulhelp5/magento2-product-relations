<?php

declare(strict_types=1);

namespace FrankBokdam\ProductRelations\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private const XML_PATH_EVENT_TTL_DAYS = 'product_relations/general/event_ttl_days';
    private const XML_PATH_ROLLUP_BATCH_SIZE = 'product_relations/general/rollup_batch_size';

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {
    }

    /**
     * Get the number of days raw session events are retained before purge.
     *
     * @return int
     */
    public function getEventTtlDays(): int
    {
        $value = $this->scopeConfig->getValue(self::XML_PATH_EVENT_TTL_DAYS);

        return is_numeric($value) ? (int) $value : 0;
    }

    /**
     * Get the maximum product pairs processed per cron run per relation type.
     *
     * @return int
     */
    public function getRollupBatchSize(): int
    {
        $value = $this->scopeConfig->getValue(self::XML_PATH_ROLLUP_BATCH_SIZE);

        return is_numeric($value) ? (int) $value : 0;
    }
}
