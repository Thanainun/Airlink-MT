<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Files
 *
 * Files Controller
 *
 * @package		files
 * @author		Nost radius
 * @version		1.0
 * @based on	Nost radius management
 * @license		GPL/GNU License Copyright (c) 2008 Nost Computer
 */

class Files extends MY_Admin
{
	function __construct()
	{
		parent::__construct();

		$this->_username = $this->session->userdata('username');
		$this->_user_id = $this->session->userdata('user_id');

	}

	function index()
	{
	
		$data = '';
	
		$this->template	->add_css('elfinder/elfinder.css?'._DATETIME)
						->add_js('elfinder/elfinder.min.js?'._DATETIME)
						->add_js('elfinder/files.js?'._DATETIME)
						->write_view('left-content', 'admin/files/files_view',$data)
						->render();
	}
	
	function connector()
	{
		if($this->_user_id==1)
		{
			$dir = UPLOAD;
			$dirname = set_realpath($dir, FALSE);
			if(!file_exists($dirname.'card')) @mkdir ($dirname.'card', 0755 );
		}
		else
		{
			$dir = $this->config->item('user_folder').$this->_username;
			$dirname = set_realpath($dir, FALSE);
			if(!file_exists($dirname)) @mkdir ($dirname, 0755 );
			if(!file_exists($dirname.'/card')) @mkdir ($dirname.'/card', 0755 );
		}
		
		$opts = array(
			'root'          	=> $dir,                       // path to root directory
			'URL'           	=> base_url().$dir, // root directory URL
			'rootAlias'     	=> 'Home',       // display this instead of root directory name
			'rootAlias'    		=> 'Home',       // display this instead of root directory name
			'disabled'     		=> array(),      // list of not allowed commands
			'dotFiles'     		=> false,        // display dot files
			'dirSize'      		=> true,         // count total directories sizes
			'fileMode'     		=> 0666,         // new files mode
			'dirMode'      		=> 0777,         // new folders mode
			'mimeDetect'   		=> 'auto',       // files mimetypes detection method (finfo, mime_content_type, linux (file -ib), bsd (file -Ib), internal (by extensions))
			'uploadAllow'  		=> array(),      // mimetypes which allowed to upload
			'uploadDeny'   		=> array('php'),      // mimetypes which not allowed to upload
			'uploadOrder'  		=> 'deny,allow', // order to proccess uploadAllow and uploadAllow options
			'imgLib'       		=> 'auto',       // image manipulation library (imagick, mogrify, gd)
			'tmbDir'       		=> '.tmb',       // directory name for image thumbnails. Set to "" to avoid thumbnails generation
			'tmbCleanProb' 		=> 1,            // how frequiently clean thumbnails dir (0 - never, 200 - every init request)
			'tmbAtOnce'   		=> 5,            // number of thumbnails to generate per request
			'tmbSize'      		=> 48,           // images thumbnails size (px)
			'tmbCrop'      		=> true,         // crop thumbnails (true - crop, false - scale image to fit thumbnail size)
			'tmbBgColor'   		=> '#ffffff',    // thumbnail background color
			'fileURL'      		=> true,         // display file URL in "get info"
			'dateFormat'   		=> 'j M Y H:i',  // file modification date format
			'logger'       		=> null,         // object logger
			'aclObj'       		=> null,         // acl object (not implemented yet)
			'aclRole'      		=> 'admin',       // role for acl
			'backups'     		=> array(        // default permisions
				'read'   	=> true,
				'write'  	=> false,
				'rm'     	=> true
				),
			'perms' 			=> array(
				'/^backups\/.*.xls$/' => array(
					'read'  => true,
					'write' => false,
					'rm'    => false
					),
				'/^userfiles\/'.$this->_username.'\/card\/001.png/' => array(
					'read'  => true,
					'write' => false,
					'rm'    => false
					),
				),      // individual folders/files permisions     
			'debug'        		=> false,        // send debug to client
			'archiveMimes' 		=> array(),      // allowed archive's mimetypes to create. Leave empty for all available types.
			'archivers'    		=> array()       // info about archivers to use. See example below. Leave empty for auto detect
		);

		$this->load->library('elfinder',$opts);

		$this->elfinder->run();
	}
	
	function media()
	{
		if($this->_user_id==1)
		{
			$dir = $this->config->item('themes_folder');
			$dirname = set_realpath($dir, FALSE);
			if(!file_exists($dirname.'/logos')) @mkdir ($dirname.'/logos', 0755 );
		}
		else
		{
			$dir = $this->config->item('themes_folder').$this->_username;
			$dirname = set_realpath($dir, FALSE);
			if(!file_exists($dirname)) @mkdir ($dirname, 0755 );
			if(!file_exists($dirname.'/logos')) @mkdir ($dirname.'/logos', 0755 );
		}
		
		$opts = array(
			'root'          	=> $dir,                       // path to root directory
			'URL'           	=> base_url().$dir, // root directory URL
			'rootAlias'     	=> 'Home',       // display this instead of root directory name
			'rootAlias'    		=> 'Home',       // display this instead of root directory name
			'disabled'     		=> array(),      // list of not allowed commands
			'dotFiles'     		=> false,        // display dot files
			'dirSize'      		=> true,         // count total directories sizes
			'fileMode'     		=> 0666,         // new files mode
			'dirMode'      		=> 0777,         // new folders mode
			'mimeDetect'   		=> 'auto',       // files mimetypes detection method (finfo, mime_content_type, linux (file -ib), bsd (file -Ib), internal (by extensions))
			'uploadAllow'  		=> array(),      // mimetypes which allowed to upload
			'uploadDeny'   		=> array('php'),      // mimetypes which not allowed to upload
			'uploadOrder'  		=> 'deny,allow', // order to proccess uploadAllow and uploadAllow options
			'imgLib'       		=> 'auto',       // image manipulation library (imagick, mogrify, gd)
			'tmbDir'       		=> '.tmb',       // directory name for image thumbnails. Set to "" to avoid thumbnails generation
			'tmbCleanProb' 		=> 1,            // how frequiently clean thumbnails dir (0 - never, 200 - every init request)
			'tmbAtOnce'   		=> 5,            // number of thumbnails to generate per request
			'tmbSize'      		=> 48,           // images thumbnails size (px)
			'tmbCrop'      		=> true,         // crop thumbnails (true - crop, false - scale image to fit thumbnail size)
			'tmbBgColor'   		=> '#ffffff',    // thumbnail background color
			'fileURL'      		=> true,         // display file URL in "get info"
			'dateFormat'   		=> 'j M Y H:i',  // file modification date format
			'logger'       		=> null,         // object logger
			'aclObj'       		=> null,         // acl object (not implemented yet)
			'aclRole'      		=> 'admin',       // role for acl
			'logos'     		=> array(        // default permisions
				'read'   	=> true,
				'write'  	=> false,
				'rm'     	=> true
				),
			'debug'        		=> false,        // send debug to client
			'archiveMimes' 		=> array(),      // allowed archive's mimetypes to create. Leave empty for all available types.
			'archivers'    		=> array()       // info about archivers to use. See example below. Leave empty for auto detect
		);

		$this->load->library('elfinder',$opts);

		$this->elfinder->run();
	}
	
	function help()
	{
		$data['head'] = "วิธีการใช้งาน";
		$data['content'] = "<p>การใช้งาน ไฟล์อัพโหลด</p>";
		
		$this->output->enable_profiler(FALSE);
		$this->load->view('admin/help', $data);
	}

}
/* End of file files.php */
/* Location: ./system/nostradius/controllers/admin/files.php */