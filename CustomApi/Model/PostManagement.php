<?php 

namespace Kitchen\CustomApi\Model;

use Kitchen\CustomApi\Api\PostManagementInterface;
use Kitchen\Product\Model\GalleryFactory;


 
// class PostManagement {

// 	/**
// 	 * {@inheritdoc}
// 	 */
// 	public function getPost()
// 	{
// 		return 'api GET return the try ' ;
// 		// echo 11;
// 		// die();
// 	}
// 	public function getEdit($name);
// }



class PostManagement 
{
    private $galleryFactory;
    protected $response = ['success' => false];

    public function __construct(
		galleryFactory $galleryFactory
		)
        {
            $this->galleryFactory = $galleryFactory;
        }

// data insert
    /** * POST for Post api * @param array $data * @return string */
    public function saveData($data)
    {
        $insertData = $this->galleryFactory->create();
        try {
            $insertData->setName($data['name'])
			
			->save();
            $response = ['success' => true, 'message' => $data];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }


// data get
    /** * @return string */
    public function getUserData()
    {
        try {
            $data = $this->galleryFactory->create()->getCollection()->getData();
            // return $data;
			return ['success' => true, 'data' => $data];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


// data delete
    /** * @param int $entity_entity_id * @return bool true on success */
    public function getDelete($entity_entity_id)
    {
        try {
            if ($entity_entity_id) {
                $data = $this->galleryFactory->create()->load($entity_entity_id);
                $data->delete();
                return "success";
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return "false";
    }

// data update

    public function updateUser($entity_id,$name,$sku,$price,$sort_order)
        {
            
            if ($entity_id) {
                try {
                    $model = $this->galleryFactory->create()->load($entity_id);
                    $model->setName($name);
                    $model->setSku($sku);
                    $model->setPrice($price);
                    $model->setSortOrder($sort_order);
        
                    $model->save();
                    
                    $response = ['status' => true, 'message' => 'updated successfully.'];
                    return $response;
                } catch (\Exception $e) {
                    $this->logger->error('Error in updateTaxRate: ' . $e->getMessage());
                    return ['status' => false, 'message' => $e->getMessage()];
                }
            } 
        }
}