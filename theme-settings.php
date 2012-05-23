<?php

/**
 * @file
 * hdpt theme-settings.php
 */

function hdpt_form_system_theme_settings_alter(&$form, $form_state){

 $form['hdpt_style'] = array(
    '#type' => 'select',
    '#title' => t('Style'),
    '#description' => t('Choose your favorite color.'),
    '#default_value' => theme_get_setting('hdpt_style'),
    '#options' => array(
      'red' => t('Red'),
      'green' => t('Blue'),
      'blue' => t('Brown'),
    ),
  );

  $form['hdpt_themelogo'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Themed Logo'),
    '#default_value' => theme_get_setting('hdpt_themelogo'),
  );

  $form['hdpt_pickstyle'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable StylePicker JavaScript'),
    '#description' => t('If enabled then you can use stylepicker see README.txt.'),
    '#default_value' => theme_get_setting('hdpt_pickstyle'),
  );

  $form['hdpt_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Width Size'),
    '#description' => t('Set the width. You  can set the width in percent for dynamic width or in px for fixed width.<br /><b>eg.: 850px or 60%</b>'),
    '#default_value' => theme_get_setting('hdpt_width'),
    '#size' => 7,
    '#maxlength' => 7,
  );

  $form['hdpt_breadcrumb'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Breadcrumbs'),
    '#default_value' => theme_get_setting('hdpt_breadcrumb'),
  );
  
  $form['hdpt_fontfamily'] = array(
    '#type' => 'select',
    '#title' => t('Font Family'),
    '#description' => t('Choose your favorite Fonts'),
    '#default_value' => theme_get_setting('hdpt_fontfamily'),
    '#options' => array(
     'Arial, Verdana, sans-serif' => t('Arial, Verdana, sans-serif'),
     '"Arial Narrow", Arial, Helvetica, sans-serif' => t('"Arial Narrow", Arial, Helvetica, sans-serif'),
     '"Times New Roman", Times, serif' => t('"Times New Roman", Times, serif'),
     '"Lucida Sans", Verdana, Arial, sans-serif' => t('"Lucida Sans", Verdana, Arial, sans-serif'),
     '"Lucida Grande", Verdana, sans-serif' => t('"Lucida Grande", Verdana, sans-serif'),
     'Tahoma, Verdana, Arial, Helvetica, sans-serif' => t('Tahoma, Verdana, Arial, Helvetica, sans-serif'),
     'Georgia, "Times New Roman", Times, serif' => t('Georgia, "Times New Roman", Times, serif'),
     'Custom' => t('Custom (specify below)'),
    ),
  );

  $form['hdpt_customfont'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom Font-Family Setting'),
    '#description' => t('type your fonts separated by ,<br />eg. <b>"Lucida Grande", Verdana, sans-serif</b>'),
    '#default_value' => theme_get_setting('hdpt_customfont'),
    '#size' => 40,
    '#maxlength' => 75,
  );

  $form['hdpt_uselocalcontent'] = array(
    '#type' => 'checkbox',
    '#title' => t('Include Custom Stylesheet'),
    '#default_value' => theme_get_setting('hdpt_uselocalcontent'),
  );

  $form['hdpt_localcontentfile'] = array(
    '#type' => 'textfield',
    '#title' => t('Path to Custom Stylesheet'),
    '#description' => t('type the location of your custom css without leading slash<br />eg. <b>sites/all/themes/newsflash/css/icons.css</b>'),
    '#default_value' => theme_get_setting('hdpt_localcontentfile'),
    '#size' => 40,
    '#maxlength' => 75,
  );

  $form['hdpt_leftsidebarwidth'] = array(
    '#type' => 'textfield',
    '#title' => t('Left Sidebar Width'),
    '#description' => t('Set the width in Pixel.'),
    '#default_value' => theme_get_setting('hdpt_leftsidebarwidth'),
    '#size' => 5,
    '#maxlength' => 5,
  );

  $form['hdpt_rightsidebarwidth'] = array(
    '#type' => 'textfield',
    '#title' => t('Right Sidebar Width'),
    '#description' => t('Set the width in Pixel.'),
    '#default_value' => theme_get_setting('hdpt_rightsidebarwidth'),
    '#size' => 5,
    '#maxlength' => 5,
  );

  $form['hdpt_suckerfish'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Suckerfish Menus'),
    '#default_value' => theme_get_setting('hdpt_suckerfish'),
  );

  $form['hdpt_usecustomlogosize'] = array(
    '#type' => 'checkbox',
    '#title' => t('Specify Custom Logo Size'),
    '#default_value' => theme_get_setting('hdpt_usecustomlogosize'),
  );

  $form['hdpt_logowidth'] = array(
    '#type' => 'textfield',
    '#title' => t('Logo Width'),
    '#description' => t('Set the width in Pixel.'),
    '#default_value' => theme_get_setting('hdpt_logowidth'),
    '#size' => 5,
    '#maxlength' => 5,
  );

  $form['hdpt_logoheight'] = array(
    '#type' => 'textfield',
    '#title' => t('Logo Height'),
    '#description' => t('Set the width in Pixel.'),
    '#default_value' => theme_get_setting('hdpt_logoheight'),
    '#size' => 5,
    '#maxlength' => 5,
  );

  $form['hdpt_banner'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show RoopleTheme footer Logo'),
    '#description' => t('if unchecked then roople logo in the footer will disapear<br>so you don\'t need touch the code'),
    '#default_value' => theme_get_setting('hdpt_banner'),
  );
  return $form;
}
