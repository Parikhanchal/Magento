<?php

namespace Kitchen\CsvUpload\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\File\Csv as CsvProcessor;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\Result\JsonFactory;

class Save extends Action
{
    protected $csvProcessor;
    protected $filesystem;
    protected $resultJsonFactory;

    public function __construct(
        Context $context,
        CsvProcessor $csvProcessor,
        \Magento\Framework\Filesystem $filesystem,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->csvProcessor = $csvProcessor;
        $this->filesystem = $filesystem;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $file = $this->getRequest()->getFiles('upload_file');

        if ($file && $file['tmp_name']) {
            $csvData = $this->csvProcessor->getData($file['tmp_name']);
           

            if (empty($csvData)) {
                return $resultJson->setData(['success' => false, 'message' => __('CSV file is empty or invalid.')]);
            }

            $header = [];
            $skuData = [];

            foreach ($csvData as $index => $row) {
                if ($index === 0) {
                    $header = $row;
                    continue;
                }

                $skuIndex = array_search('Unit(SKU)', $header);
                $qtyIndex = array_search('Qty', $header);
                $priceIndex = array_search('Price', $header);
                $assembly = array_search('Assembly', $header);
                $hinge = array_search('Hinge', $header);

                
                if ($skuIndex !== false && isset($row[$skuIndex])) {
                    $skuData[] = [
                        'sku' => $row[$skuIndex],
                        'qty' => $row[$qtyIndex] ?? 1,
                        'price' => $row[$priceIndex] ?? 0,
                        'assembly' => $row[$assembly] ?? 0,
                        'hinge' => $row[$hinge] ?? 0,

                    ];
                }
            }

            $skus = array_column($skuData, 'sku');

            return $resultJson->setData(['success' => true, 'skus' => $skus, 'skuData' => $skuData]);
        }

        return $resultJson->setData(['success' => false, 'message' => __('No file uploaded.')]);
    }
}
