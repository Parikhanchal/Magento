<?php


namespace Cp\User\Block;

use Cp\User\Model\GalleryFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface; 

class Index extends \Magento\Framework\View\Element\Template
{
    protected $galleryFactory;
    protected $urlBuilder;
    protected $scopeConfig; 

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        GalleryFactory $galleryFactory,
        UrlInterface $urlBuilder,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->galleryFactory = $galleryFactory;
        $this->urlBuilder = $urlBuilder;
        $this->scopeConfig = $scopeConfig; 
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
        $collection->setOrder('user_id', $sorting);
    }

    foreach ($collection as $item) {
        echo "<tr>";
        echo "<td>".$item->getUserId()."</td>";
        echo "<td>".$item->getName()."</td>";
        echo "<td>".$item->getEmail()."</td>";
        echo "<td>".$item->getCreationTime()."</td>";
        echo "<td>".$item->getUpdateTime()."</td>";
        echo "<td><a href='".$this->urlBuilder->getUrl('user1/index/index', ['id' => $item->getId()])."'>Edit</a></td>";
        echo "<td><button onclick=\"window.location='".$this->urlBuilder->getUrl('user1/gallery/delete', ['deleteid' => $item->getId()])."'\">Delete</button></td>";
        echo "</tr>";
    }
}
    public function sayHello()
    {
        return __('Hello World');

             
    }
    public function _prepareLayout()
{
    $breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs');
            $baseUrl = $this->_storeManager->getStore()->getBaseUrl();
    
            if ($breadcrumbsBlock) {
    
                $breadcrumbsBlock->addCrumb(
                    'home',
                    [
                    'label' => __('Home'), //lable on breadCrumbes
                    'title' => __('hello1'),
                    'link' => $baseUrl
                    ]
                );
                $breadcrumbsBlock->addCrumb(
                    'user',
                    [
                    'label' => __('User'),
                    'title' => __('User FAQ'),
                    'link' => '' //set link path
                    ]
                );
                $breadcrumbsBlock->addCrumb(
                    'user1',
                    [
                    'label' => __('User1'),
                    'title' => __('User1'),
                    'link' => '' //set link path
                    ]
                );
            }
    $this->pageConfig->getTitle()->set(__('TESTING').date('Y-m-d H:i:s'));

    return parent::_prepareLayout();
}

}
