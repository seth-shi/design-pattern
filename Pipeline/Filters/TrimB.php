<?php

namespace Filters;

class TrimB implements FilterContract
{
    public function handle(string $filter)
    {
        return str_replace('b', '', $filter);
    }
}
