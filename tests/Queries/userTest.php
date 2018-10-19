<?php
declare(strict_types=1);

namespace App\Tests;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use App\MySchema\RootQueryType;
use App\MySchema\RootMutationType;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testQueryStructure() : void
    {
        $query    = '
       query {
         user(message: "aaaa") {
           username
           posts {
             title
             author {
               email
             }
           }
         }
       }
       ';

        self::assertValidQuery($query);
    }

    public function testExactResponse() : void
    {
        $query    = '
       query {
         user(message: "aaaa") {
           username
           posts {
             title
             author {
               email
             }
           }
         }
       }
       ';

        $expected = [
            'user' => [
                'username' => 'Alexandros',
                'posts' => [
                    [
                        'title' => 'Demo title 1',
                        'author' => [
                            'email' => 'alex@gmail.com'
                        ]
                    ],
                    [
                        'title' => 'Demo title 2',
                        'author' => [
                            'email' => 'alex@gmail.com'
                        ]
                    ]
                ]
            ],
        ];

        self::assertQueryResponse($query, $expected);
    }

    /**
     * Helper function to test a query and the expected response.
     */
    private static function assertValidQuery($query): void
    {
        $rootQueryType = new RootQueryType();
        $rootMutationType = new RootMutationType();

        $schema = new Schema([
            'query' => $rootQueryType,
            'mutation' => $rootMutationType,
        ]);

        $queryResponse = GraphQL::executeQuery($schema, $query)->toArray();

        self::assertArrayHasKey(
            'data',
            $queryResponse
        );

        self::assertArrayNotHasKey(
            'error',
            $queryResponse
        );
    }

    /**
     * Helper function to test a query and the expected response.
     */
    private static function assertQueryResponse($query, $expected): void
    {
        $rootQueryType = new RootQueryType();
        $rootMutationType = new RootMutationType();

        $schema = new Schema([
            'query' => $rootQueryType,
            'mutation' => $rootMutationType,
        ]);

        self::assertEquals(
            ['data' => $expected],
            GraphQL::executeQuery($schema, $query)->toArray()
        );
    }
}
