<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\SimpleBlog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Framework\App\ResourceConnection;

class Posts extends Template
{
    protected $_coreRegistry;

    protected $_postsFactory;

    protected $_resource;

    protected $request;

    public function __construct(
        Template\Context $context,
        Registry $coreRegistry,
        ResourceConnection $resource,
        \Magento\Framework\App\RequestInterface $request,
        \Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogPost\CollectionFactory $postsFactory,
        array $data = []
    ) {
        $this->_resource = $resource;
        $this->request = $request;
        parent::__construct($context, $data);
        $this->_coreRegistry = $coreRegistry;
        $this->_postsFactory = $postsFactory;
    }

    /**
     * @return $this|mixed
     */
    function getPostItems()
    {
        $id = $this->request->getParam('tigren_blog_category_id');
        if (isset($id) && $id != null) {
            $conn = $this->_resource->getConnection();
            $select = $conn->select()
                ->from(['so' => $this->_resource->getTableName('tigren_simpleblog_tigren_blog_post')])
                ->join(['soi' => $this->_resource->getTableName('tigren_blog_category_post')],
                    'so.tigren_blog_post_id = soi.post_id',
                    ['so.*', 'soi.*'])->where('soi.category_id = ' . $id);
            $result = $conn->fetchAll($select);
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $collection = $objectManager->create('Magento\Framework\Data\Collection');

            foreach ($result as $key => $row) {
                $varienObject = new \Magento\Framework\DataObject();
                $varienObject->setData($row);
                $collection->addItem($varienObject);
            }
            return $collection;
        }

        if ($this->_coreRegistry->registry('post_items')) {
            $collection = $this->_coreRegistry->registry('post_items');
        } else {
            $collection = $this->_postsFactory->create()
                ->addFieldToSelect(array('tigren_blog_post_id', 'title', 'short_content'))
                ->addFieldToFilter('status', 1)
                ->setPageSize(10)
                ->setOrder('tigren_blog_post_id', 'ASC');
            $this->_coreRegistry->register('post_items', $collection);
        }
        //        dd($collection);
        return $collection;

    }
}
