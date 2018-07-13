<?php

namespace Filters;


class TrimString implements FilterContract
{
    /**
     * @param $filter string
     * @return string
     */
    public function handle($filter)
    {
        return str_replace('afsd', '', $filter);
    }
}
