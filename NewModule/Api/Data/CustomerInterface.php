<?php

namespace DCKAP\NewModule\Api\Data;

interface CustomerInterface
{
    const ENTITY_ID = 'entity_id';
    const CUSTOM_NAME = 'custom_name';
    const CUSTOM_AGE= 'custom_age';
    const CUSTOM_DOB = 'custom_dob';
    const CUSTOM_COUNTRY = 'custom_country';

    public function getentity_id();

    public function setentity_id($entity_id);

    public function getcustom_name();

    public function setcustom_name($custom_name);

    public function getcustom_age();

    public function setcustom_age($custom_age);

    public function getcustom_dob();

    public function setcustom_dob($custom_dob);

    public function getcustom_country();

    public function setcustom_country($custom_country);
}
