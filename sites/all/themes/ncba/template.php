<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * A QUICK OVERVIEW OF DRUPAL THEMING
 *
 *   The default HTML for all of Drupal's markup is specified by its modules.
 *   For example, the comment.module provides the default HTML markup and CSS
 *   styling that is wrapped around each comment. Fortunately, each piece of
 *   markup can optionally be overridden by the theme.
 *
 *   Drupal deals with each chunk of content using a "theme hook". The raw
 *   content is placed in PHP variables and passed through the theme hook, which
 *   can either be a template file (which you should already be familiary with)
 *   or a theme function. For example, the "comment" theme hook is implemented
 *   with a comment.tpl.php template file, but the "breadcrumb" theme hooks is
 *   implemented with a theme_breadcrumb() theme function. Regardless if the
 *   theme hook uses a template file or theme function, the template or function
 *   does the same kind of work; it takes the PHP variables passed to it and
 *   wraps the raw content with the desired HTML markup.
 *
 *   Most theme hooks are implemented with template files. Theme hooks that use
 *   theme functions do so for performance reasons - theme_field() is faster
 *   than a field.tpl.php - or for legacy reasons - theme_breadcrumb() has "been
 *   that way forever."
 *
 *   The variables used by theme functions or template files come from a handful
 *   of sources:
 *   - the contents of other theme hooks that have already been rendered into
 *     HTML. For example, the HTML from theme_breadcrumb() is put into the
 *     $breadcrumb variable of the page.tpl.php template file.
 *   - raw data provided directly by a module (often pulled from a database)
 *   - a "render element" provided directly by a module. A render element is a
 *     nested PHP array which contains both content and meta data with hints on
 *     how the content should be rendered. If a variable in a template file is a
 *     render element, it needs to be rendered with the render() function and
 *     then printed using:
 *       <?php print render($variable); ?>
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. With this file you can do three things:
 *   - Modify any theme hooks variables or add your own variables, using
 *     preprocess or process functions.
 *   - Override any theme function. That is, replace a module's default theme
 *     function with one you write.
 *   - Call hook_*_alter() functions which allow you to alter various parts of
 *     Drupal's internals, including the render elements in forms. The most
 *     useful of which include hook_form_alter(), hook_form_FORM_ID_alter(),
 *     and hook_page_alter(). See api.drupal.org for more information about
 *     _alter functions.
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   If a theme hook uses a theme function, Drupal will use the default theme
 *   function unless your theme overrides it. To override a theme function, you
 *   have to first find the theme function that generates the output. (The
 *   api.drupal.org website is a good place to find which file contains which
 *   function.) Then you can copy the original function in its entirety and
 *   paste it in this template.php file, changing the prefix from theme_ to
 *   corporatewap_. For example:
 *
 *     original, found in modules/field/field.module: theme_field()
 *     theme override, found in template.php: corporatewap_field()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_field() function.
 *
 *   Note that base themes can also override theme functions. And those
 *   overrides will be used by sub-themes unless the sub-theme chooses to
 *   override again.
 *
 *   Zen core only overrides one theme function. If you wish to override it, you
 *   should first look at how Zen core implements this function:
 *     theme_breadcrumbs()      in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called theme hook suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node--forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and theme hook suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440 and http://drupal.org/node/1089656
 */

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
 function corporatewap_preprocess_maintenance_page(&$variables, $hook) {
 // When a variable is manipulated or added in preprocess_html or
 // preprocess_page, that same work is probably needed for the maintenance page
 // as well, so we can just re-use those functions to do that work here.
 corporatewap_preprocess_html($variables, $hook);
 corporatewap_preprocess_page($variables, $hook);
 }
 // */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
 function corporatewap_preprocess_html(&$variables, $hook) {
 $variables['sample_variable'] = t('Lorem ipsum.');

 // The body tag's classes are controlled by the $classes_array variable. To
 // remove a class from $classes_array, use array_diff().
 //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
 }
 // */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
 function corporatewap_preprocess_page(&$variables, $hook) {
 $variables['sample_variable'] = t('Lorem ipsum.');
 }
 // */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
 function corporatewap_preprocess_node(&$variables, $hook) {
 $variables['sample_variable'] = t('Lorem ipsum.');

 // Optionally, run node-type-specific preprocess functions, like
 // corporatewap_preprocess_node_page() or corporatewap_preprocess_node_story().
 $function = __FUNCTION__ . '_' . $variables['node']->type;
 if (function_exists($function)) {
 $function($variables, $hook);
 }
 }
 // */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
 function corporatewap_preprocess_comment(&$variables, $hook) {
 $variables['sample_variable'] = t('Lorem ipsum.');
 }
 // */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
 function corporatewap_preprocess_region(&$variables, $hook) {
 // Don't use Zen's region--sidebar.tpl.php template for sidebars.
 //if (strpos($variables['region'], 'sidebar_') === 0) {
 //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
 //}
 }
 // */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
 function corporatewap_preprocess_block(&$variables, $hook) {
 // Add a count to all the blocks in the region.
 // $variables['classes_array'][] = 'count-' . $variables['block_id'];

 // By default, Zen will use the block--no-wrapper.tpl.php for the main
 // content. This optional bit of code undoes that:
 //if ($variables['block_html_id'] == 'block-system-main') {
 //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
 //}
 }
 // */
function coopforms_preprocess_html(&$variables, $hook) {
    $variables['classes_array'] = array_diff($variables['classes_array'], array('html', 'front', 'not-logged-in', 'no-sidebars', 'page-node', 'section-products', 'not-front', 'page-products', 'page-views'));

}

function clean_navigation($links) {

    $result = array();
    foreach($links as $id => $item) {
        $new_item = array('title' => $item['link']['title'], 'link_path' => $item['link']['link_path'], 'href' => $item['link']['href']);
       // $new_item =l($item['link']['title'], $item['link']['href'],  $item['link']);

        if ($item['below']) {
            $new_item['below'] = clean_navigation($item['below']);
        }
        $result[] = $new_item;
    }
    return $result;

}

function footer_menu($links){
  foreach ($links as $link => $item) {
    print "<ul class='one_fifth fl'>";
      print "<h6>". $item['link']['title']."</h6>";
      if($item['below']):
        print "<div class='accordion'>";
          foreach($item['below'] as $sub_link => $sub_item):
            $sub_link =l($sub_item['link']['title'], $sub_item['link']['href'],  $sub_item['link']);
            print "<li>";
              print $sub_link;
            print "</li>";
            endforeach;
        print "</div>";
        endif;
    print "</ul>";
  }

}

function corporate_menu($links){
  $counter = -1;
  $corporate_menu_html = "";
  $corporate_menu_html .="<ul class='filterMenu open'>";
  foreach ($links as $link=> $item) {
    $counter++;
    $data_filter = $item['link']['options']['item_attributes']['class'];
    $link_title = $item['link']['title'];
    if($counter=0){
      $corporate_menu_html.="<li data-filter='.".$data_filter."' data-slide='".$data_filter."' class='selected'>".$link_title."</li>";
    }else{
      $corporate_menu_html.="<li data-filter='.".$data_filter."' data-slide='".$data_filter."'>".$link_title."</li>";
  }
  }
  $corporate_menu_html .="</ul>'";
  print $corporate_menu_html;
}

function coopforms_links__system_main_menu($variables) {
    $html = ' ';
    $html = ' <ul>';
    foreach ($variables['links'] as $key => $value) {
        $pos = strpos($key, 'current');
        if ($pos < 0) {
            $html .= '<li>';
            $html .= l($value['title'], $value['href'],  $value);
            $html .= '</li>';
        } else {

            $html .= '<li>';
            $html .= l($value['title'], $value['href'],$value);
            $html .= '</li>';
        }

    }
    $html .= '</ul>';
    return $html;
}



function coopforms_preprocess_contact_site_form($form, &$form_state)
{
global $user;

if(!$user->uid){
$form['#attached']['library'][] = array('system', 'jquery.cookie');
$form['#attributes']['class'][] = 'user-info-from-cookie';
}

$form['#attributes']['id'][] = 'contactForm';
$form['name'] = array(
'#type' => 'textfield',
'#title' => t('Your Name'),
'#maxLength' => 255,
'#placeHolder' => 'Enter your name',
'#required' => TRUE,
);

$form['email'] = array(
'#type' => 'textfield',
'#title' => t('Your Email Address'),
'#maxLength' => 255,
'#placeHolder' => 'Enter your email',
'#required' => TRUE,
);

$form['phone'] = array(
'#type' => 'textfield',
//'#title' => t('Your Phone Number'),
'#maxLength' => 255,
'#placeHolder' => 'Phone Number',
'#required' => TRUE,
);


$form['message'] = array(
'#type' => 'textarea',
'#title' => t('Message'),
'#maxLength' => 255,
'#placeHolder' => 'Enter your query here',
'#required' => TRUE,
);
$form['actions'] =array('#type' => 'actions');
$form['actions']['submit'] = array(
'#type' => 'submit',
'#value' =>t('SUBMIT'),
);
return $form;
}

/*Personal Contact Form function*/

function coopforms_preprocess_contact_mail_page(&$vars)
{
$vars['name'] = drupal_render($vars['form']['name']);  
$vars['email'] = drupal_render($vars['form']['mail']);
$vars['message'] = drupal_render($vars['form']['message']);
//$vars['copy'] = drupal_render($vars['form']['copy']);
$vars['submit'] = drupal_render($vars['form']['submit']);
} 

function coopforms_image_style($variables) {
  // Determine the dimensions of the styled image.
  $dimensions = array(
   'width' => $variables['width'], 
    'height' => $variables['height'],
  );
  image_style_transform_dimensions($variables['style_name'], $dimensions);

  $variables['width'] = $dimensions['width'];
 $variables['height'] = $dimensions['height'];
 /*
  if ($variables['style_name'] == 'ultra_large'):
  $variables['attributes'] = array(
    'class' =>array('img_stretch'),
  );

endif;
if($variables['style_name'] == 'ultra_large_1280_x_840'):
$variables['attributes'] = array('class' => array('img_stretch'));
$variables['height']="";
$variables['width']="";
endif;
if($variables['style_name'] == 'medium_450_x_600'):
  $variables['attributes'] = array('class' => array('img_stretch2'));
  //$variables['height']="auto";
$variables['height']="";
$variables['width']="";
endif;
if($variables['style_name'] == 'large_380_x_600'):
$variables['attributes'] = array('class' => array('img_stretch2'), );
$variables['height']="";
$variables['width']="";
endif;
if($variables['style_name'] == 'medium_380_x_450'):
$variables['attributes'] = array('class' => array('img_stretch2'), );
endif;
if($variables['style_name'] == 'thumbnail_190_x_140'):
$variables['attributes'] = array('class' => array('campany_logo'), );
endif;
if($variables['style_name'] == 'medium_420_x_240'):
$variables['attributes'] = array('class' => array('stories_link_img'), );
endif;
*/

  // Determine the url for the styled image.
  $variables['path'] = image_style_url($variables['style_name'], $variables['path']);
  return theme('image', $variables);
} 

/**
 * Custom template files for user login and registration pages
 */


function coopforms_theme()
{
  $items = array();
/*  $items['comment_node_blog_post_form']= array(
   'render element' => 'form',
   'path' => drupal_get_path('theme', 'coopforms') . '/templates/form-templates',
   'template' => 'comment-node-blog_post-form',
  // 'preprocess_functions' =>array('b_preprocess_user_login'),
 );*/


  $items['contact_site_form'] = array(
'render element' => 'form',
'template' => 'contact-site-form',
'path' => drupal_get_path('theme','coopforms').'/templates/form-templates',
);

$items['user_login'] = array(
   'render element' => 'form',
   'path' => drupal_get_path('theme', 'coopforms') . '/templates/form-templates',
   'template' => 'user-login-form',
   //'preprocess_functions' =>array('basco_preprocess_user_login'),
 );
	
 $items['user_pass'] = array(
   'render element' => 'form',
   'path' => drupal_get_path('theme', 'coopforms') . '/templates/form-templates',
   'template' => 'user-pass-form',
 );
return $items;
}

function coopforms_preprocess_node(&$variables) {
    if (isset($variables['node']->type)) {
        $nodetype = $variables['node']->type;
        $variables['theme_hook_suggestions'][] = 'node--' . $nodetype;
    }
}

function coopforms_css_alter(&$css) {
  $exclude = array(
    'modules/system/system.theme.css' => FALSE,
   // 'modules/system/system.base.css' => FALSE,
    //'modules/system/system.messages.css' => FALSE,
    //drupal_get_path('module', 'views') . '/css/views.css' => FALSE,
     );
   $css = array_diff_key($css, $exclude);
}

function coopforms_form_alter(&$form, $form_state, $form_id) {
  if (strpos($form_id, 'webform_client_form_') === 0) {
    $form['actions']['reset'] = array(
      '#type' => 'button',
      '#value' => t('Reset'),
      '#weight' => 100,
      '#validate' => array(),
      '#attributes' => array('onclick' => 'this.form.reset(); return false;'),
    );
  }
}









