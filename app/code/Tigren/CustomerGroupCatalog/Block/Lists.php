<?php

namespace Tigren\CustomerGroupCatalog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\ResourceConnection;

class Lists extends Template
{
    protected $_postsFactory;

    protected $_resource;

    public function __construct(
        Template\Context $context,
        ResourceConnection $resource,
        \Magento\Framework\App\RequestInterface $request,
        array $data = []
    ) {
        $this->_resource = $resource;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    /**
     * @return $this|mixed
     */
    function getItems()
    {
        $conn = $this->_resource->getConnection();
        $select = $conn->select()
            ->from(['so' => $this->_resource->getTableName('customer_group_catalog_history')])
            ->join(['soi' => $this->_resource->getTableName('tigren_customergroupcatalog_rule')],
                'so.rule_id = soi.rule_id',
                ['so.*', 'soi.*']);
        $results = $conn->fetchAll($select);
        $orderids;
        foreach ($results as $result) {
            $orderids[] = $result['order_id'];
        }
        array_unique($orderids);
        $rowspan;
        foreach ($orderids as $orderid) {
            $rowspan[$orderid] = 0;
            foreach ($results as $result) {
                if ($orderid == $result['order_id']) {
                    $rowspan[$orderid]++;
                }
            }
        }

        //        dd([$results, $rowspan]);

        return [$results, $rowspan];
    }
}
