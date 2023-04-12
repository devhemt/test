<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2023 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\CustomerGroupCatalog\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ResourceConnection;

class Orderplaceafter implements ObserverInterface
{
    protected $logger;
    protected $_resource;

    public function __construct(ResourceConnection $resource, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->_resource = $resource;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {

            $conn = $this->_resource->getConnection();
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $session = $objectManager->get('\Magento\Customer\Model\Session');
            $customerid = $session->getCustomer()->getId();
            $order = $observer->getEvent()->getOrder();
            $orderid = $observer->getEvent()->getOrder()->getIncrementId();
            $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
            $storeid = $storeManager->getStore()->getId();
            $cusgroupid = $session->getCustomer()->getGroupId();

            $items = $order->getAllVisibleItems();
            $productids = [];
            foreach ($items as $item) {
                $productids[] = $item->getProductId();
            }
            $rules = array();

            foreach ($productids as $p) {
                $select = $conn->select()
                    ->from(['so' => $this->_resource->getTableName('tigren_customergroupcatalog_rule')])
                    ->join(['soi' => $this->_resource->getTableName('tigren_rule_store')],
                        'so.rule_id = soi.rule_id')
                    ->join(['soii' => $this->_resource->getTableName('tigren_rule_customer_group')],
                        'so.rule_id = soii.rule_id')
                    ->join(['soiii' => $this->_resource->getTableName('tigren_rule_products')],
                        'so.rule_id = soiii.rule_id',)
                    ->where('product_id =' . $p)
                    ->where('store_id = ' . $storeid)
                    ->where('customer_group_id = ' . $cusgroupid);
                $result = $conn->fetchAll($select);

                $max = 0;
                $discount = 0;
                $ruleid = 0;
                foreach ($result as $r) {
                    if ($r['priority'] > $max) {
                        $max = $r['priority'];
                        $discount = $r['discount_amount'];
                        $ruleid = $r['rule_id'];
                    }
                }

                $rules[] = $ruleid;
            }


            $rules = array_unique($rules);

            foreach ($rules as $rule) {
                $save = $conn->insert('customer_group_catalog_history', [
                    'order_id' => $orderid,
                    'customer_id' => $customerid,
                    'rule_id' => $rule
                ]);
            }


        } catch (\Exception $e) {
            $this->logger->info($e->getMessage());
        }
    }
}
