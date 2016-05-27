<?php
class Menu_Data_Support {
    static function helper_init(){
        //<editor-fold defaultstate="collapsed">
        $ices = SI::type_get('ICES_Engine','ices','$app_list');
        get_instance()->load->helper($ices['app_base_dir'].'menu/menu_engine');
        //</editor-fold>
    }
    
    public static function menu_get($id){
        //<editor-fold defaultstate="collapsed">
        $db = new DB();
        $result = array();
        $q = '
            select *
            from menu
            where id = '.$db->escape($id).'
        ';
        $rs = $db->query_array($q);
        if(count($rs)>0){
            $menu = $rs[0];
            $u_group = array();
            $menu_id = $id;
            
            $q = '
                select distinct ug.*
                from u_group ug
                inner join menu_u_group eug on ug.id = eug.u_group_id
                where eug.menu_id = '.$db->escape($id).'
                    and ug.status>0
                order by ug.app_name, ug.name
            ';
            $rs = $db->query_array($q);
            if(count($rs)>0){
                $u_group = $rs;
            }
            $result['menu'] = $menu;
            $result['u_group'] = $u_group;
        }
        return $result;
        //</editor-fold>
    }
    
    
}
?>
