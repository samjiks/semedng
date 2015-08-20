<?php
defined('SYSPATH') OR die('No Direct Script Access');
abstract class Controller_CController extends Controller_Template
{
	public $template = 'hmo_masterpage';
	public $other_template = '';
	protected $theme;
	protected $session;
	protected $cache;
	public $authenticate=true;
	protected $site;
	public $message=array();
	protected $user=null;
	protected $owner=array();
	
	public function before()
	{
		View::bind_global('site', $this->site);
		View::bind_global('message', $this->message);
		View::bind_global('user', $this->user);
	}
	public function __construct($request)
	{
		parent::__construct($request);
		$this->template=View::factory('hmo_masterpage');

		$config=Kohana_Config::instance()->load("config");
		$this->site=$config['app_path'];

		$this->session=Session::instance();
		if($this->authenticate)
			$this->authenticate();
		$this->message=I18n::load('en-us');

	}
	public function logged_in($role='login')
	{
		return Auth::instance()->logged_in($role);
	}
	protected function authenticate()
	{
		if(!Auth::instance()->logged_in()):
			$this->session->set('redirect',Request::detect_uri());
			$this->request->redirect($this->site."/login");
		else:
			$this->user=Auth::instance()->get_user();
		endif;
	}
}
?>