<?php

class InvertedSerial
{
    public function add($id = null, $type = null)
    {
        echo "ADD called | ID: $id | TYPE: $type";
    }

    public function update($model = null, $status = null)
    {
        echo "UPDATE called | MODEL: $model | STATUS: $status";
    }

    public function delete($id)
    {
        echo "DELETE called | ID: $id";
    }
}

$method = $_GET['method'] ?? '';

$controller = new InvertedSerial();

if ($method && method_exists($controller, $method)) {

    $ref = new ReflectionMethod($controller, $method);

    if (!$ref->isPublic()) {
        exit("Method not accessible");
    }

    // 🔥 get method parameters
    $params = [];

    foreach ($ref->getParameters() as $param) {
        $name = $param->getName();

        if (isset($_GET[$name])) {
            $params[] = $_GET[$name];
        } elseif ($param->isDefaultValueAvailable()) {
            $params[] = $param->getDefaultValue();
        } else {
            $params[] = null;
        }
    }

    // 🔥 dynamic call with params
    $ref->invokeArgs($controller, $params);

} else {
    echo "Method not found";
}
