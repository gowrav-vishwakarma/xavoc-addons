<?php

namespace xavoc_acl;

class Model_Acl extends \Model_Table {
	var $table= "acl_users";

	function init(){
		parent::init();
		$this->hasOne('xavoc_acl/ACLUser','acl_user_id');
		$this->hasOne('xavoc_acl/AclPages','page_id');
		$this->addField('allowed')->type('boolean');
		$this->addField('permissions')->defaultValue(0)
			->setvalueList(
				array(
					'0'=>'Only View',
					'2'=>"Only Add",
					'3'=>"Only Edit",
					'5'=>'Only Delete',
					'6' =>' Add + Edit',
					'10' => 'Add + Delete',
					'15' =>'Edit + Delete',
					'30' =>' All'
					)
				)
			;

	}


}