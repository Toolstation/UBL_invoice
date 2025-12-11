<?php

namespace CleverIt\UBL\Invoice;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class PeppolInvoice implements XmlSerializable{

    const UBL_VERSION = '2.0';
    const UBL_CUSTOM_ID = 'urn:cen.eu:en16931:2017#compliant#urn:fdc:peppol.eu:2017:poacc:billing:3.0';

    /**
     * @var string
     */
    private $profileId;

    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $copyIndicator = false;

    /**
     * @var \DateTime
     */
    private $issueDate;

    /**
     * @var string
     */
    private $invoiceTypeCode;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var Party
     */
    private $accountingSupplierParty;

    /**
     * @var Party
     */
    private $accountingCustomerParty;

    /**
     * @var TaxTotal
     */
    private $taxTotal;

    /**
     * @var LegalMonetaryTotal
     */
    private $legalMonetaryTotal;

    /**
     * @var InvoiceLine[]
     */
    private $invoiceLines;

    /**
     * @var AllowanceCharge[]
     */
    private $allowanceCharges;

    /**
     * @var string
     */
    private $receiverCustomerId;

    private $paymentMeans;

    private $orderReference;

    private $paymentTerms;

    private $note;


    function validate()
    {
        if ($this->profileId === null) {
            throw new \InvalidArgumentException('Missing profile id');
        }

        if ($this->id === null) {
            throw new \InvalidArgumentException('Missing invoice id');
        }

        if ($this->id === null) {
            throw new \InvalidArgumentException('Missing invoice id');
        }

        if (!$this->issueDate instanceof \DateTime) {
            throw new \InvalidArgumentException('Invalid invoice issueDate');
        }

        if ($this->invoiceTypeCode === null) {
            throw new \InvalidArgumentException('Missing invoice invoiceTypeCode');
        }

        if ($this->currencyCode === null) {
            throw new \InvalidArgumentException('Missing currency code');
        }

        if ($this->accountingSupplierParty === null) {
            throw new \InvalidArgumentException('Missing invoice accountingSupplierParty');
        }

        if ($this->accountingCustomerParty === null) {
            throw new \InvalidArgumentException('Missing invoice accountingCustomerParty');
        }

        if ($this->invoiceLines === null) {
            throw new \InvalidArgumentException('Missing invoice lines');
        }

        if ($this->legalMonetaryTotal === null) {
            throw new \InvalidArgumentException('Missing invoice LegalMonetaryTotal');
        }
    }

    function xmlSerialize(Writer $writer)
    {
        $cbc = '{urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2}';
        $cac = '{urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2}';

        $this->validate();

        $writer->write([
            $cbc . 'UBLVersionID' => self::UBL_VERSION,
            $cbc . 'CustomizationID' => self::UBL_CUSTOM_ID,
            $cbc . 'ProfileID' => $this->profileId,
            $cbc . 'ID' => $this->id,
            $cbc . 'CopyIndicator' => $this->copyIndicator ? 'true' : 'false',
            $cbc . 'IssueDate' => $this->issueDate->format('Y-m-d'),
            $cbc . 'InvoiceTypeCode' => $this->invoiceTypeCode,
            $cbc . 'Note' => $this->note,
            $cbc . 'DocumentCurrencyCode' => $this->currencyCode,
            $cac . 'OrderReference' => [
                $cbc . 'ID' => $this->orderReference
            ],
            /*
            $cac . 'BillingReference' => [
                $cac . 'InvoiceDocumentReference' => [
                    $cbc . 'ID' => $this->orderReference
                ]
            ],
            */
            $cac . 'AccountingSupplierParty' => [$cac . "Party" => $this->accountingSupplierParty],
            $cac . 'AccountingCustomerParty' => [
                $cbc . "SupplierAssignedAccountID" => $this->receiverCustomerId,
                $cac . "Party" => $this->accountingCustomerParty
            ],
            $cac . 'PaymentMeans' => $this->paymentMeans,
            $cac . 'PaymentTerms' => [
                $cbc . 'Note' => $this->paymentTerms
            ],
        ]);

        if ($this->allowanceCharges != null) {
            foreach ($this->allowanceCharges as $invoiceLine) {
                $writer->write([
                    Schema::CAC . 'AllowanceCharge' => $invoiceLine
                ]);
            }
        }

        if ($this->taxTotal != null) {
            $writer->write([
                Schema::CAC . 'TaxTotal' => $this->taxTotal
            ]);
        }

        $writer->write([
            $cac . 'LegalMonetaryTotal' => $this->legalMonetaryTotal
        ]);

        foreach ($this->invoiceLines as $invoiceLine) {
            $writer->write([
                Schema::CAC . 'InvoiceLine' => $invoiceLine
            ]);
        }

    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Invoice
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isCopyIndicator() {
        return $this->copyIndicator;
    }

    /**
     * @param boolean $copyIndicator
     * @return Invoice
     */
    public function setCopyIndicator($copyIndicator) {
        $this->copyIndicator = $copyIndicator;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getIssueDate() {
        return $this->issueDate;
    }

    /**
     * @param \DateTime $issueDate
     * @return Invoice
     */
    public function setIssueDate($issueDate) {
        $this->issueDate = $issueDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceTypeCode() {
        return $this->invoiceTypeCode;
    }

    public function setProfileId($profileId)
    {
        $this->profileId = $profileId;
        return $this;
    }

    /**
     * @param string $invoiceTypeCode
     * @return Invoice
     */
    public function setInvoiceTypeCode($invoiceTypeCode) {
        $this->invoiceTypeCode = $invoiceTypeCode;
        return $this;
    }

    /**
     * @param string
     * =
     * @return Invoice
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @return Party
     */
    public function getAccountingSupplierParty() {
        return $this->accountingSupplierParty;
    }

    /**
     * @param Party $accountingSupplierParty
     * @return Invoice
     */
    public function setAccountingSupplierParty($accountingSupplierParty) {
        $this->accountingSupplierParty = $accountingSupplierParty;
        return $this;
    }

    /**
     * @return Party
     */
    public function getAccountingCustomerParty() {
        return $this->accountingCustomerParty;
    }

    /**
     * @param Party $accountingCustomerParty
     * @return Invoice
     */
    public function setAccountingCustomerParty($accountingCustomerParty) {
        $this->accountingCustomerParty = $accountingCustomerParty;
        return $this;
    }

    /**
     * @return TaxTotal
     */
    public function getTaxTotal() {
        return $this->taxTotal;
    }

    /**
     * @param TaxTotal $taxTotal
     * @return Invoice
     */
    public function setTaxTotal($taxTotal) {
        $this->taxTotal = $taxTotal;
        return $this;
    }

    /**
     * @return LegalMonetaryTotal
     */
    public function getLegalMonetaryTotal() {
        return $this->legalMonetaryTotal;
    }

    /**
     * @param LegalMonetaryTotal $legalMonetaryTotal
     * @return Invoice
     */
    public function setLegalMonetaryTotal($legalMonetaryTotal) {
        $this->legalMonetaryTotal = $legalMonetaryTotal;
        return $this;
    }

    /**
     * @return InvoiceLine[]
     */
    public function getInvoiceLines() {
        return $this->invoiceLines;
    }

    /**
     * @param InvoiceLine[] $invoiceLines
     * @return Invoice
     */
    public function setInvoiceLines($invoiceLines) {
        $this->invoiceLines = $invoiceLines;
        return $this;
    }

    /**
     * @return AllowanceCharge[]
     */
    public function getAllowanceCharges() {
        return $this->allowanceCharges;
    }

    /**
     * @param AllowanceCharge[] $allowanceCharges
     * @return Invoice
     */
    public function setAllowanceCharges($allowanceCharges) {
        $this->allowanceCharges = $allowanceCharges;
        return $this;
    }

    public function setReceiverCustomerId($receiverCustomerId) {
        $this->receiverCustomerId = $receiverCustomerId;
        return $this;
    }

    public function setPaymentMeans($paymentMeans) {
        $this->paymentMeans = $paymentMeans;
        return $this;
    }

    public function setOrderReference($orderReference) {
        $this->orderReference = $orderReference;
        return $this;
    }

    public function setPaymentTerms($paymentTerms) {
        $this->paymentTerms = $paymentTerms;
        return $this;
    }

    public function setNote($note) {
        $this->note = $note;
        return $this;
    }
}
