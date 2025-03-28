<?php
/*
 *  This file is part of ODY framework.
 *
 *  @link     https://ody.dev
 *  @document https://ody.dev/docs
 *  @license  https://github.com/ody-dev/ody-foundation/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Ody\DB\Tests\Comparator;

use Ody\DB\Migrations\Comparator\ColumnComparator;
use Ody\DB\Migrations\Database\Element\Column;
use PHPUnit\Framework\TestCase;

final class ColumnComparatorTest extends TestCase
{
    public function testSameWithEmptySettings(): void
    {
        $column1 = new Column('a', 'string');
        $column2 = new Column('a', 'string');
        $columnComparator = new ColumnComparator();
        $this->assertEquals(null, $columnComparator->diff($column1, $column2));
    }

    public function testSameWithSameSettings(): void
    {
        $column1 = new Column('b', 'integer', ['null' => true, 'default' => 10]);
        $column2 = new Column('b', 'integer', ['null' => true, 'default' => 10]);
        $columnComparator = new ColumnComparator();
        $this->assertEquals(null, $columnComparator->diff($column1, $column2));
    }

    public function testChangeType(): void
    {
        $column1 = new Column('a', 'string');
        $column2 = new Column('a', 'integer');
        $columnComparator = new ColumnComparator();
        $this->assertEquals(new Column('a', 'integer'), $columnComparator->diff($column1, $column2));
    }

    public function testEnumWithDifferentSettings(): void
    {
        $column1 = new Column('e', 'enum', ['null' => true, 'values' => ['a', 'b', 'c']]);
        $column2 = new Column('e', 'enum', ['null' => false, 'values' => ['d', 'e', 'f']]);
        $columnComparator = new ColumnComparator();
        $this->assertEquals(new Column('e', 'enum', ['null' => false, 'values' => ['d', 'e', 'f']]), $columnComparator->diff($column1, $column2));
    }
}
