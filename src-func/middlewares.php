<?php

/**
 * This file is part of PHPRedmin project.
 *
 * (c) Sasan Rose <sasan.rose@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpRedmin;

use PhpRedmin\Middleware\Redis as RedisMiddleware;
use Pimple\Container;
use PSR7Sessions\Storageless\Http\SessionMiddleware;
use Redis;

function middlewares(Container $c)
{
    $c[RedisMiddleware::class] = function ($c) {
        return new RedisMiddleware($c, $c[Redis::class]);
    };

    $c[SessionMiddleware::class] = function ($c) {
        return SessionMiddleware::fromSymmetricKeyDefaults(
            $c['SESSION_KEY'],
            $c['SESSION_LIFETIME']
        );
    };

    return $c;
}
