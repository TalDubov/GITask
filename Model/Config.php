<?php
/**
 * Created by PhpStorm.
 * User: TalDubov
 */

namespace Model;
/**
 * Class Config
 */
final class Config {
 const VERSION = 'v1';
 const BASE_URL = 'https://sandbox.d.greeninvoice.co.il/api/'.self::VERSION . '/';
 const ITEM_URL = self::BASE_URL.'items';
 const TOKEN_URL = self::BASE_URL.'account/token';
 const API_PARAM_ID = 'id';
 const API_PARAM_SECRET = 'secret';
 const API_PARAM_TOKEN = 'token';
 const SEND_METHOD_POST = 'POST';
 const SEND_METHOD_GET = 'GET';
 public static $currencies = array('ILS', 'USD');
}