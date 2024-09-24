<?php
require_once('C.php'); // Nhúng class C chỉ một lần

class B extends C {
    public function b1() {
        echo "This is function b1 from class B<br>";
    }
}
?>
