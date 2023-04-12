<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\CustomerGroupCatalog\Ui\Component\Listing\Column;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Store extends \Magento\Ui\Component\Listing\Columns\Column
{

    protected $_resource;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        ResourceConnection $resource,
        array $components = [],
        array $data = [],
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_resource = $resource;
    }


    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource['data']['items'] as & $item) {
            $item['store_id'] = $this->StoreString($item['rule_id']);
            $item['discount_amount'] = $item['discount_amount'] . '%';
        }
        //        dd($dataSource);

        return $dataSource;
    }

    public function StoreString($id)
    {
        $conn = $this->_resource->getConnection();
        $select = $conn->select()
            ->from(['so' => $this->_resource->getTableName('tigren_customergroupcatalog_rule')])
            ->join(['soi' => $this->_resource->getTableName('tigren_rule_store')],
                'so.rule_id = soi.rule_id',
                ['so.*', 'soi.*'])->where('soi.rule_id = ' . $id);
        $result = $conn->fetchAll($select);
        if ($result[0]['store_id'] == 0) {
            return 'All Store Views';
        }
        if ($result[0]['store_id'] == 1) {
            return 'Default Store View';
        }
        return '';
    }
}

