<?php

namespace KocicakEET;

use SlevomatEET\Cryptography\CryptographyService;
use SlevomatEET\Configuration;
use SlevomatEET\EvidenceEnvironment;
use SlevomatEET\Client;
use SlevomatEET\Receipt;
use SlevomatEET\Driver\GuzzleSoapClientDriver;

class Executor
{
    public function Execute($argv)
    {
        var_dump($argv);die();

        $crypto = new CryptographyService('../cert/EET_CA1_Playground-CZ683555118.key', '../cert/EET_CA1_Playground-CZ683555118.pub', 'eet');
        $configuration = new Configuration(
            'CZ683555118',
            '01',
            '01',
            EvidenceEnvironment::get(EvidenceEnvironment::PLAYGROUND), // nebo EvidenceEnvironment::get(EvidenceEnvironment::PRODUCTION) pro komunikaci s produkčním systémem
            false // zda zasílat účtenky v ověřovacím módu
        );
        $client = new Client($crypto, $configuration, new GuzzleSoapClientDriver(new \GuzzleHttp\Client()));

        $receipt = new Receipt(
            true,
            'CZ683555118',
            '0/6460/ZQ42',
            new \DateTimeImmutable('2016-11-01 00:30:12'),
            3411300
        );

        try {
            $response = $client->send($receipt);
            echo "FIK: " . $response->getFik() . "\r\n";
            echo "BKP: " . $response->getBkp() . "\r\n";
            echo "PKP: " . base64_encode($response->getRequest()->getPkpCode()) . "\r\n";

        } catch (\SlevomatEET\FailedRequestException $e) {
            echo $e->getRequest()->getPkpCode(); // if request fails you need to print the PKP and BKP codes to receipt
        } catch (\SlevomatEET\InvalidResponseReceivedException $e) {
            echo $e->getResponse()->getRequest()->getPkpCode(); // on invalid response you need to print the PKP and BKP too
        }
    }

    /**
     * @param $args
     */
    private function parseArgs($args){
        if (empty($args) || !is_array($args)){
            throw new \InvalidArgumentException("No input args!");
        }

        foreach($args as $a){

        }
    }
}

class InputStructure{
    public $Environment= EvidenceEnvironment::PLAYGROUND;
    public $PrivateKeyPath;
    public $PublicKeyPath;
    public $KeyPassword;
    public $VatIdentifier;
    public $CashdeskId;
    public $DeviceId;
}

