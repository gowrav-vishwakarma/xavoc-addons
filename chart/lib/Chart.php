<?php
namespace chart;

class Chart extends \View {
	public $options;
	var $_debug;

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
		$this->_debug=false;
	}

	function defaultTemplate(){
		return array('view/chart');
	}

	
	function setChartType($charttype){
		$this->options['chart']['type']=$charttype;
		return $this;
	}

	function setTitle($title,$title_x_posistion=-20, $subtitle="",$subtitle_x_position=-20){
		$this->options['title']=array(
			'text'=>$title,
			'x'=>$title_x_posistion
			);
		$this->options['subtitle']=array(
			'text'=>$subtitle,
			'x'=>$subtitle_x_posistion
			);
		return $this;
	}

	function setXAxis($x_Axis){
		$this->options['xAxis']['categories']=$x_Axis;
		return $this;
	}

	function setXAxisTitle($x_Axis_Title){
		$this->options['xAxis']['title']['text']=$x_Axis_Title;
		return $this;
	}

	function setYAxisTitle($y_Axis){
		$this->options['yAxis']['title']['text']=$y_Axis;
		return $this;	
	}

	function setLegendsOptions($options){
		$this->options['legend']=$options;
		return $this;
	}

	function setData($data){
		$this->options['series']['data']=$data;
	}

	function debug(){
		$this->_debug=true;
	}

	function render(){
		// $this->options['series']=array(
		// 		array(
		// 			"name"=>"tokyo",
		// 			"data"=>array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6)
		// 			)
		// 	);
		// if(!isset($this->options['series'])) $this->options['series']=array();
		$this->options['chart']['renderTo']=$this->name;
		// if(!isset($this->options['chart']['type'])) $this->options['chart']['type']='line';
		$this->js(true)
				->_load('highcharts')
				->_load('chart')
				->univ()->draw($this->name,json_encode($this->options),$this->_debug);
		parent::render();
	}
}