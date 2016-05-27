<?php

class Menu_Engine {

    public static $prefix_id = 'menu';
    public static $prefix_method;
    public static $status_list;

    public static function helper_init() {
        //<editor-fold defaultstate="collapsed">
        self::$prefix_method = self::$prefix_id;

        self::$status_list = array(
            //<editor-fold defaultstate="collapsed">
            array(
                'val' => ''
                , 'text' => ''
                , 'method' => 'menu_add'
                , 'next_allowed_status' => array()
                , 'msg' => array(
                    'success' => array(
                        array('val' => 'Add')
                        , array('val' => Lang::get(array('Menu'), true, true, false, false, true))
                        , array('val' => 'success','lower_all'=>true)
                    )
                )
            ),
            array(
                'val' => 'active'
                , 'text' => 'ACTIVE'
                , 'method' => 'menu_active'
                , 'next_allowed_status' => array('inactive')
                , 'default' => true
                , 'msg' => array(
                    'success' => array(
                        array('val' => 'Update')
                        , array('val' => Lang::get(array('Menu'), true, true, false, false, true))
                        , array('val' => 'success','lower_all'=>true)
                    )
                )
            ),
            array(
                'val' => 'inactive'
                , 'text' => 'INACTIVE'
                , 'method' => 'menu_inactive'
                , 'next_allowed_status' => array('active')
                , 'msg' => array(
                    'success' => array(
                        array('val' => 'Update')
                        , array('val' => Lang::get(array('Menu'), true, true, false, false, true))
                        , array('val' => 'success','lower_all'=>true)
                    )
                )
            ),
                //</editor-fold>
        );

        //</editor-fold>
    }

    public static function path_get() {
        $path = array(
            'index' => ICES_Engine::$app['app_base_url'] . 'menu/'
            , 'menu_engine' => ICES_Engine::$app['app_base_dir'] . 'menu/menu_engine'
            , 'menu_data_support' => ICES_Engine::$app['app_base_dir'] . 'menu/menu_data_support'
            , 'menu_renderer' => ICES_Engine::$app['app_base_dir'] . 'menu/menu_renderer'
            , 'ajax_search' => ICES_Engine::$app['app_base_url'] . 'menu/ajax_search/'
            , 'data_support' => ICES_Engine::$app['app_base_url'] . 'menu/data_support/'
        );

        return json_decode(json_encode($path));
    }

    public static function validate($method, $data = array()) {
        //<editor-fold defaultstate="collapsed">
        $path = Menu_Engine::path_get();
        get_instance()->load->helper($path->menu_data_support);

        $result = SI::result_format_get();

        $success = 1;
        $msg = array();

        $menu = isset($data['menu']) ? Tools::_arr($data['menu']) : array();
        $u_group = isset($data['u_group']) ? Tools::_arr($data['u_group']) : array();
        $menu_id = $menu['id'];
        $temp = Menu_Data_Support::menu_get($menu_id);
        $menu_db = isset($temp['menu'])?$temp['menu']:array();
        
        $db = new DB();
        switch ($method) {
            case self::$prefix_method . '_add':
            case self::$prefix_method . '_active':
            case self::$prefix_method . '_inactive':
                //<editor-fold defaultstate="collapsed">
                if (!(isset($menu['firstname']) && isset($menu['lastname']) && isset($menu['username']) && isset($menu['password']) && isset($menu['menu_status'])
                        )) {
                    $success = 0;
                    $msg[] = Lang::get('Menu Parameter') . ' ' . Lang::get('invalid', true, false);
                }
                if ($success === 1) {

                    $firstname = Tools::empty_to_null(Tools::_str($menu['firstname']));
                    $lastname = Tools::empty_to_null(Tools::_str($menu['lastname']));
                    $username = Tools::empty_to_null(Tools::_str($menu['username']));
                    $password = Tools::empty_to_null(Tools::_str($menu['password']));

                    //<editor-fold defaultstate="collapsed" desc="Major Validation">
                    if (is_null($firstname) || is_null($lastname) || is_null($username) || is_null($password)) {
                        $success = 0;
                        $msg[] = Lang::get('First Name')
                                . ' ' . Lang::get('or', true, false) . ' ' . Lang::get('Last Name')
                                . ' ' . Lang::get('or', true, false) . ' ' . Lang::get('Username')
                                . ' ' . Lang::get('or', true, false) . ' ' . Lang::get('Password')
                                . ' ' . Lang::get('empty', true, false);
                    }
                    if(!count($u_group)>0){
                        $success = 0;
                        $msg[] = 'User Group'.' '.Lang::get('empty',true,false);
                    }
                    if ($success !== 1)
                        break;

                    //</editor-fold>

                    $q = '
                        select 1
                        from menu sc
                        where sc.status > 0
                            and sc.username = ' . $db->escape($username) . '
                            and sc.id <> ' . $db->escape($menu_id) . '
                    ';

                    if (count($db->query_array($q)) > 0) {
                        $success = 0;
                        $msg[] = 'Username exists';
                    }
                    
                    //<editor-fold defaultstate="collapsed" desc="u_group">
                    if($success === 1){
                        $q_u_group_id = '';
                        foreach($u_group as $idx=>$row){
                            $u_group_id = Tools::_str(isset($row['id'])?$row['id']:'');
                            $q_u_group_id.=($q_u_group_id !== ''?',':'').$db->escape($u_group_id);
                        }
                        $q = '
                            select distinct ug.* 
                            from u_group ug
                            where ug.id in ('.$q_u_group_id.')
                                and ug.status > 0
                        ';
                        $t_u_group = $db->query_array($q);
                        if(count($t_u_group)!= count($u_group)){
                            $success = 0;
                            $msg[] = 'Duplicate User Group';
                        }

                        if($success === 1){
                            foreach($t_u_group as $idx=>$row){
                                foreach($t_u_group as $idx2=>$row2){
                                    if($row['app_name'] === $row2['app_name'] and $idx !== $idx2){
                                        $success = 0;
                                        $msg[] = 'Duplicate User Group in similar APP';
                                    }
                                    if($success !== 1) break;
                                }
                                if($success !== 1) break;
                            }
                        }
                    }
                    
                    
                    //</editor-fold>
                    
                    if (in_array($method, array(self::$prefix_method . '_active', self::$prefix_method . '_inactive'))) {
                        //<editor-fold defaultstate="collapsed">
                        if (!count($menu_db) > 0) {
                            $success = 0;
                            $msg[] = 'Invalid Menu';
                        }

                        if ($success === 1) {
                            $temp_result = SI::data_validator()->validate_on_update(
                                            array(
                                        'module' => 'menu',
                                        'module_name' => Lang::get('Menu'),
                                        'module_engine' => 'menu_engine',
                                            ), $menu
                            );
                            $success = $temp_result['success'];
                            $msg = array_merge($msg,$temp_result['msg']);
                        }
                        //</editor-fold>
                    }
                }

                //</editor-fold>
                break;
            default:
                $success = 0;
                $msg[] = 'Invalid Method';
                break;
        }
        $result['success'] = $success;
        $result['msg'] = $msg;

        return $result;
        //</editor-fold>
    }

    public static function adjust($method, $data = array()) {
        //<editor-fold defaultstate="collapsed">
        $db = new DB();
        $result = array();

        $menu_data = isset($data['menu']) ? $data['menu'] : array();
        $u_group_data = isset($data['u_group']) ? $data['u_group'] : array();

        $temp = Menu_Data_Support::menu_get($menu_data['id']);
        $menu_db = isset($temp['menu'])?$temp['menu']:array();
        
        $modid = User_Info::get()['user_id'];
        $datetime_curr = Date('Y-m-d H:i:s');

        switch ($method) {
            case self::$prefix_method . '_add':
            case self::$prefix_method . '_active':
            case self::$prefix_method . '_inactive':
                //<editor-fold defaultstate="collapsed">
                $pwd = Tools::_str($menu_data['password']);

                if (count($db->query_array_obj('select password from menu where id = ' . $db->escape($menu_data['id']) . ' and password=' . $db->escape($pwd) . '')) === 0) {
                    $pwd = md5($pwd);
                }

                $menu = array(
                    'firstname' => Tools::_str($menu_data['firstname']),
                    'lastname' => Tools::_str($menu_data['lastname']),
                    'username' => Tools::_str($menu_data['username']),
                    'password' => $pwd,
                    'status' => 1,
                    'modid' => $modid,
                    'moddate' => $datetime_curr,
                );
                switch ($method) {
                    case self::$prefix_method . '_add':
                        $menu['menu_status'] = SI::type_default_type_get('Menu_Engine', '$status_list')['val'];
                        break;
                    case self::$prefix_method . '_active':
                        $menu['menu_status'] = 'active';
                        break;
                    case self::$prefix_method . '_inactive':
                        $menu['menu_status'] = 'inactive';
                        break;
                }

                $menu_u_group = array();
                foreach($u_group_data as $idx=>$row){
                    $menu_u_group[] = array(
                        'menu_id'=>$menu_data['id'],
                        'u_group_id'=>$row['id'],
                        
                    );
                }
                
                $result['menu_u_group'] = $menu_u_group;
                $result['menu'] = $menu;

                //</editor-fold>
                break;
        }





        return $result;
        //</editor-fold>
    }

    public function menu_add($db, $final_data, $id = '') {
        //<editor-fold defaultstate="collapsed">
        $path = Menu_Engine::path_get();
        get_instance()->load->helper($path->menu_data_support);
        $result = DB::result_format_get();
        $success = 1;
        $msg = array();

        $fmenu = $final_data['menu'];
        $fmenu_u_group = $final_data['menu_u_group'];

        $modid = User_Info::get()['user_id'];
        $moddate = Date('Y-m-d H:i:s');

        if (!$db->insert('menu', $fmenu)) {
            $msg[] = $db->_error_message();
            $db->trans_rollback();
            $success = 0;
        }

        if ($success == 1) {
            $menu_id = $db->fast_get('menu'
                ,array('username' => $fmenu['username'], 'status' => 1)
            )[0]['id'];
            $result['trans_id'] = $menu_id;
        }

        if ($success == 1) {
            $temp_result = SI::status_log_add($db, 'menu', $menu_id, $fmenu['menu_status']);
            $success = $temp_result['success'];
            $msg = array_merge($msg, $temp_result['msg']);
        }

        if($success === 1){
            foreach($fmenu_u_group as $idx=>$row){
                $param_eug = $row;
                $param_eug['menu_id'] = $menu_id;
                
                if (!$db->insert('menu_u_group', $param_eug)) {
                    $msg[] = $db->_error_message();
                    $db->trans_rollback();
                    $success = 0;                    
                }
                
                if ($success == 1) {
                    $param_eugl = array(
                        'menu_id'=>$param_eug['menu_id'],
                        'u_group_id'=>$param_eug['u_group_id'],
                        'modid'=>$modid,
                        'moddate'=>$moddate,
                    );
                    if (!$db->insert('menu_u_group_log', $param_eugl)) {
                        $msg[] = $db->_error_message();
                        $db->trans_rollback();
                        $success = 0;

                    }
                }
                
                if($success !== 1) break;
            }
        }
        
        $result['success'] = $success;
        $result['msg'] = $msg;
        return $result;
        //</editor-fold>
    }

    public function menu_active($db, $final_data, $id) {
        //<editor-fold defaultstate="collapsed">
        $path = Menu_Engine::path_get();
        get_instance()->load->helper($path->menu_data_support);
        $result = DB::result_format_get();
        $success = 1;
        $msg = array();

        $fmenu = $final_data['menu'];
        $fmenu_u_group = $final_data['menu_u_group'];

        $modid = User_Info::get()['user_id'];
        $moddate = Date('Y-m-d H:i:s');
        $menu_id = $id;

        $result['trans_id'] = $id;

        if (!$db->update('menu', $fmenu, array('id' => $id))) {
            $msg[] = $db->_error_message();
            $db->trans_rollback();
            $success = 0;
        }

        if ($success == 1) {
            $temp_result = SI::status_log_add($db, 'menu', $menu_id, $fmenu['menu_status']);
            $success = $temp_result['success'];
            $msg = array_merge($msg, $temp_result['msg']);
        }

        if($success === 1){
            if(!$db->query('delete from menu_u_group where menu_id = '.$db->escape($menu_id))){
                $msg[] = $db->_error_message();
                $db->trans_rollback();
                $success = 0;
                
            }
            
            if($success === 1){
                foreach($fmenu_u_group as $idx=>$row){
                    $param_eug = $row;

                    if (!$db->insert('menu_u_group', $param_eug)) {
                        $msg[] = $db->_error_message();
                        $db->trans_rollback();
                        $success = 0;

                    }
                    
                    if ($success == 1) {
                        $param_eugl = array(
                            'menu_id'=>$param_eug['menu_id'],
                            'u_group_id'=>$param_eug['u_group_id'],
                            'modid'=>$modid,
                            'moddate'=>$moddate,
                        );
                        if (!$db->insert('menu_u_group_log', $param_eugl)) {
                            $msg[] = $db->_error_message();
                            $db->trans_rollback();
                            $success = 0;

                        }
                    }

                    if($success !== 1) break;
                }
            }
        }
        
        $result['success'] = $success;
        $result['msg'] = $msg;
        return $result;
        //</editor-fold>
    }

    public function menu_inactive($db, $final_data, $id) {
        //<editor-fold defaultstate="collapsed">
        $result = self::menu_active($db, $final_data, $id);
        return $result;
        //</editor-fold>
    }

}

?>
