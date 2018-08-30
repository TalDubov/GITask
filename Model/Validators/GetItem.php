<?php
/**
 * Created by PhpStorm.
 * User: TalDubov
 */
namespace Model\Validators;
use Model\ApiException;
use Model\Config;

class GetItem implements ValidatorInterface {
    /**
     * Pattern of the id set by api
     */
    const ITEM_ID_PATTERN = '/^[0-9a-z\-]{36}$/';
    /**
     * @param array $params
     * @throws ApiException
     */
    public function validate(array $params) : void{
        preg_match(self::ITEM_ID_PATTERN, $params[Config::API_PARAM_ID], $results);
        if(empty($results[0])) {
            throw new ApiException("Id $params[id] is not valid", 201806061234);
        }
    }
}