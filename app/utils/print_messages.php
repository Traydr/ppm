<?php

class print_messages {
    /**
     * Prints a success message
     * @param string $inner Message
     * @return void
     */
    public static function printInfo(string $inner): void {
        print "<div class='d-flex justify-content-center text-success border-bottom fs-1'><a>" . $inner . "</a></div><br>";
    }

    /**
     * Prints an error message to the user
     * @param string $inner Message
     * @return void
     */
    public static function printError(string $inner): void {
        print "<div class='d-flex justify-content-center text-danger border-bottom fs-2'><a>" . $inner . "</a></div><br>";
    }

    /**
     * Debug only message
     * @param string $inner Message
     * @return void
     */
    public static function printDebug(string $inner): void {
        print "<div class='d-flex justify-content-center text-black bg-info border-bottom fs-2'><a>" . $inner . "</a></div><br>";
    }

    /**
     * Prints an array in the same style as printDebug
     * @param array $inner Any Array
     * @return void
     */
    public static function printArray(array $inner): void {
        print "<div class='d-flex justify-content-center text-black bg-info border-bottom fs-2'><a>" . print_r($inner, true) . "</a></div><br>";
    }
}
