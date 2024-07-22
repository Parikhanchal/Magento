<?php

namespace Kitchen\CsvUpload\Block\Index;

use Magento\Framework\View\Element\Template;
use Magento\Framework\File\Csv as CsvProcessor;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;


class Uploader extends Template
{
    protected $csvProcessor;
    protected $categoryCollectionFactory;
    protected $storeManager;
    protected $_urlBuilder;


    public function __construct(
        Template\Context $context,
        CsvProcessor $csvProcessor,
        CategoryCollectionFactory $categoryCollectionFactory,
        UrlInterface $urlBuilder,
        StoreManagerInterface $storeManagerInterface,

        
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->csvProcessor = $csvProcessor;
        $this->storeManager = $storeManagerInterface;
        $this->_urlBuilder = $urlBuilder;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    public function getCsvProcessor()
    {
        return $this->csvProcessor;
    }

    public function getSubmitUrl()
    {
        return $this->getUrl('csvupload/index/save');
    }
    public function getSampleUrl()
    {
        return $this->getViewFileUrl('Kitchen_CsvUpload::sample/samples.csv');
    }
    // root category collection
    public function getRootCategoryId(): int
    {
        $storeGroupId = $this->storeManager->getStore()->getStoreGroupId();
        $rootCategoryId = $this->storeManager->getGroup($storeGroupId)->getRootCategoryId();
        return $rootCategoryId;
    }

    public function getCategories()
    {
        $categories = $this->categoryCollectionFactory->create()
            ->addAttributeToSelect(['name', 'sku']) // Add 'sku' to attribute selection
            ->setOrder('position', 'ASC')
            ->addFieldToFilter('parent_id', $this->getRootCategoryId());

        $categoryOptions = [];
        foreach ($categories as $category) {
            $categoryOptions[] = [
                'value' => $category->getId(),
                'label' => $category->getName(),
                'sku' => $category->getSku() // Include 'sku' attribute
            ];
        }
        return $categoryOptions;
    }

}
