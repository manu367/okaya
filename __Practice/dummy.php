<?php

function greet()
{
    echo "helo";
}
class Hello{
    function __construct()
    {

    }

    function greetManu()
    {
        greet();
    }
}

greet();
(new Hello())->greetManu();

?>