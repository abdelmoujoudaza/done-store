<?php

namespace App\Processors;

class InputProcessorFactory implements InputProcessorFactoryInterface
{
    public function getProcessor(string $processor): InputProcessorInterface
    {
        return match ($processor) {
            'request' => new RequestInputProcessor(),
            'console' => new ConsoleInputProcessor(),
            default => throw new \InvalidArgumentException('Invalid input processor'),
        };
    }
}
