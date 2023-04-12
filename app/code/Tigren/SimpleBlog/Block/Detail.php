<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\SimpleBlog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;

class Detail extends Template
{
    protected $_coreRegistry;

    protected $_postsFactory;

    protected $request;

    protected $postRepository;

    public function __construct(
        Template\Context $context,
        Registry $coreRegistry,
        \Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogPost\CollectionFactory $postsFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Tigren\SimpleBlog\Api\TigrenBlogPostRepositoryInterface $postRepository,
        array $data = []
    ) {
        $this->request = $request;
        $this->postRepository = $postRepository;
        parent::__construct($context, $data);
        $this->_coreRegistry = $coreRegistry;
        $this->_postsFactory = $postsFactory;
    }

    /**
     * @return $this|mixed
     */
    function getPostItems()
    {
        $id = $this->request->getParam('tigren_blog_post_id');
        $collection = $this->postRepository->get($id);
        return $collection;

    }
}
