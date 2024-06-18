<?php
namespace App\Enums;

enum DocumentTypes: string {
    case CI = 'CI';
    case Passport = 'Passport';
    case NIT = 'NIT';

    public function toString(): ?string
    {
        return match ($this) {
            self::CI => 'CI',
            self::Passport => 'Passport',
            self::NIT => 'NIT',
        };
    }

    /*public static function fromString(string $value): self
    {
        return match ($value) {
            'CI' => self::CI,
            'Passport' => self::Passport,
            'NIT' => self::NIT,
        };
    }*/

    public function getColor(): string
    {
        return match ($this) {
            self::CI => 'green',
            self::Passport => 'blue',
            self::NIT => 'red',
        };
    }

}


?>
