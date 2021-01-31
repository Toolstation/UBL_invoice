<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 25-10-2016
 * Time: 12:29
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Address implements XmlSerializable{
    private $streetName;
    private $buildingNumber;
    private $cityName;
    private $postalZone;
    private $department;
    /**
     * @var Country
     */
    private $country;

    /**
     * @return mixed
     */
    public function getStreetName() {
        return $this->streetName;
    }

    /**
     * @param mixed $streetName
     * @return Address
     */
    public function setStreetName($streetName) {
        $this->streetName = $streetName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBuildingNumber() {
        return $this->buildingNumber;
    }

    /**
     * @param mixed $buildingNumber
     * @return Address
     */
    public function setBuildingNumber($buildingNumber) {
        $this->buildingNumber = $buildingNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCityName() {
        return $this->cityName;
    }

    /**
     * @param mixed $cityName
     * @return Address
     */
    public function setCityName($cityName) {
        $this->cityName = $cityName;
        return $this;
    }


    /**
     * @param mixed $sdepartment
     * @return Address
     */
    public function setDepartment($department) {
        $this->department = $department;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getPostalZone() {
        return $this->postalZone;
    }

    /**
     * @param mixed $postalZone
     * @return Address
     */
    public function setPostalZone($postalZone) {
        $this->postalZone = $postalZone;
        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * @param Country $country
     * @return Address
     */
    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    function xmlSerialize(Writer $writer) {
        // TODO: Implement xmlSerialize() method.
        $cbc = '{urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2}';
        $cac = '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}';

        $addressData = [];
        if (!empty($this->department)) {
            $addressData[Schema::CBC.'Department'] = $this->department;
        }
        if (!empty($this->streetName)) {
            $addressData[Schema::CBC.'StreetName'] = $this->streetName;
        }
        if (!empty($this->buildingNumber)) {
            $addressData[Schema::CBC.'BuildingNumber'] = $this->buildingNumber;
        }
        $addressData[Schema::CBC.'CityName'] = $this->cityName;
        $addressData[Schema::CBC.'PostalZone'] = $this->postalZone;
        $addressData[Schema::CAC.'Country'] = $this->country;

        $writer->write($addressData);
    }
}
