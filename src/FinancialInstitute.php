<?php

namespace CleverIt\UBL\Invoice;


use Illuminate\Console\Scheduling\Schedule;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class FinancialInstitute implements XmlSerializable {
    private $id;
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
            Schema::CAC . 'FinancialInstitution' => [
                Schema::CBC . 'ID' => $this->id,
                Schema::CBC . 'Name' => $this->name,
            ]
        ]);
    }
}
