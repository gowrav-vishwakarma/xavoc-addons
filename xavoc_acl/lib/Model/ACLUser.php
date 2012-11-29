<?php
namespace xavoc_acl;

class Model_ACLUser extends \Model_Table {
	var $table= 'users';

	function init(){
		parent::init();
		$this->addField('username');
		$this->addField('password');
		$this->addField('is_system_admin')->type('boolean')->defaultValue(false)->system(true);
		$this->hasMany('xavoc_acl/Acl','acl_user_id');

		$this->addExpression('name')->set('username');
		
		$this->addHook('beforeDelete',$this);
	}

		function beforeDelete(){
		if($this['is_system_admin']) throw $this->exception('You cannot delete System Administrator');
	}
}