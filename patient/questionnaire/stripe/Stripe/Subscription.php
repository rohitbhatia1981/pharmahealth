<?php

class Stripe_Subscription extends Stripe_ApiResource
{
   /**
   * @param string $id The ID of the charge to retrieve.
   * @param string|null $apiKey
   *
   * @return Stripe_Charge
   */
  public static function retrieve($id, $options=null)
  {
    $class = get_class();
    return self::_scopedRetrieve($class, $id, $options);
  }

  /**
   * @param array|null $params
   * @param string|null $apiKey
   *
   * @return array An array of Stripe_Charges.
   */
  public static function all($params=null, $options=null)
  {
    $class = get_class();
    return self::_scopedAll($class, $params, $options);
  }

  /**
   * @param array|null $params
   * @param string|null $apiKey
   *
   * @return Stripe_Charge The created charge.
   */
  public static function create($params=null, $options=null)
  {  	
    $class = get_class();
    return self::_scopedCreate($class, $params, $options);
  }

  /**
   * @return Stripe_Charge The saved charge.
   */
  public function save($options=null)
  {
    $class = get_class();
    return self::_scopedSave($class, $options);
  }

  /**
   * @param array|null $params
   * @return Stripe_Subscription The deleted subscription.
   */
  public function cancel($params=null)
  {
    $class = get_class();
    return self::_scopedDelete($class, $params);
  }


  /**
   * @return Stripe_Subscription The updated subscription.
   */
  public function deleteDiscount()
  {
    $requestor = new Stripe_ApiRequestor($this->_apiKey);
    $url = $this->instanceUrl() . '/discount';
    list($response, $apiKey) = $requestor->request('delete', $url);
    $this->refreshFrom(array('discount' => null), $apiKey, true);
  }
}
