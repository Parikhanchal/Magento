<?php

namespace Kitchen\CustomPdf\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Sales\Model\Order\Pdf\Invoice;
use Magento\Sales\Model\OrderRepository;

class Export extends Action
{
    protected $pageFactory;
    protected $fileFactory;
    protected $orderRepository;
    protected $invoicePdf;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        FileFactory $fileFactory,
        Invoice $invoicePdf,
        OrderRepository $orderRepository
    ) {
        $this->pageFactory = $pageFactory;
        $this->fileFactory = $fileFactory;
        $this->invoicePdf = $invoicePdf;
        $this->orderRepository = $orderRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $orderId = $this->getRequest()->getParam('order_id');
        
        try {
            // Load order
            $order = $this->orderRepository->get($orderId);
            
            // Generate PDF
            $pdf = $this->invoicePdf->getPdf([$order]);
    
            // Set headers
            $fileName = 'invoice_' . $order->getIncrementId() . '.pdf';
    
            return $this->fileFactory->create(
                $fileName,
                $pdf->render(),
                \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR,
                'application/pdf'
            );
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error generating PDF: %1', $e->getMessage()));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }
    }
}
