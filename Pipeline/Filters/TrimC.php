<?php


namespace Filters;


class TrimC implements FilterContract
{
    public function handle(string $filter)
    {
        return str_replace('c', '', $filter);
    }
}
