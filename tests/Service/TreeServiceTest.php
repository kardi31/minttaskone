<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\TreeService;
use PHPUnit\Framework\TestCase;

class TreeServiceTest extends TestCase
{
    /**
     * @var TreeService
     */
    private $treeService;

    public function setUp()
    {
        $this->treeService = new TreeService();
    }

    public function testAppendNameToTree()
    {
        $tree = [
            [
                "id"       => 11,
                "children" => [
                    [
                        "id"       => 12,
                        "children" => [],
                    ],
                    [
                        "id"       => 13,
                        "children" => [],
                    ],
                ],
            ],
        ];

        $list = [
            [
                "category_id" => 11,
                "translations" => [
                    "pl_PL" => [
                        "name" => 'First custom name'
                    ]
                ]
            ],
            [
                "category_id" => 12,
                "translations" => [
                    "pl_PL" => [
                        "name" => 'Second custom name'
                    ]
                ]
            ]
        ];

        $expectedResult = [
            [
                "id" => 11,
                "children" => [
                    [
                        "id" => 12,
                        "children" => [],
                        "name" => "Second custom name"
                    ],
                    [
                        "id" => 13,
                        "children" => [],
                    ],
                ],
                "name" => "First custom name"
            ],
        ];

        $result = $this->treeService->appendNameToTree($tree, $list);

        $this->assertIsArray($result);
        $this->assertEquals($expectedResult, $result);
    }
}

