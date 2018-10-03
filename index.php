<?php
// Test this using following command
// php -S localhost:8080 ./graphql.php &
// curl http://localhost:8080 -d '{"query": "query { echo(message: \"Hello World\") }" }'
// curl http://localhost:8080 -d '{"query": "mutation { sum(x: 2, y: 2) }" }'
require_once __DIR__ . './vendor/autoload.php';

use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use MySchema\RootQueryType;
use MySchema\RootMutationType;

try {
    $rootQueryType = new RootQueryType();
    $rootMutationType = new RootMutationType();

    $schema = new Schema([
        'query' => $rootQueryType,
        'mutation' => $rootMutationType,
    ]);

    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    $query = $input['query'];
    $variableValues = isset($input['variables']) ? $input['variables'] : null;
    $rootValue = ['prefix' => 'You said: '];

    $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
    $output = $result->toArray();
} catch (\Exception $e) {
    $output = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output);
