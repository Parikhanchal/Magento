<?php

namespace Kitchen\Product\Controller\Adminhtml\Customer;

use Magento\Framework\Controller\ResultFactory;

class Upload extends \Magento\Backend\App\Action
{

    /**
     * @var \Kitchen\Product\Model\ImageUploader
     */
    public $imageUploader;

    /**
     * Upload constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Kitchen\Product\Model\ImageUploader $imageUploader
     */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Kitchen\Product\Model\ImageUploader $imageUploader
	) {
		parent::__construct($context);
		$this->imageUploader = $imageUploader;
	}

    /**
     * @return mixed
     */
	public function _isAllowed() {
		return $this->_authorization->isAllowed('Kitchen_Product::customer_page');
	}

    /**
     * @return mixed
     */
    public function execute() {
		try {
			$result = $this->imageUploader->saveFileToTmpDir('profile_image');
			$result['cookie'] = [
				'name' => $this->_getSession()->getName(),
				'value' => $this->_getSession()->getSessionId(),
				'lifetime' => $this->_getSession()->getCookieLifetime(),
				'path' => $this->_getSession()->getCookiePath(),
				'domain' => $this->_getSession()->getCookieDomain(),
			];
		} catch (\Exception $e) {
			$result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
		}
		return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
	}
}