<?php

namespace IceProductionz\ValueMiddleware\Factory;

use IceProductionz\Value\Identifier\Uuid;
use IceProductionz\Value\Number\Integer;
use IceProductionz\Value\Text\Short;
use IceProductionz\Value\Uri\Url;
use IceProductionz\ValueMiddleware\Exception\InvalidType;
use IceProductionz\ValueMiddleware\Exception\MissingKey;
use IceProductionz\ValueMiddleware\Exception\NotImplemented;

class Value
{
    /**
     * @param array $input
     *
     * @return \IceProductionz\Value\Value
     */
    public function toValue(array $input): \IceProductionz\Value\Value
    {
        if (!isset($input['type'])) {
            throw new MissingKey('`type` key is missing from $input array');
        }

        if (!isset($input['value'])) {
            throw new MissingKey('`value` key is missing from $input array');
        }

        if (!\is_string($input['type'])) {
            throw new InvalidType('`type` from array is not a string');
        }

        switch ($input['type']) {
            case 'identifier.uuid':
                return new Uuid($input['value']);
            case 'number.integer':
                return new Integer($input['value']);
            case 'text.short':
                return new Short($input['value']);
            case 'uri.url':
                return new Url($input['value']);
            default:
                throw new NotImplemented('`type` is not an array');
        }
    }
}