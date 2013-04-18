<?php

namespace xavoc_acl;

class Acl extends \AbstractController{
	public $page_name=null;
	public $acl_table=null;
	public $redirect_to=null;
	public $allowed_attempts=3;

	private $user;
	private $user_acl;
	private $page;

	function init(){
		parent::init();
		if($this->page_name === null ) $this->page_name = $this->owner->short_name;

		$this->user= $this->add('xavoc_acl/Model_ACLUser');
		$this->user->load($this->api->auth->model->id);

		$this->page = $this->add('xavoc_acl/Model_AclPages');
		$this->page->addCondition('name',$this->page_name);
		$this->page->tryLoadAny();
		if(!$this->page->loaded()){
			$this->page->save();
			if(!$this->user['is_system_admin'])
				throw $this->exception('This page is first time loaded, Added to system, Let System administrator manage it for you');
		} 

		$this->user_acl=$this->user->ref('xavoc_acl/Acl')->addCondition('page_id',$this->page->id)->tryLoadAny();
		if(!$this->user_acl->loaded()) {
			if($this->user['is_system_admin']){
				$this->user_acl['allowed']=true;
				$this->user_acl['permissions']=30;
			}
			$this->user_acl->save();
			if(!$this->user['is_system_admin'])
				throw $this->exception('This is your first access to this page, Your request is sent to administrator');
		}
		if($this->user_acl['allowed']==false){
			throw $this->exception('You are not allowed to access the page');
		}

	}

	function getPermissions(){
		$array=array('allow_add'=>false,'allow_edit'=>false,'allow_del'=>false, 'allow_delete'=>false);
		if($this->user_acl['permissions'] == 0) return $array;
		
		if($this->user_acl['permissions'] % 2 == 0) $array['allow_add']=true;
		if($this->user_acl['permissions'] % 3 == 0) $array['allow_edit']=true;
		if($this->user_acl['permissions'] % 5 == 0) $array['allow_del']=$array['allow_delete']=true;
		return $array;
	}

}