<?php
class MongoDumper {
  private $_BACKUP_FILE = "";
  
	private $_BACKUP_FOLDER = "";

	private $current_dump_path = "";
	private $files_to_delete = array();
	private $debug = false;
	public function __construct($backup_file) {
      $this->_BACKUP_FILE = $backup_file;
	}
	public function run($debug = false) {
		$this->debug = ($debug === true);
		try {
            $this->current_dump_path = "/var/www/html/db-backups";
			$this->echo_if_debug("<ol>");
            $this->echo_if_debug("<li>Unzipping...</li>");
			unzip_files();
            $this->echo_if_debug("<li>Executing import...</li>");
            mongoundump();
			$this->echo_if_debug("<li>Deleting dump folder...</li>");
			delete_dump_folder();
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
      $command = "mongorestore --db " . $this->current_dump_path;
      $results = shell_exec($command);
	  $this->echo_if_debug("<ul><li>" . $command . "</li><li>".$results."</li></ul>");
    }
  
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