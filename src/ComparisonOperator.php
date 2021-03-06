<?php

namespace BaoPham\DynamoDb;

/**
 * Class DynamoDbOperator.
 */
class ComparisonOperator
{
    public static function getOperatorMapping()
    {
        return [
            '=' => 'EQ',
            '>' => 'GT',
            '>=' => 'GE',
            '<' => 'LT',
            '<=' => 'LE',
            'in' => 'IN',
            '!=' => 'NE',
            'begins_with' => 'BEGINS_WITH',
            'between' => 'BETWEEN',
            'not_contains' => 'NOT_CONTAINS',
            'contains' => 'CONTAINS',
        ];
    }

    public static function getSupportedOperators()
    {
        return array_keys(static::getOperatorMapping());
    }

    public static function isValidOperator($operator)
    {
        $operator = strtolower($operator);

        $mapping = static::getOperatorMapping();

        return isset($mapping[$operator]);
    }

    public static function getDynamoDbOperator($operator)
    {
        $mapping = static::getOperatorMapping();

        $operator = strtolower($operator);

        return $mapping[$operator];
    }

    public static function getQuerySupportedOperators()
    {
        return ['EQ'];
    }

    public static function isValidQueryOperator($operator)
    {
        $dynamoDbOperator = static::getDynamoDbOperator($operator);

        return static::isValidQueryDynamoDbOperator($dynamoDbOperator);
    }

    public static function isValidQueryDynamoDbOperator($dynamoDbOperator)
    {
        return in_array($dynamoDbOperator, static::getQuerySupportedOperators());
    }
}
