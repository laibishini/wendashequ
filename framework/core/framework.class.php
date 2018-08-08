<?php 

namespace framework\core;


/**
* 
*/
class Framework
{


	public function __construct(){

		$this->initAutoload();

		$this-> initConst();

		//获得index.php路径的信息
        $this->initPathinfo();



		$config1 = $this->loadFrameworkConfig();
		$config2 = $this->loadCommonConfig();

		$GLOBALS['config'] = array_merge($config1,$config2);


        $this-> initMCA();




		$config3 = $this->loadModuleConfig();

        $GLOBALS['config'] = array_merge($GLOBALS['config'],$config3);





        $this->dispatch();
	}
	

	public function initAutoload(){

		spl_autoload_register(array($this,"autoloader"));
	}

	//初始化路径信息
    public function initPathinfo(){

	    if(isset($_SERVER['PATH_INFO'])){
	        //使用我们的规则


            $path = $_SERVER['PATH_INFO'];

            //1、先把.html 和.htm等障眼法给删除
            $last_fix = strrchr($path,'.');
            $path = str_replace($last_fix,'',$path);// /admin/question/add



            //2、根据/分割成数组

            $path = substr($path,1);//      admin/question
            $arr = explode('/',$path);

            $length = count($arr);

            if($length == 1){
                //说明只有模块，控制器、方法采用默认的，不用在这里指定
                $_GET['m'] = $arr[0];
            }elseif ($length == 2){
                //指定控制器，控制器是谁，方法不用指定采用默认的
                $_GET['m'] = $arr[0];
                $_GET['c'] = $arr[1];
            }elseif ($length == 3){
                $_GET['m'] = $arr[0];
                $_GET['c'] = $arr[1];
                $_GET['a'] = $arr[2];
            }else{
                //否则就是大于3 前面3个是mca后面就是额外的参数
                $_GET['m'] = $arr[0];
                $_GET['c'] = $arr[1];
                $_GET['a'] = $arr[2];

                for($i = 3; $i < $length; $i+=2){
                    //我们最终要拼接$_GET['k'] = 'php'

                    $_GET[$arr[$i]] = $arr[$i+1];

                }
            }



        }

        //如果index没有设置路径信息我们使用原来的规则.
    }



	public function autoloader($classNname){

	//如果有Smarty我就直接加载它下面就不走了

	if($classNname == 'Smarty'){

		require_once './framework/vendor/smarty/Smarty.class.php';
		return;
	}

		//根据类来解析它的路径
//   echo "需要：".$classNname.'<br>';

   //1、第一步先炸开字符串把它变成为数组
   
   $arr = explode('\\', $classNname);



  //2、根据第一个元素来判断确定加载那个跟目录，
  if($arr[0] == 'framework') {

  		$basi_path = './';

  }else{

  		$basi_path = './application/';
  }
 
		///3、确定子目录

    	$sub_path = str_replace('\\', '/',$classNname);

    	

    		//4、确定后缀I_DAO.interface确定最后一个元素它的长度减一
    		if(substr($arr[count($arr) - 1], 0,2)== 'I_'){
    			$fix = '.interface.php';
    		}else{
    			$fix = '.class.php';
    		}

    		//确定文件的路径  只有按照我们这个规则的文件我们才加载其他的不加载

    		$class_file =  $basi_path.$sub_path.$fix;

    		if(file_exists($class_file)){


    			require_once $class_file;

    		}

    		

}

	public function initMCA(){

								//入口文件分发控制器
				//用来接受用户请求携带的参数

				//1、确定是前台还是后台

				$m = isset($_GET['m'])? $_GET['m']: $GLOBALS['config']['default_module'];

				

				define('MODEL',$m);

				//2、你要访问那个控制器

				$c = isset($_GET['c'])? $_GET['c']:$GLOBALS['config']['default_controller'];

				define("CONTROLLER",$c);

				//3、你要访问控制器那个操作


				$a = isset($_GET['a'])? $_GET['a']:$GLOBALS['config']['default_action'];

				if(substr($a,-6)!= 'Action'){
				    $a.='Action';
                }

				define("ACTION",$a);

	}


		public function dispatch(){




				//4、控制器的名字


				$controller_name = MODEL.'\controller\\'.CONTROLLER.'controller';

				//5、先加载控制器，然后在实例化对象
				//
				// $class_file = './application/'.$m.'/controller/'.$controller_name.'.class.php';

					$a = ACTION;
				//6、实例化这个对象先引入然后在实例化这个对象

				//
				// 
				

				$controller = new $controller_name;


				$controller->$a();




		}


		//加载框架配置文件

     private  function  loadFrameworkConfig(){

		    $config_file = './framework/config/config.php';

		    return require_once $config_file;
     }

     //加载公共的配置文件

    private  function  loadCommonConfig(){
         $config_file = './application/common/config/config.php';

         //公共配置文件可能没有没有我们就返回空数组

        if(file_exists($config_file)){

            return require_once $config_file;
        }else{
            return array();
        }
    }

    //前后台配置文件
    private  function loadModuleConfig(){
            $config_file = './application/'.MODEL.'/config/config.php';

            if(file_exists($config_file)){
                return require_once $config_file;
            }else{
                return array();
            }

    }


    //定义固定的路径

    private  function  initConst(){

        //项目目录
        define('ROOT_PATH',str_replace('\\','/',getcwd().'/'));

        //应用目录

        define('APP_PATH',ROOT_PATH.'application/');

       //框架目录

        define('FRAMEWORK_PATH',ROOT_PATH.'framework/');

        //公共的资源目录
        define('PUBLIC_PATH','/application/public/');

        //上传文件的目录
        define('UPLOADS_PATH','./application/public/uploads/');
        //缩略图的目录
        define('THUMB_PATH','./application/public/thumb/');

        //字体目录
        define('FONT_PATH','./application/public/fonts/');
    }


}






 ?>