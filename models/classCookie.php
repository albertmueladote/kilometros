<?php
class Cookie {
    private function string() {
        return 'L&GD5@=1C[QHK&#,3w8Zk!T{SW.i*DKx?!?Ri9J[8S&yLd-an?';
    }

    public function create() {
        $value = $this->string();
        $expiryTime = time() + (7 * 24 * 60 * 60);
        setcookie(COOKIE, $value, $expiryTime, "/");
        return true;
    }

    public function exists() {
        return isset($_COOKIE[COOKIE]);
    }

    public function delete() {
        setcookie(COOKIE, "", time() - 3600, "/");
        unset($_COOKIE[COOKIE]);
        return true;
    }
}
?>