<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Oye\Deliverydate\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

/**
 * @codeCoverageIgnore
 */
class Uninstall implements UninstallInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->dropTable($setup->getTable('oye_deliverydate_holiday'));

        $setup->getConnection()->dropColumn(
            $setup->getTable('quote'),
            'delivery_date'
        );
        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_order'),
            'delivery_date'
        );
        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_order_grid'),
            'delivery_date'
        );

        $setup->endSetup();
    }

}