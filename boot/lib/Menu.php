<?php
namespace boot;
class Menu extends \Menu {

	public $current_menu_class="active";
    public $inactive_menu_class="";
    public $fixed_top=true;

	function initializeTemplate(){
		$l = $this->api->locate('addons',__NAMESPACE__,'location');
		$addon_location = $this->api->locate('addons',__NAMESPACE__);
		$this->api->pathfinder->addLocation($addon_location,array(
			'js'=>'js',
			'css'=>'css',
			'template'=>'templates'
		))->setParent($l);
		parent::initializeTemplate();
	}

	function init(){
		parent::init();
	}

	function setBrand($brand="Xavoc"){
		$this->template->trySetHTML('brand',$brand);
		return $this;
	}

	function render(){
		if(!$this->fixed_top) $this->template->tryDel('fixed_top');
		parent::render();
	}

	function defaultTemplate(){
        return array('view/menu','Menu');
    }
}