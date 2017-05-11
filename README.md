#EET-CLI

### A proprietary PHP script for communication with Andrej fucking Babiš. Based on slevomat/eet-client (many thanks). Designed for use from extenral program - not in CLI manually.

## Install:

 just run `composer install`
 
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

### Footnote

I don't expect you would use this but if you do, do it without any warranty or support. Blame Babiš and .NET Core framework, in which is practically impossible to code the EET client.

Cheers.



