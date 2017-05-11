<?php

namespace KocicakEET;


class InputMapper
{
    public static function Map($args) : InputCommand
    {
        if (empty($args) || !is_array($args)) {
            throw new \InvalidArgumentException("No input args!");
        }

        if (!isset($args[1])) {
            throw new \InvalidArgumentException("First argument must be JSON command.");
        }

        $parsed = json_decode($args[1]);
        if ($parsed == null) {
            throw new \InvalidArgumentException("Json input cannot be parsed");
        }

        $command = new InputCommand();
        foreach ($parsed as $key => $val) {
            if (!property_exists(InputCommand::class, $key)) {
                throw new \InvalidArgumentException("Invalid configuration key: " . $key);
            }

            $command->{$key} = $val;
        }

        if ($command->CashdeskId == null
        || $command->DeviceId == null
        || $command->KeyPassword == null
        || $command->OverallAmount == null
        || $command->PrivateKeyPath == null
        || $command->PublicKeyPath == null
        || $command->ReceiptNumber == null){
            throw new \InvalidArgumentException("Incomplete request. Following arguments are required: 
            CashdeskId, DeviceId, PrivateKeyPath, PublicKeyPath, KeyPassword, OverallAmount, ReceiptNumber");
        }

        return $command;
    }
}