<?php
/**
 * Created by PhpStorm.
 * User: TalDubov
 */
namespace Model\Validators;
use Model\ApiException;
use Model\Config;

class AddItem implements ValidatorInterface {
    /**
     * @param array $params
     * @throws ApiException
     */
    public function validate(array $params) : void {
            if(!isset($params['name'])) {
                throw new ApiException('No set name', 201804041113);
            }
            if(!isset($params['description'])) {
                throw new ApiException('No set description', 201804041114);
            }
            if(!isset($params['price']) || !is_float($params['price'])) {
                throw new ApiException('No set price', 201804041115);
            }
            if(!isset($params['currency']) || !in_array($params['currency'], Config::$currencies)) {
                throw new ApiException('No set currency', 201804041116);
            }
    }
}