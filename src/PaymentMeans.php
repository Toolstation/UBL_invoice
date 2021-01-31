<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 25-10-2016
 * Time: 16:51
 */

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class PaymentMeans implements XmlSerializable {
    private $code = 'IBAN';
    private $dueDate;
    private $channelCode;
    private $payeeFinancialAccount;
    private $instructionNote;

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return PaymentMeans
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param mixed $dueDate
     * @return PaymentMeans
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChannelCode()
    {
        return $this->channelCode;
    }

    /**
     * @param mixed $channelCode
     * @return PaymentMeans
     */
    public function setChannelCode($channelCode)
    {
        $this->channelCode = $channelCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayeeFinancialAccount()
    {
        return $this->payeeFinancialAccount;
    }

    /**
     * @param mixed $payeeFinancialAccount
     * @return PaymentMeans
     */
    public function setPayeeFinancialAccount($payeeFinancialAccount)
    {
        $this->payeeFinancialAccount = $payeeFinancialAccount;
        return $this;
    }

    public function setInstructionNote($instructionNote)
    {
        $this->InstructionNote = $instructionNote;
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
            Schema::CBC . 'PaymentMeansCode' => $this->code,
            Schema::CBC . 'PaymentDueDate' => $this->dueDate,
            Schema::CBC . 'PaymentChannelCode' => $this->channelCode,
            Schema::CAC . 'PayeeFinancialAccount' => $this->payeeFinancialAccount,
            //Schema::CBC . 'InstructionNote' => $this->instructionNote,
        ]);
    }
}
