<?php
/**
 * Created by PhpStorm.
 * User: TalDubov
 */

namespace Model;

class Request {
    /**
     * @var
     */
    private $curlRequest;
    /**
     * @var string
     */
    private $sendMethod;

    /**
     * Request constructor.
     * @param string $url
     * @param string $sendMethod
     */
    public function __construct(string $url, string $sendMethod) {
        $this->setSendMethod($sendMethod);
        $this->setCurlRequest(curl_init($url));
        curl_setopt($this->getCurlRequest(), CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    }

    /**
     * @param string $key
     * @param array $data
     * @return mixed (Json result)
     * @throws ApiException
     */
    public function send(string $key, array $data): array {
        curl_setopt($this->getCurlRequest(), CURLOPT_HTTPHEADER, array('Content-Type: application/json' , "Authorization: Bearer $key" ));
        return $this->sendBasic($data);
    }
    /**
     * @param array $data
     * @return mixed
     * @throws ApiException
     */
    public function sendWithNoKey(array $data): array {
        return $this->sendBasic($data);
    }
    /**
     *  Closing the connection
     */
    public function __destruct() {
        curl_close($this->getCurlRequest());
    }
    /**
     * @param array $data
     * @return array
     * @throws ApiException
     */
    private function sendBasic(array $data) : array {
        curl_setopt($this->getCurlRequest(), CURLOPT_CUSTOMREQUEST, $this->getSendMethod());
        curl_setopt($this->getCurlRequest(), CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->getCurlRequest(), CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->getCurlRequest(), CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($this->getCurlRequest());
        $this->validateResponse($result);
        return json_decode($result, TRUE);
    }
    /**
     * @param string|mixed $result
     * @throws ApiException
     */
    private function validateResponse($result) {
        $httpcode = curl_getinfo($this->getCurlRequest(), CURLINFO_HTTP_CODE);
        if($httpcode !== 200 && $httpcode !== 201) {
            throw new ApiException("Response code was not ok, HttpCode:$httpcode", 201801010744);
        }
        $resDecoded = json_decode($result, TRUE);
        if(!is_array($resDecoded)) {
            throw new ApiException("Result is not valid Json, result: $result", 201801010745);
        }
    }
    /**
     * @return mixed
     */
    private function getCurlRequest() {
        return $this->curlRequest;
    }

    /**
     * @param mixed $curlRequest
     */
    private function setCurlRequest($curlRequest): void {
        $this->curlRequest = $curlRequest;
    }

    /**
     * @return string
     */
    public function getSendMethod(): string {
        return $this->sendMethod;
    }

    /**
     * @param string $sendMethod
     */
    public function setSendMethod(string $sendMethod): void {
        $this->sendMethod = $sendMethod;
    }
}