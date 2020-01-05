<?php

namespace Errors;

use function Siler\Http\Response\html;
use function Siler\Twig\render;

/**
 * Display the not found error page.
 *
 * @return void
 */
function notFoundError()
{
    html(render('notfound.twig'), 404);
    exit;
}

/**
 * Display the internal server error page.
 *
 * @return void
 */
function internalServerError()
{
    html('Internal Server Error', 500);
    exit;
}
