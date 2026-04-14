<?php

declare(strict_types=1);

namespace FrankBokdam\ProductRelations\Test\Unit\Model;

use FrankBokdam\ProductRelations\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * Test that getEventTtlDays returns an integer value.
     *
     * @return void
     */
    public function testGetEventTtlDaysReturnsInteger(): void
    {
        $scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $scopeConfig->method('getValue')
            ->with('product_relations/general/event_ttl_days')
            ->willReturn('30');

        $config = new Config($scopeConfig);

        $this->assertSame(30, $config->getEventTtlDays());
    }

    /**
     * Test that getRollupBatchSize returns an integer value.
     *
     * @return void
     */
    public function testGetRollupBatchSizeReturnsInteger(): void
    {
        $scopeConfig = $this->createMock(ScopeConfigInterface::class);
        $scopeConfig->method('getValue')
            ->with('product_relations/general/rollup_batch_size')
            ->willReturn('1000');

        $config = new Config($scopeConfig);

        $this->assertSame(1000, $config->getRollupBatchSize());
    }
}
