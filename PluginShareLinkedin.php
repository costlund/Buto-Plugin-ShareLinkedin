<?php
class PluginShareLinkedin{
  function __construct() {
    wfPlugin::includeonce('wf/yml');
  }
  public function page_demo(){
    wfPlugin::enable('share/linkedin');
    wfPlugin::enable('icons/bootstrap_v1_8_1');
    $widget = wfDocument::createWidget('share/linkedin', 'button_share_page');
    wfDocument::renderElement(array($widget));
  }
  public function widget_button_share_page($data){
    $data = new PluginWfArray($data);
    if(!$data->get('data/u')){
      if(wfRequest::get('u')){
        $data->set('data/u', wfRequest::get('u'));
      }else{
        $data->set('data/u', wfServer::calcUrl(true));
      }
    }
    $data->set('data/href', 'https://www.linkedin.com/sharing/share-offsite/?url'.$data->get('data/u'));
    $element = wfDocument::getElementFromFolder(__DIR__, __FUNCTION__);
    $element->setByTag($data->get('data'));
    wfDocument::renderElement($element);
  }
}