<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ICES_Engine {
    
    public static $company_list = array();
    public static $company;
    public static $app_list;
    public static $app;
    
    public static function helper_init(){
        //<editor-fold defaultstate="collapsed">
        self::$company_list = array(
            array(
                'val'=>'restorant',
                'app'=>array(
                    //<editor-fold defaultstate="collapsed">
                    array(
                        'val'=>'administration',
                        'text'=>'Administration',
                        'dev_text'=>'Administration',
                        'short_name'=>'Administration',
                        'app_base_url'=>get_instance()->config->base_url().'administration/',
                        'app_icon_img'=>get_instance()->config->base_url().'libraries/img/ices/cutlery.png',
                        'app_base_dir'=>'Administration/',
                        'app_db_conn_name'=>'Administration',
                        'app_translate'=>true,
                        'app_default_url'=>get_instance()->config->base_url().'Administration/dashboard',
                        'app_theme'=>'AdminLTE',
                        'app_db_lock_name'=>'administration',
                        'app_db_lock_limit'=>10,
                        'non_permission_controller'=>array(),
                        'app_info'=>''
                    ),
                    
                    array(
                        'val'=>'management',
                        'text'=>'Management',
                        'dev_text'=>'Management',
                        'short_name'=>'Management',
                        'app_base_url'=>get_instance()->config->base_url().'management/',
                        'app_base_dir'=>'management/',
                        'app_db_conn_name'=>'management',
                        'app_translate'=>false,
                        'app_default_url'=>get_instance()->config->base_url().'management/dashboard',
                        'app_icon_img'=>get_instance()->config->base_url().'libraries/img/ices/aryana_phone_book.png',
                        'app_theme'=>'AdminLTE',
                        'app_db_lock_name'=>'management',
                        'app_db_lock_limit'=>10,
                        'non_permission_controller'=>array(),
                        'app_info'=>''
                    ),
                    
                    array(
                        'val'=>'cashier',
                        'text'=>'Cashier',
                        'dev_text'=>'Cashier',
                        'short_name'=>'Cashier',
                        'app_base_url'=>get_instance()->config->base_url().'cashier/',
                        'app_base_dir'=>'cashier/',
                        'app_db_conn_name'=>'cashier',
                        'app_translate'=>false,
                        'app_default_url'=>get_instance()->config->base_url().'cashier/dashboard',
                        'app_icon_img'=>get_instance()->config->base_url().'libraries/img/ices/aryana_phone_book.png',
                        'app_theme'=>'AdminLTE',
                        'app_db_lock_name'=>'cashier',
                        'app_db_lock_limit'=>10,
                        'non_permission_controller'=>array(),
                        'app_info'=>''
                    ),
                    
                    array(
                        'val'=>'accounting',
                        'text'=>'Accounting',
                        'dev_text'=>'Accounting',
                        'short_name'=>'Accounting',
                        'app_base_url'=>get_instance()->config->base_url().'accounting/',
                        'app_base_dir'=>'cashier/',
                        'app_db_conn_name'=>'cashier',
                        'app_translate'=>false,
                        'app_default_url'=>get_instance()->config->base_url().'accounting/dashboard',
                        'app_icon_img'=>get_instance()->config->base_url().'libraries/img/ices/aryana_phone_book.png',
                        'app_theme'=>'AdminLTE',
                        'app_db_lock_name'=>'accounting',
                        'app_db_lock_limit'=>10,
                        'non_permission_controller'=>array(),
                        'app_info'=>''
                    ),
                    
                    array(
                        'val'=>'kitchen',
                        'text'=>'Kitchen',
                        'dev_text'=>'Kitchen',
                        'short_name'=>'Kitchen',
                        'app_base_url'=>get_instance()->config->base_url().'kitchen/',
                        'app_base_dir'=>'kitchen/',
                        'app_db_conn_name'=>'kitchen',
                        'app_translate'=>false,
                        'app_default_url'=>get_instance()->config->base_url().'kitchen/dashboard',
                        'app_icon_img'=>get_instance()->config->base_url().'libraries/img/ices/aryana_phone_book.png',
                        'app_theme'=>'AdminLTE',
                        'app_db_lock_name'=>'kitchen',
                        'app_db_lock_limit'=>10,
                        'non_permission_controller'=>array(),
                        'app_info'=>''
                    ),
                    
                    array(
                        'val'=>'waiters',
                        'text'=>'Waiters',
                        'dev_text'=>'Waiters',
                        'short_name'=>'Waiters',
                        'app_base_url'=>get_instance()->config->base_url().'waiters/',
                        'app_base_dir'=>'waiters/',
                        'app_db_conn_name'=>'waiters',
                        'app_translate'=>false,
                        'app_default_url'=>get_instance()->config->base_url().'waiters/dashboard',
                        'app_icon_img'=>get_instance()->config->base_url().'libraries/img/ices/aryana_phone_book.png',
                        'app_theme'=>'AdminLTE',
                        'app_db_lock_name'=>'waiters',
                        'app_db_lock_limit'=>10,
                        'non_permission_controller'=>array(),
                        'app_info'=>''
                    ),
                    //</editor-fold>
                ),
                'active'=>true
            ),
        );
        
        self::$app_list = array(
            //<editor-fold defaultstate="collapsed">
            array(
                'val'=>'ices',
                'text'=>'Integrated System',
                'dev_text'=>'Integrated System',
                'short_name'=>'ICES System',
                'app_base_url'=>get_instance()->config->base_url().'ices/',
                'app_base_dir'=>'ices/',
                'app_db_conn_name'=>'ices',
                'app_translate'=>false,
                'app_default_url'=>get_instance()->config->base_url().'ices/dashboard',
                'app_icon_img'=>get_instance()->config->base_url().'libraries/img/ices/ices.png',
                'app_theme'=>'AdminLTE',
                'app_db_lock_name'=>'ices',
                'app_db_lock_limit'=>10,
                'non_permission_controller'=>array(),
                'app_info'=>''
            ),
            //</editor-fold>
        );
        
        foreach(self::$company_list as $idx=>$row){
            if($row['active']){
                self::$company =  $row;
                self::$app_list = array_merge(self::$app_list,self::$company['app']);
                unset(self::$company['app']);
                break;
            }
        }
        
        self::helper_load();
        $app_name = get_instance()->uri->segment(1);
        self::app_set($app_name);
        //</editor-fold>
    }
    
    public static function helper_load(){
        //<editor-fold defaultstate="collapsed">
        get_instance()->load->helper('ices/user_info/user_info');
        get_instance()->load->helper('ices/handy/printer_helper');
        get_instance()->load->helper('ices/handy/excel_helper');
        get_instance()->load->helper('ices/handy/tools');
        get_instance()->load->helper('ices/handy/si/si');
        get_instance()->load->helper('ices/handy/email/email_engine');
        get_instance()->load->helper('ices/handy/email/email_message');
        get_instance()->load->helper('ices/handy/minifier');
        get_instance()->load->helper('ices/security/security_engine');
        get_instance()->load->helper('ices/handy/db');
        get_instance()->load->helper('ices/app/app');
        get_instance()->load->helper('ices/app/app_icon');
        get_instance()->load->helper('ices/app_message/app_message_engine');
        get_instance()->load->helper('ices/app/app_message');
        
        //</editor-fold>
    }
    
    public static function app_set($app_name=''){
        //<editor-fold defaultstate="collapsed">
        $t_app = SI::type_get('ICES_Engine',$app_name,'$app_list');
        if($t_app !== null){
            self::$app = $t_app;
            get_instance()->load->helper(self::$app['app_base_dir'].'lang/lang_helper');
        }
        //<editor-fold>
    }
    
    public static function app_get($app_name = ''){
        $result = array();
        
        foreach(self::$app_list as $idx=>$row){
            if($row['val'] === $app_name){
                $result = $row;
            }
        }
        
        return $result;
    }
    
}