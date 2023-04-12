<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2023 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */
declare(strict_types=1);

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Rule;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\ResourceConnection;
use Magento\Setup\Console\Command\DbDataUpgradeCommand;


class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $_resource;

    protected $productCollectionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ResourceConnection $resource,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->_resource = $resource;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        //        dd($data);
        if ($data) {
            $conditions = $data['rule']['conditions'];
            array_shift($conditions);
            dd($conditions);
            $collection = $this->productCollectionFactory->create();
            $stem = [];
            foreach ($conditions as $c) {
                if ($c['attribute'] != null && $c['value'] != null) {
                    $res = $collection->addAttributeToFilter($c['attribute'], ['eq' => $c['value']])->getData();
                    foreach ($res as $cin) {
                        $stem[] = $cin['entity_id'];
                    }
                }
            }
            $stem = array_unique($stem);

            $id = $this->getRequest()->getParam('rule_id');

            $model = $this->_objectManager->create(\Tigren\CustomerGroupCatalog\Model\Rule::class)->load($id);

            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Rule no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                $conn = $this->_resource->getConnection();
                $select = $conn->select()
                    ->from(['so' => $this->_resource->getTableName('tigren_customergroupcatalog_rule')]);
                $result = $conn->fetchAll($select);
                $lastId;
                foreach ($result as $r) {
                    $lastId = $r['rule_id'];
                }
                if (isset($data['rule_id'])) {
                    $lastId = $data['rule_id'];
                    $delete = $conn->delete('tigren_rule_store', ['rule_id = ' . $lastId]);
                    $delete = $conn->delete('tigren_rule_customer_group', ['rule_id = ' . $lastId]);
                    $delete = $conn->delete('tigren_rule_products', ['rule_id = ' . $lastId]);
                    foreach ($data['store_ids'] as $d) {
                        $store = $conn->insert('tigren_rule_store', ['rule_id' => $lastId, 'store_id' => $d]);
                    }
                    foreach ($data['customer_group_ids'] as $d) {
                        $store = $conn->insert('tigren_rule_customer_group',
                            ['rule_id' => $lastId, 'customer_group_id' => $d]);
                    }
                    if (sizeof($data['rule']['conditions']) == 1 || $stem == null) {
                        $res = $collection->getData();
                        foreach ($res as $cin) {
                            $store = $conn->insert('tigren_rule_products',
                                ['rule_id' => $lastId, 'product_id' => $cin['entity_id']]);
                        }
                    } else {
                        foreach ($conditions as $c) {
                            foreach ($stem as $cin) {
                                $store = $conn->insert('tigren_rule_products',
                                    ['rule_id' => $lastId, 'product_id' => $cin]);
                            }
                        }
                    }

                } else {
                    if (sizeof($data['rule']['conditions']) == 1 || $stem == null) {
                        $res = $collection->getData();
                        foreach ($res as $cin) {
                            $store = $conn->insert('tigren_rule_products',
                                ['rule_id' => $lastId, 'product_id' => $cin['entity_id']]);
                        }
                    } else {
                        foreach ($conditions as $c) {
                            foreach ($stem as $cin) {
                                $store = $conn->insert('tigren_rule_products',
                                    ['rule_id' => $lastId, 'product_id' => $cin]);
                            }
                        }
                    }


                    foreach ($data['store_ids'] as $d) {
                        $store = $conn->insert('tigren_rule_store', ['rule_id' => $lastId, 'store_id' => $d]);
                    }
                    foreach ($data['customer_group_ids'] as $d) {
                        $store = $conn->insert('tigren_rule_customer_group',
                            ['rule_id' => $lastId, 'customer_group_id' => $d]);
                    }
                }

                $this->messageManager->addSuccessMessage(__('You saved the Rule.'));
                $this->dataPersistor->clear('tigren_customergroupcatalog_rule');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['rule_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Rule.'));
            }

            $this->dataPersistor->set('tigren_customergroupcatalog_rule', $data);
            return $resultRedirect->setPath('*/*/edit', ['rule_id' => $this->getRequest()->getParam('rule_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

