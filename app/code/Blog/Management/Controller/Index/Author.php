<?php
namespace Blog\Management\Controller\Index; 

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Blog\Management\Model\DataExampleFactory;
use Magento\Framework\DataObject; 

class Author extends \Magento\Framework\App\Action\Action
{

    protected $transportBuilder;
    protected $storeManager;
    protected $inlineTranslation;
    protected $logger;
    protected $_dataExample;
    protected $helperData;
    protected $helperUser; 
    protected $dataObject;


    public function __construct(
        \Blog\Management\Model\DataExampleFactory  $dataExample,
        Context $context,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        \Psr\Log\LoggerInterface $logger,
        StateInterface $state,
        \Blog\Management\Helper\Data $helperData,
        \Blog\Management\Helper\User $helperUser,
        DataObject $dataObject

    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        $this->logger = $logger;
        $this->_dataExample = $dataExample;
        $this->helperData = $helperData;
        $this->helperUser = $helperUser; 
        $this->DataObject = $dataObject; 

        parent::__construct($context);
    }
  public function execute() {

    if (isset($_POST['submit'])) {
    $data = $this->getRequest()->getParams();
    $aemail = $data['a_email']; 
    $model = $this->_dataExample->create();
    $model->setData($data);
    $saveData = $model->save();
    if($saveData){
        $this->messageManager->addSuccess( __('Insert Record Successfully !') );
    }
    $templateId = 'custom_module_email_template'; // template id
    $fromEmail = 'magento2withsakshi@test.com';  // sender Email id
    $fromName = 'Magento2withSakshi';             // sender Name
    $toEmail = 'saku.bissa@gmail.com'; // receiver email id
    $templateVars = ['data' => new DataObject($data)];

    $this->helperData->sendemail($templateId,$fromEmail,$fromName,$toEmail, $templateVars);
    $this->helperUser->createuser(); 
       
      }
      return $this->resultFactory->create(ResultFactory::TYPE_PAGE);

    }
}