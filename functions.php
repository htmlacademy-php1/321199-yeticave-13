<?php

function xssAdg(string $e):string
{
    return htmlspecialchars($e);
}
