<?php
namespace xavoc_acl;

class page_user_management extends \Page {
	public $crud;

	function init(){
		parent::init();
		$acl=$this->add('xavoc_acl/Acl');
	}

	function page_index(){
		$this->crud=$this->add('CRUD');
		$this->crud->setModel('xavoc_acl/ACLUser');

		if($this->crud->grid){
			$this->crud->grid->addColumn('Expander','acls');
		}
	}

	function page_acls(){
		$this->api->stickyGET('users_id');
		$user=$this->add('xavoc_acl/Model_ACLUser');
		$user->load($_GET['users_id']);
		if($user['is_system_admin']){
			$this->add('View_Error')->set('This user is not allowed to edit acls, This has all the permissions');
			return;
		}

		$map=$user->ref('xavoc_acl/Acl');
		if($map->count()->getOne() == 0) {
			$this->add('View_Info')->set('Log in with this account and try to access pages to make a request for admin');
		}
		
		$v=$this->add('View');
		$v->addClass('atk-box ui-widget-content ui-corner-all')
		        ->addStyle('background','#eee');
		$grid=$v->add('Grid');
		$grid->addClass('acl_grid');
		$grid->js('reloadgrid',$grid->js()->reload());
		$grid->setModel($map);

		$grid->addColumn('Expander','edit');
	}

	function page_acls_edit(){
		$this->api->stickyGET('acl_users_id');
		$v=$this->add('View');
		$v->addClass('atk-box ui-widget-content ui-corner-all')->addStyle('background','#aaa');
		$form=$v->add('Form');
		
		$m=$this->add('xavoc_acl/Model_Acl');
		$m->load($_GET['acl_users_id']);
		$m->addCondition('acl_user_id',$m['acl_user_id']);
		$m->addCondition('page_id',$m['page_id']);

		$form->setModel($m);
		$form->addSubmit('Update');

		if($form->isSubmitted())
		{
			$form->update();
			$form->js(null,$form->js()->_selector('.acl_grid')->trigger('reloadgrid'))->univ()->closeExpander()->execute();
		}
	}
}