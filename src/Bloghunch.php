<?php

namespace Bloghunch;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Bloghunch\Exceptions\BloghunchException;

class Bloghunch
{
    private const API_URL = 'https://api.bloghunch.com';
    private string $key;
    private string $domain;
    private Client $client;

    public function __construct(string $key, string $domain)
    {
        $this->key = $key;
        $this->domain = $domain;
        $this->client = new Client([
            'base_uri' => self::API_URL,
            'headers' => [
                'Authorization' => "Bearer {$this->key}",
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws BloghunchException
     */
    public function getAllPosts(): array
    {
        return $this->makeRequest('GET', "/app/{$this->domain}/posts")['posts'];
    }

    /**
     * @throws BloghunchException
     */
    public function getPost(string $slug): array
    {
        return $this->makeRequest('GET', "/app/{$this->domain}/posts/{$slug}")['post'];
    }

    /**
     * @throws BloghunchException
     */
    public function getPostComments(string $postId): array
    {
        return $this->makeRequest('GET', "/app/{$this->domain}/comments/{$postId}");
    }

    /**
     * @throws BloghunchException
     */
    public function getAllSubscribers(): array
    {
        return $this->makeRequest('GET', "/app/{$this->domain}/subscribers");
    }

    /**
     * @throws BloghunchException
     */
    public function getAllTags(): array
    {
        return $this->makeRequest('GET', "/app/{$this->domain}/tags");
    }

    /**
     * @throws BloghunchException
     */
    private function makeRequest(string $method, string $endpoint): array
    {
        try {
            $response = $this->client->request($method, $endpoint);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new BloghunchException("API request failed: " . $e->getMessage(), $e->getCode(), $e);
        }
    }
}