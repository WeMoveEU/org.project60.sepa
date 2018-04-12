<?php

class CRM_Sepa_Logic_Links {

  /**
   * Links for recurring contributions with mandates.
   *
   * @param string $context
   *
   * @return array
   */
  public static function recurring($context = 'contribution') {
    return [
      CRM_Core_Action::VIEW => array(
        'name' => ts('View'),
        'title' => ts('View Recurring Payment'),
        'url' => 'civicrm/contact/view/contributionrecur',
        'qs' => "reset=1&id=%%crid%%&cid=%%cid%%&context={$context}",
      ),
      CRM_Core_Action::UPDATE => array(
        'name' => ts('edit mandate', array('domain' => 'org.project60.sepa')),
        'title' => ts('edit sepa mandate', array('domain' => 'org.project60.sepa')),
        'url' => 'civicrm/sepa/xmandate',
        'qs' => "mid=%%mid%%",
      ),
    ];
  }

}
