<?php 
namespace Cp\User\Api;
 
 
interface CpApiInterface {


	/**
	 * GET for Post api
	 * @return string
	 */
	
	public function getInfo();

	
	 /**
   * POST for test api
   * @param string[] $data
   * @return string
   */
  public function save($data);


   /**
    * Get Users
    *
    * @return array
    */
	public function getUsers();


   /**
    * Delete User by ID
    *
    * @param int $id
    * @return bool
    */
	public function deleteUser($id);

	/**
    * GET for Post api
    * @param int $id
    * @param string $name
    * @param string $email
    * @param int $password
    * @param int $aid
    * @return string
    */
	public function updateUser($id,$name,$email,$password,$aid);



	}





