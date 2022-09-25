<?php

class FileUploadController extends AppController {
	public function index() {
		$this->set('title', __('File Upload Answer'));
		// debug(json_encode($this->request->params));exit;
		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
	}

	public function upload() {
		$data = $this->request->data;
		$file = $data['FileUpload']['file']['tmp_name'];
		ini_set('auto_detect_line_endings', TRUE);
		$lines = file($file, FILE_IGNORE_NEW_LINES);

		foreach ($lines as $key => $value)
		{
			$current = str_getcsv($value);
			if ($current[0] === 'Name') {
				continue;
			}
			$myArray = explode(',', $value);
			$this->FileUpload->create();
			$this->FileUpload->save(['name'=>$myArray[0], 'email'=> $myArray[1]]);
			
		}
		$handle = fopen($file, "r");
	
		$this->setSuccess();
		$this->redirect('/FileUpload');
	}
}