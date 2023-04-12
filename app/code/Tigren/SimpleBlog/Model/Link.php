<?php
/**
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

namespace Tigren\SimpleBlog\Model;

use Magento\Framework\Model\AbstractModel;

class Link extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tigren\SimpleBlog\Model\ResourceModel\Link');
    }
}
