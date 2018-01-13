<?php
	namespace App\Http\Controllers\Backend\commons;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Intervention\Image\ImageManagerStatic as Image;
	class ImageMaker extends Controller
	{
		public function base64ToImage($pathToStore,$imageName)
		{
			$image="Test";
	        if( preg_match('/data:image/', $imageName) ){                
				preg_match('/data:image\/(?<mime>.*?)\;/', $imageName , $groups);
				$mimetype = $groups['mime'];
				           
				$image='images/'.$imageName.'.'.$mimetype;
				$image = Image::make($imageName)
				->fit(400, 500) 
				->encode($mimetype, 100) 
				->save(public_path($image));                
	      	}
	      	return $image;
		}
	}
?>