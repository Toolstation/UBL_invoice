<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 25-10-2016
 * Time: 13:44
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Contact implements XmlSerializable {
    private $telephone;
    private $telefax;
    private $electronicMail;
    private $contactName;

    /**
     * @return mixed
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     * @return Contact
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefax() {
        return $this->telefax;
    }

    /**
     * @param mixed $telefax
     * @return Contact
     */
    public function setTelefax($telefax) {
        $this->telefax = $telefax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getElectronicMail() {
        return $this->electronicMail;
    }

    /**
     * @param mixed $contactName
     * @return Contact
     */
    public function setContactName($contactName) {
        $this->contactName = $contactName;
        return $this;
    }

    /**
     * @param mixed $electronicMail
     * @return Contact
     */
    public function setElectronicMail($electronicMail) {
        $this->electronicMail = $electronicMail;
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
        if(!empty($this->contactName)) {
            $writer->write([
                Schema::CBC . 'Name' => $this->contactName
            ]);
        }

        if(!empty($this->telephone)) {
            $writer->write([
                Schema::CBC . 'Telephone' => $this->telephone
            ]);
        }

        if(!empty($this->telefax)) {
            $writer->write([
                Schema::CBC . 'Telefax' => $this->telefax
            ]);
        }

        if(!empty($this->electronicMail)) {
            $writer->write([
                Schema::CBC . 'ElectronicMail' => $this->electronicMail
            ]);
        }
    }

}
