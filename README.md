# EET-CLI

### A proprietary PHP script for communication with Andrej fucking Babiš. Based on slevomat/eet-client (many thanks). Designed for use from external program - not from console manually. That would be a real fuckery...

## Install:

 Run `composer install`
 
## Use

```
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
```

... Just pass an escaped JSON string with fields listed above and everything should work.
The response is also in JSON and contains FIK, BKP, PKP or error code.

And for the record - referenced keys must be in PEM format.

### Footnote

I don't expect you would use this but if you do, do it without any warranty or support.

Cheers.



