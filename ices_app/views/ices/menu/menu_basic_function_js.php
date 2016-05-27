<script>
    var menu_parent_pane = $('<?php echo $detail_tab; ?>')[0];
    var menu_ajax_url = null;
    var menu_index_url = null;
    var menu_view_url = null;
    var menu_window_scroll = null;
    var menu_data_support_url = null;
    var menu_common_ajax_listener = null;
    var menu_component_prefix_id = '';
    
    var menu_init = function(){
        var parent_pane = menu_parent_pane;

        menu_ajax_url = '<?php echo $ajax_url ?>';
        menu_index_url = '<?php echo $index_url ?>';
        menu_view_url = '<?php echo $view_url ?>';
        menu_window_scroll = '<?php echo $window_scroll; ?>';
        menu_data_support_url = '<?php echo $data_support_url; ?>';
        menu_common_ajax_listener = '<?php echo $common_ajax_listener; ?>';
        menu_component_prefix_id = '#<?php echo $component_prefix_id; ?>';
        
    }

    var menu_after_submit = function(){

    }
    
    var menu_data ={
        
    }
    
    var menu_methods = {
        
        hide_all:function(){
            var lparent_pane = menu_parent_pane;
            var lprefix_id = menu_component_prefix_id;
            $(lparent_pane).find('.hide_all').hide();
        },
        disable_all:function(){
            var lparent_pane = menu_parent_pane;
            var lcomponents = $(lparent_pane).find('.disable_all');
            APP_COMPONENT.disable_all(lparent_pane);
        },
        
        show_hide: function(){
            var lparent_pane = menu_parent_pane;
            var lprefix_id = menu_component_prefix_id;
            var lmethod = $(lparent_pane).find('#menu_method').val();            
            
            menu_methods.hide_all();
            
            switch(lmethod){
                case 'add':
                case 'view':
                    $(lparent_pane).find(lprefix_id+'_firstname').closest('div [class*="form-group"]').show();
                    $(lparent_pane).find(lprefix_id+'_lastname').closest('div [class*="form-group"]').show();
                    $(lparent_pane).find(lprefix_id+'_username').closest('div [class*="form-group"]').show();
                    $(lparent_pane).find(lprefix_id+'_password').closest('div [class*="form-group"]').show();
                    $(lparent_pane).find(lprefix_id+'_tbl_u_group').closest('div [class*="form-group"]').show();
                    $(lparent_pane).find(lprefix_id+'_menu_status').closest('div [class*="form-group"]').show();
                    break;
            }
            
            switch(lmethod){
                case 'add':
                    
                    break;
                case 'view':
                    $(lparent_pane).find(lprefix_id+'_btn_delete').show();
                    break;
            }
        },        
        enable_disable: function(){
            var lparent_pane = menu_parent_pane;
            var lprefix_id = menu_component_prefix_id;
            var lmethod = $(lparent_pane).find(lprefix_id+'_method').val();  
            menu_methods.disable_all();
            
            switch(lmethod){
                case "add":
                case 'view':
                    $(lparent_pane).find(lprefix_id+'_firstname').prop('disabled',false);
                    $(lparent_pane).find(lprefix_id+"_lastname").prop("disabled",false);
                    $(lparent_pane).find(lprefix_id+"_username").prop("disabled",false);
                    $(lparent_pane).find(lprefix_id+"_password").prop("disabled",false);
                    $(lparent_pane).find(lprefix_id+'_menu_status').select2('enable');
                    break;
            }
        },
        reset_all:function(){
            var lparent_pane = menu_parent_pane;
            var lprefix_id = menu_component_prefix_id;
            
            $(lparent_pane).find(lprefix_id+'_firstname').val('');
            $(lparent_pane).find(lprefix_id+'_lastname').val('');
            $(lparent_pane).find(lprefix_id+'_username').val('');
            $(lparent_pane).find(lprefix_id+'_password').val('');
            
            APP_FORM.status.default_status_set(
                'menu',
                $(lparent_pane).find(lprefix_id+'_menu_status')
            );
           
            menu_u_group_methods.load_u_group({u_group:[]});
        },
        after_submit: function(){
            
        },
        submit:function(){
            var lparent_pane = menu_parent_pane;
            var lprefix_id = menu_component_prefix_id;
            var lajax_url = menu_index_url;
            var lmethod = $(lparent_pane).find("#menu_method").val();
            var menu_id = $(lparent_pane).find(lprefix_id+"_id").val();        
            var json_data = {
                ajax_post:true,
                menu:{},
                u_group:[],
                message_session:true
            };

            switch(lmethod){
                case 'add':
                case 'view':
                    
                    json_data.menu.firstname = $(lparent_pane).find(lprefix_id+"_firstname").val();
                    json_data.menu.lastname = $(lparent_pane).find(lprefix_id+"_lastname").val();
                    json_data.menu.username = $(lparent_pane).find(lprefix_id+"_username").val();
                    json_data.menu.password = $(lparent_pane).find(lprefix_id+"_password").val();
                    json_data.menu.method = $(lparent_pane).find(lprefix_id+"_method_name").val();
                    json_data.menu.menu_status = $(lparent_pane).find(lprefix_id+"_menu_status").select2('val');
                    json_data.u_group = menu_tbl_u_group_method.setting.func_get_data_table().u_group;
                    break;
            }
            
            var lajax_method='';
            switch(lmethod){
                case 'add':
                    lajax_method = 'menu_add';
                    break;
                case 'view':
                    lajax_method = $(lparent_pane).find(lprefix_id+'_menu_status').select2('data').method;
                    break;
            }
            lajax_url +=lajax_method+'/'+menu_id;
            
            var lresult = {
                json_data:json_data,
                ajax_url:lajax_url
            };
            return lresult;
        },
    }

    var menu_bind_event = function(){
        var lparent_pane = menu_parent_pane;
        var lprefix_id = menu_component_prefix_id;
        
        $(lparent_pane).find(lprefix_id+'_btn_submit').off('click');
        APP_COMPONENT.button.submit.set($(lparent_pane).find(lprefix_id+'_btn_submit'),{
            parent_pane:lparent_pane,
            module_method:menu_methods,
            view_url: menu_view_url,
            prefix_id:lprefix_id,
            window_scroll:menu_window_scroll,
        });
        
        menu_u_group_bind_event();
    }
    
    var menu_components_prepare= function(){
        var lparent_pane = menu_parent_pane;
        var lprefix_id = menu_component_prefix_id;
        var method = $(menu_parent_pane).find(lprefix_id+"_method").val();
                
        var menu_data_set = function(){
            var lparent_pane = menu_parent_pane;
            var lprefix_id = menu_component_prefix_id;
            switch(method){
                case "add":
                    menu_methods.reset_all();
                    break;
                case "view":
                    var menu_id = $(menu_parent_pane).find(lprefix_id+"_id").val();
                    var json_data={data:menu_id};
                    var lresponse = APP_DATA_TRANSFER.ajaxPOST(menu_data_support_url+"menu_get",json_data).response;
                    if(lresponse != []){
                        var lmenu = lresponse.menu;
                        var lu_group = lresponse.u_group;
                        
                        $(lparent_pane).find(lprefix_id+'_firstname').val(lmenu.firstname);
                        $(lparent_pane).find(lprefix_id+'_lastname').val(lmenu.lastname);
                        $(lparent_pane).find(lprefix_id+'_username').val(lmenu.username);
                        $(lparent_pane).find(lprefix_id+'_password').val(lmenu.password);
                        
                        $(lparent_pane).find(lprefix_id+'_menu_status')
                        .select2('data',lmenu.menu_status
                        ).change();
                            
                        $(lparent_pane).find(lprefix_id+'_menu_status')
                        .select2({data:lresponse.menu_status_list});
                        
                        menu_u_group_methods.load_u_group({u_group:lu_group});
                        
                    };
                    break;            
            }
        }
    
        menu_methods.enable_disable();
        menu_methods.show_hide();
        menu_data_set();
    }
    
</script>