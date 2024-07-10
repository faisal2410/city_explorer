<?php
namespace App\App\Models;
class WorldCityModel 
{
    public function __construct(
        public int $id,
        public string $city,
        public string $cityAscii,
        public float $lat,
        public float $lng,
        public string $country,
        public string $iso2,
        public string $iso3,
        public string $adminName,
        public string $capital,
        public int $population
    ) {
    }

    public function getCityWithCountry(): string
    {
        return "{$this->city} ({$this->getFlag()} $this->country)";
    }

    public function getFlag(): string
    {
        return $this->get_flag_for_country($this->iso2);
    }

    private function get_flag_for_country(string $iso2): string
    {
        $iso2 = strtolower($iso2);
        if (strlen($iso2) !== 2) {
            return $iso2;
        }
        return mb_chr(127462 + ord($iso2[0]) - ord('a')) .
        mb_chr(127462 + ord($iso2[1]) - ord('a'));
    }
}