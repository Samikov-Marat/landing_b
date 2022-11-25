<?php


namespace App\Classes;

use XMLReader;

class OfficeReader
{
    const PVZ_LIST = 'PvzList';
    const PVZ = 'Pvz';

    const OFFICE_ATTRIBUTES = [
        'Code',
        'Status',
        'PostalCode',
        'Name',
        'CountryCode',
        'countryCodeIso',
        'CountryName',
        'RegionCode',
        'RegionName',
        'CityCode',
        'City',
        'WorkTime',
        'Address',
        'FullAddress',
        'AddressComment',
        'Phone',
        'Email',
        'Note',
        'coordX',
        'coordY',
        'Type',
        'ownerCode',
        'IsDressingRoom',
        'HaveCashless',
        'HaveCash',
        'AllowedCod',
        'TakeOnly',
        'IsHandout',
        'IsReception',
        'NearestStation',
        'MetroStation',
        'Site',
        'Fulfillment',
    ];

    var $reader;
    var $repository;

    public function __construct($officeModelClass)
    {
        $this->reader = new XMLReader();
        $this->repository = new OfficeRepository($officeModelClass);
    }

    public static function getInstance($officeModelClass)
    {
        return new static($officeModelClass);
    }

    public function read($filename)
    {
        $this->reader->open($filename);
        $this->findList();
        $this->parseList();
        $this->reader->close();
    }

    private function findList()
    {
        while ($this->reader->read()) {
            if ($this->isPvzList()) {
                break;
            }
        }
    }

    private function isPvzList()
    {
        return ($this->reader->nodeType == XMLReader::ELEMENT) &&
            ($this->reader->localName == static::PVZ_LIST);
    }

    private function parseList()
    {
        $this->repository->clear();
        while ($this->reader->read()) {
            if ($this->isPvz()) {
                $this->repository->save($this->getOffice());
            }
        }
        $this->repository->flush();
    }

    private function isPvz()
    {
        return ($this->reader->nodeType == XMLReader::ELEMENT) &&
            ($this->reader->localName == static::PVZ);
    }

    private function getOffice()
    {
        $officeAttributes = [];
        foreach (static::OFFICE_ATTRIBUTES as $attribute) {
            $this->reader->moveToAttribute($attribute);
            $officeAttributes[$attribute] = $this->reader->value;
        }
        return $officeAttributes;
    }
}
