<?php

class CRM_Sepa_Logic_Note {

  const TRANSLITERATED_SUBJECT = 'SEPA Transliterated Name';

  /**
   * Create or update transliterated name
   *
   * @param int $contactId
   * @param string $displayName
   *
   * @return int
   * @throws \CiviCRM_API3_Exception
   */
  public static function transliteratedName($contactId, $displayName) {
    $note = self::get($contactId, self::TRANSLITERATED_SUBJECT);
    if (self::isEmpty($note)) {
      return self::create($contactId, self::TRANSLITERATED_SUBJECT, $displayName);
    }
    elseif (self::isDifferent($displayName, $note)) {
      return self::update($note['values'][0]['id'], $displayName);
    }

    return 0;
  }

  /**
   * @param $note
   *
   * @return bool
   */
  private static function isEmpty($note) {
    return !$note['count'];
  }

  /**
   * @param $displayName
   * @param $note
   *
   * @return bool
   */
  private static function isDifferent($displayName, $note) {
    return $note['values'][0]['note'] != $displayName;
  }

  /**
   * @param int $contactId
   * @param string $subject
   *
   * @return array
   * @throws \CiviCRM_API3_Exception
   */
  private static function get($contactId, $subject) {
    $params = [
      'sequential' => 1,
      'entity_table' => "civicrm_contact",
      'entity_id' => $contactId,
      'subject' => $subject,
    ];
    $result = civicrm_api3('Note', 'get', $params);

    return $result;
  }

  /**
   * @param int $contactId
   * @param string $subject
   * @param string $note
   *
   * @return int Id of note
   * @throws \CiviCRM_API3_Exception
   */
  private static function create($contactId, $subject, $note) {
    $params = [
      'sequential' => 1,
      'entity_id' => $contactId,
      'entity_table' => "civicrm_contact",
      'subject' => $subject,
      'note' => $note,
    ];
    $result = civicrm_api3('Note', 'create', $params);

    return $result['id'];
  }

  /**
   * @param int $id
   * @param string $note
   *
   * @return int Id of note
   * @throws \CiviCRM_API3_Exception
   */
  private static function update($id, $note) {
    $params = [
      'sequential' => 1,
      'id' => $id,
      'note' => $note,
    ];
    $result = civicrm_api3('Note', 'create', $params);

    return $result['id'];
  }

}
