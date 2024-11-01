<?php 
/**
 * @package Wordpress Perfection
 * @author Shaon
 * @version 1.0.0
 */
/*
Plugin Name: Wordpress Perfection
Plugin URI: http://www.wpeden.com/
Description: One click installer for all "must have" plugins for wordpress
Author: Shaon
Version: 1.0.0
Author URI: http://www.wpeden.com/
*/
 

$plugindir = str_replace('\\','/',dirname(__FILE__));
 

define('PLUGINDIR',$plugindir);  

function wpp_install(){      
    add_option('wpp_redirect', true); 
    
}

function wpp_redirect(){
    if (get_option('wpp_redirect', false)) {
        delete_option('wpp_redirect');
        wp_redirect(home_url('/wp-admin/admin.php?page=wpperfection'));
    }
}

function wpp_unzip($zipf, $dest){
    $zip = zip_open($zipf);
    if ($zip) {
      while ($zip_entry = zip_read($zip)) {
        $fp = @fopen($dest.zip_entry_name($zip_entry), "w");
        if(!$fp) 
        @mkdir($dest.zip_entry_name($zip_entry));
        if (zip_entry_open($zip, $zip_entry, "r")) {
          $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));          
          fwrite($fp,"$buf");
          zip_entry_close($zip_entry);
          fclose($fp);
        }
      }
      zip_close($zip);
    }
}

function wpp_suggestedplugins(){
    ?>
    <div class="wrap">
   <div class="icon32" id="icon-plugins"><br></div>
   <h2>Seggested Plugins For Your Wordpress Site</h2> <br>
     Coming with next update!
   </div>
    <?php
}

function wpp_install_plugin(){
    if(file_exists(ABSPATH . "wp-content/plugins/{$_REQUEST[plugin]}/")){
    @unlink(dirname(__FILE__)."/{$_REQUEST[plugin]}.zip");    
    die('Already Exist');                                               
    }
    $handle = fopen("http://downloads.wordpress.org/plugin/{$_REQUEST[plugin]}.zip", "rb");
    $data = '';
        while (!feof($handle)) {
            $data .= fread($handle, 8192);
        }
        fclose($handle);
        $zipf = dirname(__FILE__)."/{$_REQUEST[plugin]}.zip";
        file_put_contents($zipf,$data);
        mkdir(ABSPATH . "wp-content/plugins/{$_REQUEST[plugin]}/");
        wpp_unzip($zipf,ABSPATH . "wp-content/plugins/");        
        @unlink($zipf);
        die('done');
     
}

 
function wpp_admin_options(){
    
   ?>
   <style type="text/css">
   .inm{
       padding-left: 10px;
       color: #008000;
       font-weight: bold;
   }
   </style>
   <div class="wrap">
   <div class="icon32" id="icon-plugins"><br></div>
   <h2>Must Have Plugins For Your Wordpress Site</h2> <br>
   <form action="" method="post" id="">
    <input type="submit" class="button-primary" value="Install Selected Plugins"><br/><br/>
    <table class="widefat">
    <thead>
    <tr><th></th><th>Plugin</th></tr>
    </thead>
    <tfoot>
    <tr><th></th><th>Plugin</th></tr>
    </tfoot>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="all-in-one-seo-pack"></td><td><b>All in One SEO Pack</b><span class="inm" id="all-in-one-seo-pack"></span><br/>Optimizes your Wordpress blog for Search Engines (Search Engine Optimization).</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="wp-super-cache"></td><td><b>WP Super Cache</b><span class="inm" id="wp-super-cache"></span><br/>A very fast caching engine for WordPress that produces static html files.</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="contact-form-7"></td><td><b>Contact Form 7</b><span class="inm" id="contact-form-7"></span><br/>Contact Form 7 can manage multiple contact forms, plus you can customize the form and the mail contents flexibly with simple markup. The form supports Ajax-powered submitting, CAPTCHA, Akismet spam filtering and so on.</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="easy-google-analytics-for-wordpress"></td><td><b>Easy google analytics for Wordpress</b><span class="inm" id="easy-google-analytics-for-wordpress"></span><br/>Easy google analytics plugin will embed the google analytics code in your wordpress site.</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="google-sitemap-generator"></td><td><b>Google XML Sitemaps</b><span class="inm" id="google-sitemap-generator"></span><br/>This plugin will generate a special XML sitemap which will help search engines to better index your blog.</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="add-to-any"></td><td><b>AddToAny: Share/Bookmark/Email Buttons</b><span class="inm" id="add-to-any"></span><br/>Help people share, bookmark, and email your posts & pages using any service, such as Facebook, Twitter, Google, StumbleUpon, Digg and many more.</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="yet-another-related-posts-plugin"></td><td><b>Yet Another Related Posts Plugin</b><span class="inm" id="yet-another-related-posts-plugin"></span><br/>Display a list of related entries on your site and feeds based on a unique algorithm. Templating allows customization of the display.</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="wp-db-backup"></td><td><b>WP-DB-Backup</b><span class="inm" id="wp-db-backup"></span><br/>WP-DB-Backup allows you easily to backup your core WordPress database tables. You may also backup other tables in the same database.</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="download-controler"></td><td><b>Download Controller</b><span class="inm" id="download-controler"></span><br/>This plugin will help you to manage, track and control file downloads from your wordpress site. You can set password and set access level any of your wordpress site.</td></tr>
    <tr><td valign="top" width="20px"><input checked="checked" type="checkbox" class="ins" name="ins[]" value="nextgen-gallery"></td><td><b>NextGEN Gallery</b><span class="inm" id="nextgen-gallery"></span><br/>NextGEN Gallery is a full integrated Image Gallery plugin for WordPress with dozens of options and features.</td></tr>
    
    
    </table>
    <br>
    
    <input type="button" id="btn" class="button-primary" value="Install Selected Plugins">
    </form>
    </div>
    <script language="JavaScript">
    <!--
      jQuery(function(){
          
         
          jQuery('#btn').click(function(){           
              jQuery('.ins').each(function(){
                       if(this.checked){
                          var pid = '#'+this.value; 
                          var plugin = this.value; 
                          jQuery(pid).html('Installing...<img src="images/loading.gif"/>');
                          jQuery.post(ajaxurl,{action:'wpp_install_plugin',plugin:plugin},function(res){
                              jQuery(pid).html('Installed');
                          });                           
                       }
                  });
              
          });
          
          
      });
    //-->
    </script>
   <?php 
   
}


function wpp_menu(){
    add_menu_page("WP Perfection","WP Perfection",'administrator','wpperfection','wpp_admin_options');
    add_submenu_page( 'wpperfection', 'Sggested Plugins', 'Sggested Plugins', 'administrator', 'wpperfection/suggest', 'wpp_suggestedplugins');    
    
}

if(is_admin()){
    add_action("admin_menu","wpp_menu");
    wp_enqueue_script("jquery");
    wp_enqueue_script("jquery-form",plugins_url().'/wordpress-perfection/jquery.form.js');
    add_action('wp_ajax_wpp_install_plugin','wpp_install_plugin');
}
 

register_activation_hook(__FILE__,'wpp_install');
add_action('admin_init','wpp_redirect');