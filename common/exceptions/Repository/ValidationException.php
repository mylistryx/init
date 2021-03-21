<?php

declare(strict_types=1);

namespace common\exceptions\Repository;

use Throwable;

final class ValidationException extends \DomainException
{
    private array $errors;

    /**
     * ValidationException constructor.
     * @param string $message
     * @param array $errors
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", array $errors = [], int $code = 0, Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}