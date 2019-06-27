<?php 


class Image {
	private $_errors = array();
	private $_imageurl = array();
	private $_tempName = array();
	private $_validated = false;

	public function processImage($images, $saveUrl){
		 if ($images) {
		 	foreach ($images as $name) {
		    	$image = $_FILES[$name];
		    	$imagename = $_FILES[$name]['name'];
		    	$this->_tempName[] = $_FILES[$name]['tmp_name'];
		    	$imageSize = $_FILES[$name]['size'];
		    	$imageError = $_FILES[$name]['error'];
		    	$imageType = $_FILES[$name]['type'];

		    	$imageExte = explode('/', $imageType);
		    	$imageExt = strtolower(end($imageExte));
		    	$allowed = array('jpg', 'jpeg', 'png');

		    	if (in_array($imageExt, $allowed)) {
		    		if ($imageError === 0) {
		    			if ($imageSize < 1000000000) {
		    				$imageNewName = uniqid('', true).'.'.$imageExt;
		    				$imageDestination = $saveUrl.$imageNewName;
		    				$this->addImage($imageDestination);
		    				if (empty($this->_errors)) {
		    					$this->_validated = true;
		    				}
		    			}else{
		    				$this->addError('The '.$name.' you uploaded is too big.');
		    			}
		    		}else{
		    			$this->addError('There was a problem uploading '.$name.'. Please try again.');
		    		}
		    	}else{
		    		$this->addError('Please upload '.$name.' with a png, jpg or jpeg extension.');
		    	}
		    }
	    }
	}

	private function addError($error) {
		$this->_errors[] = $error;
	}

	private function addImage($url) {
		$this->_imageurl[] = $url;
	}

	public function moveImage($index){
		move_uploaded_file($this->_tempName[$index], BASEURL.'/'.$this->_imageurl[$index]);
		return true;
	}

	public function getURL($index){
		return $this->_imageurl[$index];
	}

	public function validated(){
		return $this->_validated;
	}

	public function errors(){
		return $this->_errors;
	}
}