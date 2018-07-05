<?php

namespace Oye\Deliverydate\Setup\Upgrades;

class Upgrade11
{
    public function execute($setup, $context)
    {
        $this->addHolidayTable($setup);
    }

    /**
     * @param $setup
     * @throws \Zend_Db_Exception
     */
    private function addHolidayTable($setup)
    {
        /**
         * Create table 'oye_deliverydate_holiday'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('oye_deliverydate_holiday'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'primary' => true, 'unsigned' => true, 'nullable' => false],
                'Primary key'
            )
            ->addColumn(
                'year',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Year'
            )
            ->addColumn(
                'month',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Month'
            )
            ->addColumn(
                'day',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'day'
            );
        $setup->getConnection()->createTable($table);
    }

}