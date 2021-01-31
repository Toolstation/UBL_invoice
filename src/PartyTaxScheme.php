<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 13-10-2016
 * Time: 17:19
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class PartyTaxScheme implements XmlSerializable{

    private $companyId;

    private $taxScheme;

    /**
     * @return mixed
     */
    public function getCompanyId() {
        return $this->companyId;
    }

    /**
     * @param mixed $name
     * @return Party
     */
    public function setCompanyId($companyId) {
        $this->companyId = $companyId;
        return $this;
    }

    public function getTaxScheme() {
        return $this->getTaxScheme();
    }

    public function setTaxScheme($taxScheme) {
        $this->taxScheme = $taxScheme;
        return $this;
    }

    function xmlSerialize(Writer $writer) {
        $writer->write([
            Schema::CAC.'PartyTaxScheme' => [
                Schema::CBC.'CompanyID' => $this->companyId,
                Schema::CAC.'TaxScheme' => [Schema::CBC.'ID' => $this->taxScheme]
            ]
        ]);
    }
}
