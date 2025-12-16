<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 25-10-2016
 * Time: 16:39
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class PeppolItem implements XmlSerializable {
    private $description;
    private $name;
    private $sellersItemIdentification;

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Item
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Item
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSellersItemIdentification() {
        return $this->sellersItemIdentification;
    }

    /**
     * @param mixed $sellersItemIdentification
     * @return Item
     */
    public function setSellersItemIdentification($sellersItemIdentification) {
        $this->sellersItemIdentification = $sellersItemIdentification;
        return $this;
    }



    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    function xmlSerialize(Writer $writer) {
        $writer->write([
           Schema::CBC.'Description' => $this->description,
           Schema::CBC.'Name' => $this->name,
           Schema::CAC.'SellersItemIdentification' => [
               Schema::CBC.'ID' => $this->sellersItemIdentification
           ],
           Schema::CAC.'ClassifiedTaxCategory' => [
               Schema::CBC.'ID' => 'S', // S is for VAT https://docs.peppol.eu/poacc/billing/3.0/codelist/UNCL5305/
               Schema::CBC.'Percent' => '21',
               Schema::CAC.'Percent' => [
                   Schema::CBC.'ID' => 'VAT',
               ]
           ],
        ]);
    }
}