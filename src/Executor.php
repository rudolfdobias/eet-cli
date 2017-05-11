<?php

namespace KocicakEET;

class Executor
{
    public function Execute($argv) : void
    {
        try {

            $data = $this->_doWork($argv);
            echo json_decode($data);
            exit(0);

        } catch (\Exception $crap) {
            echo "ERROR: " . $crap->getMessage() . "\r\n";
            $this->printHelp();
            exit(1);
        }
    }

    private function _doWork($args) : ReturnStructure
    {

        $command = InputMapper::Map($args);
        $receipt = CommandMapper::Map($command);
        $client = EetClientFactory::Map($command);


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
    private function printHelp()
    {
        echo "
        ******
        
        Usage: 'php client.php [json command]'
        
        Json fields:
        
        Environment ('playground|production', default: playground)
        PrivateKeyPath (required)
        PublicKeyPath (required)
        KeyPassword (required)
        VatIdentifier (required)
        CashdeskId (required)
        DeviceId (required)
   
        ReceiptNumber (required)
        OverallAmount (required)
        TaxFreeAmount (required)
    
        TaxBaseLevel1
        TaxBaseLevel2
        TaxBaseLevel3
        TaxAmountLevel1
        TaxAmountLevel2
        TaxAmountLevel3
        
        ---
        For further help open the InputMapper.php.
        Don't blame me. Blame Andrej fucking Babiš and the .NET foundation 'cause it wasn't possible to code this on C#.NET Core.
        ---
        Good luck.
        
        ******
        ";
    }
}



