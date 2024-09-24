<?php

declare(strict_types=1);

include_once('A.php');
include_once('B.php');
include_once('C.php');
include_once('I.php');

class Demo
{

    // Trả về đối tượng A
    public function typeA(): A
    {
        echo __FUNCTION__ . "<br>";
        return new A();
    }

    // Trả về đối tượng B
    public function typeB(): B
    {
        echo __FUNCTION__ . "<br>";
        return new B();
    }

    // Trả về đối tượng C
    public function typeC(): C
    {
        echo __FUNCTION__ . "<br>";
        return new C();
    }

    // Trả về đối tượng I (interface không thể trả về trực tiếp)
    public function typeI(): I
    {
        echo __FUNCTION__ . "<br>";
        return new C(); 
    }

    // Trả về Null
    public function typeNull(): ?C
    {
        echo __FUNCTION__ . "<br>";
        return null;
    }

    // Trả về A, nhưng kiểu khai báo là C
    public function typeC_ReturnA(): C
    {
        echo __FUNCTION__ . "<br>";
        return new A(); 
    }

    // Trả về B, nhưng kiểu khai báo là C
    public function typeC_ReturnB(): C
    {
        echo __FUNCTION__ . "<br>";
        return new B(); 
    }

    // Trả về C và khai báo C
    public function typeC_ReturnC(): C
    {
        echo __FUNCTION__ . "<br>";
        return new C(); 
    }

    // Trả về null với kiểu khai báo C
    public function typeC_ReturnNull(): ?C
    {
        echo __FUNCTION__ . "<br>";
        return null; 
    }

    // Trả về A, nhưng kiểu khai báo là B (False)
    public function typeB_ReturnA(): B
    {
        echo __FUNCTION__ . "<br>";
        return new A(); 
    }

    // Trả về C, nhưng kiểu khai báo là A (False)
    public function typeA_ReturnC(): A
    {
        echo __FUNCTION__ . "<br>";
        return new C(); 
    }

    // Trả về A với kiểu khai báo A
    public function typeA_ReturnA(): A
    {
        echo __FUNCTION__ . "<br>";
        return new A(); 
    }

    // Trả về B với kiểu khai báo B
    public function typeB_ReturnB(): B
    {
        echo __FUNCTION__ . "<br>";
        return new B();
    }

    // Trả về C, nhưng kiểu khai báo là interface I (True)
    public function typeI_ReturnC(): I
    {
        echo __FUNCTION__ . "<br>";
        return new C(); 
    }

    // Trả về null với kiểu khai báo interface I (False)
    public function typeI_ReturnNull(): ?I
    {
        echo __FUNCTION__ . "<br>";
        return null; 
    }

    // Trả về C với kiểu khai báo interface I (True)
    public function typeI_ReturnC2(): I
    {
        echo __FUNCTION__ . "<br>";
        return new C(); 
    }

    // Trả về A, nhưng kiểu khai báo là interface I (False)
    public function typeI_ReturnA(): I
    {
        echo __FUNCTION__ . "<br>";
        return new A(); 
    }

    // Trả về B, nhưng kiểu khai báo là interface I (False)
    public function typeI_ReturnB(): I
    {
        echo __FUNCTION__ . "<br>";
        return new B(); 
    }

    // Trả về C, nhưng kiểu khai báo là Null (False)
    public function typeNull_ReturnC(): ?C
    {
        echo __FUNCTION__ . "<br>";
        return new C(); 
    }

    // Trả về null nhưng kiểu khai báo là A (False)
    public function typeA_ReturnNull(): ?A
    {
        echo __FUNCTION__ . "<br>";
        return null; 
    }

    // Trả về A nhưng kiểu khai báo là null (False)
    public function typeNull_ReturnA(): ?A
    {
        echo __FUNCTION__ . "<br>";
        return new A(); 
    }

    // Trả về B nhưng kiểu khai báo là null (False)
    public function typeNull_ReturnB(): ?B
    {
        echo __FUNCTION__ . "<br>";
        return new B(); 
    }

    // Trả về I nhưng kiểu khai báo là null (False)
    public function typeNull_ReturnI(): ?I
    {
        echo __FUNCTION__ . "<br>";
        return new C(); 
    }

    // Trả về null với kiểu khai báo là C (True)
    public function typeC_ReturnNull2(): ?C
    {
        echo __FUNCTION__ . "<br>";
        return null; 
    }
}

$demo = new Demo();

$obj1 = $demo->typeA(); // True
$obj2 = $demo->typeB(); // True
$obj3 = $demo->typeC(); // True
$obj4 = $demo->typeI(); // True
$obj5 = $demo->typeNull(); // Null

$obj6 = $demo->typeC_ReturnA(); // True
$obj7 = $demo->typeC_ReturnB(); // True
$obj8 = $demo->typeC_ReturnC(); // True
$obj9 = $demo->typeC_ReturnNull(); // Null

try {
    $obj10 = $demo->typeB_ReturnA(); // False
} catch (TypeError $e) {
    echo "False: " . $e->getMessage() . "<br>";
}

try {
    $obj11 = $demo->typeA_ReturnC(); // False
} catch (TypeError $e) {
    echo "False: " . $e->getMessage() . "<br>";
}

$obj12 = $demo->typeA_ReturnA(); // True
$obj13 = $demo->typeB_ReturnB(); // True
$obj14 = $demo->typeI_ReturnC(); // True

$obj15 = $demo->typeI_ReturnNull(); // Null
$obj16 = $demo->typeI_ReturnC2(); // True

try {
    $obj17 = $demo->typeI_ReturnA(); // False
} catch (TypeError $e) {
    echo "False: " . $e->getMessage() . "<br>";
}

try {
    $obj18 = $demo->typeI_ReturnB(); // False
} catch (TypeError $e) {
    echo "False: " . $e->getMessage() . "<br>";
}

$obj19 = $demo->typeNull_ReturnC(); // False

$obj20 = $demo->typeA_ReturnNull(); // Null
$obj21 = $demo->typeNull_ReturnA(); // False
$obj22 = $demo->typeNull_ReturnB(); // False
$obj23 = $demo->typeNull_ReturnI(); // False
$obj24 = $demo->typeC_ReturnNull2(); // Null
