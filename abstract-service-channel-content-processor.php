<?php
  namespace KuntaAPI\Services;
  
  require_once( __DIR__ . '/vendor/autoload.php');
    
  if (!defined('ABSPATH')) { 
    exit;
  }
  
  if (!class_exists( 'KuntaAPI\Services\AbstractServiceChannelContentProcessor' ) ) {
    
    abstract class AbstractServiceChannelContentProcessor extends \KuntaAPI\Core\AbstractContentProcessor {

      private $type;
      private $renderer;
      
      public function __construct($type) {
        $this->type = $type;
        $this->renderer = new ServiceChannelRenderer();
      }

      public function process($lang, $dom, $mode) {

        foreach ($dom->find('*[data-type="'. $this->type .'"]') as $article) {
          $serviceId = $article->{'data-service-id'};
          $serviceChannelId = $article->{'data-service-channel-id'};
          if($mode == 'edit') {
             $article->class = 'mceNonEditable';
          } else {
            $article->removeAttribute('data-service-id');
            $article->removeAttribute('data-type');
            $article->removeAttribute('data-service-channel-id');
          }
          
          $article->innertext = $this->renderServiceChannelContent($serviceId, $serviceChannelId, $lang);
        } 
      }
      
      public abstract function renderServiceChannelContent($serviceId, $serviceChannelId, $lang);
      
      protected function getRenderer() {
        return $this->renderer;
      }
      
    }
  }
  
?>