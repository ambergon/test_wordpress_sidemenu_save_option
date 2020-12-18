<?php
/*
 *Plugin Name:test_options_menu
 *
 * */

function use_setting_api_test(){

    #セクションを作成
    add_settings_section(
            'section1',
            'Setting1',
            'set_describe1',
            'word'
            );

    #フィールドを作成しセクションに編入
    add_settings_field(
            'example1',
            'Example setting Name',
            'get_function',
            'word',
            'section1'

            );
    #情報を受け取り更新する
    register_setting( 'word' , 'example1' );
}

#セクション生成時に呼び出される
function set_describe1(){
    echo '<p>設定セクションを説明する</p>';
}

#フィールドを生成時に呼び出される
#field名と同じidのexample1のvalueが取得される対象である。
#初期値として現在の値を読み込んでいる
function get_function(){
    echo '<input name="example1" id="example1" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'example1' ), false ) . ' /> ';
}

#menuの設置とセクション周りの読み込み
function example_menu(){
    /* $file_local = WP_PLUGIN_DIR . '/A_RecentPostThumbnail/side_menu.php'; */
    /* add_menu_page( 'page_title' , 'menu_name' , 'administrator' , $file_local ); */
    add_menu_page( 'page_title' , 'menu_name' , 'administrator' , __FILE__ , 'create_admin_page' );
    add_action('admin_init' , 'use_setting_api_test' );
}
if ( is_admin() ){ 
    add_action( 'admin_menu' , 'example_menu' );
}
function create_admin_page(){
    global $parent_file;
    if ( $parent_file != 'options-general.php' ) {
        require(ABSPATH . 'wp-admin/options-head.php');
    }

    ?><form method="post" action="options.php"><?php

    settings_fields( 'word' );
    do_settings_sections( 'word' );
    submit_button();

    ?></form><?php
}
?>
