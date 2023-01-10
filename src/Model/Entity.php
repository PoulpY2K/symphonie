<?php

namespace App\Model;

use Doctrine\Common\Collections\Collection;

abstract class Entity
{
    public function __construct(?array $payload = null)
    {
        $this->hydrate($payload);
    }

    public function hydrate(?array $payload = null)
    {
        if (!empty($payload)) {
            foreach ($payload as $attribut => $value) {
                if (is_array($value)) {
                    $method = 'get'.ucfirst($attribut);
                    if (is_callable([$this, $method]) && !empty($this->$method())) {
                        $object = $this->$method();

                        if ($object instanceof Collection) {
                            $object->clear();
                            foreach ($value as $val) {
                                $className = ucfirst(substr($attribut, 0, strlen($attribut) - 1));

                                if (is_array($val)) {
                                    $class = '\\App\\Entity\\'.$className;
                                    $val = new $class($val);
                                }

                                $method = 'add'.$className;

                                if (is_callable([$this, $method])) {
                                    $this->$method($val);
                                }
                            }
                        } else {
                            $object->hydrate($value);
                            $value = $object;
                        }
                    } else {
                        $class = '\\App\\Entity\\'.ucfirst($attribut);
                        $value = new $class($value);
                    }
                }

                $method = 'set'.ucfirst($attribut);

                if (is_callable([$this, $method])) {
                    $this->$method($value);
                }
            }
        }
    }
}
