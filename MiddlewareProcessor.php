<?php declare(strict_types=1);

namespace KoderHut\OnelogBundle;

use KoderHut\OnelogBundle\Middleware\MiddlewareInterface;

/**
 * Class MiddlewareProcessor
 *
 * @author Joao Jacome <969041+joaojacome@users.noreply.github.com>
 */
class MiddlewareProcessor implements MiddlewareInterface
{
    /**
     * @var MiddlewareInterface[]
     */
    private $middlewares = [];

    /**
     * @param MiddlewareInterface $middleware
     */
    public function registerMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @param string $level
     * @param mixed  $message
     * @param array  $context
     *
     * @return array
     */
    public function process($level, $message, $context): array
    {
        foreach ($this->middlewares as $middleware) {
            [$message, $context] = $middleware->process($level, $message, $context);
        }

        return [$message, $context];
    }
}
