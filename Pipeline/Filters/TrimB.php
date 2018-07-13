<?php

namespace Filters;

class TrimB implements FilterContract
{
    /**
     * @param $filter string
     * @return string
     */
    public function handle($filter)
    {
        return str_replace('b', '', $filter);
    }
}
