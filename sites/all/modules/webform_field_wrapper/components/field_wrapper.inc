<?php
/**
 * @file
 * Webform module field wrapper component.
 */

/**
 * Implements _webform_defaults_component().
 */
function _webform_defaults_field_wrapper() {
  return array(
    'name' => '',
    'form_key' => NULL,
    'pid' => 0,
    'weight' => 0,
    'value' => '',
    'required' => 0,
    'extra' => array(
      'width' => '',
      'maxlength' => '',
      'field_prefix' => '',
      'field_suffix' => '',
      'disabled' => 0,
      'unique' => 0,
      'title_display' => 0,
      'description' => '',
      'placeholder' => '',
      'attributes' => array(),
      'private' => FALSE,
      'analysis' => FALSE,
    ),
  );
}

/**
 * Implements _webform_theme_component().
 */
function _webform_theme_field_wrapper() {
  return array(
    'webform_display_field_wrapper' => array(
      'render element' => 'element',
      'path' => drupal_get_path('module', 'webform_field_wrapper'),
      'file' => 'components/field_wrapper.inc',
    ),
  );
}

/**
 * Implements _webform_edit_component().
 */
function _webform_edit_field_wrapper($component) {
  $form = array();

  $form['display']['width'] = array(
    '#type' => 'textfield',
    '#title' => t('Width'),
    '#default_value' => $component['extra']['width'],
    '#description' => t('Width of the field wrapper.') . ' ' . t('Leaving blank will use the default size.'),
    '#size' => 5,
    '#maxlength' => 10,
    '#weight' => 0,
    '#parents' => array('extra', 'width'),
  );
  $form['display']['placeholder'] = array(
    '#type' => 'textfield',
    '#title' => t('Placeholder'),
    '#default_value' => $component['extra']['placeholder'],
    '#description' => t('The placeholder will be shown in the field until the user starts entering a value.'),
    '#weight' => 1,
    '#parents' => array('extra', 'placeholder'),
  );
  $form['display']['field_prefix'] = array(
    '#type' => 'markup',
    '#title' => t('Prefix text placed to the left of the field wrapper'),
    '#default_value' => $component['extra']['field_prefix'],
    '#size' => 20,
    '#maxlength' => 127,
    '#weight' => 2.1,
    '#parents' => array('extra', 'field_prefix'),
  );
  $form['display']['field_suffix'] = array(
    '#type' => 'textfield',
    '#title' => t('Postfix text placed to the right of the field wrapper'),
    '#default_value' => $component['extra']['field_suffix'],
    '#size' => 20,
    '#maxlength' => 127,
    '#weight' => 2.2,
    '#parents' => array('extra', 'field_suffix'),
  );

  return $form;
}

/**
 * Implements _webform_render_component().
 */
function _webform_render_field_wrapper($component, $value = NULL, $filter = TRUE) {
  $node = isset($component['nid']) ? node_load($component['nid']) : NULL;
  $classes = strtolower(str_replace(' ', '-', $filter ? _webform_filter_xss($component['name']) : $component['name']));

  $element = array(
    '#type' => 'markup',
    '#title' => $filter ? _webform_filter_xss($component['name']) : $component['name'],
    '#title_display' => $component['extra']['title_display'] ? $component['extra']['title_display'] : 'before',
    '#weight' => $component['weight'],
    '#field_prefix' => empty($component['extra']['field_prefix']) ? NULL : ($filter ? _webform_filter_xss($component['extra']['field_prefix']) : $component['extra']['field_prefix']),
    '#field_suffix' => empty($component['extra']['field_suffix']) ? NULL : ($filter ? _webform_filter_xss($component['extra']['field_suffix']) : $component['extra']['field_suffix']),
    '#attributes' => $component['extra']['attributes'],
    '#theme_wrappers' => array('webform_element'),
    '#translatable' => array('title', 'description'),
  );

  if ($component['extra']['placeholder']) {
    $element['#attributes']['placeholder'] = $component['extra']['placeholder'];
  }

  // Change the 'width' option to the correct 'size' option.
  if ($component['extra']['width'] > 0) {
    $element['#size'] = $component['extra']['width'];
  }
  if ($component['extra']['maxlength'] > 0) {
    $element['#maxlength'] = $component['extra']['maxlength'];
  }


  return $element;
}

/**
 * Implements _webform_display_component().
 */
function _webform_display_field_wrapper($component, $value, $format = 'html') {
  $element = _webform_render_field_wrapper($component, $value);
  $element['#format'] = $format;
  return $element;
}
