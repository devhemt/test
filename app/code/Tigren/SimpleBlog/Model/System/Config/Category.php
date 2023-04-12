<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\SimpleBlog\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

class Category extends Template implements ArrayInterface
{

    protected $_coreRegistry;

    protected $_postsFactory;

    public function __construct(
        Template\Context $context,
        Registry $coreRegistry,
        \Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogCategory\CollectionFactory $postsFactory,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->_coreRegistry = $coreRegistry;
        $this->_postsFactory = $postsFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->_coreRegistry->registry('post_items')) {
            $collection = $this->_coreRegistry->registry('post_items');
        } else {
            $collection = $this->_postsFactory->create()
                ->addFieldToSelect(array('name'))
                ->addFieldToFilter('status', 1)
                ->setPageSize(10)
                ->setOrder('tigren_blog_category_id', 'ASC');
            $this->_coreRegistry->register('post_items', $collection);
        }
        //        dd($collection->getData()[0]);
        $options = [];
        $flag = [];
        foreach ($collection as $x) {
            $flag[] = ['value' => $x->getId(), 'label' => __($x->getName())];
            $options[$x->getId()] = $x->getName();
        }
        //        dd($flag);

        return $flag;
    }

}
