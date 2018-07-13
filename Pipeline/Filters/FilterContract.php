<?php

namespace Filters;

interface FilterContract
{
    public function handle(string $filter);
}
