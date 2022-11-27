<?php

declare(strict_types=1);

namespace App\Helpers;

use MongoDB\Client;
use MongoDB\Collection;

/**
 * Higher-level implementation of MongoDB Driver function
 */
class MongoModel
{
    private $db;
    public Collection $collection;
    private string $collectionName;

    public function __construct(string $collectionName)
    {
        $config['mongo_hostbase'] = env('DB_HOST') . ':' . env('DB_PORT');
        $config['mongo_database'] = env('DB_DATABASE');
        $config['mongo_username'] = env('DB_USERNAME');
        $config['mongo_password'] = env('DB_PASSWORD');
        $config['mongo_persist']  = TRUE;
        $config['mongo_persist_key'] = 'ci_persist';
        $config['mongo_replica_set'] = FALSE;
        $config['mongo_query_safety'] = 'safe';
        $config['mongo_suppress_connect_error'] = false;
        $config['mongo_host_db_flag'] = FALSE;

        $uriopt = ($config['mongo_username']) ? array("username" => $config['mongo_username'], "password" => $config['mongo_password']) : [];
        $conn = new Client("mongodb://" . $config['mongo_hostbase'], $uriopt, ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]);

        $this->db = $conn->{$config['mongo_database']};

        $this->collection = $this->db->selectCollection($collectionName);

        $this->collectionName = $collectionName;
    }

    private function parseCursor($docs)
    {
        $documents = [];
        foreach ($docs as $doc) {
            $documents[] = $doc;
        }

        return $documents;
    }

    public function get($filter): array
    {
        $documents = $this->collection->find($filter);
        $documents = $this->parseCursor($documents);
        return $documents;
    }

    public function find($filter): ?array
    {
        $documents = $this->collection->findOne($filter);
        return $documents;
    }

    public function save(array $data): string
    {
        $id = isset($data['_id']) ? $data['_id'] : (string) new \MongoDB\BSON\ObjectId();
        $this->collection->updateOne(['_id' => $id], ['$set' => $data], ['upsert' => true]);
        return (string) $id;
    }

    public function deleteQuery(array $filter): void
    {
        $this->collection->deleteOne($filter);
    }
}
