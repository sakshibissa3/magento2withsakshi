<?php 
namespace Blog\Management\Helper;

use Magento\Framework\App\Helper\Context;


class User extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_userFactory;
    protected $_dataExample;


public function __construct(
    \Magento\User\Model\UserFactory $userFactory,
    Context $context,
    \Blog\Management\Model\DataExampleFactory  $dataExample


) {
    $this->_userFactory = $userFactory;
    $this->_dataExample = $dataExample;

    parent::__construct($context);

}

public function createuser()
{
    $resultPage = $this->_dataExample->create();
    $model = $this->_dataExample->create();
    $data = $model->load(); 
   $formdata =  $data->getData(); 
    

    $adminInfo = [
        'username'  => $formdata['a_name'].'user',
        'firstname' => $formdata['a_name'].'firstname',
        'lastname'    => $formdata['a_name'].'lastname',
        'email'     => $formdata['a_email'],
        'password'  =>$formdata['a_name'].'@123',       
        'interface_locale' => 'en_US',
        'is_active' => 1,
        'role_id' => '7'
    ];
    $userModel = $this->_userFactory->create();
    $userModel->setData($adminInfo);
    $userModel->setRoleId(1,2,3);
    try{
       $userModel->save(); 
    } catch (\Exception $ex) {
        $ex->getMessage();
    }
}

}