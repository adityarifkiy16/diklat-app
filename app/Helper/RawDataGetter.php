<?php

namespace App\Helper;

use ParseCsv\Csv;

class RawDataGetter
{
    /**
     * Raw Data file path.
     *
     * @return string
     */
    protected static $path = __DIR__ . '/../data';

    /**
     * Get provinces data.
     *
     * @return array
     */
    public static function getProvinces()
    {
        $result = self::getCsvData(self::$path . '/provinces.csv');
        foreach ($result as &$row) {
            if (isset($row['id'])) {
                $row['id'] = str_replace('.', '', $row['id']);
            }
        }
        return $result;
    }

    /**
     * Get regencies data.
     *
     * @return array
     */
    public static function getRegencies()
    {
        $result = self::getCsvData(self::$path . '/regencies.csv');
        foreach ($result as &$row) {
            if (isset($row['id'])) {
                $row['id'] = str_replace('.', '', $row['id']);
            }
        }

        return $result;
    }

    /**
     * Get districts data.
     *
     * @return array
     */
    public static function getDistricts()
    {
        $result = self::getCsvData(self::$path . '/districts.csv');

        foreach ($result as &$row) {
            if (isset($row['id'])) {
                $row['id'] = str_replace('.', '', $row['id']);
            }
            if (isset($row['regency_id'])) {
                $row['regency_id'] = str_replace('.', '', $row['regency_id']);
            }
        }

        return $result;
    }

    /**
     * Get villages data.
     *
     * @return array
     */
    public static function getVillages()
    {
        $result = self::getCsvData(self::$path . '/villages.csv');

        foreach ($result as &$row) {
            if (isset($row['id'])) {
                $row['id'] = str_replace('.', '', $row['id']);
            }
            if (isset($row['district_id'])) {
                $row['district_id'] = str_replace('.', '', $row['district_id']);
            }
        }

        return $result;
    }

    /**
     * Get Data from CSV.
     *
     * @param string $path File Path.
     *
     * @return array
     */
    public static function getCsvData($path = '')
    {
        $csv = new Csv();
        $csv->auto($path);

        return $csv->data;
    }
}
