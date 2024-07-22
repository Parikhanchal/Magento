<?php

namespace Kitchen\Product\Block;

use Kitchen\Product\Model\GalleryFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
class Index extends \Magento\Framework\View\Element\Template
{
    protected $galleryFactory;
    protected $urlBuilder;
    protected $timezoneInterface;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        GalleryFactory $galleryFactory,
        UrlInterface $urlBuilder,
        TimezoneInterface $timezoneInterface
    ) {
        $this->galleryFactory = $galleryFactory;
        $this->urlBuilder = $urlBuilder;
        $this->timezoneInterface = $timezoneInterface;
        parent::__construct($context);
    }
 
    public function display()
    {
        $userStatus = $this->getRequest()->getParam('user_status');
        $sorting = $this->getRequest()->getParam('sorting');

        $model = $this->galleryFactory->create();
        $collection = $model->getCollection();

        if ($userStatus !== null && $userStatus !== 'all') {
            $collection->addFieldToFilter('is_active', $userStatus);
        }

        if ($sorting !== null && ($sorting === 'ASC' || $sorting === 'DESC')) {
            $collection->setOrder('entity_id', $sorting);
        }

        foreach ($collection as $item) {
            echo "<tr>";
            echo "<td>".$item->getEntityId()."</td>";
            echo "<td>".$item->getName()."</td>";
            echo "<td>".$item->getSku()."</td>";
            echo "<td>".$item->getPrice()."</td>";
            echo "<td>".$item->getSortOrder()."</td>";
            echo "<td>".$item->getIsActive()."</td>";
            echo "<td>".$item->getAId()."</td>";
            echo "<td><a href='".$this->urlBuilder->getUrl('pro/index/index', ['entity_id' => $item->getEntityId()])."'>Edit</a></td>";
            echo "<td><a href='".$this->urlBuilder->getUrl('pro/index/delete', ['entity_id' => $item->getEntityId()])."'>Delete</a></td>";
            echo "</tr>";
        }
    }


    // add dynamic page title and breadcrums using Block class.
    public function _prepareLayout()
    {

        $this->pageConfig->getTitle()->prepend(__('product') . ' ' . $this->timezoneInterface->date()->format('Y-m-d H:i:s'));

        $breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs');
        // $baseUrl = $this->_storeManager->getStore()->getBaseUrl();
 
        if ($breadcrumbsBlock) {
 
            // $breadcrumbsBlock->addCrumb(
            //     'home',
            //     [
            //     'label' => __('Home'), //lable on breadCrumbes
            //     'title' => __('Home'),
            //     'link' => $baseUrl
            //     ]
            // );
            // $breadcrumbsBlock->addCrumb(
            //     'blog',
            //     [
            //     'label' => __('Blog'), //lable on breadCrumbes
            //     'title' => __('Blog'),
            //     'link' => ''
            //     ]
            // );
            // $breadcrumbsBlock->addCrumb(
            //     'blog1',
            //     [
            //     'label' => __('Blog1'), //lable on breadCrumbes
            //     'title' => __('Blog1'),
            //     'link' => ''
            //     ]
            // );

            $breadcrumbsBlock->addCrumb(
                'product',
                [
                'label' => __('product '), //lable on breadCrumbes
                'title' => __('product '),
                'link' => 'http://aanchal.localhost.com/product.html'
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'phone',
                [
                'label' => __('phone 1'), //lable on breadCrumbes
                'title' => __('phone 1'),
                'link' => 'http://aanchal.localhost.com/product/phone.html'
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'headphone',
                [
                'label' => __('headphone 2'), //lable on breadCrumbes
                'title' => __('headphone 2'),
                'link' => 'http://aanchal.localhost.com/product/headphone.html'
                ]
            );
        }
        // $this->pageConfig->getTitle()->set(__('Blog')); // set page name
        // $this->pageConfig->getTitle()->set(__('Blog1')); // set page name
        $this->pageConfig->getTitle()->set(__('product')); // set page name
        $this->pageConfig->getTitle()->set(__('phone')); // set page name
        $this->pageConfig->getTitle()->set(__('headphone')); // set page name
        return parent::_prepareLayout();
    }
}