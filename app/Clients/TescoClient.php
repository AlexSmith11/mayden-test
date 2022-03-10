<?php

namespace App\Clients;

use GuzzleHttp\Client;

class TescoClient
{
    protected $url;
    protected $subscriptionKey;
    protected $client;

    public function __construct(Client $client)
    {
        $this->url = config('services.tesco_api.url');
        $this->subscriptionKey = config('services.tesco_api.subscription_key');
        $this->client = $client;
    }

    public function search(string $searchString)
    {
        $query = '/?query=' . $searchString . '&offset=0&limit=50';

        $response = $this->client->get(
            $this->url . $query,
            [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
                ]
            ]
        );

        return json_decode((string) $response->getBody());
    }
}
