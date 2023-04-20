<?php

class password_generator {
    private int $passwordLength;
    private bool $hasUpperCase;
    private bool $hasLowerCase;
    private bool $hasSymbols;
    private bool $hasNumbers;

    public function __construct(int $passwordLength, bool $hasNumbers, bool $hasSymbols, bool $hasUpperCase, bool $hasLowerCase) {
        $this->passwordLength = $passwordLength;
        $this->hasNumbers = $hasNumbers;
        $this->hasSymbols = $hasSymbols;
        $this->hasUpperCase = $hasUpperCase;
        $this->hasLowerCase = $hasLowerCase;
    }

    /**
     * Generates a password based on the previous parameters
     * @return string The password
     * @throws Exception
     */
    public function generate(): string {
        if ($this->passwordLength <= 0) {
            throw new Exception("Password length cannot be less than 1");
        } else if ($this->passwordLength > 128) {
            throw new Exception("Password length cannot be more than 128");
        }

        if (!$this->hasLowerCase && !$this->hasUpperCase && !$this->hasSymbols && !$this->hasNumbers) {
            throw new Exception("At least 1 option must be enabled");
        }

        $pwd = "";

        for ($i = 0; $i < $this->passwordLength;) {
            $switch = rand(0, 3);

            // lowercase character
            if (($switch == 0) && $this->hasLowerCase) {
                $pwd .= chr(rand(97, 122));
                $i++;
            }

            // uppercase character
            if (($switch == 1) && $this->hasUpperCase) {
                $pwd .= chr(rand(65, 90));
                $i++;
            }

            // number
            if (($switch == 2) && $this->hasNumbers) {
                $pwd .= chr(rand(48, 57));
                $i++;
            }

            // symbol
            if (($switch == 3) && $this->hasSymbols) {
                $pwd .= chr(rand(37, 47));
                $i++;
            }
        }

        return $pwd;
    }

    /**
     * @return int
     */
    public function getPasswordLength(): int {
        return $this->passwordLength;
    }

    /**
     * @param int $passwordLength
     */
    public function setPasswordLength(int $passwordLength): void {
        $this->passwordLength = $passwordLength;
    }

    /**
     * @return bool
     */
    public function isHasSymbols(): bool {
        return $this->hasSymbols;
    }

    /**
     * @param bool $hasSymbols
     */
    public function setHasSymbols(bool $hasSymbols): void {
        $this->hasSymbols = $hasSymbols;
    }

    /**
     * @return bool
     */
    public function isHasUpperCase(): bool {
        return $this->hasUpperCase;
    }

    /**
     * @param bool $hasUpperCase
     */
    public function setHasUpperCase(bool $hasUpperCase): void {
        $this->hasUpperCase = $hasUpperCase;
    }

    /**
     * @return bool
     */
    public function isHasNumbers(): bool {
        return $this->hasNumbers;
    }

    /**
     * @param bool $hasNumbers
     */
    public function setHasNumbers(bool $hasNumbers): void {
        $this->hasNumbers = $hasNumbers;
    }

    /**
     * @return bool
     */
    public function isHasLowerCase(): bool {
        return $this->hasLowerCase;
    }

    /**
     * @param bool $hasLowerCase
     */
    public function setHasLowerCase(bool $hasLowerCase): void {
        $this->hasLowerCase = $hasLowerCase;
    }
}
