<?php

namespace KocicakEET;

use SlevomatEET\EvidenceEnvironment;

class InputCommand{
    public $Environment= EvidenceEnvironment::PLAYGROUND;
    public $PrivateKeyPath;
    public $PublicKeyPath;
    public $KeyPassword;
    public $VatIdentifier;
    public $CashdeskId;
    public $DeviceId;

    public $ReceiptNumber;
    public $OverallAmount;
    public $TaxFreeAmount;

    public $TaxBaseLevel1;
    public $TaxBaseLevel2;
    public $TaxBaseLevel3;
    public $TaxAmountLevel1;
    public $TaxAmountLevel2;
    public $TaxAmountLevel3;
}