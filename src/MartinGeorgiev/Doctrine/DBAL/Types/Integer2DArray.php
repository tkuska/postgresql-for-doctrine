<?php

declare(strict_types=1);

namespace MartinGeorgiev\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\ConversionException;
use MartinGeorgiev\Utils\DataStructure;

/**
 * Implementation of PostgreSql INTEGER[] data type.
 *
 * @see https://www.postgresql.org/docs/9.4/static/arrays.html
 * @since 0.1
 *
 * @author Martin Georgiev <martin.georgiev@gmail.com>
 */
class Integer2DArray extends Base2DArray
{
    /**
     * @var string
     */
    protected const TYPE_NAME = 'integer[][]';

    protected function getMinValue(): string
    {
        return '-2147483648';
    }

    protected function getMaxValue(): string
    {
        return '2147483647';
    }

    /**
     * @param mixed $item
     */
    public function isValidArrayItemForDatabase($item): bool
    {
        return (\is_int($item) || \is_string($item))
            && (bool) \preg_match('/^-?[0-9]+$/', (string) $item)
            && (string) $item >= $this->getMinValue()
            && (string) $item <= $this->getMaxValue();
    }


    protected function transformFromPostgresTextArray(string $postgresValue): array
    {
        if ($postgresValue === '{{}}') {
            return [[]];
        }

        return DataStructure::transformPostgresTextArrayToPHPArray($postgresValue);
    }
}
