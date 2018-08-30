<?php
/**
 * Created by PhpStorm.
 * User: TalDubov
 */
namespace Model\Validators;

use Model\ApiException;

interface ValidatorInterface {
    /**
     * @param array $params
     * @throws ApiException
     */
    public function validate(array $params): void;
}