<?php

namespace App\Processors;

interface InputProcessorFactoryInterface
{
    public function getProcessor(string $processor): InputProcessorInterface;
}
