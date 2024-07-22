<?php


namespace Cp\User\Block;

use Cp\User\Model\GalleryFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface; 

class Promotion extends \Magento\Framework\View\Element\Template
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
    public function records()
    {
        $model = $this->galleryFactory->create();
        $collection = $model->getCollection();
    
            $collection->addFieldToFilter('is_active', 1)->setOrder('user_id', 'ASC');
    
    
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

    public function getModuleEnable()
    {
        return $this->scopeConfig->getValue('kinfo/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE) == 1;
    }
    
 
   public function getDisplayName()
    {
        return $this->scopeConfig->getValue('kinfo/general/title', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
 
    public function getDisplayDescription()
    {
        return $this->scopeConfig->getValue('kinfo/general/description', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
 
    public function getStartDate()
    {
        return $this->scopeConfig->getValue('kinfo/general/startdate', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
 
    public function getEndDate()
    {
        return $this->scopeConfig->getValue('kinfo/general/enddate', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
 
    public function isActive()
    {
        return $this->scopeConfig->getValue('kinfo/general/act', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    



    public function sayHello()
    {
        return __('Hello World');
    }
}
