<?php
declare(strict_types=1);

namespace App\Tests;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use App\MySchema\RootQueryType;
use App\MySchema\RootMutationType;
use PHPUnit\Framework\TestCase;

class Echo2Test extends TestCase
{
    /**
     * @see it('Correctly identifies R2-D2 as the hero of the Star Wars Saga')
     */
    public function testAllFieldsAreThere() : void
    {
        $query    = '
           query HeroNameQuery {
             echo2(message: "ssss")
           }
       ';
        $expected = [
            'echo2' => "ssss"
        ];
        self::assertValidQuery($query, $expected);
    }

    /**
     * Helper function to test a query and the expected response.
     */
    private static function assertValidQuery($query, $expected): void
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
