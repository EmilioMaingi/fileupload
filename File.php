<?php 


class File {
	private $_errors = array();
	private $_fileurl = array();
	private $_tempName = array();
	private $_validated = false;

	public function processFile($files, $saveUrl){
		 if ($files) {
		   foreach ($files as $name) {
		    	$this->_tempName[] = $_FILES[$name]['tmp_name'];
		    	$fileSize = $_FILES[$name]['size'];
		    	$fileError = $_FILES[$name]['error'];
		    	$fileType = $_FILES[$name]['type'];

		    	$fileExte = explode('/', $fileType);
		    	$fileExt = strtolower(end($fileExte));
		    	$allowed = array('jpg', 'jpeg', 'png');

		    	if (in_array($fileExt, $allowed)) {
		    		if ($fileError === 0) {
		    			if ($fileSize < 1000000000) {
		    				$fileNewName = uniqid('', true).'.'.$fileExt;
		    				$fileDestination = $saveUrl.$fileNewName;
		    				$this->addFile($fileDestination);
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

	private function addFile($url) {
		$this->_fileurl[] = $url;
	}

	public function moveFile($index){
		move_uploaded_file($this->_tempName[$index], BASEURL.'/'.$this->_fileurl[$index]);
		return true;
	}

	public function getURL($index){
		return $this->_fileurl[$index];
	}

	public function validated(){
		return $this->_validated;
	}

	public function errors(){
		return $this->_errors;
	}
}
