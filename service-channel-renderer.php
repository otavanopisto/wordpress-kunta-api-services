<?php
  namespace KuntaAPI\Services;

  use KuntaAPI\Services\ServiceChannelMapper;
		
  defined( 'ABSPATH' ) || die( 'No script kiddies please!' );
  
  require_once( __DIR__ . '/vendor/autoload.php');
  require_once( __DIR__ . '/service-channel-mapper.php');
  
  if (!class_exists( 'KuntaAPI\Services\ServiceChannelRenderer' ) ) {
    class ServiceChannelRenderer {
      
      private $twig;
      
      public function __construct() {
        $this->twig = new \Twig_Environment(new \Twig_Loader_Filesystem( __DIR__ . '/templates'));
      }
      
      public function renderElectronicChannel($serviceId, $electronicChannel, $lang) {
        $channelData = ServiceChannelMapper::mapElectronicChannel($serviceId, $electronicChannel)[$lang];
        return $this->twig->render("electronic-service-channel.twig", $channelData);
      }
      
      public function renderPhoneChannel($serviceId, $phoneChannel, $lang) {
        $channelData = ServiceChannelMapper::mapPhoneChannel($serviceId, $phoneChannel)[$lang];
        return $this->twig->render("phone-service-channel.twig", $channelData);
      }
      
      public function renderPrintableFormChannel($serviceId, $printableFormChannel, $lang) {
        $channelData = ServiceChannelMapper::mapPrintableFormChannel($serviceId, $printableFormChannel)[$lang];
        return $this->twig->render("printable-form-service-channel.twig", $channelData);
      }
      
      public function renderServiceLocationChannel($serviceId, $serviceLocationChannel, $lang) {
        $channelData = ServiceChannelMapper::mapServiceLocationChannel($serviceId, $serviceLocationChannel)[$lang];
        return $this->twig->render("service-location-service-channel.twig", $channelData);
      }
      
      public function renderWebPageChannel($serviceId, $webPageChannel, $lang) {
        $channelData = ServiceChannelMapper::mapWebPageChannel($serviceId, $webPageChannel)[$lang];
        return $this->twig->render("webpage-service-channel.twig", $channelData);
      }
      
    }  
  }
?>