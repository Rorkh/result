<?php

namespace Ren\Result;

use Exception;

class Result
{
    /**
     * Type of result
     *
     * @var ResultType
     */
    private ResultType $type;
    /**
     * Value of result
     *
     * @var mixed
     */
    private mixed $value;

    /**
     * Result constructor
     *
     * @param ResultType $type
     * @param mixed $value
     */
    public function __construct(ResultType $type, mixed $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->type->name;
    }

    /**
     * Returns type name of object
     *
     * @return string
     */
    public function type(): string
    {
        return (string) $this;
    }

    /**
     * Returns class object with ResultType::Ok and specified value
     *
     * @param mixed $value
     * @return Result
     */
    public static function ok(mixed $value): Result
    {
        return new self(ResultType::Ok, $value);
    }

    /**
     * Returns class object with ResultType::Error and specified value
     *
     * @param mixed $value
     * @return Result
     */
    public static function error(mixed $value): Result
    {
        return new self(ResultType::Error, $value);
    }

    /**
     * Returns class object with ResultType::Error and specified value
     *
     * @param mixed $value
     * @return Result
     */
    public static function err(mixed $value): Result
    {
        return new self(ResultType::Error, $value);
    }

    /**
     * Returns true if the result is ResultType::Ok.
     *
     * @return boolean
     */
    public function isOk(): bool
    {
        return $this->type == ResultType::Ok;
    }

    /**
     * Returns true if the result is ResultType::Ok and the value inside of it matches a predicate.
     *
     * @param callable $callback
     * @return boolean
     */
    public function isOkAnd(callable $callback): bool
    {
        return $callback($this->value) and $this->isOk();
    }

    /**
     * Returns true if the result is Err.
     *
     * @return boolean
     */
    public function isErr(): bool
    {
        return $this->type == ResultType::Error;
    }

    /**
     * Returns true if the result is ResultType::Error and the value inside of it matches a predicate.
     *
     * @param callable $callback
     * @return boolean
     */
    public function isErrAnd(callable $callback): bool
    {
        return $callback($this->value) and $this->isErr();
    }

    /**
     * Calls callback if the result is ResultType::Ok, otherwise returns the value of self.
     *
     * @param callable $callback
     * @return Result
     */
    public function andThen(callable $callback): Result
    {
        if ($this->isOk()) {
            return $callback($this->value);
        }
        return Result::error($this->value);
    }

    /**
     * Calls callback if the result is ResultType::Error, otherwise returns the value of self.
     *
     * @param callable $callback
     * @return Result
     */
    public function orElse(callable $callback): Result
    {
        if ($this->isErr()) {
            return $callback($this->value);
        }
        return Result::error($this->value);
    }

    /**
     * Returns the contained ResultType::Ok value
     * Calls exception with value message if the result type is ResultType::Error
     *
     * @return mixed
     * @throws Exception
     */
    public function unwrap(): mixed
    {
        if ($this->isErr()) {
            throw new Exception($this->value);
        }
        return $this->value;
    }

    /**
     * Returns the contained ResultType::Error value
     * Calls exception with value message if the result type is ResultType::Ok
     *
     * @return mixed
     * @throws Exception
     */
    public function unwrapErr(): mixed
    {
        if ($this->isOk()) {
            throw new Exception($this->value);
        }
        return $this->value;
    }
}

