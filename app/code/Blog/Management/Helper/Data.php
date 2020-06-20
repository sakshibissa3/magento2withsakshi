<?php
namespace Blog\Management\Helper;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\Context;



class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $transportBuilder;
    protected $storeManager;
    protected $inlineTranslation;
    protected $logger;
    
    public function __construct(
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


        parent::__construct($context);
    }

   public function sendemail($templateId,$fromEmail, $fromName, $toEmail,$templateVars )
   {
     try {
        // template variables pass here
        
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
      $this->inlineTranslation->resume();
     } 
    catch (\Exception $e) {
    $this->logger->info($e->getMessage());
    }
    }
}