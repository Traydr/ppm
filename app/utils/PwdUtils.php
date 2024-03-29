<?php

class PwdUtils {
    /**
     * Encrypts any password
     * @param string $pwd Plain-text password
     * @return string Base64 encoded string
     */
    public static function encryptPassword(string $pwd): string {
        return base64_encode(openssl_encrypt($pwd, "aes-256-cbc", $_SESSION['master_key'], OPENSSL_RAW_DATA));
    }

    /**
     * Decrypts any password
     * @param string $pwd Plain-text password
     * @return string Decrypted password
     */
    public static function decryptPassword(string $pwd): string {
        return openssl_decrypt(base64_decode($pwd), "aes-256-cbc", $_SESSION['master_key'], OPENSSL_RAW_DATA);
    }

    /**
     * Encrypts the master password
     * @param string $master Plain-text master password
     * @param string $pwd Plain-text password
     * @return string Base64 encoded string
     */
    public static function encryptMaster(string $master, string $pwd): string {
        return base64_encode(openssl_encrypt($master, "aes-256-cbc", $pwd, OPENSSL_RAW_DATA));
    }

    /**
     * Decrypts the master password
     * @param string $encrypted_master An encoded Base64 string
     * @param string $pwd Plain-text password
     * @return string
     */
    public static function decryptMaster(string $encrypted_master, string $pwd): string {
        return openssl_decrypt(base64_decode($encrypted_master), "aes-256-cbc", $pwd, OPENSSL_RAW_DATA);
    }

    /**
     * Creates a new master key
     * @return string Master Key
     */
    public static function generateMasterKey(): string {
        return base64_encode(openssl_random_pseudo_bytes(64));
    }
}
