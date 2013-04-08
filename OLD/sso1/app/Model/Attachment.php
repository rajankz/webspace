<?php
/**
 * User: rajankz
 * Date: 9/29/12
 * Time: 04:28 PM
 */

class Attachment extends AppModel{

	var $name = "Attachment";
	var $useTable = "attachments";

	public $actsAs = array( 
	'Uploader.Attachment' => array(
		'file' => array(
			'name'		=> '',	// Name of the function to use to format filenames
			'baseDir'	=> '',			// See UploaderComponent::$baseDir
			'uploadDir'	=> '/uploads/2012/',			// See UploaderComponent::$uploadDir
			'dbColumn'	=> 'link',	// The database column name to save the path to
			'importFrom'	=> '',			// Path or URL to import file
			'defaultPath'	=> '',			// Default file path if no upload present
			'maxNameLength'	=> 30,			// Max file name length
			'overwrite'	=> true,		// Overwrite file with same name if it exists
			'stopSave'	=> true,		// Stop the model save() if upload fails
			'allowEmpty'	=> true,		// Allow an empty file upload to continue
			'transforms'	=> array(),		// What transformations to do on images: scale, resize, etc
			's3'		=> array(),		// Array of Amazon S3 settings
			'metaColumns'	=> array(		// Mapping of meta data to database fields
				'ext' => '',
				'type' => '',
				'size' => '',
				'group' => '',
				'width' => '',
				'height' => '',
				'filesize' => ''
			)
		)
	)
	);
	
	
	public function beforeSave() {
		$worksheetId = $this->data['Attachment']['worksheetId'];
		$this->actsAs['Uploader.Attachment']['file']['uploadDir'] = '/uploads/'.$worksheetId.'/';
	}
	
}

?>