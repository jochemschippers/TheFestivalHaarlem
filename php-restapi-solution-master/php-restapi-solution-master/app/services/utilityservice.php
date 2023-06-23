<?php
class UtilityService
{
    public function createAndValidateObject($data, $className, $constructorArgs, $argTypes)
    {
        try {
            $constructorArgs = $this->validateObject($data, $constructorArgs, $argTypes);
            return $this->createObject($className, $constructorArgs, $data);
        } catch (TypeError $e) {
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
            return null;
        }
    }
    private function validateObject($data, $constructorArgs, $argTypes)
    {
        $argKeys = array_keys($data);

        foreach ($constructorArgs as $index => $value) {
            $type = gettype($value);
            $key = $this->checkForUnknownKey($index, $argKeys);
            $expectedType = $argTypes[$index];

            if ($type !== $expectedType) {
                $castedValue = $this->castValueToExpectedType($expectedType, $value);
                $this->checkCastedValue($castedValue, $expectedType, $key, $type, $index, $constructorArgs);
            }
        }

        return $constructorArgs;
    }

    private function checkForUnknownKey($index, $argKeys)
    {
        $key = $index < count($argKeys) ? $argKeys[$index] : "unknown";

        if ($key === "unknown") {
            throw new TypeError("Something went wrong! Please contact support.");
        }

        return $key;
    }

    private function castValueToExpectedType($expectedType, $value)
    {
        switch ($expectedType) {
            case 'integer':
                return (int) $value;
            case 'string':
                return (string) $value;
            case 'double':
                return $this->castDouble($value);
            case 'object':
                return $value;
            case 'dateTime':
                return DateTime::createFromFormat('Y-m-d H:i:s', $value);
            default:
                return null;
        }
    }

    private function castDouble($value)
    {
        //casted into float, because in the models, we have all objects stored as float, however when using getType, the gettype() 
        //function will return 'double' since that's how PHP internally represents floating-point numbers.  
        $castedValue = (float) $value;

        if ($value != '0' && $castedValue == 0) {
            $castedValue = '';
        }

        return $castedValue;
    }

    private function checkCastedValue($castedValue, $expectedType, $key, $type, $index, &$constructorArgs)
    {
        if (gettype($castedValue) === $expectedType) {
            // Update the value in constructor arguments to the casted value, prevents error in the object creation class
            $constructorArgs[$index] = $castedValue;
        } else {
            throw new TypeError("Something went wrong! We expected a {$expectedType} value for the {$this->toReadableString($key)}, but a {$type} value was given. Please check the provided data.");
        }
    }
    private function createObject($className, $constructorArgs, $data)
    {
        $reflection = new ReflectionClass($className);
        $object = $reflection->newInstanceArgs();

        $keys = array_keys($data);
        for ($i = 0; $i < count($data); $i++) {
            $key = $keys[$i];
            try {
                $setter = 'set' . ucfirst($key);
                if (method_exists($object, $setter)) {
                    try {
                        $object->{$setter}($constructorArgs[$i]);
                    } catch (TypeError $e) {
                        throw new TypeError("{$this->toReadableString($key)} has invalid parameters. Please check the provided data.");
                    }
                } else {
                    throw new TypeError("Invalid property: {$this->toReadableString($key)}. Please check the provided data.");
                }
            } catch (TypeError $e) {
                throw $e;
            }
        }
        return $object;
    }
    private function toReadableString($input)
    {
        $output = preg_replace('/(?<=\\w)(?=[A-Z])/', " $1", $input);
        $output = ucfirst($output);

        return $output;
    }
}
