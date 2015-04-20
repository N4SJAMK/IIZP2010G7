<?php
class MongoDumper {
    private $_BACKUP_FILE = "";
  
	private $_BACKUP_FOLDER = "/tmp/";
	//private $_CURRENT_DATE_TIME = ""; 
	private $current_dump_path = "";
	//private $database = "";
	private $files_to_delete = array();
	private $debug = false;
	public function __construct($backup_file) {
		//$now = new DateTime;
		//$this->_BACKUP_FOLDER = rtrim($backup_folder, '/');
		//$this->_CURRENT_DATE_TIME = $now->format('d-m-Y_H-i');
      $this->_BACKUP_FILE = $backup_file;
	}
	public function run($debug = false) {
		$this->debug = ($debug === true);
		try {
			//$this->current_dump_path = $this->_BACKUP_FOLDER . "/" . $database . "_" . $this->_CURRENT_DATE_TIME;
            $this->current_dump_path = "/tmp/dump";
          
			//$this->database = $database;
			//$this->echo_if_debug("<p><strong>Backing up '" . $database . "' to '" . $this->current_dump_path . "'</strong></p>");
			$this->echo_if_debug("<ol>");
			//$this->echo_if_debug("<li>Executing mongodump...</li>");
			//$this->mongodump();
          
            $this->echo_if_debug("<li>Unzipping...</li>");
			unzip_files();
          
            $this->echo_if_debug("<li>Executing import...</li>");
            mongoundump();
          
			//$this->echo_if_debug("<li>Zipping files...</li>");
			//$this->zip_files();
          
			$this->echo_if_debug("<li>Deleting dump folder...</li>");
			//$this->delete_dump_folder();
			$this->echo_if_debug("<li>Complete!</li>");
			$this->echo_if_debug("</ol>");
			return;
		}
		catch (Exception $ex) {
			return false;
		}
	}
	private function echo_if_debug($string) {
		if ($this->debug) {
			echo $string;
		}
	}
  
    private function mongoundump() {
      $command = "mongorestore " . $this->current_dump_path;
      $results = shell_exec($command);
	  $this->echo_if_debug("<ul><li>" . $command . "</li><li>".$results."</li></ul>");
    }
  
    /*
	private function mongodump() {
		$command = "mongodump --db " . $this->database . " --out " . $this->current_dump_path;
	    $results = shell_exec($command);
	    $this->echo_if_debug("<ul><li>" . $command . "</li><li>".$results."</li></ul>");
	}
	*/
    private function unzip_files() {
      $zip = new ZipArchive;
      $res = $zip->open($_BACKUP_FILE);
      if ($res === TRUE) {
        $zip->extractTo($current_dump_path);
        $zip->close();
        echo 'woot!';
      } else {
        echo 'doh!';
      }
    }
  
    /*
    private function zip_files() {
		$database_dump_folder = $this->current_dump_path . "/" . $this->database; 
		// Initialize archive object
		$zip = new ZipArchive;
		$zip->open($this->current_dump_path . '.zip', ZipArchive::CREATE);
		// Create recursive directory iterator
		$files = new RecursiveIteratorIterator(
		    new RecursiveDirectoryIterator($database_dump_folder),
		    RecursiveIteratorIterator::LEAVES_ONLY
		);
		foreach ($files as $name => $file) {
		    // Get real path for current file
		    $filePath = $file->getRealPath();
		    // Add current file to archive
		    $zip->addFile($filePath);
		    // add file to delete queue
		    $this->files_to_delete[] = $filePath;
		}
		$zip->close();
	}
    */
    
	private function delete_dump_folder() {
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($this->current_dump_path, FilesystemIterator::SKIP_DOTS), 
			RecursiveIteratorIterator::CHILD_FIRST
		);
		foreach ( $files as $file ) {
		    $file->isDir() ? rmdir($file) : unlink($file);
		}
		rmdir($this->current_dump_path);
	}
}