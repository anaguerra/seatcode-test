<?php declare(strict_types=1);

namespace SeatCode\Interview\Domain\Collections;

use Countable;
use IteratorAggregate;
use SeatCode\Interview\Domain\Exception\InvalidArgumentException;

abstract class ObjectCollection implements IteratorAggregate, Countable
{
    protected array $items = [];

    public function __construct(array $items = [])
    {
        $this->items = [];
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    abstract public static function allowedObjectClass(): string;

    /**
     * @param mixed $item
     */
    abstract protected function itemAssertions($item): void;

    /**
     * @param mixed $item
     */
    public function add($item): void
    {
        $this->assertItemType($item);
        $this->itemAssertions($item);
        $this->items[] = $item;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    public function hasElements(): bool
    {
        return $this->count() > 0;
    }

    /**
     * @param mixed $item
     */
    private function assertItemType($item): void
    {
        $expectedObjectClass = static::allowedObjectClass();
        if (! $item instanceof $expectedObjectClass) {
            throw new InvalidArgumentException(
                sprintf('Invalid item. This collection supports %s items only.', $expectedObjectClass)
            );
        }
    }

    public function union(ObjectCollection ...$collections): void
    {
        foreach ($collections as $collection) {
            foreach ($collection as $item) {
                $this->add($item);
            }
        }
    }

    public function reset(): void
    {
        $this->items = [];
    }
}
