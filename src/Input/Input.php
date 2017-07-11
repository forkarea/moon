<?php

declare(strict_types=1);

namespace Moon\Core\Input;

class Input implements InputInterface
{
    /**
     * @var array $options
     */
    private $options = [];

    /**
     * @var array $arguments
     */
    private $arguments = [];

    /**
     * @var string $commandName
     */
    private $commandName;

    /**
     * Input constructor.
     *
     * Format (-a -b are an aliases for options):
     * php bin/console commandName:name argument1 argumentN --optionWithNoValue --optionWithValue=1 -a -b=1
     *
     * will be mapped as:
     *
     * $commandName = 'commandName:name'
     * $arguments = ['argument1', 'argumentN']
     * $options = ['optionWithNoValue' => null, 'optionWithValue' => 1, 'a' => null, 'b' => 1]
     *
     * TODO: Add logic for split the executed command into commandName, arguments, options
     *
     * @param string $command
     */
    public function __construct(string $command)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function options(): array
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(string $option, string $alias = ''): bool
    {
        if (isset($this->options[$option])) {

            return true;
        }

        if ($alias !== '' && isset($this->options[$alias])) {

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionValue(string $option, string $alias = ''):? string
    {
        if (isset($this->options[$option])) {

            return $this->options[$option];
        }

        if ($alias !== '' && isset($this->options[$alias])) {

            return $this->options[$alias];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function arguments(): array
    {
        return $this->arguments;
    }

    /**
     * {@inheritdoc}
     */
    public function hasArgument(int $index): bool
    {
        return isset($this->arguments[$index]);
    }

    /**
     * {@inheritdoc}
     */
    public function getArgumentValue(int $index):? string
    {
        if (isset($this->arguments[$index])) {

            return $this->arguments[$index];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function commandName(): string
    {
        return $this->commandName;
    }
}