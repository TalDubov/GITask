<?php
/**
 * Created by PhpStorm.
 * User: TalDubov
 */
namespace Model\Api;
use Model\Config;
use Model\Request;
use Model\Validators\AddItem;
use Model\Validators\GetItem;

/**
 * Class APIClient
 */
class Items {
    /**
     * @var string
     */
    private $token;
    /**
     * Items constructor.
     * @param string $key
     * @param string $secret
     * @throws \Model\ApiException
     */
    public function __construct(string $key, string $secret) {
        $token = $this->getJWTTokenFromApi($key, $secret);
        $this->setJWTToken($token);
    }
    /**
     * @param array $params
     * @return array
     * @throws \Model\ApiException
     */
    public function addItem(array $params) : array {
        $validator = new AddItem();
        $validator->validate($params);
        return $this->sendRequest(Config::ITEM_URL, $params, Config::SEND_METHOD_POST);
    }
    /**
     * @param string $id
     * @return array
     * @throws \Model\ApiException
     */
    public function getItem(string $id) : array {
        $validator = new GetItem();
        $validator->validate(array('id' => $id));
        return $this->sendRequest(Config::ITEM_URL. "/$id", array(), Config::SEND_METHOD_GET);
    }
    /**
     * @param string $key
     * @param string $secret
     * @return string
     * @throws \Model\ApiException
     */
    private function getJWTTokenFromApi(string $key, string $secret) : string {
        $tokenClass = new Token();
        $token = $tokenClass->get($key, $secret);
        return $token;
    }

    /**
     * @param string $url
     * @param array $data
     * @param string $sendMethod
     * @return array
     * @throws \Model\ApiException
     */
    private function sendRequest(string $url, array $data, string $sendMethod) : array {
        $request = new Request($url, $sendMethod);
        $result = $request->send($this->getJWTToken(), $data);
        return $result;
    }
    /**
     * @param string $key
     */
    private function setJWTToken(string $key): void {
        $this->token = $key;
    }
    /**
     * @return string
     */
    private function getJWTToken(): string {
        return $this->token;
    }
}