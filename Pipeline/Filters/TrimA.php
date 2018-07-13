<?php

namespace Filters;

class TrimA implements FilterContract
{
    /**
     * @param $filter string
     * @return string
     */
    public function handle($filter)
    {
        return str_replace('a', '', $filter);
    }
}
