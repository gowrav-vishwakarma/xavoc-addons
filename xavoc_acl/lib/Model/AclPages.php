<?php

namespace xavoc_acl;

class Model_AclPages extends \Model_Table {
	var $table= "acl_pages";
	function init(){
		parent::init();
		$this->addField('name');
		$this->hasMany('xavoc_acl/Acl','page_id');
	}
}