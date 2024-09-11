<?php

namespace Kitchen\Product\Controller\Index;

use Magento\Framework\App\Action\Context;
use Kitchen\Product\Model\GalleryFactory;

class Save extends \Magento\Framework\App\Action\Action
{
	protected $galleryFactory;
	protected $messageManager;

	public function __construct(
		Context $context,
        GalleryFactory $galleryFactory,
		\Magento\Framework\Message\ManagerInterface $messageManager
	){
		$this->galleryFactory = $galleryFactory;
		$this->messageManager = $messageManager;
		parent::__construct($context);
	}

	public function execute()
    {
		$data = $this->getRequest()->getPostValue();
        $model = $this->galleryFactory->create();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();
		// $collection= $model->getCollection();
		
		if (empty($data['name']) || empty($data['sku']) || empty($data['price']) || empty($data['sort_order'])) {
			$this->messageManager->addError(__('Please fill in all required fields.'));
			$this->_redirect('pro/index/index'); 
			return;
		}

		if(!empty($data['entity_id']))
		{
			$model->load($data['entity_id']);
			$model->setName($data["name"]);
			$model->setSku($data['sku']);
			$model->setPrice($data['price']);
			$model->setSortOrder($data['sort_order']);
			$model->save();
			$this->messageManager->addSuccess(__('User data has been updated.'));
        	$this->_redirect('pro/index/index');
		}
		else{
		}
		$model->setName($data['name']);
		$model->setSku($data['sku']);
		$model->setPrice($data['price']);
		$model->setSortOrder($data['sort_order']);
		$model->save();
		$this->messageManager->addSuccess(__('User data has been Added.'));
        $this->_redirect('pro/index/index');
    }

	
}
----------------------------------------------------


<?php

namespace Kitchen\Product\Controller\Index;

use Magento\Framework\App\Action\Context;
use Kitchen\Product\Model\GalleryFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $galleryFactory;
    protected $messageManager;
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        GalleryFactory $galleryFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ){
        $this->galleryFactory = $galleryFactory;
        $this->messageManager = $messageManager;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->galleryFactory->create();

        if (!empty($data['entity_id'])) {
            $model->load($data['entity_id']);
        }

        if (empty($data['name']) || empty($data['sku']) || empty($data['price']) || empty($data['sort_order'])) {
            $this->messageManager->addError(__('Please fill in all required fields.'));
            $this->_redirect('pro/index/index');
            return;
        }

        try {
            $model->setData($data);
            $model->save();

            if (!empty($data['entity_id'])) {
                $this->messageManager->addSuccess(__('User data has been updated.'));
            } else {
                $this->messageManager->addSuccess(__('User data has been added.'));
            }

            $this->_redirect('pro/index/index');
            return;
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            $this->_redirect('pro/index/index');
            return;
        }
    }
}
--------------------------------------------
<?php
 
namespace Kitchen\Blog\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Kitchen\Blog\Model\GalleryFactory;
 
class Deleteall extends Action
{
    protected $galleryFactory;
    protected $messageManager;
 
    public function __construct(
        Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        GalleryFactory $galleryFactory
    ) {
        $this->galleryFactory = $galleryFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }
 
    public function execute()
    {
        $deleteall = $this->galleryFactory->create();
        $collection = $deleteall->getCollection();
 
        foreach ($collection as $row) {
            $row->delete();
            $this->messageManager->addSuccess(__("Delete All successfully"));
        }
        $this->_redirect('pradip/index/index');
    }
}
 -----------------------------------------------------

 <?php

namespace Kitchen\Product\Controller\Index;

use Magento\Framework\App\Action\Context;
use Kitchen\Product\Model\GalleryFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $galleryFactory;
    protected $messageManager;

    public function __construct(
        Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        GalleryFactory $galleryFactory
    ) {
        $this->galleryFactory = $galleryFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $deleteAll = $this->galleryFactory->create();
        $collection = $deleteAll->getCollection();

        foreach ($collection as $row) {
            $row->delete();
            $this->messageManager->addSuccess(__("Delete All successfully"));
        }

        $data = $this->getRequest()->getPostValue();
        $model = $this->galleryFactory->create();

        if (empty($data['name']) || empty($data['sku']) || empty($data['price']) || empty($data['sort_order'])) {
            $this->messageManager->addError(__('Please fill in all required fields.'));
            return $this->_redirect('pro/index/index');
        }

        if (!empty($data['entity_id'])) {
            $model->load($data['entity_id']);
        }

        $model->setName($data['name'])
            ->setSku($data['sku'])
            ->setPrice($data['price'])
            ->setSortOrder($data['sort_order'])
            ->save();

        if (!empty($data['entity_id'])) {
            $this->messageManager->addSuccess(__('User data has been updated.'));
        } else {
            $this->messageManager->addSuccess(__('User data has been added.'));
        }

        return $this->_redirect('pro/index/index');
    }
}
======================================


<?php

namespace Kitchen\Product\Controller\Index;

use Magento\Framework\App\Action\Context;
use Kitchen\Product\Model\GalleryFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $galleryFactory;
    protected $messageManager;

    public function __construct(
        Context $context,
        GalleryFactory $galleryFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ){
        $this->galleryFactory = $galleryFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->galleryFactory->create();

        if (empty($data['name']) || empty($data['sku']) || empty($data['price']) || empty($data['sort_order'])) {
            $this->messageManager->addError(__('Please fill in all required fields.'));
            $this->_redirect('pro/index/index');
            return;
        }

        if (!empty($data['entity_id'])) {
            $model->load($data['entity_id']);
        }

        $model->setName($data['name'])
            ->setSku($data['sku'])
            ->setPrice($data['price'])
            ->setSortOrder($data['sort_order'])
            ->save();

        if (!empty($data['entity_id'])) {
            $this->messageManager->addSuccess(__('User data has been updated.'));
        } else {
            $this->messageManager->addSuccess(__('User data has been added.'));
        }
        
        $this->_redirect('pro/index/index');
    }
}
============================================

public function execute()
{
    $data = $this->getRequest()->getPost();
    $model = $this->galleryFactory->create();
    if ($model->load($data['blog_id'])) {
        
        $model->setBlogTitle($data['blog_title']);
        $model->setBlogDesc($data['blog_desc']);
        $model->setIsActive($data['is_active']);
        $model->save();
        echo "save successfully";
    }
    else {
        $model->setBlogTitle($data['blog_title']);
        $model->setBlogDesc($data['blog_desc']);
        $model->setIsActive($data['is_active']);
        $model->save();
        echo "Update successfully";
    }
}
}


---------------------------------------------------------------

Save.php

<?php
 
namespace Kitchen\Review\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Kitchen\Review\Model\ReviewsFactory;
 
class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $collection;
    protected $messageManager;
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Kitchen\Review\Model\ReviewsFactory $collection,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        
        $this->collection = $collection;
        $this->messageManager = $messageManager;
        return parent::__construct($context);
    }
    public function execute(){
 
        $data = $this->getRequest()->getPostValue();
        $model = $this->collection->create();
      
       // $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        
        // Filter parameters
        $filterParams = [];
        if (!empty($data['name'])) {
            $filterParams['name'] = $data['name'];
        }
        if (isset($data['is_active'])) {
            $filterParams['is_active'] = $data['is_active'];
        }
        
        // Redirect to the index page with filter parameters
      
        if (empty($data['name'])) {
            $this->messageManager->addError(__('Please fill in all required fields.'));
            $this->_redirect('review/index/index');
            return;
        }
        if (!empty($data['edit_id'])) {
            $model->load($data['edit_id']);
        }
 
       
 
        if((!empty($data['edit_id']))) {
            $model->load($data['edit_id']);
        }
            $model->setName($data["name"]);
            $model->setRating($data["rating"]);
            $model->setDescription($data["description"]);
            $model->setIsActive($data["is_active"]);
            $model->save();
        if(!empty($data['edit_id'])) {
            $this->messageManager->addSuccess(__("Updated Successfully."));
        }   
        else {
            $this->messageManager->addSuccess(__("Saved Successfully."));
        }
        $this->_redirect('review/index/index');
    }
    }
 



index.phtml
<!--  -->
<div id="review-form">
    <form class="form review" action="<?php echo $block->getUrl('review/index/save')?>" method="post" id="review-form">
        <input type="hidden" name="edit_id" value="<?php echo $this->getRequest()->getParam('edit_id') ?>" />
        <div class="field name required">
            <label for="name">Name</label>
            <div class="control">
                <input name="name" id="name" class="input-text" type="text" value="" required/>
            </div>
        </div>
        <div class="field description required">
            <label class="label" for="description">Description</label>
            <div class="control">
                <textarea name="description" id="description" class="input-text" cols="5" rows="3" required></textarea>
            </div>
        </div>
        <div class="field rating required">
            <label class="label" for="rating">Rating</label>
            <div class="control">
                <input name="rating" id="rating" class="input-text" type="number" min="1" max="5" value="" required/>
            </div>
        </div>
        <div class="field is_active required">
            <label class="label" for="is_active">Is Active</label>
            <div class="control">
                <select name="is_active" id="is_active" required>
                    <option value="1" >Yes</option>
                    <option value="0" >No</option>
                </select>
            </div>
        </div>
        <div class="actions-toolbar">
            <?php if ($this->getRequest()->getParam('edit_id')): ?>
                <button type="submit" class="action submit primary" id="update_btn">Update</button>
            <?php else: ?>
                <button type="submit" class="action submit primary" id="submit_btn">Submit</button>
            <?php endif; ?>
        </div>
    </form>
    <!-- Filter Form -->
<form action="<?php echo $block->getUrl('review/index/index') ?>" method="get">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $block->escapeHtml($block->getRequest()->getParam('name')) ?>">
    
    <label for="is_active">Is Active:</label>
    <select id="is_active" name="is_active">
        <option value="">-- Select --</option>
        <option value="1" <?php echo ($block->getRequest()->getParam('is_active') == '1') ? 'selected' : '' ?>>yes</option>
        <option value="0" <?php echo ($block->getRequest()->getParam('is_active') == '0') ? 'selected' : '' ?>>no</option>
    </select>
 
    <button type="submit">Filter</button>
</form>
 
</div>
<h3>All User Details</h3>
<form action="<?php echo $block->getUrl('review/index/deleteAll') ?>" method="post" id="delete-all-form">
<table>
<?php
$filterParams = $block->getRequest()->getParams();   
?>
<!-- Table Header with Sorting Links -->
<tr>
    <th>Select</th>
    <th><a href="<?php echo $block->getUrl('*/*/*', ['sort' => 'k_id', 'order' => (isset($filterParams['sort']) && $filterParams['sort'] == 'k_id' && isset($filterParams['order']) && $filterParams['order'] == 'asc') ? 'desc' : 'asc']); ?>">Id</a></th>
    <th><a href="<?php echo $block->getUrl('*/*/*', ['sort' => 'name', 'order' => (isset($filterParams['sort']) && $filterParams['sort'] == 'name' && isset($filterParams['order']) && $filterParams['order'] == 'asc') ? 'desc' : 'asc']); ?>">Name</a></th>
    <th>Description</th>
    <th><a href="<?php echo $block->getUrl('*/*/*', ['sort' => 'rating', 'order' => (isset($filterParams['sort']) && $filterParams['sort'] == 'rating' && isset($filterParams['order']) && $filterParams['order'] == 'asc') ? 'desc' : 'asc']); ?>">Rating</a></th>
    <th>Is Active</th>
    <th>Created Date</th>
    <th>Update Date</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
 
    <?php
        echo $block->show();
       // echo $block->getData();
        echo $this->getLayout()
        ->createBlock('Magento\Cms\Block\Block')
        ->setBlockId('review')
        ->toHtml();
    ?>
 
</table>
<button type="submit" onclick="return confirm('Are you sure you want to delete selected items?')">Delete All</button>
            </form>
 
<!-- Display Filtered Data -->
 
<!-- Pagination Links -->
<?php echo $block->getPagerHtml() ?>
 
 



[11:46] Disha Pansuriya
block/task.php
<?php
// app/code/Kitchen/Review/Block/Task.php
 
namespace Kitchen\Review\Block;
 
use Magento\Framework\View\Element\Template\Context;
use Kitchen\Review\Model\ResourceModel\Reviews\CollectionFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Request\Http;
 
class Task extends \Magento\Framework\View\Element\Template
{
    protected $reviewsFactory;
    protected $urlBuilder;
    protected $editId;
    protected $reviewData;
    protected $request;
 
    public function __construct(
        Context $context,
        CollectionFactory $reviewsFactory,
        UrlInterface $urlBuilder,
        Http $request,
        array $data = []
    ) {
        $this->reviewsFactory = $reviewsFactory;
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
        $this->editId = $this->request->getParam('edit_id');
        parent::__construct($context, $data);
    }
 
    public function show()
    {
        // Retrieve filter parameters
        $filterParams = $this->getRequest()->getParams();
 
        // Create collection
        $collection = $this->reviewsFactory->create();
 
        $sortField = isset($filterParams['sort']) ? $filterParams['sort'] : 'name';
        $sortOrder = isset($filterParams['order']) ? $filterParams['order'] : 'asc';
        $collection->setOrder($sortField, $sortOrder);
 
        // Apply filters
        if (!empty($filterParams['name'])) {
            $collection->addFieldToFilter('name', ['like' => '%' . $filterParams['name'] . '%']);
        }
        if (isset($filterParams['is_active'])) {
            $collection->addFieldToFilter('is_active', $filterParams['is_active']);
        }
 
        // Iterate through the collection and display data
        foreach ($collection as $item) {
            echo "<tr>";
            echo '<td><input type="checkbox" name="delete_ids[]" value="' . $item->getKId() . '"></td>';
            echo "<td>".$item->getKId()."</td>";
            echo "<td>".$item->getName()."</td>";
            echo "<td>".$item->getDescription()."</td>";
            echo "<td>".$item->getRating()."</td>";
            echo "<td>".$item->getIsActive()."</td>";
            echo "<td>".$item->getCreationTime()."</td>";
            echo "<td>".$item->getUpdateTime()."</td>";
            echo "<td><a href='".$this->urlBuilder->getUrl('review/index/index', ['edit_id' => $item->getKId()])."'>Edit</a></td>";
            echo "<td><button onclick=\"window.location='".$this->urlBuilder->getUrl('review/index/delete', ['deleteid' => $item->getKId()])."'\">Delete</button></td>";
 
            echo "</tr>";
        }
    }
 
    public function getReviewData()
    {
        $editId = $this->getRequest()->getParam('edit_id');
        if ($editId) {
            $review = $this->reviewsFactory->create()->load($editId);
            return $review->getData();
        }
        return [];
    }
    public function getKId()
    {
        return $this->editId;
    }
 
    public function sayHello()
    {
        return __('Hello World');
    }
}
 
------------------------------------

index.phtml                                                                                                                                                                                                                                          <form action="<?php echo $block->getUrl('pradip/index/index') ?>" method="GET">
    <label>Select Status:</label>
    <select name="user_status" id="user_status">
        <option value="all">All</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
    </select>
    <button type="submit" name="submit">Filter</button>
    <br>
    <label for="sorting">Select Status:</label>
    <select name="sorting" id="sorting">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
    </select>
    <button type="submit" name="submit">Sort</button>
</form>

block/index.php
$userStatus = $this->getRequest()->getParam('user_status');
        $sorting = $this->getRequest()->getParam('sorting');
 
        $model = $this->galleryFactory->create();
        $collection = $model->getCollection();
 
        if ($userStatus !== null && $userStatus !== 'all') {
            $collection->addFieldToFilter('is_active', $userStatus);
        }
 
        if ($sorting !== null && ($sorting === 'ASC' || $sorting === 'DESC')) {
            $collection->setOrder('blog_id', $sorting);
        }
        
----------------------------------------------------------------
        <form action="<?php echo $block->getUrl('pradip/index/index') ?>" method="GET">
        <label>Select Status:</label>
        <select name="user_status" id="user_status">
            <option value="all">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
        </select>
        <button type="submit" name="submit">Filter</button>
        <br>
        <label for="sorting">Select Status:</label>
        <select name="sorting" id="sorting">
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
        </select>
        <button type="submit" name="submit">Sort</button>
    </form>


---------------------------------------------------

<?php

namespace Kitchen\Product\Block;

use Kitchen\Product\Model\GalleryFactory;
use Magento\Framework\UrlInterface;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $galleryFactory;
    protected $urlBuilder;
 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        GalleryFactory $galleryFactory,
        UrlInterface $urlBuilder
    ) {
        $this->galleryFactory = $galleryFactory;
        $this->urlBuilder = $urlBuilder;
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
        
        $model = $this->galleryFactory->create();
        $collection = $model->getCollection();
 
        foreach ($collection as $item) {
            echo "<tr>";
            echo "<td>".$item->getEntityId()."</td>";
            echo "<td>".$item->getName()."</td>";
            echo "<td>".$item->getSku()."</td>";
            echo "<td>".$item->getPrice()."</td>";
            echo "<td>".$item->getSortOrder()."</td>";
            echo "<td>".$item->getIsActive()."</td>";
            echo "<td><a href='".$this->urlBuilder->getUrl('pro/index/index', ['entity_id' => $item->getEntityId()])."'>Edit</a></td>";
            echo "<td><a href='".$this->urlBuilder->getUrl('pro/index/delete', ['entity_id' => $item->getEntityId()])."'>Delete</a></td>";
            echo "</tr>";
        }
    }
}
============================================================================================================================================

promot.phtml

<?php if ($block->isModuleEnabled('Yes')): 

    $currentTime = strtotime('now');

    $start = strtotime($block->getStartDate());
    $end = strtotime($block->getEndDate());

    if (($currentTime == $start || $currentTime > $start) && $currentTime <= $end) :
?>
    <div>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>IsActive</th>
            </tr>
            <tr>
                <td><?php echo $block->getDisplayName(); ?></td>
                <td><?php echo $block->getDisplayDescription(); ?></td>
                <td><?php echo $block->getStartDate(); ?></td>
                <td><?php echo $block->getEndDate(); ?></td>
                <td><?php echo $block->isActive(); ?></td>
            </tr>
        </table>
    </div>
    <?php elseif($currentTime < $start): ?>
        <h4>Coming Soon..</h4>
<?php else : ?>
     <h4>Validity expire...</h4>
<?php endif; ?>
<?php endif; ?>
--------------------------------------------------
MODEL


PROMOT.PHP

<?php

namespace Kitchen\Blog\Model\Config\Source;

use Kitchen\Blog\Model\GalleryFactory;

class Promot implements \Magento\Framework\Option\ArrayInterface
{
    protected $galleryFactory;

    public function __construct(
        GalleryFactory $galleryFactory
    ) {
        $this->galleryFactory = $galleryFactory;
    }

    public function toOptionArray()
    {
        return [
            ['value' => '2', 'label' => 'Not'],
            ['value' => '1', 'label' => 'Active'],
            ['value' => '0', 'label' => 'De-Active']
        ];
    }
}
---------------------------------------------------------------------------------------------------

Promotion.PHP
<?php
    namespace Kitchen\Blog\Block;
 
    use Kitchen\Blog\Model\GalleryFactory;
    use Magento\Framework\UrlInterface;
    use Magento\Framework\View\Element\Template\Context;
    use Magento\Framework\App\Config\ScopeConfigInterface;
 
    class Promotion extends \Magento\Framework\View\Element\Template
    {
        protected $galleryFactory;
        protected $urlBuilder;
        protected $scopeConfig;
 
        public function __construct(
            Context $context,
            ScopeConfigInterface $scopeConfig,
            GalleryFactory $galleryFactory,
            UrlInterface $urlBuilder
    )
    {
        $this->galleryFactory = $galleryFactory;
        $this->urlBuilder = $urlBuilder;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function isModuleEnabled()
    {
        return $this->scopeConfig->getValue('info/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getDisplayName()
    {
        return $this->scopeConfig->getValue('info/general/name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getDisplayDescription()
    {
        return $this->scopeConfig->getValue('info/general/description', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getStartDate()
    {
        return $this->scopeConfig->getValue('info/general/startDate', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getEndDate()
    {
        return $this->scopeConfig->getValue('info/general/endDate', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function isActive()
    {
        return $this->scopeConfig->getValue('info/general/isActive', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
