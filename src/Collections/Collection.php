<?php

namespace Mihaib\PortalJustService\Collections;

class Collection
{
    public function __construct(
        public array $items = []
    ) {
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function filter($callback): self
    {
        $items = array_filter($this->items, $callback);

        return new self($items);
    }

    public function filterWhen(mixed $value, $callback): self
    {
        if (!$value) {
            return $this;
        }

        return $this->filter($callback);
    }

    public function each(callable $callback): void
    {
        foreach ($this->items as $item) {
            $callback($item);
        }
    }

    public function map(callable $callback): array
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = $callback($item);
        }

        return $items;
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
