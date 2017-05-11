<?php

namespace KocicakEET;


use SlevomatEET\Receipt;

class CommandMapper
{
    public static function Map(InputCommand $command) : Receipt
    {
        if ($command == null){
            throw new \InvalidArgumentException("Could not parse command (result null)");
        }
        $receipt = new Receipt(
            true,
            $command->VatIdentifier,
            $command->ReceiptNumber,
            new \DateTimeImmutable(date(\DateTime::ISO8601)),
            $command->OverallAmount,
            $command->TaxFreeAmount,
            $command->TaxBaseLevel1,
            $command->TaxAmountLevel1,
            $command->TaxBaseLevel2,
            $command->TaxAmountLevel2,
            $command->TaxBaseLevel3,
            $command->TaxAmountLevel3
        );

        return $receipt;
    }
}