<?php

declare(strict_types=1);

namespace Ody\DB\ConnectionPool\Hooks;

use Ody\DB\ConnectionPool\Pool\Hook\PoolItemHook;
use Ody\DB\ConnectionPool\Pool\PoolItemWrapperInterface;
use Ody\DB\ConnectionPool\Pool\Hook\PoolItemHookInterface;

use function is_null;

/**
 * @template TItem of object
 * @implements PoolItemHookInterface<TItem>
 */
readonly class ConnectionResetHook implements PoolItemHookInterface
{
    /**
     * @param  callable(TItem): void  $resetter
     */
    public function __construct(
        protected mixed $resetter,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function invoke(PoolItemWrapperInterface $poolItemWrapper): void
    {
        $item = $poolItemWrapper->getItem();
        $resetter = $this->resetter;

        if (!is_null($item)) {
            $resetter($item);
        }
    }

    public function getHook(): PoolItemHook
    {
        return PoolItemHook::AFTER_RETURN;
    }
}
