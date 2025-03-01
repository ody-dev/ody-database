<?php

declare(strict_types=1);

namespace Ody\DB\Tests\Command\CreateCommand;

use Ody\DB\Tests\Command\PgsqlCommandBehavior;

final class PgsqlCreateCommandTest extends CreateCommandTest
{
    use PgsqlCommandBehavior;
}
