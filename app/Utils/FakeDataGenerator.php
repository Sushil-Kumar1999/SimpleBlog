<?php

namespace App\Utils;

use GuzzleHttp\Client;

class FakeDataGenerator
{
    protected $httpClient;

	public function __construct(Client $client)
	{
		$this->httpClient = $client;
    }

    public function getFakeComment()
    {
        $fake_comment_id = random_int(1, 500);
        $response = $this->httpClient->request('GET', 'comments/' . $fake_comment_id);
	    $fake_comment = $response->getBody()->getContents();

	    return $fake_comment;
    }
}
