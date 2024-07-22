<?php 

namespace Kitchen\CustomApi\Api;
 
interface PostManagementInterface {

	/**
	 * GET for Post api
	 * @return string
	 */
	
	// public function getPost();
	/**
     * POST for Post api
     * @param string[] $data
     * @return string
     */
    public function saveData($data);

    /**
     * @return string
     */
    public function getUserData();

    /**
     * @param int $entity_id
     * @return bool true on success
     */
    public function getDelete($entity_id);


    	/**
    * GET for Post api
    * @param int $entity_id
    * @param string $name
    * @param string $sku
    * @param int $price
    * @param string $sort_order
    * @return string
    */
	public function updateUser($entity_id,$name,$sku,$price,$sort_order);

}


