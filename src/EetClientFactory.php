<?php

namespace KocicakEET;

use SlevomatEET\Client;
use SlevomatEET\Configuration;
use SlevomatEET\Cryptography\CryptographyService;
use SlevomatEET\Driver\GuzzleSoapClientDriver;
use SlevomatEET\EvidenceEnvironment;

class EetClientFactory
{
    public static function Map(InputCommand $command) : Client
    {
        if ($command == null){
            throw new \InvalidArgumentException("Could not parse command (result null)");
        }

        $env = $command->Environment == null || strtolower($command->Environment) == "production"
                ? EvidenceEnvironment::PRODUCTION
                : EvidenceEnvironment::PLAYGROUND;

        $crypto = new CryptographyService(
            $command->PublicKeyPath,
            $command->PrivateKeyPath,
            $command->KeyPassword);

        $configuration = new Configuration(
            $command->VatIdentifier,
            $command->CashdeskId,
            $command->DeviceId,
            EvidenceEnvironment::get($env),
            false // zda zasílat účtenky v ověřovacím módu
        );
        return new Client($crypto, $configuration, new GuzzleSoapClientDriver(new \GuzzleHttp\Client()));
    }
}