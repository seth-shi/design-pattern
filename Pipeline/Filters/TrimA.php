<?php

namespace Filters;

class TrimA implements FilterContract
{
    public function handle(string $filter)
    {
        return str_replace('a', '', $filter);
    }
}
