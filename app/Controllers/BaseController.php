<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	public function __construct(){
		$this->UserModel = new Models\UserModel();
		$this->CheckinModel = new Models\CheckinModel();
	}
	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		// $arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
		 
		// $agent = $_SERVER['HTTP_USER_AGENT'];
		 
		// $user_browser = '';
		// foreach ($arr_browsers as $browser) {
		//     if (strpos($agent, $browser) !== false) {
		//         $user_browser = $browser;
		//         break;
		//     }   
		// }
		  
		// switch ($user_browser) {
		//     case 'MSIE':
		//         $user_browser = 'Internet Explorer';
		//         break;
		  
		//     case 'Trident':
		//         $user_browser = 'Internet Explorer';
		//         break;
		  
		//     case 'Edg':
		//         $user_browser = 'Microsoft Edge';
		//         break;
		// }

		// function getIPAddress() {  
		//     //whether ip is from the share internet  
		//      if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
		//                 $ip = $_SERVER['HTTP_CLIENT_IP'];  
		//         }  
		//     //whether ip is from the proxy  
		//     elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
		//                 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
		//      }  
		// //whether ip is from the remote address  
		//     else{  
		//              $ip = $_SERVER['REMOTE_ADDR'];  
		//      }  
		//      return $ip;  
		// }  
		// // $ip = getIPAddress();  
		// $ip = gethostbyname("www.google.com");  
	}

}
