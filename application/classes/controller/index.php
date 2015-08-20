<?php
defined('SYSPATH') OR die('No Direct Script Access');
class Controller_Index extends Controller_CController
{
	protected $model;
	public function __construct($request)
	{
		parent::__construct($request);
	}
	
	public function action_index()
	{
		$view = View::factory('home');
		Model::factory('treatmentcyclemd')->elapse_all();
		if(Auth::instance()->logged_in("consultant"))
			$this->request->redirect("patient/consultant/".Text::random());	
		elseif(Auth::instance()->logged_in("technician"))
			$this->request->redirect("patient/technician/".Text::random());	
		
/*		elseif(Auth::instance()->logged_in("nhis") OR Auth::instance()->logged_in("nhisuser"))
			$this->request->redirect("patient/status");	
*/					
		
		$this->template->content=$view;
	}
	
	function action_getimage()
  	{
		$this->template='';
		if(isset($_GET["id"]))
		{
			header("Content-Type: image/jpeg");
			$id=$_GET["id"];
			$obj=Model::factory("membermd")->SelectById($id,$this->owner['id']);
		   
		   $path=$obj['picture'];
		   $percent = $_GET["pt"];
		   $image;
		
			// Get new dimensions
			list($width, $height,$type) = getimagesize($path);
			if($width <=70)
				$percent=1;
					
			$new_width = $width * $percent;
			$new_height = $height * $percent;
			
			// Resample
			$image_p = imagecreatetruecolor($new_width, $new_height);
			if($type==IMAGETYPE_JPEG)
				$image = imagecreatefromjpeg($path);
			if($type==IMAGETYPE_GIF)
				$image = imagecreatefromgif($path);	
			if($type==IMAGETYPE_PNG)
				$image = imagecreatefrompng($path);	
				
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			// Output
			if($type==IMAGETYPE_JPEG)
				imagejpeg($image_p, null, 100);
			else if($type==IMAGETYPE_GIF)
				imagegif($image_p);
			else if($type==IMAGETYPE_PNG)
			imagepng($image_p);
		}
  }
}
?>
