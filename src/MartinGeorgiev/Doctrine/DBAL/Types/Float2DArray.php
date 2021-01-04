<?php

declare(strict_types=1);

namespace MartinGeorgiev\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use MartinGeorgiev\Utils\DataStructure;

/**
 * Implementation of PostgreSql FLOAT[] data type.
 *
 * @see https://www.postgresql.org/docs/9.4/static/arrays.html
 * @since 0.1
 *
 * @author Martin Georgiev <martin.georgiev@gmail.com>
 */
class Float2DArray extends Base2DArray
{
    /**
     * @var string
     */
    protected const TYPE_NAME = 'float[][]';


    /**
     * Converts a value from its PHP representation to its database representation of the type.
     *
     * @param array|null $value the value to convert
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        return $this->transformToPostgresFloatArray($value);
    }

    protected function transformToPostgresFloatArray(array $phpFloatArray): string
    {
        if (!\is_array($phpFloatArray)) {
            throw new \InvalidArgumentException(\sprintf('Value %s is not an array', \var_export($phpFloatArray, true)));
        }
        if (empty($phpFloatArray)) {
            return '{{}}';
        }

        return DataStructure::transformPHPArrayToPostgresTextArray($phpTextArray);
    }

    /**
     * Converts a value from its database representation to its PHP representation of this type.
     *
     * @param string|null $value the value to convert
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?array
    {
        if ($value === null) {
            return null;
        }

        return $this->transformFromPostgresTextArray($value);
    }

    protected function transformFromPostgresTextArray(string $postgresValue): array
    {
        if ($postgresValue === '{{}}' || $postgresValue == null) {
            return [[]];
        }

        return DataStructure::transformPostgresTextArrayToPHPArray($postgresValue);
    }
}
