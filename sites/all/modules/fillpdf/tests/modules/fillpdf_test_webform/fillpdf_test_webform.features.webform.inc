<?php

/**
 * @file
 * fillpdf_test_webform.features.webform.inc
 */

/**
 * Implements hook_webform_defaults().
 */
function fillpdf_test_webform_webform_defaults() {
  $webforms = array();
  $webforms['fillpdf_test_webform'] = array(
    'uid' => 1,
    'title' => 'FillPDF Test Webform',
    'log' => '',
    'status' => 1,
    'comment' => 1,
    'promote' => 1,
    'sticky' => 0,
    'type' => 'webform',
    'language' => 'und',
    'tnid' => 0,
    'translate' => 0,
    'revision_uid' => 1,
    'rdf_mapping' => array(
      'rdftype' => array(
        0 => 'sioc:Item',
        1 => 'foaf:Document',
      ),
      'title' => array(
        'predicates' => array(
          0 => 'dc:title',
        ),
      ),
      'created' => array(
        'predicates' => array(
          0 => 'dc:date',
          1 => 'dc:created',
        ),
        'datatype' => 'xsd:dateTime',
        'callback' => 'date_iso8601',
      ),
      'changed' => array(
        'predicates' => array(
          0 => 'dc:modified',
        ),
        'datatype' => 'xsd:dateTime',
        'callback' => 'date_iso8601',
      ),
      'body' => array(
        'predicates' => array(
          0 => 'content:encoded',
        ),
      ),
      'uid' => array(
        'predicates' => array(
          0 => 'sioc:has_creator',
        ),
        'type' => 'rel',
      ),
      'name' => array(
        'predicates' => array(
          0 => 'foaf:name',
        ),
      ),
      'comment_count' => array(
        'predicates' => array(
          0 => 'sioc:num_replies',
        ),
        'datatype' => 'xsd:integer',
      ),
      'last_activity' => array(
        'predicates' => array(
          0 => 'sioc:last_activity_date',
        ),
        'datatype' => 'xsd:dateTime',
        'callback' => 'date_iso8601',
      ),
    ),
    'webform' => array(
      'confirmation' => '',
      'confirmation_format' => NULL,
      'redirect_url' => '<confirmation>',
      'status' => 1,
      'block' => 0,
      'allow_draft' => 0,
      'auto_save' => 0,
      'submit_notice' => 1,
      'confidential' => 0,
      'submit_text' => '',
      'submit_limit' => -1,
      'submit_interval' => -1,
      'total_submit_limit' => -1,
      'total_submit_interval' => -1,
      'progressbar_bar' => 1,
      'progressbar_page_number' => 0,
      'progressbar_percent' => 0,
      'progressbar_pagebreak_labels' => 1,
      'progressbar_include_confirmation' => 1,
      'progressbar_label_first' => 'Start',
      'progressbar_label_confirmation' => 'Complete',
      'preview' => 0,
      'preview_next_button_label' => '',
      'preview_prev_button_label' => '',
      'preview_title' => '',
      'preview_message' => '',
      'preview_message_format' => NULL,
      'preview_excluded_components' => array(),
      'machine_name' => 'fillpdf_test_webform',
      'record_exists' => TRUE,
      'roles' => array(
        0 => 1,
        1 => 2,
      ),
      'emails' => array(),
      'components' => array(
        'fillpdf_test_webform__image_field' => array(
          'form_key' => 'image_field',
          'name' => 'Image field',
          'type' => 'file',
          'value' => '',
          'extra' => array(
            'title_display' => 'before',
            'description_above' => 0,
            'private' => 0,
            'wrapper_classes' => '',
            'css_classes' => '',
            'filtering' => array(
              'size' => '50 MB',
              'types' => array(
                0 => 'gif',
                1 => 'jpg',
                2 => 'jpeg',
                3 => 'png',
              ),
              'addextensions' => '',
            ),
            'rename' => '',
            'scheme' => 'public',
            'directory' => '',
            'progress_indicator' => 'throbber',
            'description' => '',
            'attributes' => array(),
            'analysis' => FALSE,
          ),
          'required' => 0,
          'weight' => 0,
          'machine_name' => 'fillpdf_test_webform__image_field',
          'page_num' => 1,
        ),
      ),
      'conditionals' => array(),
    ),
    'cid' => 0,
    'last_comment_name' => NULL,
    'last_comment_uid' => 1,
    'comment_count' => 0,
    'name' => 'admin',
    'picture' => 0,
    'data' => 'b:0;',
    'path' => NULL,
  );
  return $webforms;
}
