<?php

namespace Filters;


class TrimString implements FilterContract
{
    public function handle(string $filter)
    {
        return str_replace('afsd', '', $filter);
    }
}
