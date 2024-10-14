<?php

use GuzzleHttp\Client;

class GuzzleHelper {
    private $client;

    public function __construct($baseUri, $headers = []) {
        $this->client = new Client([
            'base_uri' => $baseUri,
            'headers' => $headers
        ]);
    }

    /**
     * Realiza una solicitud GET a la API.
     * @param string $endpoint
     * @param array $queryParams
     * @return array
     */
    public function getRequest($endpoint, $queryParams = []) {
        $result = ['success' => false, 'data' => null, 'error' => null];
        try {
            $response = $this->client->request('GET', $endpoint, [
                'query' => $queryParams
            ]);
            $result['success'] = true;
            $result['data'] = json_decode($response->getBody(), true);
        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * Realiza una solicitud POST a la API.
     * @param string $endpoint
     * @param array $bodyParams
     * @return array
     */
    public function postRequest($endpoint, $bodyParams = []) {
        $result = ['success' => false, 'data' => null, 'error' => null];
        try {
            $response = $this->client->request('POST', $endpoint, [
                'json' => $bodyParams
            ]);
            $result['success'] = true;
            $result['data'] = json_decode($response->getBody(), true);
        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }
        return $result;
    }
}
?>