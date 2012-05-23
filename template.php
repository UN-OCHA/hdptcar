<?php

/**
 * @file
 * hdpt template.php
 */
  
 
function get_hdpt_style() {
  $style = theme_get_setting('hdpt_style');
  if (!$style) {
    $style = 'blue';
  }
  if (theme_get_setting('hdpt_pickstyle')) {
    if (isset($_COOKIE["hdptstyle"])) {
      $style = $_COOKIE["hdptstyle"];
    }
  }
  return $style;
}

 /**
 * To not Display title node

 
 function hdpt_preprocess_page(&$vars, $hook) {
    if ($vars['node']->sticky || $vars['node']->type == "frontpage")
       $vars['title'] = 0;
}**/
 
 /**
 * Searchbox template
 **/
 
function hdpt_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    $form['search_block_form']['#size'] = 32;  // define size of the textfield
    $form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield
    $form['actions']['submit']['#value'] = t('GO!'); // Change the text on the submit button
    $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');

// Add extra attributes to the text box
    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search';}";
    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
  }
} 


/**
 * Implements hook_preprocess_html()
 **/
function hdpt_preprocess_html(&$variables) {
  drupal_add_css(path_to_theme() . '/style.css'); //is not settet in info file because it's loades to late
  drupal_add_css(drupal_get_path('theme', 'hdpt') . '/css/' . get_hdpt_style() . '.css');

  if (theme_get_setting('hdpt_pickstyle')) {
    drupal_add_js(drupal_get_path('theme', 'hdpt') . '/js/pickstyle.js');
  }
  
  if (theme_get_setting('hdpt_suckerfish')) {
    drupal_add_css(drupal_get_path('theme', 'hdpt') . '/css/suckerfish_'  . get_hdpt_style() . '.css');
  }

  if (theme_get_setting('hdpt_uselocalcontent')) {
  // $local_content = drupal_get_path('theme', 'hdpt') . '/' . theme_get_setting('hdpt_localcontentfile');
    $local_content =  theme_get_setting('hdpt_localcontentfile');
    if (file_exists($local_content)) {
      drupal_add_css($local_content);
    }
  }
}

/**
 * Implements hook_preprocess_page()
 **/
function hdpt_preprocess_page(&$variables) {
  if (theme_get_setting('hdpt_themelogo')) {
    $variables['logo'] = base_path() . path_to_theme() . '/images/' . get_hdpt_style() . '/logo.png';
  }
}

/**
 * Implements hook_preprocess_block()
 **/
function hdpt_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if (theme_get_setting('hdpt_suckerfish') && ($variables['block']->region == 'suckerfish')) {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
  
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
  
  $variables['title_attributes_array']['class'][] = 'title';
}

/**
 * Implements hook_process_html()
 **/
function hdpt_process_html(&$variables) {
  // calculates side width and fonts
  $variables['styles'] .= '<style type="text/css">'/* Nedded to avoid */ .'</style>';

  if (theme_get_setting('hdpt_width')) {
  $variables['styles'] .= '<style type="text/css">
      #page {
        width: ' . theme_get_setting('hdpt_width') . ';
      }
        </style>';
  } else {
  $variables['styles'] .= '<style type="text/css">
      #page {
        width: 95%;
      }
        </style>';
  } 
   
  if ($left_sidebar_width = theme_get_setting('hdpt_leftsidebarwidth')) {
      $variables['styles'] .= '<style type="text/css">
        body.sidebar-first #main 
        {
          margin-left: -' . $left_sidebar_width . 'px;
        }
        body.two-sidebars #main 
        {
          margin-left: -' . $left_sidebar_width . 'px;
        }
        body.sidebar-first #squeeze 
        {
          margin-left: ' . $left_sidebar_width . 'px;
        }
        body.two-sidebars #squeeze 
        {
          margin-left: ' . $left_sidebar_width . 'px;
        }
        #sidebar-left 
        {
          width: ' . $left_sidebar_width . 'px;
        }
      </style>';
  } 

  if ($right_sidebar_width = theme_get_setting('hdpt_rightsidebarwidth')) {
      $variables['styles'] .= '<style type="text/css">
        body.sidebar-second #main 
        {
          margin-right: -' . $right_sidebar_width . 'px;
        }
        body.two-sidebars #main 
        {
          margin-right: -' . $right_sidebar_width . 'px;
        }
        body.sidebar-second #squeeze 
        {
          margin-right: ' . $right_sidebar_width . 'px;
        }
        body.two-sidebars #squeeze 
        {
          margin-right: ' . $right_sidebar_width . 'px;
        }
        #sidebar-right 
        {
          width: ' . $right_sidebar_width . 'px;
        }
      </style>';
  } 

  if (theme_get_setting('hdpt_fontfamily') != 'Custom') {

  $variables['styles'] .= '<style type="text/css">
              body {
                font-family : ' . theme_get_setting('hdpt_fontfamily') . ';
              }
           </style>';
  }
  elseif (theme_get_setting('hdpt_fontfamily')) {
  $variables['styles'] .= '<style type="text/css">
              body {
                font-family : ' . theme_get_setting('hdpt_customfont') . ';
              }
           </style>';
  } 

  if (theme_get_setting('hdpt_usecustomlogosize')) {
    $variables['styles'] .= '<style type="text/css">
          img#logo {
            width : ' . theme_get_setting('hdpt_logowidth') . 'px;
            height: ' . theme_get_setting('hdpt_logoheight') . 'px;
          }
        </style>';
  } 

  $variables['styles'] .= '<!--[if IE]>
  <style type="text/css" media="all">@import "' . base_path() . path_to_theme() . '/css/ie.css";</style>
  <![endif]-->';

  if (theme_get_setting('hdpt_suckerfish')) {
    $variables['styles'] .= '<style type="text/css">
        #suckerfishmenu div .contextual-links-wrapper {
           display:none;
        }
    </style>';
    $variables['scripts'] .= '<!--[if lte IE 6]>
      <script type="text/javascript" src="' . $GLOBALS['base_url'] . '/' . path_to_theme() . '/js/suckerfish.js"></script>
    <![endif]-->';
  }
}


/// breadcrumb

function hdpt_breadcrumb($breadcrumb) {
  $links = array();
  $path = '';
  $request = request_path();

  $arguments = explode('/', $request);

  // Remove empty values
  foreach ($arguments as $key => $value) {
    if (empty($value)) {
      unset($arguments[$key]);
    }
  }
  $arguments = array_values($arguments);

  // Add 'Home' link
  $links[] = l(t('Home'), '<front>');

  // Add other links
  if (!empty($arguments)) {
    foreach ($arguments as $key => $value) {
      //remove fr from breadcrumb
      
      if ($value == 'fr') {
        continue;
      }

      // Don't make last breadcrumb a link
      if ($key == (count($arguments) - 1)) {
        $links[] = drupal_get_title();
      } else {
        if (!empty($path)) {
          $path .= '/'. $value;
        } else {
          $path .= $value;
          $node=node_load(substr(drupal_get_normal_path($path), 5));
          $title=node_page_title($node);
        }
        //Check if path is valid
        if (drupal_lookup_path('source', $path)) {
          $links[] = l($title, $path);
        } else {
          $links[] = drupal_ucfirst($value);
        }
      }
    }
  }

  // Set custom breadcrumbs
  drupal_set_breadcrumb($links);

  // Get custom breadcrumbs
  $breadcrumb = drupal_get_breadcrumb();

  // Hide breadcrumbs if only 'Home' exists
  if (count($breadcrumb) > 1) {
    return '<div class="breadcrumb">'. implode(' &raquo; ', $breadcrumb) .'</div>';
  }
}
?>
