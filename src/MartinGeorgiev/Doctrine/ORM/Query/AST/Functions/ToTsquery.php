<?php

declare(strict_types=1);

namespace MartinGeorgiev\Doctrine\ORM\Query\AST\Functions;

/**
 * Implementation of PostgreSql TO_TSQUERY().
 *
 * @see https://www.postgresql.org/docs/9.4/static/textsearch-controls.html
 * @since 0.1
 *
 * @author Martin Georgiev <martin.georgiev@gmail.com>
 */
class ToTsquery extends BaseVariadicFunction
{
    protected function customiseFunction(): void
    {
        $this->setFunctionPrototype('to_tsquery(%s)');
    }
}
