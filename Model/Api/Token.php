<?php
/**
 * Created by PhpStorm.
 * User: TalDubov
 */

namespace Model\Api;

use Model\ApiException;
use Model\Config;
use Model\Request;

class Token {
    /**
     * @param string $key
     * @param string $secret
     * @return string
     * @throws ApiException
     */
    public function get(string $key, string $secret): string {
        $paramsRequest = array(Config::API_PARAM_ID => $key, Config::API_PARAM_SECRET => $secret);
        $request = new Request(Config::TOKEN_URL, Config::SEND_METHOD_POST);
        $result = $request->sendWithNoKey($paramsRequest);
        if(!isset($result[Config::API_PARAM_TOKEN])) {
            throw new ApiException("No token isset in response, response: ".json_encode($result), 201802021234);
        }
        return $result[Config::API_PARAM_TOKEN];
    }
}