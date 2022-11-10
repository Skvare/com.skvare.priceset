<?php

require_once 'priceset.civix.php';
// phpcs:disable
use CRM_Priceset_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function priceset_civicrm_config(&$config) {
  _priceset_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function priceset_civicrm_xmlMenu(&$files) {
  _priceset_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function priceset_civicrm_install() {
  _priceset_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function priceset_civicrm_postInstall() {
  _priceset_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function priceset_civicrm_uninstall() {
  _priceset_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function priceset_civicrm_enable() {
  _priceset_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function priceset_civicrm_disable() {
  _priceset_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function priceset_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _priceset_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function priceset_civicrm_managed(&$entities) {
  _priceset_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Add CiviCase types provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function priceset_civicrm_caseTypes(&$caseTypes) {
  _priceset_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Add Angular modules provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function priceset_civicrm_angularModules(&$angularModules) {
  // Auto-add module files from ./ang/*.ang.php
  _priceset_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function priceset_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _priceset_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function priceset_civicrm_entityTypes(&$entityTypes) {
  _priceset_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function priceset_civicrm_themes(&$themes) {
  _priceset_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function priceset_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_buildForm().
 */
function priceset_civicrm_buildForm($fname, &$form) {
  if (in_array($fname, ['CRM_Price_Form_Field'])) {
    if ($form->_action & CRM_Core_Action::UPDATE) {
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      if ($form->_defaultValues['html_type'] == 'Text') {
        $form->addElement('checkbox', 'pricefield_allow_other_amount_range', ts('Set Amount range'), NULL, ['onclick' => "minMax(this);"]);
        $form->add('text', 'pricefield_min_range', ts('Minimum Amount'), ['size' => 8, 'maxlength' => 8]);
        $form->addRule('pricefield_min_range', ts('Please enter a valid money value (e.g. %1).', [1 => CRM_Utils_Money::formatLocaleNumericRoundedForDefaultCurrency('9.99')]), 'money');

        $form->add('text', 'pricefield_max_range', ts('Maximum Amount'), ['size' => 8, 'maxlength' => 8]);
        $form->addRule('pricefield_max_range', ts('Please enter a valid money value (e.g. %1).', [1 => CRM_Utils_Money::formatLocaleNumericRoundedForDefaultCurrency('99.99')]), 'money');

        $form->setDefaults(['pricefield_allow_other_amount_range' => $settings->get('pricefield_allow_other_amount_range_fid_' . $form->getVar('_fid'))]);
        $form->setDefaults(['pricefield_min_range' => $settings->get('pricefield_min_range_fid_' . $form->getVar('_fid'))]);
        $form->setDefaults(['pricefield_max_range' => $settings->get('pricefield_max_range_fid_' . $form->getVar('_fid'))]);
      }
    }
  }
}

/**
 * Implementation of hook_civicrm_postProcess()
 */
function priceset_civicrm_postProcess($class, &$form) {
  if (in_array($class, ['CRM_Price_Form_Field'])) {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    if ($form->getVar('_fid')) {
      $id = $form->getVar('_fid');
    }
    if ($id) {
      if ($form->_submitValues['html_type'] == 'Text') {
        $pricefield_allow_other_amount_range = $form->_submitValues['pricefield_allow_other_amount_range'] ?? NULL;
        $pricefield_min_range = $form->_submitValues['pricefield_min_range'] ?? NULL;
        $pricefield_max_range = $form->_submitValues['pricefield_max_range'] ?? NULL;
        $domainID = CRM_Core_Config::domainID();
        $settings = Civi::settings($domainID);
        $settings->set('pricefield_allow_other_amount_range_fid_' . $id, $pricefield_allow_other_amount_range);
        $settings->set('pricefield_min_range_fid_' . $id, $pricefield_min_range);
        $settings->set('pricefield_max_range_fid_' . $id, $pricefield_max_range);

      }
    }
  }
}

/**
 * Implementation of hook_civicrm_validateForm()
 */
function priceset_civicrm_validateForm($name, &$fields, &$files, &$form, &$errors) {
  if (in_array($name, ['CRM_Contribute_Form_Contribution_Main'])) {
    $priceSetFields = array_keys($form->_priceSet['fields']);
    $priceSetFieldsValue = [];
    foreach ($priceSetFields as $fieldID) {
      if (array_key_exists('price_' . $fieldID, $fields) && !empty($fields['price_' . $fieldID])) {
        if ($form->_priceSet['fields'][$fieldID]['html_type'] == 'Text')
          $priceSetFieldsValue[$fieldID] = $fields['price_' . $fieldID];
      }
    }
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    foreach ($priceSetFieldsValue as $fieldID => $fieldValue) {
      if ($settings->get('pricefield_allow_other_amount_range_fid_' . $fieldID)) {
        $minRange = $settings->get('pricefield_min_range_fid_' . $fieldID);
        $maxRange = $settings->get('pricefield_max_range_fid_' . $fieldID);
        if ($minRange && $fieldValue < $minRange) {
          $errors['price_' . $fieldID] = ts('Amount must be at least %1.', [1 => $minRange]);
        }
        if ($maxRange && $fieldValue > $maxRange) {
          $errors['price_' . $fieldID] = ts('Amount cannot be more than %1.', [1 => $maxRange]);
        }
        if (!empty($minRange) && !empty($maxRange) && $fieldValue !== min(max($fieldValue, $minRange), $maxRange)) {
          $errors['price_' . $fieldID] = ts('Please provide amount between %1 to %2.', ['1' => $minRange, '2' => $maxRange]);
        }
      }
    }
  }
  elseif (in_array($name, ['CRM_Price_Form_Field'])) {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    $is_allow_other_amount_range = $fields['pricefield_allow_other_amount_range'] ?? NULL;
    $minAmount = $fields['pricefield_min_range'] ?? NULL;
    $maxAmount = $fields['pricefield_max_range'] ?? NULL;
    if (!empty($is_allow_other_amount_range) && !empty($minAmount) && !empty($maxAmount)) {
      $minAmount = CRM_Utils_Rule::cleanMoney($minAmount);
      $maxAmount = CRM_Utils_Rule::cleanMoney($maxAmount);
      if ((float )$minAmount > (float )$maxAmount) {
        $errors['pricefield_min_range'] = ts('Minimum Amount should be less than Maximum Amount');
      }
    }
  }
}
