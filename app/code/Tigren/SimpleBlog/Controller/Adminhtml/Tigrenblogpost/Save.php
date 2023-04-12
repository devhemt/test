<?php
/**
 * Copyright © @author    Tigren Solutions <info@tigren.com> @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved. @license   Open Software License ("OSL") v. 3.0 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Tigren\SimpleBlog\Controller\Adminhtml\Tigrenblogpost;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\ResourceConnection;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    protected $_resource;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ResourceConnection $resource,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
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
        //        dd(isset($data['tigren_blog_post_id']));
        if ($data) {
            $id = $this->getRequest()->getParam('tigren_blog_post_id');

            $model = $this->_objectManager->create(\Tigren\SimpleBlog\Model\TigrenBlogPost::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Tigren Blog Post no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date('d-m-y h:i:s');
            $data['published_at'] = $date;
            
            if (isset($data['tigren_blog_post_id'])) {
                $data['list_image'] = [];
                $flag = [];
                foreach ($data['list_image'] as $i) {
                    if (isset($i['name']) && $i['name'] != '') {
                        try {
                            $uploader = $this->_fileUploaderFactory->create(['fileId' => 'list_image']);
                            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                            $uploader->setAllowRenameFiles(true);
                            $uploader->setFilesDispersion(true);
                            $path = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')
                                ->getStore()
                                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
                            $result = $uploader->save($path . 'list_image');
                            array_push($flag, $result['file']);
                        } catch (\Exception $e) {
                            array_push($flag, $i['name']);
                        }
                    } else {
                        if (isset($i['value'])) {
                            array_push($flag, $i['value']);
                        } else {
                            $data['list_image'] = '';
                        }
                    }
                }
                $data['list_image'] = implode(",", $flag);

                $image = $data['post_image'][0];
                if (isset($image['name']) && $image['name'] != '') {
                    try {
                        $uploader = $this->_fileUploaderFactory->create(['fileId' => 'post_image']);
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(true);
                        $path = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')
                            ->getStore()
                            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
                        $result = $uploader->save($path . 'post_image');
                        $data['post_image'] = $result['file'];
                    } catch (\Exception $e) {
                        $data['post_image'] = $image['name'];
                    }
                } else {
                    if (isset($image['value'])) {
                        $data['post_image'] = $image['value'];
                    } else {
                        $data['post_image'] = '';
                    }
                }
            }

            $model->setData($data);

            try {
                $model->save();
                $model = $this->_objectManager->create(\Tigren\SimpleBlog\Model\ResourceModel\TigrenBlogPost\CollectionFactory::class);
                $model = $model->create();
                $items = $model->getItems();
                $lastId;
                foreach ($items as $m) {
                    $lastId = $m->getData()['tigren_blog_post_id'];
                }
                if (isset($data['tigren_blog_post_id'])) {
                    $lastId = $data['tigren_blog_post_id'];
                }

                $conn = $this->_resource->getConnection();
                $select = $conn->select()
                    ->from(['so' => $this->_resource->getTableName('tigren_blog_category_post')])
                    ->where('so.category_id = ' . $data['category']);
                $result = $conn->fetchAll($select);
                $edit = false;
                foreach ($result as $r) {
                    if ($r['post_id'] == 12) {
                        $edit = true;
                    }
                }

                if (!$edit) {
                    $link = $this->_objectManager->create(\Tigren\SimpleBlog\Model\Link::class)->load($id);
                    $linkData['post_id'] = $lastId;
                    $linkData['category_id'] = $data['category'];
                    $link->setData($linkData);
                    $link->save();
                }

                $this->messageManager->addSuccessMessage(__('You saved the Tigren Blog Post.'));
                $this->dataPersistor->clear('tigren_simpleblog_tigren_blog_post');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['tigren_blog_post_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e,
                    __('Something went wrong while saving the Tigren Blog Post.'));
            }

            $this->dataPersistor->set('tigren_simpleblog_tigren_blog_post', $data);
            return $resultRedirect->setPath('*/*/edit',
                ['tigren_blog_post_id' => $this->getRequest()->getParam('tigren_blog_post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

