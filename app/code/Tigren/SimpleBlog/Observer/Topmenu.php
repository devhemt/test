<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\SimpleBlog\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Event\ObserverInterface;

class Topmenu implements ObserverInterface
{
    public function __construct()
    {
    }

    public function execute(EventObserver $observer)
    {
        $menu = $observer->getMenu();
        //        dd($menu);
        $tree = $menu->getTree();
        $data = [
            'name' => __('Tigren SimpleBlog'),
            'id' => 'TSB',
            'url' => 'http://magento24.localhost.com/simpleblog/index/lists',
            'is_active' => false
        ];
        $node = new Node($data, 'id', $tree, $menu);
        $menu->addChild($node);
        $menu1 = $menu->getLastChild();
        $tree1 = $menu1->getTree();
        $data1 = [
            'name' => __('Category'),
            'id' => 'TSB-child1',
            'url' => 'http://magento24.localhost.com/simpleblog/index/category',
            'is_active' => false
        ];
        $node1 = new Node($data1, 'id1', $tree1, $menu1);
        $menu1->addChild($node1);


        return $this;
    }
}
