<?php

namespace Errors;

use function Siler\Http\Response\html;
use function Siler\Twig\render;

function notFoundError() {
    html(render('notfound.twig'));
    exit;
}
