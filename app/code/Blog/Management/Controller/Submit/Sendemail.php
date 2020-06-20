<?php
namespace Blog\Management\Controller\Submit; 

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Blog\Management\Model\DataExampleFactory;
class Sendemail extends \Magento\Framework\App\Action\Action
{

    protected $transportBuilder;
    protected $storeManager;
    protected $inlineTranslation;
    protected $logger;
    protected $_dataExample;




    public function __construct(
        \Blog\Management\Model\DataExampleFactory  $dataExample,
        Context $context,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        \Psr\Log\LoggerInterface $logger,
        StateInterface $state
        
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        $this->logger = $logger;
        $this->_dataExample = $dataExample;


        parent::__construct($context);
    }
  public function execute() {
    $data = $this->getRequest()->getParams();
    //echo "<pre>"; print_r($data); exit; 
    $model = $this->_dataExample->create();
    $model->setData($data);
    $saveData = $model->save();
    if($saveData){
        $this->messageManager->addSuccess( __('Insert Record Successfully !') );
    }

            echo "submitted successfully!"; 
            $this->_view->loadLayout();
            $this->_view->getLayout()->initMessages();
            $this->_view->renderLayout();
            $this->sendEmail(); 
  }
  public function sendEmail()
    {
       // echo "hi"; exit; 
        // this is an example and you can change template id,fromEmail,toEmail,etc as per your need.
        $templateId = 'custom_module_email_template'; // template id
        $fromEmail = 'magento2withsakshi@test.com';  // sender Email id
        $fromName = 'Admin';             // sender Name
        $toEmail = 'gaurav.vyas0315@gmail.com'; // receiver email id
 
        try {

            // template variables pass here
            $templateVars = [
                'msg' => 'test',
                'msg1' => 'test1'
            ];
 
            $storeId = $this->storeManager->getStore()->getId();

            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();

            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];

            $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($toEmail)
                ->getTransport();

            $transport->sendMessage();
          //  echo 'hello2'; exit; 

            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
         //   echo "hi"; exit; 
            $this->logger->info($e->getMessage());
        }
    }
}