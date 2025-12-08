# Reference
## Bill
<details><summary><code>$client->bill->addBill($entry, $request) -> BillResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a bill in an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->addBill(
    '8cfec329267',
    new AddBillRequest([
        'body' => new BillOutData([
            'billNumber' => 'ABC-123',
            'netAmount' => 3762.87,
            'billDate' => new DateTime('2024-07-01'),
            'dueDate' => new DateTime('2024-07-01'),
            'comments' => 'Deposit for materials',
            'billItems' => [
                new BillItem([
                    'itemProductCode' => 'M-DEPOSIT',
                    'itemProductName' => 'Materials deposit',
                    'itemDescription' => 'Deposit for materials',
                    'itemCommodityCode' => '010',
                    'itemUnitOfMeasure' => 'SqFt',
                    'itemCost' => 5,
                    'itemQty' => 1,
                    'itemMode' => 0,
                    'itemCategories' => [
                        'deposits',
                    ],
                    'itemTotalAmount' => 123,
                    'itemTaxAmount' => 7,
                    'itemTaxRate' => 0.075,
                ]),
            ],
            'mode' => 0,
            'accountingField1' => 'MyInternalId',
            'vendor' => new VendorData([
                'vendorNumber' => '1234-A',
            ]),
            'endDate' => new DateTime('2024-07-01'),
            'frequency' => Frequency::Monthly->value,
            'terms' => 'NET30',
            'status' => -99,
            'attachments' => [
                new FileContent([
                    'ftype' => FileContentFtype::Pdf->value,
                    'filename' => 'my-doc.pdf',
                    'furl' => 'https://mysite.com/my-doc.pdf',
                ]),
            ],
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `BillOutData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->deleteAttachedFromBill($idBill, $filename, $request) -> BillResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a file attached to a bill.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->deleteAttachedFromBill(
    '0_Bill.pdf',
    285,
    new DeleteAttachedFromBillRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idBill:** `int` — Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
    
</dd>
</dl>

<dl>
<dd>

**$filename:** `string` 

The filename in Payabli. Filename is `zipName` in response to a
request to `/api/Invoice/{idInvoice}`. Here, the filename is
`0_Bill.pdf`. 

```json
  "DocumentsRef": {
    "zipfile": "inva_269.zip",
    "filelist": [
      {
        "originalName": "Bill.pdf",
        "zipName": "0_Bill.pdf",
        "descriptor": null
      }
    ]
  }
  ```
    
</dd>
</dl>

<dl>
<dd>

**$returnObject:** `?bool` — When `true`, the request returns the file content as a Base64-encoded string.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->deleteBill($idBill) -> BillResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a bill by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->deleteBill(
    285,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idBill:** `int` — Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->editBill($idBill, $request) -> EditBillResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a bill by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->editBill(
    285,
    new BillOutData([
        'netAmount' => 3762.87,
        'billDate' => new DateTime('2025-07-01'),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idBill:** `int` — Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `BillOutData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->getAttachedFromBill($idBill, $filename, $request) -> FileContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a file attached to a bill, either as a binary file or as a Base64-encoded string.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->getAttachedFromBill(
    '0_Bill.pdf',
    285,
    new GetAttachedFromBillRequest([
        'returnObject' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idBill:** `int` — Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
    
</dd>
</dl>

<dl>
<dd>

**$filename:** `string` 

The filename in Payabli. Filename is `zipName` in response to a request to `/api/Invoice/{idInvoice}`. Here, the filename is `0_Bill.pdf``. 
"DocumentsRef": {
  "zipfile": "inva_269.zip",
  "filelist": [
    {
      "originalName": "Bill.pdf",
      "zipName": "0_Bill.pdf",
      "descriptor": null
    }
  ]
}
    
</dd>
</dl>

<dl>
<dd>

**$returnObject:** `?bool` — When `true`, the request returns the file content as a Base64-encoded string.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->getBill($idBill) -> GetBillResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a bill by ID from an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->getBill(
    285,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idBill:** `int` — Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->listBills($entry, $request) -> BillQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of bills for an entrypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->listBills(
    '8cfec329267',
    new ListBillsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set. 
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response isn't filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `frequency` (`in`, `nin`, `ne`, `eq`)
- `method` (`in`, `nin`, `eq`, `ne`)
- `event` (`in`, `nin`, `eq`, `ne`)
- `target` (`ct`, `nct`, `eq`, `ne`)
- `status` (`eq`, `ne`)
- `approvalUserId` (`eq`, `ne`)
- `parentOrgId` (`ne`, `eq`, `nin`, `in`)
- `approvalUserEmail` (`eq`, `ne`)
- `scheduleId` (`ne`, `eq`)

List of comparison accepted - enclosed between parentheses:
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array
- `nin` => not inside array

List of parameters accepted:
- `limitRecord` : max number of records for query (default="20", "0" or negative value for all)
- `fromRecord` : initial record in query
Example: `totalAmount(gt)=20` returns all records with a `totalAmount` that's greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->listBillsOrg($orgId, $request) -> BillQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of bills for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->listBillsOrg(
    123,
    new ListBillsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response isn't filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `frequency` (in, nin, ne, eq)
- `method` (in, nin, eq, ne)
- `event` (in, nin, eq, ne)
- `target` (ct, nct, eq, ne)
- `status` (eq, ne)
- `parentOrgId` (ne, eq, nin, in)
- `approvalUserId` (eq, ne)
- `approvalUserEmail` (eq, ne)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: totalAmount(gt)=20 return all records with totalAmount greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->modifyApprovalBill($idBill, $request) -> ModifyApprovalBillResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Modify the list of users the bill is sent to for approval.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->modifyApprovalBill(
    285,
    [
        'string',
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idBill:** `int` — Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->sendToApprovalBill($idBill, $request) -> BillResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Send a bill to a user or list of users to approve.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->sendToApprovalBill(
    285,
    new SendToApprovalBillRequest([
        'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
        'body' => [
            'string',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idBill:** `int` — Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
    
</dd>
</dl>

<dl>
<dd>

**$autocreateUser:** `?bool` — Automatically create the target user for approval if they don't exist.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->bill->setApprovedBill($idBill, $approved, $request) -> SetApprovedBillResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Approve or disapprove a bill by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->bill->setApprovedBill(
    'true',
    285,
    new SetApprovedBillRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idBill:** `int` — Payabli ID for the bill. Get this ID by querying `/api/Query/bills/` for the entrypoint or the organization.
    
</dd>
</dl>

<dl>
<dd>

**$approved:** `string` — String representing the approved status. Accepted values: 'true' or 'false'.
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` — Email or username of user modifying approval status.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Boarding
<details><summary><code>$client->boarding->addApplication($request) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a boarding application in an organization. This endpoint requires an application API token.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->addApplication(
    new ApplicationDataPayIn([
        'services' => new ApplicationDataPayInServices([
            'ach' => new ApplicationDataPayInServicesAch([]),
            'card' => new ApplicationDataPayInServicesCard([
                'acceptAmex' => true,
                'acceptDiscover' => true,
                'acceptMastercard' => true,
                'acceptVisa' => true,
            ]),
        ]),
        'annualRevenue' => 1000,
        'averageBillSize' => '500',
        'averageMonthlyBill' => '5650',
        'avgmonthly' => 1000,
        'baddress' => '123 Walnut Street',
        'baddress1' => 'Suite 103',
        'bankData' => new ApplicationDataPayInBankData([]),
        'bcity' => 'New Vegas',
        'bcountry' => 'US',
        'binperson' => 60,
        'binphone' => 20,
        'binweb' => 20,
        'bstate' => 'FL',
        'bsummary' => 'Brick and mortar store that sells office supplies',
        'btype' => OwnType::LimitedLiabilityCompany->value,
        'bzip' => '33000',
        'contacts' => [
            new ApplicationDataPayInContactsItem([
                'contactEmail' => 'herman@hermanscoatings.com',
                'contactName' => 'Herman Martinez',
                'contactPhone' => '3055550000',
                'contactTitle' => 'Owner',
            ]),
        ],
        'creditLimit' => 'creditLimit',
        'dbaName' => 'Sunshine Gutters',
        'ein' => '123456789',
        'faxnumber' => '1234567890',
        'highticketamt' => 1000,
        'legalName' => 'Sunshine Services, LLC',
        'license' => '2222222FFG',
        'licstate' => 'CA',
        'maddress' => '123 Walnut Street',
        'maddress1' => 'STE 900',
        'mcc' => '7777',
        'mcity' => 'Johnson City',
        'mcountry' => 'US',
        'mstate' => 'TN',
        'mzip' => '37615',
        'orgId' => 123,
        'ownership' => [
            new ApplicationDataPayInOwnershipItem([
                'oaddress' => '33 North St',
                'ocity' => 'Any City',
                'ocountry' => 'US',
                'odriverstate' => 'CA',
                'ostate' => 'CA',
                'ownerdob' => '01/01/1990',
                'ownerdriver' => 'CA6677778',
                'owneremail' => 'test@email.com',
                'ownername' => 'John Smith',
                'ownerpercent' => 100,
                'ownerphone1' => '555888111',
                'ownerphone2' => '555888111',
                'ownerssn' => '123456789',
                'ownertitle' => 'CEO',
                'ozip' => '55555',
            ]),
        ],
        'phonenumber' => '1234567890',
        'processingRegion' => 'US',
        'recipientEmail' => 'josephray@example.com',
        'recipientEmailNotification' => true,
        'resumable' => true,
        'signer' => new SignerDataRequest([
            'address' => '33 North St',
            'address1' => 'STE 900',
            'city' => 'Bristol',
            'country' => 'US',
            'dob' => '01/01/1976',
            'email' => 'test@email.com',
            'name' => 'John Smith',
            'phone' => '555888111',
            'ssn' => '123456789',
            'state' => 'TN',
            'zip' => '55555',
            'pciAttestation' => true,
            'signedDocumentReference' => 'https://example.com/signed-document.pdf',
            'attestationDate' => '04/20/2025',
            'signDate' => '04/20/2025',
            'additionalData' => '{"deviceId":"499585-389fj484-3jcj8hj3","session":"fifji4-fiu443-fn4843","timeWithCompany":"6 Years"}',
        ]),
        'startdate' => '01/01/1990',
        'taxFillName' => 'Sunshine LLC',
        'templateId' => 22,
        'ticketamt' => 1000,
        'website' => 'www.example.com',
        'whenCharged' => Whencharged::WhenServiceProvided->value,
        'whenDelivered' => Whendelivered::Over30Days->value,
        'whenProvided' => Whenprovided::ThirtyDaysOrLess->value,
        'whenRefunded' => Whenrefunded::ThirtyDaysOrLess->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `ApplicationDataPayIn|ApplicationDataManaged|ApplicationDataOdp|ApplicationData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->deleteApplication($appId) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a boarding application by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->deleteApplication(
    352,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$appId:** `int` — Boarding application ID. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->getApplication($appId) -> ApplicationDetailsRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the details for a boarding application by ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->getApplication(
    352,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$appId:** `int` — Boarding application ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->getApplicationByAuth($xId, $request) -> ApplicationQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets a boarding application by authentication information. This endpoint requires an `application` API token. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->getApplicationByAuth(
    '17E',
    new RequestAppByAuth([
        'email' => 'admin@email.com',
        'referenceId' => 'n6UCd1f1ygG7',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$xId:** `string` — The application ID in Hex format. Find this at the end of the boarding link URL returned in a call to api/Boarding/applink/{appId}/{mail2}. For example in:  `https://boarding-sandbox.payabli.com/boarding/externalapp/load/17E`, the xId is `17E`. 
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` — The email address the applicant used to save the application.
    
</dd>
</dl>

<dl>
<dd>

**$referenceId:** `?string` — The referenceId is sent to the applicant via email when they save the application.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->getByIdLinkApplication($boardingLinkId) -> BoardingLinkQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves details for a boarding link, by ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->getByIdLinkApplication(
    91,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$boardingLinkId:** `int` — The boarding link ID. You can find this at the end of the boarding link reference name. For example `https://boarding.payabli.com/boarding/app/myorgaccountname-00091`. The ID is `91`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->getByTemplateIdLinkApplication($templateId) -> BoardingLinkQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get details for a boarding link using the boarding template ID. This endpoint requires an application API token.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->getByTemplateIdLinkApplication(
    80,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateId:** `float` — The boarding template ID. You can find this at the end of the boarding template URL in PartnerHub. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->getExternalApplication($appId, $mail2, $request) -> PayabliApiResponse00</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a link and the verification code used to log into an existing boarding application. You can also use this endpoint to send a link and referenceId for an existing boarding application to an email address. The recipient can use the referenceId and email address to access and edit the application.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->getExternalApplication(
    352,
    'mail2',
    new GetExternalApplicationRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$appId:** `int` — Boarding application ID. 
    
</dd>
</dl>

<dl>
<dd>

**$mail2:** `string` — Email address used to access the application. If `sendEmail` parameter is true, a link to the application is sent to this email address.
    
</dd>
</dl>

<dl>
<dd>

**$sendEmail:** `?bool` — If `true`, sends an email that includes the link to the application to the `mail2` address. Defaults to `false`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->getLinkApplication($boardingLinkReference) -> BoardingLinkQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the details for a boarding link, by reference name. This endpoint requires an application API token.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->getLinkApplication(
    'myorgaccountname-00091',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$boardingLinkReference:** `string` — The boarding link reference name. You can find this at the end of the boarding link URL. For example `https://boarding.payabli.com/boarding/app/myorgaccountname-00091`
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->listApplications($orgId, $request) -> QueryBoardingAppsListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of boarding applications for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->listApplications(
    123,
    new ListApplicationsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `createdAt` (gt, ge, lt, le, eq, ne)
- `startDate` (gt, ge, lt, le, eq, ne)
- `dbaname` (ct, nct)
- `legalname` (ct, nct)
- `ein` (ct, nct)
- `address` (ct, nct)
- `city` (ct, nct)
- `state` (ct, nct)
- `phone` (ct, nct)
- `mcc` (ct, nct)
- `owntype` (ct, nct)
- `ownerName` (ct, nct)
- `contactName` (ct, nct)
- `status` (in, nin, eq,ne)
- `orgParentname` (ct, nct)
- `externalpaypointID` (ct, nct, eq, ne)
- `repCode` (ct, nct, eq, ne)
- `repName` (ct, nct, eq, ne)
- `repOffice` (ct, nct, eq, ne)
List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->listBoardingLinks($orgId, $request) -> QueryBoardingLinksResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Return a list of boarding links for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->listBoardingLinks(
    123,
    new ListBoardingLinksRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `lastUpdated` (gt, ge, lt, le, eq, ne)
- `templateName` (ct, nct)
- `referenceName` (ct, nct)
- `acceptRegister` (eq, ne)
- `acceptAuth` (eq, ne)
- `templateCode` (ct, nct)
- `templateId` (eq, ne)
- `orgParentname` (ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than 
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: templateName(ct)=hoa return all records with template title containing "hoa"
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->boarding->updateApplication($appId, $request) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a boarding application by ID. This endpoint requires an application API token.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->boarding->updateApplication(
    352,
    new ApplicationData([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$appId:** `int` — Boarding application ID. 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `ApplicationData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ChargeBacks
<details><summary><code>$client->chargeBacks->addResponse($id, $request) -> AddResponseResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add a response to a chargeback or ACH return.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->chargeBacks->addResponse(
    1000000,
    new ResponseChargeBack([
        'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `int` — ID of the chargeback or return record.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$attachments:** `?array` — Array of attached files to response.
    
</dd>
</dl>

<dl>
<dd>

**$contactEmail:** `?string` — Email of response submitter.
    
</dd>
</dl>

<dl>
<dd>

**$contactName:** `?string` — Name of response submitter
    
</dd>
</dl>

<dl>
<dd>

**$notes:** `?string` — Response notes
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->chargeBacks->getChargeback($id) -> ChargebackQueryRecords</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a chargeback record and its details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->chargeBacks->getChargeback(
    1000000,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `int` — ID of the chargeback or return record. This is returned as `chargebackId` in the [RecievedChargeback](/developers/developer-guides/webhook-payloads#receivedChargeback) and [ReceivedAchReturn](/developers/developer-guides/webhook-payloads#receivedachreturn) webhook notifications.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->chargeBacks->getChargebackAttachment($id, $fileName) -> string</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a chargeback attachment file by its file name.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->chargeBacks->getChargebackAttachment(
    1000000,
    'fileName',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `int` — The ID of chargeback or return record.
    
</dd>
</dl>

<dl>
<dd>

**$fileName:** `string` — The chargeback attachment's file name.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## CheckCapture
<details><summary><code>$client->checkCapture->checkProcessing($request) -> CheckCaptureResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Captures a check for Remote Deposit Capture (RDC) using the provided check images and details. This endpoint handles the OCR extraction of check data including MICR, routing number, account number, and amount. See the [RDC guide](/developers/developer-guides/pay-in-rdc) for more details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->checkCapture->checkProcessing(
    new CheckCaptureRequestBody([
        'entryPoint' => '47abcfea12',
        'frontImage' => '/9j/4AAQSkZJRgABAQEASABIAAD...',
        'rearImage' => '/9j/4AAQSkZJRgABAQEASABIAAD...',
        'checkAmount' => 12550,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entryPoint:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$frontImage:** `string` — Base64-encoded front check image. Must be JPEG or PNG format and less than 1MB. Image must show the entire check clearly with no partial, blurry, or illegible portions.
    
</dd>
</dl>

<dl>
<dd>

**$rearImage:** `string` — Base64-encoded rear check image. Must be JPEG or PNG format and less than 1MB. Image must show the entire check clearly with no partial, blurry, or illegible portions.
    
</dd>
</dl>

<dl>
<dd>

**$checkAmount:** `int` — Check amount in cents (maximum 32-bit integer value).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Cloud
<details><summary><code>$client->cloud->addDevice($entry, $request) -> AddDeviceResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Register a cloud device to an entrypoint. See [Devices Quickstart](/developers/developer-guides/devices-quickstart#devices-quickstart) for a complete guide.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->cloud->addDevice(
    '8cfec329267',
    new DeviceEntry([
        'registrationCode' => 'YS7DS5',
        'description' => 'Front Desk POS',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Description or name for the device. This can be anything, but Payabli recommends entering the name of the paypoint, or some other easy to identify descriptor. If you have several devices for one paypoint, you can give them descriptions like "Cashier 1" and "Cashier 2", or "Front Desk" and "Back Office"
    
</dd>
</dl>

<dl>
<dd>

**$registrationCode:** `?string` 

The device registration code or serial number, depending on the model.

- Ingenico devices: This is the activation code that's displayed on the device screen during setup.

- PAX A920 device: This code is the serial number on the back of the device.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->cloud->historyDevice($entry, $deviceId) -> CloudQueryApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the registration history for a device. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->cloud->historyDevice(
    'WXGDWB',
    '8cfec329267',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$deviceId:** `string` — ID of the cloud device. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->cloud->listDevice($entry, $request) -> CloudQueryApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of cloud devices registered to an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->cloud->listDevice(
    '8cfec329267',
    new ListDeviceRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$forceRefresh:** `?bool` — When `true`, the request retrieves an updated list of devices from the processor instead of returning a cached list of devices.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->cloud->removeDevice($entry, $deviceId) -> RemoveDeviceResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a cloud device from an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->cloud->removeDevice(
    '6c361c7d-674c-44cc-b790-382b75d1xxx',
    '8cfec329267',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$deviceId:** `string` — ID of the cloud device. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Customer
<details><summary><code>$client->customer->addCustomer($entry, $request) -> PayabliApiResponseCustomerQuery</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a customer in an entrypoint. An identifier is required to create customer records. Change your identifier settings in Settings > Custom Fields in PartnerHub. 
If you don't include an identifier, the record is rejected.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customer->addCustomer(
    '8cfec329267',
    new AddCustomerRequest([
        'body' => new CustomerData([
            'customerNumber' => '12356ACB',
            'firstname' => 'Irene',
            'lastname' => 'Canizales',
            'address1' => "123 Bishop's Trail",
            'city' => 'Mountain City',
            'state' => 'TN',
            'zip' => '37612',
            'country' => 'US',
            'email' => 'irene@canizalesconcrete.com',
            'identifierFields' => [
                'email',
            ],
            'timeZone' => -5,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer.
    
</dd>
</dl>

<dl>
<dd>

**$replaceExisting:** `?int` — Flag indicating to replace existing customer with a new record. Possible values: 0 (don't replace), 1 (replace). Default is `0`.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `CustomerData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->customer->deleteCustomer($customerId) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a customer record.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customer->deleteCustomer(
    998,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in PartnerHub. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->customer->getCustomer($customerId) -> CustomerQueryRecords</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a customer's record and details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customer->getCustomer(
    998,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in PartnerHub. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->customer->linkCustomerTransaction($customerId, $transId) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Links a customer to a transaction by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customer->linkCustomerTransaction(
    998,
    '45-as456777hhhhhhhhhh77777777-324',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in PartnerHub. 
    
</dd>
</dl>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->customer->requestConsent($customerId) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sends the consent opt-in email to the customer email address in the customer record.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customer->requestConsent(
    998,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in PartnerHub. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->customer->updateCustomer($customerId, $request) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a customer record. Include only the fields you want to change.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->customer->updateCustomer(
    998,
    new CustomerData([
        'firstname' => 'Irene',
        'lastname' => 'Canizales',
        'address1' => "145 Bishop's Trail",
        'city' => 'Mountain City',
        'state' => 'TN',
        'zip' => '37612',
        'country' => 'US',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in PartnerHub. 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `CustomerData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Export
<details><summary><code>$client->export->exportApplications($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of boarding applications for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportApplications(
    ExportFormat1::Csv->value,
    123,
    new ExportApplicationsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
- `createdAt` (gt, ge, lt, le, eq, ne)
- `startDate` (gt, ge, lt, le, eq, ne)
- `dbaname`  (ct, nct)
- `legalname`  (ct, nct)
- `ein`  (ct, nct)
- `address`  (ct, nct)
- `city`  (ct, nct)
- `state`  (ct, nct)
- `phone`  (ct, nct)
- `mcc`  (ct, nct)
- `owntype`  (ct, nct)
- `ownerName`  (ct, nct)
- `contactName`  (ct, nct)
- `status`  (eq, ne)
- `orgParentname`  (ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- `limitRecord` : max number of records for query (default="20", "0" or negative value for all)
- `fromRecord` : initial record in query

Example: `dbaname(ct)=hoa` returns all records with a `dbaname` containing "hoa"
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportBatchDetails($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

This endpoint is deprecated. Export batch details for a paypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportBatchDetails(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportBatchDetailsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**List of field names accepted:**

  - `settlementDate` (gt, ge, lt, le, eq, ne)
  - `depositDate` (gt, ge, lt, le, eq, ne)
  - `transId`  (ne, eq, ct, nct)
  - `gatewayTransId`  (ne, eq, ct, nct)
  - `method`   (in, nin, eq, ne)
  - `settledAmount`  (gt, ge, lt, le, eq, ne)
  - `operation`    (in, nin, eq, ne)
  - `source`   (in, nin, eq, ne)
  - `batchNumber`  (ct, nct, eq, ne)
  - `payaccountLastfour`   (nct, ct)
  - `payaccountType`   (ne, eq, in, nin)
  - `customerFirstname`   (ct, nct, eq, ne)
  - `customerLastname`    (ct, nct, eq, ne)
  - `customerName`   (ct, nct)
  - `customerId`  (eq, ne)
  - `customerNumber`  (ct, nct, eq, ne)
  - `customerCompanyname`    (ct, nct, eq, ne)
  - `customerAddress` (ct, nct, eq, ne)
  - `customerCity`    (ct, nct, eq, ne)
  - `customerZip` (ct, nct, eq, ne)
  - `customerState` (ct, nct, eq, ne)
  - `customerCountry` (ct, nct, eq, ne)
  - `customerPhone` (ct, nct, eq, ne)
  - `customerEmail` (ct, nct, eq, ne)
  - `customerShippingAddress` (ct, nct, eq, ne)
  - `customerShippingCity`    (ct, nct, eq, ne)
  - `customerShippingZip` (ct, nct, eq, ne)
  - `customerShippingState` (ct, nct, eq, ne)
  - `customerShippingCountry` (ct, nct, eq, ne)
  - `orgId`  (eq) *mandatory when entry=org*
  - `isHold` (eq, ne)
  - `paypointId`  (ne, eq)
  - `paypointLegal`  (ne, eq, ct, nct)
  - `paypointDba`  (ne, eq, ct, nct)
  - `orgName`  (ne, eq, ct, nct)
  - `batchId` (ct, nct, eq, neq)
  - `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: `amount(gt)=20` return all records with amount greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportBatchDetailsOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

This endpoint is deprecated. Export batch details for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportBatchDetailsOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportBatchDetailsOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**List of field names accepted:**

  - `settlementDate` (gt, ge, lt, le, eq, ne)
  - `depositDate` (gt, ge, lt, le, eq, ne)
  - `transId`  (ne, eq, ct, nct)
  - `gatewayTransId`  (ne, eq, ct, nct)
  - `method`   (in, nin, eq, ne)
  - `settledAmount`  (gt, ge, lt, le, eq, ne)
  - `operation`    (in, nin, eq, ne)
  - `source`   (in, nin, eq, ne)
  - `batchNumber`  (ct, nct, eq, ne)
  - `payaccountLastfour`   (nct, ct)
  - `payaccountType`   (ne, eq, in, nin)
  - `customerFirstname`   (ct, nct, eq, ne)
  - `customerLastname`    (ct, nct, eq, ne)
  - `customerName`   (ct, nct)
  - `customerId`  (eq, ne)
  - `customerNumber`  (ct, nct, eq, ne)
  - `customerCompanyname`    (ct, nct, eq, ne)
  - `customerAddress` (ct, nct, eq, ne)
  - `customerCity`    (ct, nct, eq, ne)
  - `customerZip` (ct, nct, eq, ne)
  - `customerState` (ct, nct, eq, ne)
  - `customerCountry` (ct, nct, eq, ne)
  - `customerPhone` (ct, nct, eq, ne)
  - `customerEmail` (ct, nct, eq, ne)
  - `customerShippingAddress` (ct, nct, eq, ne)
  - `customerShippingCity`    (ct, nct, eq, ne)
  - `customerShippingZip` (ct, nct, eq, ne)
  - `customerShippingState` (ct, nct, eq, ne)
  - `customerShippingCountry` (ct, nct, eq, ne)
  - `orgId`  (eq) *mandatory when entry=org*
  - `isHold` (eq, ne)
  - `paypointId`  (ne, eq)
  - `paypointLegal`  (ne, eq, ct, nct)
  - `paypointDba`  (ne, eq, ct, nct)
  - `orgName`  (ne, eq, ct, nct)
  - `batchId` (ct, nct, eq, neq)
  - `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: `amount(gt)=20` return all records with amount greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportBatches($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of batches for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportBatches(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportBatchesRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `batchDate` (gt, ge, lt, le, eq, ne)
- `batchNumber` (ne, eq)
- `connectorName` (ne, eq, ct, nct)
- `method` (in, nin, eq, ne)
- `batchAmount` (gt, ge, lt, le, eq, ne)
- `feeBatchAmount` (gt, ge, lt, le, eq, ne)
- `netBatchAmount` (gt, ge, lt, le, eq, ne)
- `releaseAmount` (gt, ge, lt, le, eq, ne)
- `heldAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `paypointId` (ne, eq)
- `externalPaypointID` (ct, nct, eq, ne)
- `expectedDepositDate` (gt, ge, lt, le, eq, ne)
- `batchRecords` (gt, ge, lt, le, eq, ne)
- `transferId` (ne, eq)
- `transferDate` (gt, ge, lt, le, eq, ne)
- `grossAmount` (gt, ge, lt, le, eq, ne)
- `chargeBackAmount` (gt, ge, lt, le, eq, ne)
- `returnedAmount` (gt, ge, lt, le, eq, ne)
- `billingFeeAmount` (gt, ge, lt, le, eq, ne)
- `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)
- `netFundedAmount` (gt, ge, lt, le, eq, ne)
- `adjustmentAmount` (gt, ge, lt, le, eq, ne)
- `processor` (ne, eq, ct, nct)
- `transferStatus` (ne, eq, in, nin)

List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: `batchAmount(gt)=20` returns all records with a `batchAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportBatchesOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of batches for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportBatchesOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportBatchesOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `batchDate` (gt, ge, lt, le, eq, ne)
- `batchNumber` (ne, eq)
- `connectorName` (ne, eq, ct, nct)
- `method` (in, nin, eq, ne)
- `batchAmount` (gt, ge, lt, le, eq, ne)
- `feeBatchAmount` (gt, ge, lt, le, eq, ne)
- `netBatchAmount` (gt, ge, lt, le, eq, ne)
- `releaseAmount` (gt, ge, lt, le, eq, ne)
- `heldAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `paypointId` (ne, eq)
- `externalPaypointID` (ct, nct, eq, ne)
- `expectedDepositDate` (gt, ge, lt, le, eq, ne)
- `batchRecords` (gt, ge, lt, le, eq, ne)
- `transferId` (ne, eq)
- `transferDate` (gt, ge, lt, le, eq, ne)
- `grossAmount` (gt, ge, lt, le, eq, ne)
- `chargeBackAmount` (gt, ge, lt, le, eq, ne)
- `returnedAmount` (gt, ge, lt, le, eq, ne)
- `billingFeeAmount` (gt, ge, lt, le, eq, ne)
- `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)
- `netFundedAmount` (gt, ge, lt, le, eq, ne)
- `adjustmentAmount` (gt, ge, lt, le, eq, ne)
- `processor` (ne, eq, ct, nct)
- `transferStatus` (ne, eq, in, nin)

List of parameters accepted:
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query
Example: `batchAmount(gt)=20` returns all records with a `batchAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportBatchesOut($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of money out batches for a paypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportBatchesOut(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportBatchesOutRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
  - `batchDate` (gt, ge, lt, le, eq, ne)
  - `batchNumber` (ne, eq)
  - `batchAmount` (gt, ge, lt, le, eq, ne)
  - `status` (in, nin, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct, nin, in)
  - `paypointId` (ne, eq)
  - `externalPaypointID` (ct, nct, eq, ne)
List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: `batchAmount(gt)=20` returns all records with a `batchAmount` greater than 20.00"
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportBatchesOutOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of money out batches for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportBatchesOutOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportBatchesOutOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
  - `batchDate` (gt, ge, lt, le, eq, ne)
  - `batchNumber` (ne, eq)
  - `batchAmount` (gt, ge, lt, le, eq, ne)
  - `status` (in, nin, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct, nin, in)
  - `paypointId` (ne, eq)
  - `externalPaypointID` (ct, nct, eq, ne)
List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: `batchAmount(gt)=20` returns all records with a `batchAmount` greater than 20.00"
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportBills($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of bills for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportBills(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportBillsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
- `status` (in, nin, eq, ne)
- `billNumber` (ct, nct, eq, ne)
- `billDate` (gt, ge, lt, le, eq, ne)
- `billDueDate` (gt, ge, lt, le, eq, ne)
- `vendorNumber` (ct, nct, eq, ne)
- `vendorName` (ct, nct, eq, ne)
- `ein` (ct, nct, eq, ne)
- `paymentMethod` (ct, nct, eq, ne)
- `paymentId` (ct, nct, eq, ne)
- `paymentgroup` (ct, nct, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: totalAmount(gt)=20  return all records with totalAmount greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportBillsOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of bills for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportBillsOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportBillsOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
- `status` (in, nin, eq, ne)
- `billNumber` (ct, nct, eq, ne)
- `billDate` (gt, ge, lt, le, eq, ne)
- `billDueDate` (gt, ge, lt, le, eq, ne)
- `vendorNumber` (ct, nct, eq, ne)
- `vendorName` (ct, nct, eq, ne)
- `ein` (ct, nct, eq, ne)
- `paymentMethod` (ct, nct, eq, ne)
- `paymentId` (ct, nct, eq, ne)
- `paymentgroup` (ct, nct, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: totalAmount(gt)=20  return all records with totalAmount greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportChargebacks($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of chargebacks and ACH returns for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportChargebacks(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportChargebacksRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
- `chargebackDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct)
- `method` (in, nin, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `reasonCode` (in, nin, eq, ne)
- `reason` (ct, nct, eq, ne)
- `caseNumber` (ct, nct, eq, ne)
- `status` (in, nin, eq, ne)
- `accountType` (in, nin, eq, ne)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq) *mandatory when entry=org*
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportChargebacksOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of chargebacks and ACH returns for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportChargebacksOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportChargebacksOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
- `chargebackDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct)
- `method` (in, nin, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `reasonCode` (in, nin, eq, ne)
- `reason` (ct, nct, eq, ne)
- `caseNumber` (ct, nct, eq, ne)
- `status` (in, nin, eq, ne)
- `accountType` (in, nin, eq, ne)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq) *mandatory when entry=org*
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportCustomers($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of customers for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportCustomers(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportCustomersRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**List of field names accepted:**
- `createdDate` (gt, ge, lt, le, eq, ne)
- `customernumber` (ne, eq, ct, nct)
- `firstname` (ne, eq, ct, nct)
- `lastname` (ne, eq, ct, nct)
- `name` (ct, nct)
- `address` (ne, eq, ct, nct)
- `city` (ne, eq, ct, nct)
- `country` (ne, eq, ct, nct)
- `zip` (ne, eq, ct, nct)
- `state` (ne, eq, ct, nct)
- `shippingaddress` (ne, eq, ct, nct)
- `shippingcity` (ne, eq, ct, nct)
- `shippingcountry` (ne, eq, ct, nct)
- `shippingzip` (ne, eq, ct, nct)
- `shippingstate` (ne, eq, ct, nct)
- `phone` (ne, eq, ct, nct)
- `email` (ne, eq, ct, nct)
- `company` (ne, eq, ct, nct)
- `username` (ne, eq, ct, nct)
- `balance` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name
- `orgId` (eq) *mandatory when entry=org*
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

**List of comparison accepted - enclosed between parentheses:**
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

**List of parameters accepted:**
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

**Example:**
balance(gt)=20 return all records with balance greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportCustomersOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Exports a list of customers for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportCustomersOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportCustomersOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**List of field names accepted:**
- `createdDate` (gt, ge, lt, le, eq, ne)
- `customernumber` (ne, eq, ct, nct)
- `firstname` (ne, eq, ct, nct)
- `lastname` (ne, eq, ct, nct)
- `name` (ct, nct)
- `address` (ne, eq, ct, nct)
- `city` (ne, eq, ct, nct)
- `country` (ne, eq, ct, nct)
- `zip` (ne, eq, ct, nct)
- `state` (ne, eq, ct, nct)
- `shippingaddress` (ne, eq, ct, nct)
- `shippingcity` (ne, eq, ct, nct)
- `shippingcountry` (ne, eq, ct, nct)
- `shippingzip` (ne, eq, ct, nct)
- `shippingstate` (ne, eq, ct, nct)
- `phone` (ne, eq, ct, nct)
- `email` (ne, eq, ct, nct)
- `company` (ne, eq, ct, nct)
- `username` (ne, eq, ct, nct)
- `balance` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name
- `orgId` (eq) *mandatory when entry=org*
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

**List of comparison accepted - enclosed between parentheses:**
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

**List of parameters accepted:**
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

**Example:**
balance(gt)=20 return all records with balance greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportInvoices($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export list of invoices for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportInvoices(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportInvoicesRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
 - `invoiceDate` (gt, ge, lt, le, eq, ne)
 - `dueDate` (gt, ge, lt, le, eq, ne)
 - `sentDate` (gt, ge, lt, le, eq, ne)
 - `frequency`  (in, nin,ne, eq)
 - `invoiceType`   (eq, ne)
 - `payTerms`   (in, nin, eq, ne)
 - `paypointId`  (ne, eq)
 - `totalAmount`  (gt, ge, lt, le, eq, ne)
 - `paidAmount`  (gt, ge, lt, le, eq, ne)
 - `status`   (in, nin, eq, ne)
 - `invoiceNumber`   (ct, nct, eq, ne)
 - `purchaseOrder`   (ct, nct, eq, ne)
 - `itemProductCode` (ct, nct)
 - `itemDescription` (ct, nct)
 - `customerFirstname`   (ct, nct, eq, ne)
 - `customerLastname`    (ct, nct, eq, ne)
 - `customerName`   (ct, nct)
 - `customerId`  (eq, ne)
 - `customerNumber`  (ct, nct, eq, ne)
 - `customerCompanyname`    (ct, nct, eq, ne)
 - `customerAddress` (ct, nct, eq, ne)
 - `customerCity`    (ct, nct, eq, ne)
 - `customerZip` (ct, nct, eq, ne)
 - `customerState` (ct, nct, eq, ne)
 - `customerCountry` (ct, nct, eq, ne)
 - `customerPhone` (ct, nct, eq, ne)
 - `customerEmail` (ct, nct, eq, ne)
 - `customerShippingAddress` (ct, nct, eq, ne)
 - `customerShippingCity` (ct, nct, eq, ne)
 - `customerShippingZip` (ct, nct, eq, ne)
 - `customerShippingState` (ct, nct, eq, ne)
 - `customerShippingCountry` (ct, nct, eq, ne)
 - `orgId`  (eq) 
 - `paylinkId`  (ne, eq)
 - `paypointLegal`  (ne, eq, ct, nct)
 - `paypointDba`  (ne, eq, ct, nct)
 - `orgName`  (ne, eq, ct, nct)
 - `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
 - eq or empty => equal
 - gt => greater than
 - ge => greater or equal
 - lt => less than
 - le => less or equal
 - ne => not equal
 - ct => contains
 - nct => not contains
 - in => inside array
 - nin => not inside array
 
List of parameters accepted:
 - `limitRecord` : max number of records for query (default="20", "0" or negative value for all)
 - `fromRecord` : initial record in query
 
Example: `totalAmount(gt)=20` returns all records with `totalAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportInvoicesOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of invoices for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportInvoicesOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportInvoicesOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
 - `invoiceDate` (gt, ge, lt, le, eq, ne)
 - `dueDate` (gt, ge, lt, le, eq, ne)
 - `sentDate` (gt, ge, lt, le, eq, ne)
 - `frequency` (in, nin,ne, eq)
 - `invoiceType` (eq, ne)
 - `payTerms` (in, nin, eq, ne)
 - `paypointId` (ne, eq)
 - `totalAmount` (gt, ge, lt, le, eq, ne)
 - `paidAmount` (gt, ge, lt, le, eq, ne)
 - `status` (in, nin, eq, ne)
 - `invoiceNumber` (ct, nct, eq, ne)
 - `purchaseOrder` (ct, nct, eq, ne)
 - `itemProductCode` (ct, nct)
 - `itemDescription` (ct, nct)
 - `customerFirstname` (ct, nct, eq, ne)
 - `customerLastname` (ct, nct, eq, ne)
 - `customerName` (ct, nct)
 - `customerId` (eq, ne)
 - `customerNumber` (ct, nct, eq, ne)
 - `customerCompanyname` (ct, nct, eq, ne)
 - `customerAddress` (ct, nct, eq, ne)
 - `customerCity` (ct, nct, eq, ne)
 - `customerZip` (ct, nct, eq, ne)
 - `customerState` (ct, nct, eq, ne)
 - `customerCountry` (ct, nct, eq, ne)
 - `customerPhone` (ct, nct, eq, ne)
 - `customerEmail` (ct, nct, eq, ne)
 - `customerShippingAddress` (ct, nct, eq, ne)
 - `customerShippingCity` (ct, nct, eq, ne)
 - `customerShippingZip` (ct, nct, eq, ne)
 - `customerShippingState` (ct, nct, eq, ne)
 - `customerShippingCountry` (ct, nct, eq, ne)
 - `orgId` (eq) 
 - `paylinkId` (ne, eq)
 - `paypointLegal` (ne, eq, ct, nct)
 - `paypointDba` (ne, eq, ct, nct)
 - `orgName` (ne, eq, ct, nct)
 - `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name
 
List of comparison accepted - enclosed between parentheses:
 - eq or empty => equal
 - gt => greater than
 - ge => greater or equal
 - lt => less than
 - le => less or equal
 - ne => not equal
 - ct => contains
 - nct => not contains
 - in => inside array
 - nin => not inside array
 
List of parameters accepted:
 - limitRecord : max number of records for query (default="20", "0" or negative value for all)
 - fromRecord : initial record in query
 
Example: totalAmount(gt)=20  return all records with totalAmount greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportOrganizations($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of child organizations (suborganizations) for a parent organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportOrganizations(
    ExportFormat1::Csv->value,
    123,
    new ExportOrganizationsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
- `name` (ct, nct, eq, ne)
- `type` (ne, eq)
- `contactName` (ct, nct, eq, ne)
- `contactTitle` (ct, nct, eq, ne)
- `contactEmail` (ct, nct, eq, ne)
- `contactPhone` (ct, nct, eq, ne)
- `city` (ct, nct, eq, ne)
- `state` (in, nin, eq, ne)
- `address` (ct, nct, eq, ne)
- `country` (ct, nct, eq, ne)
- `zip` (ct, nct, eq, ne)
- `hasBilling` any value greater than zero is taken as TRUE otherwise is FALSE
- `hasResidual` any value greater than zero is taken as TRUE otherwise is FALSE

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: name(ct)=hoa  return all records where name contains "hoa"
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportPayout($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of payouts and their statuses for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportPayout(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportPayoutRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `status` (in, nin, eq, ne)
- `transactionDate` (gt, ge, lt, le, eq, ne)
- `billNumber` (ct, nct)
- `vendorNumber` (ct, nct, eq, ne)
- `vendorName` (ct, nct, eq, ne)
- `paymentMethod` (ct, nct, eq, ne)
- `paymentId` (ct, nct, eq, ne)
- `paymentgroup` (ct, nct, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: totalAmount(gt)=20 return all records with totalAmount greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportPayoutOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of payouts and their details for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportPayoutOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportPayoutOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `status` (in, nin, eq, ne)
- `transactionDate` (gt, ge, lt, le, eq, ne)
- `billNumber` (ct, nct)
- `vendorNumber` (ct, nct, eq, ne)
- `vendorName` (ct, nct, eq, ne)
- `paymentMethod` (ct, nct, eq, ne)
- `paymentId` (ct, nct, eq, ne)
- `paymentgroup` (ct, nct, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: totalAmount(gt)=20 return all records with totalAmount greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportPaypoints($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of paypoints in an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportPaypoints(
    ExportFormat1::Csv->value,
    123,
    new ExportPaypointsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `createdAt` (gt, ge, lt, le, eq, ne)
- `startDate` (gt, ge, lt, le, eq, ne)
- `dbaname` (ct, nct)
- `legalname` (ct, nct)
- `ein` (ct, nct)
- `address` (ct, nct)
- `city` (ct, nct)
- `state` (ct, nct)
- `phone` (ct, nct)
- `mcc` (ct, nct)
- `owntype` (ct, nct)
- `ownerName` (ct, nct)
- `contactName` (ct, nct)
- `orgParentname` (ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `dbaname(ct)=hoa` returns all records with `dbaname` containing "hoa"
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportSettlements($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of settled transactions for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportSettlements(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportSettlementsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `settlementDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct)
- `gatewayTransId` (ne, eq, ct, nct)
- `method` (in, nin, eq, ne)
- `settledAmount` (gt, ge, lt, le, eq, ne)
- `operation` (in, nin, eq, ne)
- `source` (in, nin, eq, ne)
- `batchNumber` (ct, nct, eq, ne)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq) *mandatory when entry=org*
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: `settledAmount(gt)=20` returns all records with a `settledAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportSettlementsOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of settled transactions for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportSettlementsOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportSettlementsOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `settlementDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct)
- `gatewayTransId` (ne, eq, ct, nct)
- `method` (in, nin, eq, ne)
- `settledAmount` (gt, ge, lt, le, eq, ne)
- `operation` (in, nin, eq, ne)
- `source` (in, nin, eq, ne)
- `batchNumber` (ct, nct, eq, ne)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq) *mandatory when entry=org*
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord: max number of records for query (default="20", "0" or negative value for all)
- fromRecord: initial record in query

Example: `settledAmount(gt)=20` returns all records with a `settledAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportSubscriptions($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of subscriptions for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportSubscriptions(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportSubscriptionsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `startDate` (gt, ge, lt, le, eq, ne)
- `endDate` (gt, ge, lt, le, eq, ne)
- `nextDate` (gt, ge, lt, le, eq, ne)
- `frequency` (in, nin, ne, eq)
- `method` (in, nin, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `feeAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `untilcancelled` (eq, ne)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq) 
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportSubscriptionsOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of subscriptions for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportSubscriptionsOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportSubscriptionsOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `startDate` (gt, ge, lt, le, eq, ne)
- `endDate` (gt, ge, lt, le, eq, ne)
- `nextDate` (gt, ge, lt, le, eq, ne)
- `frequency` (in, nin, ne, eq)
- `method` (in, nin, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `feeAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `untilcancelled` (eq, ne)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq) 
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportTransactions($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of transactions for an entrypoint in a file in XLXS or CSV format. Use filters to limit results. If you don't specify a date range in the request, the last two months of data are returned.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportTransactions(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportTransactionsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
- `transactionDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct)
- `gatewayTransId` (ne, eq, ct, nct)
- `orderId` (ne, eq)
- `idTrans` (ne, eq)
- `orgId` (ne, eq)
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `method` (in, nin, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `feeAmount` (gt, ge, lt, le, eq, ne)
- `operation` (in, nin, eq, ne)
- `source` (in, nin, eq, ne)
- `status` (in, nin, eq, ne)
- `settlementStatus` (in, nin, eq, ne)
- `batchNumber` (nct, ct)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportTransactionsOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of transactions for an org in a file in XLSX or CSV format. Use filters to limit results. If you don't specify a date range in the request, the last two months of data are returned.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportTransactionsOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportTransactionsOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
- `transactionDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct)
- `gatewayTransId` (ne, eq, ct, nct)
- `orderId` (ne, eq)
- `idTrans` (ne, eq)
- `orgId` (ne, eq)
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `method` (in, nin, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `feeAmount` (gt, ge, lt, le, eq, ne)
- `operation` (in, nin, eq, ne)
- `source` (in, nin, eq, ne)
- `status` (in, nin, eq, ne)
- `settlementStatus` (in, nin, eq, ne)
- `batchNumber` (nct, ct)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportTransferDetails($format, $entry, $transferId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of transfer details for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportTransferDetails(
    '8cfec329267',
    ExportFormat1::Csv->value,
    1000000,
    new ExportTransferDetailsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$transferId:** `int` — Transfer identifier.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:

  - `grossAmount` (gt, ge, lt, le, eq, ne)

  - `chargeBackAmount` (gt, ge, lt, le, eq, ne)

  - `returnedAmount` (gt, ge, lt, le, eq, ne)

  - `billingFeeAmount` (gt, ge, lt, le, eq, ne)

  - `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)

  - `netFundedAmount` (gt, ge, lt, le, eq, ne)

  - `adjustmentAmount` (gt, ge, lt, le, eq, ne)

  - `transactionId` (eq, ne, in, nin)

  - `category` (eq, ne, ct, nct)

  - `type` (eq, ne, in, nin)

  - `method` (eq, ne, in, nin)
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportTransfers($entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of transfers for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportTransfers(
    '8cfec329267',
    new ExportTransfersRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help. 

List of field names accepted:
  - `transferDate` (gt, ge, lt, le, eq, ne)

  - `grossAmount` (gt, ge, lt, le, eq, ne)

  - `chargeBackAmount` (gt, ge, lt, le, eq, ne)

  - `returnedAmount` (gt, ge, lt, le, eq, ne)

  - `billingFeeAmount` (gt, ge, lt, le, eq, ne)

  - `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)

  - `netFundedAmount` (gt, ge, lt, le, eq, ne)

  - `adjustmentAmount` (gt, ge, lt, le, eq, ne)

  - `processor` (ne, eq, ct, nct)

  - `transferStatus` (ne, eq, in, nin)

  - `batchNumber` (ne, eq, ct, nct)

  - `batchId` (ne, eq, in, nin)
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportVendors($format, $entry, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of vendors for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportVendors(
    '8cfec329267',
    ExportFormat1::Csv->value,
    new ExportVendorsRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `method` (in, nin, eq, ne)
- `enrollmentStatus` (in, nin, eq, ne)
- `status` (in, nin, eq, ne)
- `vendorNumber` (ct, nct, eq, ne)
- `name` (ct, nct, eq, ne)
- `ein` (ct, nct, eq, ne)
- `phone` (ct, nct, eq, ne)
- `email` (ct, nct, eq, ne)
- `address` (ct, nct, eq, ne)
- `city` (ct, nct, eq, ne)
- `state` (ct, nct, eq, ne)
- `country` (ct, nct, eq, ne)
- `zip` (ct, nct, eq, ne)
- `mcc` (ct, nct, eq, ne)
- `locationCode` (ct, nct, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->export->exportVendorsOrg($format, $orgId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a list of vendors for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->export->exportVendorsOrg(
    ExportFormat1::Csv->value,
    123,
    new ExportVendorsOrgRequest([
        'columnsExport' => 'BatchDate:Batch_Date,PaypointName:Legal_name',
        'fromRecord' => 251,
        'limitRecord' => 1000,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$format:** `string` — Format for the export, either XLSX or CSV. 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$columnsExport:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The number of records to return for the query. The maximum is 30,000 records. When this parameter isn't sent, the API returns up to 25,000 records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `method` (in, nin, eq, ne)
- `enrollmentStatus` (in, nin, eq, ne)
- `status` (in, nin, eq, ne)
- `vendorNumber` (ct, nct, eq, ne)
- `name` (ct, nct, eq, ne)
- `ein` (ct, nct, eq, ne)
- `phone` (ct, nct, eq, ne)
- `email` (ct, nct, eq, ne)
- `address` (ct, nct, eq, ne)
- `city` (ct, nct, eq, ne)
- `state` (ct, nct, eq, ne)
- `country` (ct, nct, eq, ne)
- `zip` (ct, nct, eq, ne)
- `mcc` (ct, nct, eq, ne)
- `locationCode` (ct, nct, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## HostedPaymentPages
<details><summary><code>$client->hostedPaymentPages->loadPage($entry, $subdomain) -> PayabliPages</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Loads all of a payment page's details including `pageIdentifier` and `validationCode`. This endpoint requires an `application` API token.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hostedPaymentPages->loadPage(
    '8cfec329267',
    'pay-your-fees-1',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `string` — Payment page identifier. The subdomain value is the last part of the payment page URL. For example, in`https://paypages-sandbox.payabli.com/513823dc10/pay-your-fees-1`, the subdomain is `pay-your-fees-1`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->hostedPaymentPages->newPage($entry, $request) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>


Creates a new payment page for a paypoint. 
Note: this operation doesn't create a new paypoint, just a payment page for an existing paypoint. Paypoints are created by the Payabli team when a boarding application is approved.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hostedPaymentPages->newPage(
    '8cfec329267',
    new NewPageRequest([
        'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
        'body' => new PayabliPages([]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `PayabliPages` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->hostedPaymentPages->savePage($entry, $subdomain, $request) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a payment page in a paypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->hostedPaymentPages->savePage(
    '8cfec329267',
    'pay-your-fees-1',
    new PayabliPages([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `string` — Payment page identifier. The subdomain value is the last part of the payment page URL. For example, in`https://paypages-sandbox.payabli.com/513823dc10/pay-your-fees-1`, the subdomain is `pay-your-fees-1`.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `PayabliPages` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Import
<details><summary><code>$client->import->importBills($entry, $request) -> PayabliApiResponseImport</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Import a list of bills from a CSV file. See the [Import Guide](/developers/developer-guides/bills-add#import-bills) for more help and an example file.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->import->importBills(
    '8cfec329267',
    new ImportBillsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->import->importCustomer($entry, $request) -> PayabliApiResponseImport</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Import a list of customers from a CSV file. See the [Import Guide](/developers/developer-guides/entities-customers#import-customers) for more help and example files.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->import->importCustomer(
    '8cfec329267',
    new ImportCustomerRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$replaceExisting:** `?int` — Flag indicating to replace existing customer with a new record. Possible values: 0 (do not replace), 1 (replace). Default is 0
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->import->importVendor($entry, $request) -> PayabliApiResponseImport</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Import a list of vendors from a CSV file. See the [Import Guide](/developers/developer-guides/entities-vendors#import-vendors) for more help and example files.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->import->importVendor(
    '8cfec329267',
    new ImportVendorRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Invoice
<details><summary><code>$client->invoice->addInvoice($entry, $request) -> InvoiceResponseWithoutData</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates an invoice in an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->addInvoice(
    '8cfec329267',
    new AddInvoiceRequest([
        'body' => new InvoiceDataRequest([
            'customerData' => new PayorDataRequest([
                'firstName' => 'Tamara',
                'lastName' => 'Bagratoni',
                'customerNumber' => '3',
            ]),
            'invoiceData' => new BillData([
                'items' => [
                    new BillItem([
                        'itemProductName' => 'Adventure Consult',
                        'itemDescription' => 'Consultation for Georgian tours',
                        'itemCost' => 100,
                        'itemQty' => 1,
                        'itemMode' => 1,
                    ]),
                    new BillItem([
                        'itemProductName' => 'Deposit ',
                        'itemDescription' => 'Deposit for trip planning',
                        'itemCost' => 882.37,
                        'itemQty' => 1,
                    ]),
                ],
                'invoiceDate' => new DateTime('2025-10-19'),
                'invoiceType' => 0,
                'invoiceStatus' => 1,
                'frequency' => Frequency::OneTime->value,
                'invoiceAmount' => 982.37,
                'discount' => 10,
                'invoiceNumber' => 'INV-3',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `InvoiceDataRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->deleteAttachedFromInvoice($idInvoice, $filename) -> InvoiceResponseWithoutData</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes an invoice that's attached to a file.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->deleteAttachedFromInvoice(
    '0_Bill.pdf',
    23548884,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idInvoice:** `int` — Invoice ID
    
</dd>
</dl>

<dl>
<dd>

**$filename:** `string` 

The filename in Payabli. Filename is `zipName` in response to a request to `/api/Invoice/{idInvoice}`. Here, the filename is `0_Bill.pdf``. 
"DocumentsRef": {
  "zipfile": "inva_269.zip",
  "filelist": [
    {
      "originalName": "Bill.pdf",
      "zipName": "0_Bill.pdf",
      "descriptor": null
    }
  ]
}
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->deleteInvoice($idInvoice) -> InvoiceResponseWithoutData</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a single invoice from an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->deleteInvoice(
    23548884,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idInvoice:** `int` — Invoice ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->editInvoice($idInvoice, $request) -> InvoiceResponseWithoutData</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates details for a single invoice in an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->editInvoice(
    332,
    new EditInvoiceRequest([
        'body' => new InvoiceDataRequest([
            'invoiceData' => new BillData([
                'items' => [
                    new BillItem([
                        'itemProductName' => 'Deposit',
                        'itemDescription' => 'Deposit for trip planning',
                        'itemCost' => 882.37,
                        'itemQty' => 1,
                    ]),
                ],
                'invoiceDate' => new DateTime('2025-10-19'),
                'invoiceAmount' => 982.37,
                'invoiceNumber' => 'INV-6',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idInvoice:** `int` — Invoice ID
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `InvoiceDataRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->getAttachedFileFromInvoice($idInvoice, $filename, $request) -> FileContent</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a file attached to an invoice.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->getAttachedFileFromInvoice(
    1,
    'filename',
    new GetAttachedFileFromInvoiceRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idInvoice:** `int` — Invoice ID
    
</dd>
</dl>

<dl>
<dd>

**$filename:** `string` 

The filename in Payabli. Filename is `zipName` in the response to a request to `/api/Invoice/{idInvoice}`. Here, the filename is `0_Bill.pdf``. 
```
  "DocumentsRef": {
    "zipfile": "inva_269.zip",
    "filelist": [
      {
        "originalName": "Bill.pdf",
        "zipName": "0_Bill.pdf",
        "descriptor": null
      }
    ]
  }
  ```
    
</dd>
</dl>

<dl>
<dd>

**$returnObject:** `?bool` — When `true`, the request returns the file content as a Base64-encoded string.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->getInvoice($idInvoice) -> GetInvoiceRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a single invoice by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->getInvoice(
    23548884,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idInvoice:** `int` — Invoice ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->getInvoiceNumber($entry) -> InvoiceNumberResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the next available invoice number for a paypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->getInvoiceNumber(
    '8cfec329267',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->listInvoices($entry, $request) -> QueryInvoiceResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of invoices for an entrypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->listInvoices(
    '8cfec329267',
    new ListInvoicesRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:

- `invoiceDate` (gt, ge, lt, le, eq, ne)
- `dueDate` (gt, ge, lt, le, eq, ne)
- `sentDate` (gt, ge, lt, le, eq, ne)
- `frequency` (in, nin,ne, eq)
- `invoiceType` (eq, ne)
- `payTerms` (in, nin, eq, ne)
- `paypointId` (ne, eq)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `paidAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `invoiceNumber` (ct, nct, eq, ne)
- `purchaseOrder` (ct, nct, eq, ne)
- `itemProductCode` (ct, nct)
- `itemDescription` (ct, nct)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq)
- `paylinkId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:
  
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: totalAmount(gt)=20 return all records with totalAmount greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->listInvoicesOrg($orgId, $request) -> QueryInvoiceResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of invoices for an org. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->listInvoicesOrg(
    123,
    new ListInvoicesOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:

- `invoiceDate` (gt, ge, lt, le, eq, ne)
- `dueDate` (gt, ge, lt, le, eq, ne)
- `sentDate` (gt, ge, lt, le, eq, ne)
- `frequency` (in, nin,ne, eq)
- `invoiceType` (eq, ne)
- `payTerms` (in, nin, eq, ne)
- `paypointId` (ne, eq)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `paidAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `invoiceNumber` (ct, nct, eq, ne)
- `purchaseOrder` (ct, nct, eq, ne)
- `itemProductCode` (ct, nct)
- `itemDescription` (ct, nct)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq)
- `paylinkId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

List of comparison accepted - enclosed between parentheses:

- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: totalAmount(gt)=20 return all records with totalAmount greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->sendInvoice($idInvoice, $request) -> SendInvoiceResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sends an invoice from an entrypoint via email.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->sendInvoice(
    23548884,
    new SendInvoiceRequest([
        'attachfile' => true,
        'mail2' => 'tamara@example.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idInvoice:** `int` — Invoice ID
    
</dd>
</dl>

<dl>
<dd>

**$attachfile:** `?bool` — When `true`, attaches a PDF version of invoice to the email.
    
</dd>
</dl>

<dl>
<dd>

**$mail2:** `?string` — Email address where the invoice will be sent to. If this parameter isn't included, Payabli uses the email address on file for the customer owner of the invoice.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->invoice->getInvoicePdf($idInvoice) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Export a single invoice in PDF format.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->invoice->getInvoicePdf(
    23548884,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idInvoice:** `int` — Invoice ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## LineItem
<details><summary><code>$client->lineItem->addItem($entry, $request) -> PayabliApiResponse6</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Adds products and services to an entrypoint's catalog. These are used as line items for invoicing and transactions. In the response, "responseData" displays the item's code.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->lineItem->addItem(
    '47cae3d74',
    new AddItemRequest([
        'body' => new LineItem([
            'itemProductCode' => 'M-DEPOSIT',
            'itemProductName' => 'Materials deposit',
            'itemDescription' => 'Deposit for materials',
            'itemCommodityCode' => '010',
            'itemUnitOfMeasure' => 'SqFt',
            'itemCost' => 12.45,
            'itemQty' => 1,
            'itemMode' => 0,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — A unique ID you can include to prevent duplicating objects or transactions if a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `LineItem` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->lineItem->deleteItem($lineItemId) -> DeleteItemResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes an item.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->lineItem->deleteItem(
    700,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$lineItemId:** `int` — ID for the line item (also known as a product, service, or item).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->lineItem->getItem($lineItemId) -> LineItemQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets an item by ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->lineItem->getItem(
    700,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$lineItemId:** `int` — ID for the line item (also known as a product, service, or item).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->lineItem->listLineItems($entry, $request) -> QueryResponseItems</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of line items and their details from an entrypoint. Line items are also known as items, products, and services. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->lineItem->listLineItems(
    '8cfec329267',
    new ListLineItemsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20

</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:

  - `categories` (ct, nct)
  - `code` (ne, eq, ct, nct)
  - `commodityCode` (ne, eq, ct, nct)
  - `createdDate` (gt, ge, lt, le, eq, ne)
  - `description` (ne, eq, ct, nct)
  - `externalPaypointID` (ct, nct, ne, eq)
  - `mode` (eq, ne)
  - `name` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `paypointId` (ne, eq)
  - `paypointLegal` (ne, eq, ct, nct)
  - `quantity` (gt, ge, lt, le, eq, ne)
  - `uom` (ne, eq, ct, nct)
  - `updatedDate` (gt, ge, lt, le, eq, ne)
  - `value` (gt, ge, lt, le, eq, ne)

List of comparison accepted - enclosed between parentheses:

- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: name(ct)=john return all records with name containing john
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->lineItem->updateItem($lineItemId, $request) -> PayabliApiResponse6</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates an item.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->lineItem->updateItem(
    700,
    new LineItem([
        'itemCost' => 12.45,
        'itemQty' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$lineItemId:** `int` — ID for the line item (also known as a product, service, or item).
    
</dd>
</dl>

<dl>
<dd>

**$request:** `LineItem` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## MoneyIn
<details><summary><code>$client->moneyIn->authorize($request) -> AuthResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Authorize a card transaction. This returns an authorization code and reserves funds for the merchant. Authorized transactions aren't flagged for settlement until [captured](/api-reference/moneyin/capture-an-authorized-transaction).

**Note**: Only card transactions can be authorized. This endpoint can't be used for ACH transactions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->authorize(
    new RequestPaymentAuthorize([
        'body' => new TransRequestBody([
            'customerData' => new PayorDataRequest([
                'customerId' => 4440,
            ]),
            'entryPoint' => 'f743aed24a',
            'ipaddress' => '255.255.255.255',
            'paymentDetails' => new PaymentDetail([
                'serviceFee' => 0,
                'totalAmount' => 100,
            ]),
            'paymentMethod' => new PayMethodCredit([
                'cardcvv' => '999',
                'cardexp' => '02/27',
                'cardHolder' => 'John Cassian',
                'cardnumber' => '4111111111111111',
                'cardzip' => '12345',
                'initiator' => 'payor',
                'method' => 'card',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `TransRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->capture($transId, $amount) -> CaptureResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated and will be sunset on November 24, 2025. Migrate to [POST `/capture/{transId}`](/api-reference/moneyin/capture-an-authorized-transaction)`.
</Warning>
  
  Capture an [authorized
transaction](/api-reference/moneyin/authorize-a-transaction) to complete the transaction and move funds from the customer to merchant account.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->capture(
    '10-7d9cd67d-2d5d-4cd7-a1b7-72b8b201ec13',
    0,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>

<dl>
<dd>

**$amount:** `float` — Amount to be captured. The amount can't be greater the original total amount of the transaction. `0` captures the total amount authorized in the transaction. Partial captures aren't supported.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->captureAuth($transId, $request) -> CaptureResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Capture an [authorized transaction](/api-reference/moneyin/authorize-a-transaction) to complete the transaction and move funds from the customer to merchant account. 

You can use this endpoint to capture both full and partial amounts of the original authorized transaction. See [Capture an authorized transaction](/developers/developer-guides/pay-in-auth-and-capture) for more information about this endpoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->captureAuth(
    '10-7d9cd67d-2d5d-4cd7-a1b7-72b8b201ec13',
    new CaptureRequest([
        'paymentDetails' => new CapturePaymentDetails([
            'totalAmount' => 105,
            'serviceFee' => 5,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>

<dl>
<dd>

**$request:** `CaptureRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->credit($request) -> PayabliApiResponse0</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Make a temporary microdeposit in a customer account to verify the customer's ownership and access to the target account. Reverse the microdeposit with `reverseCredit`.

This feature must be enabled by Payabli on a per-merchant basis. Contact support for help. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->credit(
    new RequestCredit([
        'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
        'customerData' => new PayorDataRequest([
            'billingAddress1' => '5127 Linkwood ave',
            'customerNumber' => '100',
        ]),
        'entrypoint' => 'my-entrypoint',
        'paymentDetails' => new PaymentDetailCredit([
            'serviceFee' => 0,
            'totalAmount' => 1,
        ]),
        'paymentMethod' => new RequestCreditPaymentMethod([
            'achAccount' => '88354454',
            'achAccountType' => Achaccounttype::Checking->value,
            'achHolder' => 'John Smith',
            'achRouting' => '021000021',
            'method' => 'ach',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$accountId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$customerData:** `PayorDataRequest` — Object describing the customer/payor.
    
</dd>
</dl>

<dl>
<dd>

**$entrypoint:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orderDescription:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orderId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$paymentDetails:** `PaymentDetailCredit` 
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethod:** `RequestCreditPaymentMethod` — Object describing the ACH payment method to use for transaction.
    
</dd>
</dl>

<dl>
<dd>

**$source:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->details($transId) -> TransactionQueryRecordsCustomer</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a processed transaction's details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->details(
    '45-as456777hhhhhhhhhh77777777-324',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->getpaid($request) -> PayabliApiResponseGetPaid</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Make a single transaction. This method authorizes and captures a payment in one step.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->getpaid(
    new RequestPayment([
        'body' => new TransRequestBody([
            'customerData' => new PayorDataRequest([
                'customerId' => 4440,
            ]),
            'entryPoint' => 'f743aed24a',
            'ipaddress' => '255.255.255.255',
            'paymentDetails' => new PaymentDetail([
                'serviceFee' => 0,
                'totalAmount' => 100,
            ]),
            'paymentMethod' => new PayMethodCredit([
                'cardcvv' => '999',
                'cardexp' => '02/27',
                'cardHolder' => 'John Cassian',
                'cardnumber' => '4111111111111111',
                'cardzip' => '12345',
                'initiator' => 'payor',
                'method' => 'card',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$achValidation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$includeDetails:** `?bool` — When `true`, transactionDetails object is returned in the response. See a full example of the `transactionDetails` object in the [Transaction integration guide](/developers/developer-guides/money-in-transaction-add#includedetailstrue-response).
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$validationCode:** `?string` — Value obtained from user when an API generated CAPTCHA is used in payment page
    
</dd>
</dl>

<dl>
<dd>

**$request:** `TransRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->reverse($transId, $amount) -> ReverseResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

A reversal either refunds or voids a transaction independent of the transaction's settlement status. Send a reversal request for a transaction, and Payabli automatically determines whether it's a refund or void. You don't need to know whether the transaction is settled or not.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->reverse(
    0,
    '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>

<dl>
<dd>

**$amount:** `float` 


Amount to reverse from original transaction, minus any service fees charged on the original transaction.

The amount provided can't be greater than the original total amount of the transaction, minus service fees. For example, if a transaction was $90 plus a $10 service fee, you can reverse up to $90. 

An amount equal to zero will refunds the total amount authorized minus any service fee.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->refund($transId, $amount) -> RefundResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Refund a transaction that has settled and send money back to the account holder. If a transaction hasn't been settled, void it instead.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->refund(
    0,
    '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>

<dl>
<dd>

**$amount:** `float` 


Amount to refund from original transaction, minus any service fees charged on the original transaction. 

The amount provided can't be greater than the original total amount of the transaction, minus service fees. For example, if a transaction was \$90 plus a \$10 service fee, you can refund up to \$90.

An amount equal to zero will refund the total amount authorized minus any service fee.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->refundWithInstructions($transId, $request) -> RefundWithInstructionsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Refunds a settled transaction with split instructions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->refundWithInstructions(
    '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
    new RequestRefund([
        'idempotencyKey' => '8A29FC40-CA47-1067-B31D-00DD010662DB',
        'source' => 'api',
        'orderDescription' => 'Materials deposit',
        'amount' => 100,
        'refundDetails' => new RefundDetail([
            'splitRefunding' => [
                new SplitFundingRefundContent([
                    'originationEntryPoint' => '7f1a381696',
                    'accountId' => '187-342',
                    'description' => 'Refunding undelivered materials',
                    'amount' => 60,
                ]),
                new SplitFundingRefundContent([
                    'originationEntryPoint' => '7f1a381696',
                    'accountId' => '187-343',
                    'description' => 'Refunding deposit for undelivered materials',
                    'amount' => 40,
                ]),
            ],
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$amount:** `?float` 


Amount to refund from original transaction, minus any service fees charged on the original transaction. 

The amount provided can't be greater than the original total amount of the transaction, minus service fees. For example, if a transaction was $90 plus a $10 service fee, you can refund up to $90. 

An amount equal to zero will refund the total amount authorized minus any service fee.
    
</dd>
</dl>

<dl>
<dd>

**$ipaddress:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orderDescription:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orderId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$refundDetails:** `?RefundDetail` 
    
</dd>
</dl>

<dl>
<dd>

**$source:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->reverseCredit($transId) -> PayabliApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Reverse microdeposits that are used to verify customer account ownership and access. The `transId` value is returned in the success response for the original credit transaction made with `api/MoneyIn/makecredit`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->reverseCredit(
    '45-as456777hhhhhhhhhh77777777-324',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->sendReceipt2Trans($transId, $request) -> ReceiptResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Send a payment receipt for a transaction.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->sendReceipt2Trans(
    '45-as456777hhhhhhhhhh77777777-324',
    new SendReceipt2TransRequest([
        'email' => 'example@email.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` 

Email address where the payment receipt should be sent. 

If not provided, the email address on file for the user owner of the transaction is used.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->validate($request) -> ValidateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Validates a card number without running a transaction or authorizing a charge.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->validate(
    new RequestPaymentValidate([
        'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
        'entryPoint' => 'entry132',
        'paymentMethod' => new RequestPaymentValidatePaymentMethod([
            'method' => RequestPaymentValidatePaymentMethodMethod::Card->value,
            'cardnumber' => '4360000001000005',
            'cardexp' => '12/29',
            'cardzip' => '14602-8328',
            'cardHolder' => 'Dianne Becker-Smith',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$accountId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$entryPoint:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$orderDescription:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orderId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethod:** `RequestPaymentValidatePaymentMethod` — Object describing payment method to use for transaction.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyIn->void($transId) -> VoidResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancel a transaction that hasn't been settled yet. Voiding non-captured authorizations prevents future captures. If a transaction has been settled, refund it instead.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyIn->void(
    '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## MoneyOut
<details><summary><code>$client->moneyOut->authorizeOut($request) -> AuthCapturePayoutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Authorizes transaction for payout. Authorized transactions aren't flagged for settlement until captured. Use `referenceId` returned in the response to capture the transaction. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->authorizeOut(
    new MoneyOutTypesRequestOutAuthorize([
        'body' => new AuthorizePayoutBody([
            'entryPoint' => '48acde49',
            'invoiceData' => [
                new RequestOutAuthorizeInvoiceData([
                    'billId' => 54323,
                ]),
            ],
            'orderDescription' => 'Window Painting',
            'paymentDetails' => new RequestOutAuthorizePaymentDetails([
                'totalAmount' => 47,
                'unbundled' => false,
            ]),
            'paymentMethod' => new AuthorizePaymentMethod([
                'method' => 'managed',
            ]),
            'vendorData' => new RequestOutAuthorizeVendorData([
                'vendorNumber' => '7895433',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$allowDuplicatedBills:** `?bool` — When `true`, the authorization bypasses the requirement for unique bills, identified by vendor invoice number. This allows you to make more than one payout authorization for a bill, like a split payment.
    
</dd>
</dl>

<dl>
<dd>

**$doNotCreateBills:** `?bool` — When `true`, Payabli won't automatically create a bill for this payout transaction.
    
</dd>
</dl>

<dl>
<dd>

**$forceVendorCreation:** `?bool` — When `true`, the request creates a new vendor record, regardless of whether the vendor already exists.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `AuthorizePayoutBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->cancelAllOut($request) -> CaptureAllOutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancels an array of payout transactions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->cancelAllOut(
    [
        '2-29',
        '2-28',
        '2-27',
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `array` — Array of identifiers of payout transactions to cancel.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->cancelOutGet($referenceId) -> PayabliApiResponse0000</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancel a payout transaction by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->cancelOutGet(
    '129-219',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$referenceId:** `string` — The ID for the payout transaction. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->cancelOutDelete($referenceId) -> PayabliApiResponse0000</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancel a payout transaction by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->cancelOutDelete(
    '129-219',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$referenceId:** `string` — The ID for the payout transaction. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->captureAllOut($request) -> CaptureAllOutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Captures an array of authorized payout transactions for settlement. The maximum number of transactions that can be captured in a single request is 500.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->captureAllOut(
    new CaptureAllOutRequest([
        'body' => [
            '2-29',
            '2-28',
            '2-27',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `array` — Array of identifiers of payout transactions to capture.  
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->captureOut($referenceId, $request) -> AuthCapturePayoutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Captures a single authorized payout transaction by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->captureOut(
    '129-219',
    new CaptureOutRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$referenceId:** `string` — The ID for the payout transaction. 
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->payoutDetails($transId) -> BillDetailResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns details for a processed money out transaction.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->payoutDetails(
    '45-as456777hhhhhhhhhh77777777-324',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — ReferenceId for the transaction (PaymentId).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->vCardGet($cardToken) -> VCardGetResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves vCard details for a single card in an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->vCardGet(
    '20230403315245421165',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cardToken:** `string` — ID for a virtual card.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->sendVCardLink($request) -> OperationResult</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sends a virtual card link via email to the vendor associated with the `transId`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->sendVCardLink(
    new SendVCardLinkRequest([
        'transId' => '01K33Z6YQZ6GD5QVKZ856MJBSC',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transId:** `string` — The transaction ID of the virtual card payout. The ID is returned as `ReferenceId` in the response when you authorize a payout with POST /MoneyOut/authorize.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->moneyOut->getCheckImage($assetName) -> string</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the image of a check associated with a processed transaction. 
The check image is returned in the response body as a base64-encoded string. 
The check image is only available for payouts that have been processed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->moneyOut->getCheckImage(
    'check133832686289732320_01JKBNZ5P32JPTZY8XXXX000000.pdf',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$assetName:** `string` 

Name of the check asset to retrieve. This is returned as `filename` in the `CheckData` object 
in the response when you make a GET request to `/MoneyOut/details/{transId}`.
```
    "CheckData": {
      "ftype": "PDF",
      "filename": "check133832686289732320_01JKBNZ5P32JPTZY8XXXX000000.pdf",
      "furl": "",
      "fContent": ""
  }
```
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Notification
<details><summary><code>$client->notification->addNotification($request) -> PayabliApiResponseNotifications</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new notification or autogenerated report. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notification->addNotification(
    new NotificationStandardRequest([
        'content' => new NotificationStandardRequestContent([
            'eventType' => NotificationStandardRequestContentEventType::CreatedApplication->value,
        ]),
        'frequency' => NotificationStandardRequestFrequency::Untilcancelled->value,
        'method' => NotificationStandardRequestMethod::Web->value,
        'ownerId' => '236',
        'ownerType' => 0,
        'status' => 1,
        'target' => 'https://webhook.site/2871b8f8-edc7-441a-b376-98d8c8e33275',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `NotificationStandardRequest|NotificationReportRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->notification->deleteNotification($nId) -> PayabliApiResponseNotifications</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a single notification or autogenerated report.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notification->deleteNotification(
    '1717',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$nId:** `string` — Notification ID. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->notification->getNotification($nId) -> NotificationQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a single notification or autogenerated report's details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notification->getNotification(
    '1717',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$nId:** `string` — Notification ID. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->notification->updateNotification($nId, $request) -> PayabliApiResponseNotifications</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a notification or autogenerated report. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notification->updateNotification(
    '1717',
    new NotificationStandardRequest([
        'content' => new NotificationStandardRequestContent([
            'eventType' => NotificationStandardRequestContentEventType::ApprovedPayment->value,
        ]),
        'frequency' => NotificationStandardRequestFrequency::Untilcancelled->value,
        'method' => NotificationStandardRequestMethod::Email->value,
        'ownerId' => '136',
        'ownerType' => 0,
        'status' => 1,
        'target' => 'newemail@email.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$nId:** `string` — Notification ID. 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `NotificationStandardRequest|NotificationReportRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->notification->getReportFile($id) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets a copy of a generated report by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notification->getReportFile(
    1000000,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$id:** `int` — Report ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Notificationlogs
<details><summary><code>$client->notificationlogs->searchNotificationLogs($request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Search notification logs with filtering and pagination.
  - Start date and end date cannot be more than 30 days apart
  - Either `orgId` or `paypointId` must be provided

This endpoint requires the `notifications_create` OR `notifications_read` permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notificationlogs->searchNotificationLogs(
    new SearchNotificationLogsRequest([
        'pageSize' => 20,
        'body' => new NotificationLogSearchRequest([
            'startDate' => new DateTime('2024-01-01T00:00:00Z'),
            'endDate' => new DateTime('2024-01-31T23:59:59Z'),
            'orgId' => 12345,
            'notificationEvent' => 'ActivatedMerchant',
            'succeeded' => true,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — The page number to retrieve. Defaults to 1 if not provided.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `NotificationLogSearchRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->notificationlogs->getNotificationLog($uuid) -> NotificationLogDetail</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get detailed information for a specific notification log entry.
This endpoint requires the `notifications_create` OR `notifications_read` permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notificationlogs->getNotificationLog(
    '550e8400-e29b-41d4-a716-446655440000',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$uuid:** `string` — The notification log entry.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->notificationlogs->retryNotificationLog($uuid) -> NotificationLogDetail</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retry sending a specific notification.

**Permissions:** notifications_create
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notificationlogs->retryNotificationLog(
    '550e8400-e29b-41d4-a716-446655440000',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$uuid:** `string` — Unique id
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->notificationlogs->bulkRetryNotificationLogs($request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retry sending multiple notifications (maximum 50 IDs).
This is an async process, so use the search endpoint again to check the notification status.

This endpoint requires the `notifications_create` permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->notificationlogs->bulkRetryNotificationLogs(
    [
        '550e8400-e29b-41d4-a716-446655440000',
        '550e8400-e29b-41d4-a716-446655440001',
        '550e8400-e29b-41d4-a716-446655440002',
    ],
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Ocr
<details><summary><code>$client->ocr->ocrDocumentForm($typeResult, $request) -> PayabliApiResponseOcr</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to upload an image file for OCR processing. The accepted file formats include PDF, JPG, JPEG, PNG, and GIF. Specify the desired type of result (either 'bill' or 'invoice') in the path parameter `typeResult`. The response will contain the OCR processing results, including extracted data such as bill number, vendor information, bill items, and more.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->ocr->ocrDocumentForm(
    'typeResult',
    new FileContentImageOnly([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$typeResult:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `FileContentImageOnly` — The image file to OCR. Accepted formats include PDF, JPG, JPEG, PNG, GIF.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->ocr->ocrDocumentJson($typeResult, $request) -> PayabliApiResponseOcr</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to submit a Base64-encoded image file for OCR processing. The accepted file formats include PDF, JPG, JPEG, PNG, and GIF. Specify the desired type of result (either 'bill' or 'invoice') in the path parameter `typeResult`. The response will contain the OCR processing results, including extracted data such as bill number, vendor information, bill items, and more.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->ocr->ocrDocumentJson(
    'typeResult',
    new FileContentImageOnly([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$typeResult:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `FileContentImageOnly` — Base64-encoded file content for OCR processing
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organization
<details><summary><code>$client->organization->addOrganization($request) -> AddOrganizationResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates an organization under a parent organization. This is also referred to as a suborganization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organization->addOrganization(
    new AddOrganizationRequest([
        'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
        'billingInfo' => new Instrument([
            'achAccount' => '123123123',
            'achRouting' => '123123123',
            'billingAddress' => '123 Walnut Street',
            'billingCity' => 'Johnson City',
            'billingCountry' => 'US',
            'billingState' => 'TN',
            'billingZip' => '37615',
        ]),
        'contacts' => [
            new Contacts([
                'contactEmail' => 'herman@hermanscoatings.com',
                'contactName' => 'Herman Martinez',
                'contactPhone' => '3055550000',
                'contactTitle' => 'Owner',
            ]),
        ],
        'hasBilling' => true,
        'hasResidual' => true,
        'orgAddress' => '123 Walnut Street',
        'orgCity' => 'Johnson City',
        'orgCountry' => 'US',
        'orgEntryName' => 'pilgrim-planner',
        'orgId' => '123',
        'orgLogo' => new FileContent([
            'fContent' => 'TXkgdGVzdCBmaWxlHJ==...',
            'filename' => 'my-doc.pdf',
            'ftype' => FileContentFtype::Pdf->value,
            'furl' => 'https://mysite.com/my-doc.pdf',
        ]),
        'orgName' => 'Pilgrim Planner',
        'orgParentId' => 236,
        'orgState' => 'TN',
        'orgTimezone' => -5,
        'orgType' => 0,
        'orgWebsite' => 'www.pilgrimageplanner.com',
        'orgZip' => '37615',
        'replyToEmail' => 'email@example.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$services:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$billingInfo:** `?Instrument` 
    
</dd>
</dl>

<dl>
<dd>

**$contacts:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$hasBilling:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$hasResidual:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$orgAddress:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgCity:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgCountry:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgEntryName:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgLogo:** `?FileContent` 
    
</dd>
</dl>

<dl>
<dd>

**$orgName:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgParentId:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$orgState:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgTimezone:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$orgType:** `int` 
    
</dd>
</dl>

<dl>
<dd>

**$orgWebsite:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgZip:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$replyToEmail:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->organization->deleteOrganization($orgId) -> DeleteOrganizationResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an organization by ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organization->deleteOrganization(
    123,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->organization->editOrganization($orgId, $request) -> EditOrganizationResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates an organization's details by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organization->editOrganization(
    123,
    new OrganizationData([
        'contacts' => [
            new Contacts([
                'contactEmail' => 'herman@hermanscoatings.com',
                'contactName' => 'Herman Martinez',
                'contactPhone' => '3055550000',
                'contactTitle' => 'Owner',
            ]),
        ],
        'orgAddress' => '123 Walnut Street',
        'orgCity' => 'Johnson City',
        'orgCountry' => 'US',
        'orgEntryName' => 'pilgrim-planner',
        'organizationDataOrgId' => '123',
        'orgName' => 'Pilgrim Planner',
        'orgState' => 'TN',
        'orgTimezone' => -5,
        'orgType' => 0,
        'orgWebsite' => 'www.pilgrimageplanner.com',
        'orgZip' => '37615',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$services:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$billingInfo:** `?Instrument` 
    
</dd>
</dl>

<dl>
<dd>

**$contacts:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$hasBilling:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$hasResidual:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$orgAddress:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgCity:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgCountry:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgEntryName:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$organizationDataOrgId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgLogo:** `?FileContent` 
    
</dd>
</dl>

<dl>
<dd>

**$orgName:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgParentId:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$orgState:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgTimezone:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$orgType:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$orgWebsite:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$orgZip:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$replyToEmail:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->organization->getBasicOrganization($entry) -> OrganizationQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets an organization's basic information by entry name (entrypoint identifier).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organization->getBasicOrganization(
    '8cfec329267',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->organization->getBasicOrganizationById($orgId) -> OrganizationQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets an organizations basic details by org ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organization->getBasicOrganizationById(
    123,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->organization->getOrganization($orgId) -> OrganizationQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves details for an organization by ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organization->getOrganization(
    123,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->organization->getSettingsOrganization($orgId) -> SettingsQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves an organization's settings.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->organization->getSettingsOrganization(
    123,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## PaymentLink
<details><summary><code>$client->paymentLink->addPayLinkFromInvoice($idInvoice, $request) -> PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generates a payment link for an invoice from the invoice ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->addPayLinkFromInvoice(
    23548884,
    new PayLinkDataInvoice([
        'mail2' => 'jo@example.com; ceo@example.com',
        'body' => new PaymentPageRequestBody([
            'contactUs' => new ContactElement([
                'emailLabel' => 'Email',
                'enabled' => true,
                'header' => 'Contact Us',
                'order' => 0,
                'paymentIcons' => true,
                'phoneLabel' => 'Phone',
            ]),
            'invoices' => new InvoiceElement([
                'enabled' => true,
                'invoiceLink' => new LabelElement([
                    'enabled' => true,
                    'label' => 'View Invoice',
                    'order' => 0,
                ]),
                'order' => 0,
                'viewInvoiceDetails' => new LabelElement([
                    'enabled' => true,
                    'label' => 'Invoice Details',
                    'order' => 0,
                ]),
            ]),
            'logo' => new Element([
                'enabled' => true,
                'order' => 0,
            ]),
            'messageBeforePaying' => new LabelElement([
                'enabled' => true,
                'label' => 'Please review your payment details',
                'order' => 0,
            ]),
            'notes' => new NoteElement([
                'enabled' => true,
                'header' => 'Additional Notes',
                'order' => 0,
                'placeholder' => 'Enter any additional notes here',
                'value' => '',
            ]),
            'page' => new PageElement([
                'description' => 'Complete your payment securely',
                'enabled' => true,
                'header' => 'Payment Page',
                'order' => 0,
            ]),
            'paymentButton' => new LabelElement([
                'enabled' => true,
                'label' => 'Pay Now',
                'order' => 0,
            ]),
            'paymentMethods' => new MethodElement([
                'allMethodsChecked' => true,
                'enabled' => true,
                'header' => 'Payment Methods',
                'methods' => new MethodsList([
                    'amex' => true,
                    'applePay' => true,
                    'discover' => true,
                    'eCheck' => true,
                    'mastercard' => true,
                    'visa' => true,
                ]),
                'order' => 0,
                'settings' => new MethodElementSettings([
                    'applePay' => new MethodElementSettingsApplePay([
                        'buttonStyle' => MethodElementSettingsApplePayButtonStyle::Black->value,
                        'buttonType' => MethodElementSettingsApplePayButtonType::Pay->value,
                        'language' => MethodElementSettingsApplePayLanguage::EnUs->value,
                    ]),
                ]),
            ]),
            'payor' => new PayorElement([
                'enabled' => true,
                'fields' => [
                    new PayorFields([
                        'display' => true,
                        'fixed' => true,
                        'identifier' => true,
                        'label' => 'Full Name',
                        'name' => 'fullName',
                        'order' => 0,
                        'required' => true,
                        'validation' => '^[a-zA-Z ]+$',
                        'value' => '',
                        'width' => 0,
                    ]),
                ],
                'header' => 'Payor Information',
                'order' => 0,
            ]),
            'review' => new HeaderElement([
                'enabled' => true,
                'header' => 'Review Payment',
                'order' => 0,
            ]),
            'settings' => new PagelinkSetting([
                'color' => '#000000',
                'customCssUrl' => 'https://example.com/custom.css',
                'language' => 'en',
                'pageLogo' => new FileContent([
                    'fContent' => 'PHN2ZyB2aWV3Qm94PSIwIDAgODAwIDEwMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPCEtLSBCYWNrZ3JvdW5kIC0tPgogIDxyZWN0IHdpZHRoPSI4MDAiIGhlaWdodD0iMTAwMCIgZmlsbD0id2hpdGUiLz4KICAKICA8IS0tIENvbXBhbnkgSGVhZGVyIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI2MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjI0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+R3J1enlhIEFkdmVudHVyZSBPdXRmaXR0ZXJzPC90ZXh0PgogIDxsaW5lIHgxPSI0MCIgeTE9IjgwIiB4Mj0iNzYwIiB5Mj0iODAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIyIi8+CiAgCiAgPCEtLSBDb21wYW55IERldGFpbHMgLS0+CiAgPHRleHQgeD0iNDAiIHk9IjExMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4xMjMgTW91bnRhaW4gVmlldyBSb2FkPC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxMzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+VGJpbGlzaSwgR2VvcmdpYSAwMTA1PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxNTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+VGVsOiArOTk1IDMyIDEyMyA0NTY3PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSIxNzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+RW1haWw6IGluZm9AZ3J1enlhYWR2ZW50dXJlcy5jb208L3RleHQ+CgogIDwhLS0gSW52b2ljZSBUaXRsZSAtLT4KICA8dGV4dCB4PSI2MDAiIHk9IjExMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjI0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+SU5WT0lDRTwvdGV4dD4KICA8dGV4dCB4PSI2MDAiIHk9IjE0MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5EYXRlOiAxMi8xMS8yMDI0PC90ZXh0PgogIDx0ZXh0IHg9IjYwMCIgeT0iMTYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPkludm9pY2UgIzogR1JaLTIwMjQtMTEyMzwvdGV4dD4KCiAgPCEtLSBCaWxsIFRvIFNlY3Rpb24gLS0+CiAgPHRleHQgeD0iNDAiIHk9IjIyMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+QklMTCBUTzo8L3RleHQ+CiAgPHJlY3QgeD0iNDAiIHk9IjIzNSIgd2lkdGg9IjMwMCIgaGVpZ2h0PSI4MCIgZmlsbD0iI2Y3ZjlmYSIvPgogIDx0ZXh0IHg9IjUwIiB5PSIyNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+W0N1c3RvbWVyIE5hbWVdPC90ZXh0PgogIDx0ZXh0IHg9IjUwIiB5PSIyODAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+W0FkZHJlc3MgTGluZSAxXTwvdGV4dD4KICA8dGV4dCB4PSI1MCIgeT0iMzAwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPltDaXR5LCBDb3VudHJ5XTwvdGV4dD4KCiAgPCEtLSBUYWJsZSBIZWFkZXJzIC0tPgogIDxyZWN0IHg9IjQwIiB5PSIzNDAiIHdpZHRoPSI3MjAiIGhlaWdodD0iMzAiIGZpbGw9IiMyYzNlNTAiLz4KICA8dGV4dCB4PSI1MCIgeT0iMzYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZvbnQtd2VpZ2h0PSJib2xkIiBmaWxsPSJ3aGl0ZSI+RGVzY3JpcHRpb248L3RleHQ+CiAgPHRleHQgeD0iNDUwIiB5PSIzNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IndoaXRlIj5RdWFudGl0eTwvdGV4dD4KICA8dGV4dCB4PSI1NTAiIHk9IjM2MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0id2hpdGUiPlJhdGU8L3RleHQ+CiAgPHRleHQgeD0iNjgwIiB5PSIzNjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IndoaXRlIj5BbW91bnQ8L3RleHQ+CgogIDwhLS0gVGFibGUgUm93cyAtLT4KICA8cmVjdCB4PSI0MCIgeT0iMzcwIiB3aWR0aD0iNzIwIiBoZWlnaHQ9IjMwIiBmaWxsPSIjZjdmOWZhIi8+CiAgPHRleHQgeD0iNTAiIHk9IjM5MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5Nb3VudGFpbiBDbGltYmluZyBFcXVpcG1lbnQgUmVudGFsPC90ZXh0PgogIDx0ZXh0IHg9IjQ1MCIgeT0iMzkwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPjE8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSIzOTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDI1MC4wMDwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjM5MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kMjUwLjAwPC90ZXh0PgoKICA8cmVjdCB4PSI0MCIgeT0iNDAwIiB3aWR0aD0iNzIwIiBoZWlnaHQ9IjMwIiBmaWxsPSJ3aGl0ZSIvPgogIDx0ZXh0IHg9IjUwIiB5PSI0MjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+R3VpZGVkIFRyZWsgUGFja2FnZSAtIDIgRGF5czwvdGV4dD4KICA8dGV4dCB4PSI0NTAiIHk9IjQyMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4xPC90ZXh0PgogIDx0ZXh0IHg9IjU1MCIgeT0iNDIwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPiQ0MDAuMDA8L3RleHQ+CiAgPHRleHQgeD0iNjgwIiB5PSI0MjAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDQwMC4wMDwvdGV4dD4KCiAgPHJlY3QgeD0iNDAiIHk9IjQzMCIgd2lkdGg9IjcyMCIgaGVpZ2h0PSIzMCIgZmlsbD0iI2Y3ZjlmYSIvPgogIDx0ZXh0IHg9IjUwIiB5PSI0NTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+U2FmZXR5IEVxdWlwbWVudCBQYWNrYWdlPC90ZXh0PgogIDx0ZXh0IHg9IjQ1MCIgeT0iNDUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPjE8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSI0NTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+JDE1MC4wMDwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjQ1MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kMTUwLjAwPC90ZXh0PgoKICA8IS0tIFRvdGFscyAtLT4KICA8bGluZSB4MT0iNDAiIHkxPSI0ODAiIHgyPSI3NjAiIHkyPSI0ODAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIxIi8+CiAgPHRleHQgeD0iNTUwIiB5PSI1MTAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMzNDQ5NWUiPlN1YnRvdGFsOjwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjUxMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj4kODAwLjAwPC90ZXh0PgogIDx0ZXh0IHg9IjU1MCIgeT0iNTM1IiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZvbnQtd2VpZ2h0PSJib2xkIiBmaWxsPSIjMzQ0OTVlIj5UYXggKDE4JSk6PC90ZXh0PgogIDx0ZXh0IHg9IjY4MCIgeT0iNTM1IiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPiQxNDQuMDA8L3RleHQ+CiAgPHRleHQgeD0iNTUwIiB5PSI1NzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPlRvdGFsOjwvdGV4dD4KICA8dGV4dCB4PSI2ODAiIHk9IjU3MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE2IiBmb250LXdlaWdodD0iYm9sZCIgZmlsbD0iIzJjM2U1MCI+JDk0NC4wMDwvdGV4dD4KCiAgPCEtLSBQYXltZW50IFRlcm1zIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI2NDAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPlBheW1lbnQgVGVybXM8L3RleHQ+CiAgPHRleHQgeD0iNDAiIHk9IjY3MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjE0IiBmaWxsPSIjMzQ0OTVlIj5QYXltZW50IGlzIGR1ZSB3aXRoaW4gMzAgZGF5czwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNjkwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPlBsZWFzZSBpbmNsdWRlIGludm9pY2UgbnVtYmVyIG9uIHBheW1lbnQ8L3RleHQ+CgogIDwhLS0gQmFuayBEZXRhaWxzIC0tPgogIDx0ZXh0IHg9IjQwIiB5PSI3MzAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNiIgZm9udC13ZWlnaHQ9ImJvbGQiIGZpbGw9IiMyYzNlNTAiPkJhbmsgRGV0YWlsczwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNzYwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPkJhbms6IEJhbmsgb2YgR2VvcmdpYTwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iNzgwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiMzNDQ5NWUiPklCQU46IEdFMTIzNDU2Nzg5MDEyMzQ1Njc4PC90ZXh0PgogIDx0ZXh0IHg9IjQwIiB5PSI4MDAiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzM0NDk1ZSI+U1dJRlQ6IEJBR0FHRTIyPC90ZXh0PgoKICA8IS0tIEZvb3RlciAtLT4KICA8bGluZSB4MT0iNDAiIHkxPSI5MDAiIHgyPSI3NjAiIHkyPSI5MDAiIHN0cm9rZT0iIzJjM2U1MCIgc3Ryb2tlLXdpZHRoPSIxIi8+CiAgPHRleHQgeD0iNDAiIHk9IjkzMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjN2Y4YzhkIj5UaGFuayB5b3UgZm9yIGNob29zaW5nIEdydXp5YSBBZHZlbnR1cmUgT3V0Zml0dGVyczwvdGV4dD4KICA8dGV4dCB4PSI0MCIgeT0iOTUwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM3ZjhjOGQiPnd3dy5ncnV6eWFhZHZlbnR1cmVzLmNvbTwvdGV4dD4KPC9zdmc+Cg==',
                    'filename' => 'logo.jpg',
                    'ftype' => FileContentFtype::Jpg->value,
                    'furl' => '',
                ]),
                'redirectAfterApprove' => true,
                'redirectAfterApproveUrl' => 'https://example.com/success',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idInvoice:** `int` — Invoice ID
    
</dd>
</dl>

<dl>
<dd>

**$amountFixed:** `?bool` — Indicates whether customer can modify the payment amount. A value of `true` means the amount isn't modifiable, a value `false` means the payor can modify the amount to pay.
    
</dd>
</dl>

<dl>
<dd>

**$mail2:** `?string` — List of recipient email addresses. When there is more than one, separate them by a semicolon (;).
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `PaymentPageRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentLink->addPayLinkFromBill($billId, $request) -> PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generates a payment link for a bill from the bill ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->addPayLinkFromBill(
    23548884,
    new PayLinkDataBill([
        'mail2' => 'jo@example.com; ceo@example.com',
        'body' => new PaymentPageRequestBody([
            'contactUs' => new ContactElement([
                'emailLabel' => 'Email',
                'enabled' => true,
                'header' => 'Contact Us',
                'order' => 0,
                'paymentIcons' => true,
                'phoneLabel' => 'Phone',
            ]),
            'logo' => new Element([
                'enabled' => true,
                'order' => 0,
            ]),
            'messageBeforePaying' => new LabelElement([
                'enabled' => true,
                'label' => 'Please review your payment details',
                'order' => 0,
            ]),
            'notes' => new NoteElement([
                'enabled' => true,
                'header' => 'Additional Notes',
                'order' => 0,
                'placeholder' => 'Enter any additional notes here',
                'value' => '',
            ]),
            'page' => new PageElement([
                'description' => 'Get paid securely',
                'enabled' => true,
                'header' => 'Payment Page',
                'order' => 0,
            ]),
            'paymentButton' => new LabelElement([
                'enabled' => true,
                'label' => 'Pay Now',
                'order' => 0,
            ]),
            'paymentMethods' => new MethodElement([
                'allMethodsChecked' => true,
                'enabled' => true,
                'header' => 'Payment Methods',
                'methods' => new MethodsList([
                    'amex' => true,
                    'applePay' => true,
                    'discover' => true,
                    'eCheck' => true,
                    'mastercard' => true,
                    'visa' => true,
                ]),
                'order' => 0,
            ]),
            'payor' => new PayorElement([
                'enabled' => true,
                'fields' => [
                    new PayorFields([
                        'display' => true,
                        'fixed' => true,
                        'identifier' => true,
                        'label' => 'Full Name',
                        'name' => 'fullName',
                        'order' => 0,
                        'required' => true,
                        'validation' => '^[a-zA-Z ]+$',
                        'value' => '',
                        'width' => 0,
                    ]),
                ],
                'header' => 'Payor Information',
                'order' => 0,
            ]),
            'review' => new HeaderElement([
                'enabled' => true,
                'header' => 'Review Payment',
                'order' => 0,
            ]),
            'settings' => new PagelinkSetting([
                'color' => '#000000',
                'language' => 'en',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$billId:** `int` — The Payabli ID for the bill.
    
</dd>
</dl>

<dl>
<dd>

**$amountFixed:** `?bool` — Indicates whether customer can modify the payment amount. A value of `true` means the amount isn't modifiable, a value `false` means the payor can modify the amount to pay.
    
</dd>
</dl>

<dl>
<dd>

**$mail2:** `?string` — List of recipient email addresses. When there is more than one, separate them by a semicolon (;).
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `PaymentPageRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentLink->deletePayLinkFromId($payLinkId) -> PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a payment link by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->deletePayLinkFromId(
    'payLinkId',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$payLinkId:** `string` — ID for the payment link.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentLink->getPayLinkFromId($paylinkId) -> GetPayLinkFromIdResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a payment link by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->getPayLinkFromId(
    'paylinkId',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$paylinkId:** `string` — ID for payment link
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentLink->pushPayLinkFromId($payLinkId, $request) -> PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Send a payment link to the specified email addresses or phone numbers.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->pushPayLinkFromId(
    'payLinkId',
    PushPayLinkRequest::sms(new PushPayLinkRequestSms([])),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$payLinkId:** `string` — ID for the payment link.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `PushPayLinkRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentLink->refreshPayLinkFromId($payLinkId, $request) -> PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Refresh a payment link's content after an update.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->refreshPayLinkFromId(
    'payLinkId',
    new RefreshPayLinkFromIdRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$payLinkId:** `string` — ID for the payment link.
    
</dd>
</dl>

<dl>
<dd>

**$amountFixed:** `?bool` — Indicates whether customer can modify the payment amount. A value of `true` means the amount isn't modifiable, a value `false` means the payor can modify the amount to pay.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentLink->sendPayLinkFromId($payLinkId, $request) -> PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sends a payment link to the specified email addresses. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->sendPayLinkFromId(
    'payLinkId',
    new SendPayLinkFromIdRequest([
        'mail2' => 'jo@example.com; ceo@example.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$payLinkId:** `string` — ID for the payment link.
    
</dd>
</dl>

<dl>
<dd>

**$attachfile:** `?bool` — When `true`, attaches a PDF version of invoice to the email.
    
</dd>
</dl>

<dl>
<dd>

**$mail2:** `?string` — List of recipient email addresses. When there is more than one, separate them by a semicolon (;).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentLink->updatePayLinkFromId($payLinkId, $request) -> PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a payment link's details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->updatePayLinkFromId(
    '332-c277b704-1301',
    new PayLinkUpdateData([
        'notes' => new NoteElement([
            'enabled' => true,
            'header' => 'Additional Notes',
            'order' => 0,
            'placeholder' => 'Enter any additional notes here',
            'value' => '',
        ]),
        'paymentButton' => new LabelElement([
            'enabled' => true,
            'label' => 'Pay Now',
            'order' => 0,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$payLinkId:** `string` — ID for the payment link.
    
</dd>
</dl>

<dl>
<dd>

**$contactUs:** `?ContactElement` — ContactUs section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$logo:** `?Element` — Logo section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$messageBeforePaying:** `?LabelElement` — Message section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$notes:** `?NoteElement` — Notes section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?PageElement` — Page header section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$paymentButton:** `?LabelElement` — Payment button section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethods:** `?MethodElement` — Payment methods section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$review:** `?HeaderElement` — Review section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$settings:** `?PagelinkSetting` — Settings section of payment link page
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentLink->addPayLinkFromBillLotNumber($lotNumber, $request) -> PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generates a vendor payment link for a specific bill lot number. This allows you to pay all bills with the same lot number for a vendor with a single payment link.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentLink->addPayLinkFromBillLotNumber(
    'LOT-2024-001',
    new PayLinkDataOut([
        'entryPoint' => 'billing',
        'vendorNumber' => 'VENDOR-123',
        'mail2' => 'customer@example.com; billing@example.com',
        'amountFixed' => 'true',
        'body' => new PaymentPageRequestBody([
            'contactUs' => new ContactElement([
                'emailLabel' => 'Email',
                'enabled' => true,
                'header' => 'Contact Us',
                'order' => 0,
                'paymentIcons' => true,
                'phoneLabel' => 'Phone',
            ]),
            'logo' => new Element([
                'enabled' => true,
                'order' => 0,
            ]),
            'messageBeforePaying' => new LabelElement([
                'enabled' => true,
                'label' => 'Please review your payment details',
                'order' => 0,
            ]),
            'notes' => new NoteElement([
                'enabled' => true,
                'header' => 'Additional Notes',
                'order' => 0,
                'placeholder' => 'Enter any additional notes here',
                'value' => '',
            ]),
            'page' => new PageElement([
                'description' => 'Get paid securely',
                'enabled' => true,
                'header' => 'Payment Page',
                'order' => 0,
            ]),
            'paymentButton' => new LabelElement([
                'enabled' => true,
                'label' => 'Pay Now',
                'order' => 0,
            ]),
            'paymentMethods' => new MethodElement([
                'allMethodsChecked' => true,
                'enabled' => true,
                'header' => 'Payment Methods',
                'methods' => new MethodsList([
                    'amex' => true,
                    'applePay' => true,
                    'discover' => true,
                    'eCheck' => true,
                    'mastercard' => true,
                    'visa' => true,
                ]),
                'order' => 0,
            ]),
            'payor' => new PayorElement([
                'enabled' => true,
                'fields' => [
                    new PayorFields([
                        'display' => true,
                        'fixed' => true,
                        'identifier' => true,
                        'label' => 'Full Name',
                        'name' => 'fullName',
                        'order' => 0,
                        'required' => true,
                        'validation' => '^[a-zA-Z ]+$',
                        'value' => '',
                        'width' => 0,
                    ]),
                ],
                'header' => 'Payor Information',
                'order' => 0,
            ]),
            'review' => new HeaderElement([
                'enabled' => true,
                'header' => 'Review Payment',
                'order' => 0,
            ]),
            'settings' => new PagelinkSetting([
                'color' => '#000000',
                'language' => 'en',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$lotNumber:** `string` — Lot number of the bills to pay. All bills with this lot number will be included.
    
</dd>
</dl>

<dl>
<dd>

**$entryPoint:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$vendorNumber:** `string` — The vendor number for the vendor being paid with this payment link.
    
</dd>
</dl>

<dl>
<dd>

**$mail2:** `?string` — List of recipient email addresses. When there is more than one, separate them by a semicolon (;).
    
</dd>
</dl>

<dl>
<dd>

**$amountFixed:** `?string` — Indicates whether customer can modify the payment amount. A value of `true` means the amount isn't modifiable, a value `false` means the payor can modify the amount to pay.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `PaymentPageRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## PaymentMethodDomain
<details><summary><code>$client->paymentMethodDomain->addPaymentMethodDomain($request) -> AddPaymentMethodDomainApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add a payment method domain to an organization or paypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentMethodDomain->addPaymentMethodDomain(
    new AddPaymentMethodDomainRequest([
        'domainName' => 'checkout.example.com',
        'entityId' => 109,
        'entityType' => 'paypoint',
        'applePay' => new AddPaymentMethodDomainRequestApplePay([
            'isEnabled' => true,
        ]),
        'googlePay' => new AddPaymentMethodDomainRequestGooglePay([
            'isEnabled' => true,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$applePay:** `?AddPaymentMethodDomainRequestApplePay` — Apple Pay configuration information.
    
</dd>
</dl>

<dl>
<dd>

**$googlePay:** `?AddPaymentMethodDomainRequestGooglePay` — Google Pay configuration information.
    
</dd>
</dl>

<dl>
<dd>

**$domainName:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$entityId:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$entityType:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentMethodDomain->cascadePaymentMethodDomain($domainId) -> PaymentMethodDomainGeneralResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cascades a payment method domain to all child entities. All paypoints and suborganization under this parent will inherit this domain and its settings.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentMethodDomain->cascadePaymentMethodDomain(
    'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$domainId:** `string` — The payment method domain's ID in Payabli.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentMethodDomain->deletePaymentMethodDomain($domainId) -> DeletePaymentMethodDomainResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a payment method domain. You can't delete an inherited domain, you must delete a domain at the organization level.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentMethodDomain->deletePaymentMethodDomain(
    'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$domainId:** `string` — The payment method domain's ID in Payabli.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentMethodDomain->getPaymentMethodDomain($domainId) -> PaymentMethodDomainApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the details for a payment method domain.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentMethodDomain->getPaymentMethodDomain(
    'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$domainId:** `string` — The payment method domain's ID in Payabli.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentMethodDomain->listPaymentMethodDomains($request) -> ListPaymentMethodDomainsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of payment method domains that belong to a PSP, organization, or paypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentMethodDomain->listPaymentMethodDomains(
    new ListPaymentMethodDomainsRequest([
        'entityId' => 1147,
        'entityType' => 'paypoint',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entityId:** `?int` 

Identifier for the organization or paypoint. 
- For organization, provide the organization ID - For paypoint, provide the paypoint ID
    
</dd>
</dl>

<dl>
<dd>

**$entityType:** `?string` 

The type of entity. Valid values: 
  - organization
  - paypoint
  - psp
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — Number of records to skip. Defaults to `0`.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records for query response. Defaults to `20`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentMethodDomain->updatePaymentMethodDomain($domainId, $request) -> PaymentMethodDomainGeneralResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a payment method domain's configuration values.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentMethodDomain->updatePaymentMethodDomain(
    'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
    new UpdatePaymentMethodDomainRequest([
        'applePay' => new UpdatePaymentMethodDomainRequestWallet([
            'isEnabled' => false,
        ]),
        'googlePay' => new UpdatePaymentMethodDomainRequestWallet([
            'isEnabled' => false,
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$domainId:** `string` — The payment method domain's ID in Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$applePay:** `?UpdatePaymentMethodDomainRequestWallet` 
    
</dd>
</dl>

<dl>
<dd>

**$googlePay:** `?UpdatePaymentMethodDomainRequestWallet` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paymentMethodDomain->verifyPaymentMethodDomain($domainId) -> PaymentMethodDomainGeneralResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Verify a new payment method domain. If verification is successful, Apple Pay is automatically activated for the domain.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paymentMethodDomain->verifyPaymentMethodDomain(
    'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$domainId:** `string` — The payment method domain's ID in Payabli.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Paypoint
<details><summary><code>$client->paypoint->getBasicEntry($entry) -> GetBasicEntryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the basic details for a paypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paypoint->getBasicEntry(
    '8cfec329267',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paypoint->getBasicEntryById($idPaypoint) -> GetBasicEntryByIdResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the basic details for a paypoint by ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paypoint->getBasicEntryById(
    '198',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idPaypoint:** `string` — Paypoint ID. You can find this value by querying `/api/Query/paypoints/{orgId}`
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paypoint->getEntryConfig($entry, $request) -> GetEntryConfigResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the details for a single paypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paypoint->getEntryConfig(
    '8cfec329267',
    new GetEntryConfigRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$entrypages:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paypoint->getPage($entry, $subdomain) -> PayabliPages</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the details for single payment page for a paypoint. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paypoint->getPage(
    '8cfec329267',
    'pay-your-fees-1',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `string` — Payment page identifier. The subdomain value is the last portion of the payment page URL. For example, in`https://paypages-sandbox.payabli.com/513823dc10/pay-your-fees-1`, the subdomain is `pay-your-fees-1`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paypoint->removePage($entry, $subdomain) -> PayabliApiResponseGeneric2Part</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a payment page in a paypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paypoint->removePage(
    '8cfec329267',
    'pay-your-fees-1',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `string` — Payment page identifier. The subdomain value is the last portion of the payment page URL. For example, in`https://paypages-sandbox.payabli.com/513823dc10/pay-your-fees-1`, the subdomain is `pay-your-fees-1`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paypoint->saveLogo($entry, $request) -> PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a paypoint logo. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paypoint->saveLogo(
    '8cfec329267',
    new FileContent([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$request:** `FileContent` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paypoint->settingsPage($entry) -> SettingsQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves an paypoint's basic settings like custom fields, identifiers, and invoicing settings.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paypoint->settingsPage(
    '8cfec329267',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->paypoint->migrate($request) -> MigratePaypointResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Migrates a paypoint to a new parent organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->paypoint->migrate(
    new PaypointMoveRequest([
        'entryPoint' => '473abc123def',
        'newParentOrganizationId' => 123,
        'notificationRequest' => new NotificationRequest([
            'notificationUrl' => 'https://webhook-test.yoursie.com',
            'webHeaderParameters' => [
                new WebHeaderParameter([
                    'key' => 'testheader',
                    'value' => '1234567890',
                ]),
            ],
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `PaypointMoveRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Query
<details><summary><code>$client->query->listBatchDetails($entry, $request) -> QueryBatchesDetailResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of batches and their details, including settled and
unsettled transactions for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listBatchDetails(
    '8cfec329267',
    new ListBatchDetailsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted:**

- `settlementDate` (gt, ge, lt, le, eq, ne)
- `depositDate` (gt, ge, lt, le, eq, ne)
- `transId`  (ne, eq, ct, nct)
- `gatewayTransId`  (ne, eq, ct, nct)
- `method`   (in, nin, eq, ne)
- `settledAmount`  (gt, ge, lt, le, eq, ne)
- `operation`    (in, nin, eq, ne)
- `source`   (in, nin, eq, ne)
- `batchNumber`  (ct, nct, eq, ne)
- `payaccountLastfour`   (nct, ct)
- `payaccountType`   (ne, eq, in, nin)
- `customerFirstname`   (ct, nct, eq, ne)
- `customerLastname`    (ct, nct, eq, ne)
- `customerName`   (ct, nct)
- `customerId`  (eq, ne)
- `customerNumber`  (ct, nct, eq, ne)
- `customerCompanyname`    (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity`    (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity`    (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId`  (eq) *mandatory when entry=org*
- `isHold` (eq, ne)
- `paypointId`  (ne, eq)
- `paypointLegal`  (ne, eq, ct, nct)
- `paypointDba`  (ne, eq, ct, nct)
- `orgName`  (ne, eq, ct, nct)
- `batchId` (ct, nct, eq, neq)
- `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

**List of comparison accepted:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**List of parameters accepted:**

- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `settledAmount(gt)=20` returns all records with a `settledAmount` greater than 20.00.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listBatchDetailsOrg($orgId, $request) -> QueryResponseSettlements</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of batches and their details, including settled and unsettled transactions for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listBatchDetailsOrg(
    123,
    new ListBatchDetailsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted:**

- `settlementDate` (gt, ge, lt, le, eq, ne)
- `depositDate` (gt, ge, lt, le, eq, ne)
- `transId`  (ne, eq, ct, nct)
- `gatewayTransId`  (ne, eq, ct, nct)
- `method`   (in, nin, eq, ne)
- `settledAmount`  (gt, ge, lt, le, eq, ne)
- `operation`    (in, nin, eq, ne)
- `source`   (in, nin, eq, ne)
- `batchNumber`  (ct, nct, eq, ne)
- `payaccountLastfour`   (nct, ct)
- `payaccountType`   (ne, eq, in, nin)
- `customerFirstname`   (ct, nct, eq, ne)
- `customerLastname`    (ct, nct, eq, ne)
- `customerName`   (ct, nct)
- `customerId`  (eq, ne)
- `customerNumber`  (ct, nct, eq, ne)
- `customerCompanyname`    (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity`    (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity`    (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId`  (eq) *mandatory when entry=org*
- `isHold` (eq, ne)
- `paypointId`  (ne, eq)
- `paypointLegal`  (ne, eq, ct, nct)
- `paypointDba`  (ne, eq, ct, nct)
- `orgName`  (ne, eq, ct, nct)
- `batchId` (ct, nct, eq, neq)
- `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

**List of comparison accepted:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**List of parameters accepted:**

- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `settledAmount(gt)=20` returns all records with a `settledAmount` greater than 20.00.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listBatches($entry, $request) -> QueryBatchesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of batches for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listBatches(
    '8cfec329267',
    new ListBatchesRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted:**

- `batchDate` (gt, ge, lt, le, eq, ne)
- `batchNumber` (ne, eq)
- `method` (in, nin, eq, ne)
- `connectorName` (ne, eq, ct, nct)
- `batchAmount` (gt, ge, lt, le, eq, ne)
- `feeBatchAmount` (gt, ge, lt, le, eq, ne)
- `netBatchAmount` (gt, ge, lt, le, eq, ne)
- `releaseAmount` (gt, ge, lt, le, eq, ne)
- `heldAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `paypointId` (ne, eq)
- `externalPaypointID` (ct, nct, eq, ne)
- `expectedDepositDate` (gt, ge, lt, le, eq, ne)
- `depositDate` (gt, ge, lt, le, eq, ne)
- `batchRecords` (gt, ge, lt, le, eq, ne)
- `transferId` (ne, eq)
- `transferDate` (gt, ge, lt, le, eq, ne)
- `grossAmount` (gt, ge, lt, le, eq, ne)
- `chargeBackAmount` (gt, ge, lt, le, eq, ne)
- `returnedAmount` (gt, ge, lt, le, eq, ne)
- `billingFeeAmount` (gt, ge, lt, le, eq, ne)
- `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)
- `netFundedAmount` (gt, ge, lt, le, eq, ne)
- `adjustmentAmount` (gt, ge, lt, le, eq, ne)
- `processor` (ne, eq, ct, nct)
- `transferStatus` (ne, eq, in, nin)

**List of parameters accepted:**
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `batchAmount(gt)=20` returns all records with a `batchAmount` greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listBatchesOrg($orgId, $request) -> QueryBatchesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of batches for an org. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listBatchesOrg(
    123,
    new ListBatchesOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted:**

- `batchDate` (gt, ge, lt, le, eq, ne)
- `batchNumber` (ne, eq)
- `method` (in, nin, eq, ne)
- `connectorName` (ne, eq, ct, nct)
- `batchAmount` (gt, ge, lt, le, eq, ne)
- `feeBatchAmount` (gt, ge, lt, le, eq, ne)
- `netBatchAmount` (gt, ge, lt, le, eq, ne)
- `releaseAmount` (gt, ge, lt, le, eq, ne)
- `heldAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `paypointId` (ne, eq)
- `externalPaypointID` (ct, nct, eq, ne)
- `expectedDepositDate` (gt, ge, lt, le, eq, ne)
- `depositDate` (gt, ge, lt, le, eq, ne)
- `batchRecords` (gt, ge, lt, le, eq, ne)
- `transferId` (ne, eq)
- `transferDate` (gt, ge, lt, le, eq, ne)
- `grossAmount` (gt, ge, lt, le, eq, ne)
- `chargeBackAmount` (gt, ge, lt, le, eq, ne)
- `returnedAmount` (gt, ge, lt, le, eq, ne)
- `billingFeeAmount` (gt, ge, lt, le, eq, ne)
- `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)
- `netFundedAmount` (gt, ge, lt, le, eq, ne)
- `adjustmentAmount` (gt, ge, lt, le, eq, ne)
- `processor` (ne, eq, ct, nct)
- `transferStatus` (ne, eq, in, nin)

**List of parameters accepted:**
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `batchAmount(gt)=20` returns all records with a `batchAmount` greater than 20.00      
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listBatchesOut($entry, $request) -> QueryBatchesOutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of MoneyOut batches for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listBatchesOut(
    '8cfec329267',
    new ListBatchesOutRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted**:

- `batchDate` (gt, ge, lt, le, eq, ne)
- `batchNumber` (ne, eq)
- `batchAmount` (gt, ge, lt, le, eq, ne)
- `parentOrgId` (ne, eq, nin, in)
- `status` (in, nin, eq, ne)
- `orgId` (eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `paypointId` (ne, eq)
- `externalPaypointID` (ct, nct, eq, ne)
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listBatchesOutOrg($orgId, $request) -> QueryBatchesOutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of MoneyOut batches for an org. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listBatchesOutOrg(
    123,
    new ListBatchesOutOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted**:

- `batchDate` (gt, ge, lt, le, eq, ne)
- `batchNumber` (ne, eq)
- `batchAmount` (gt, ge, lt, le, eq, ne)
- `parentOrgId` (ne, eq, nin, in)
- `status` (in, nin, eq, ne)
- `orgId` (eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `paypointId` (ne, eq)
- `externalPaypointID` (ct, nct, eq, ne)
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listChargebacks($entry, $request) -> QueryChargebacksResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of chargebacks and returned transactions for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listChargebacks(
    '8cfec329267',
    new ListChargebacksRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**List of field names accepted:**
- `chargebackDate` (gt, ge, lt, le, eq, ne)
- `transId`  (ne, eq, ct, nct)
- `method`   (in, nin, eq, ne)
- `netAmount`  (gt, ge, lt, le, eq, ne)
- `reasonCode`   (in, nin, eq, ne)
- `reason`  (ct, nct, eq, ne)
- `replyDate` (gt, ge, lt, le, eq, ne)
- `caseNumber`  (ct, nct, eq, ne)
- `status`   (in, nin, eq, ne)
- `accountType`   (in, nin, eq, ne)
- `payaccountLastfour`   (nct, ct)
- `payaccountType`   (ne, eq, in, nin)
- `customerFirstname`   (ct, nct, eq, ne)
- `customerLastname`    (ct, nct, eq, ne)
- `customerName`   (ct, nct)
- `customerId`  (eq, ne)
- `customerNumber`  (ct, nct, eq, ne)
- `customerCompanyname`    (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity`    (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity`    (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId`  (eq) *mandatory when entry=org*
- `paypointId`  (ne, eq)
- `paypointLegal`  (ne, eq, ct, nct)
- `paypointDba`  (ne, eq, ct, nct)
- `orgName`  (ne, eq, ct, nct)
- `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

**List of comparison accepted - enclosed between parentheses:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**List of parameters accepted:**
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listChargebacksOrg($orgId, $request) -> QueryChargebacksResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of chargebacks and returned transactions for an org. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listChargebacksOrg(
    123,
    new ListChargebacksOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info> See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**List of field names accepted:**

- `chargebackDate` (gt, ge, lt, le, eq, ne)
- `transId`  (ne, eq, ct, nct)
- `method`   (in, nin, eq, ne)
- `netAmount`  (gt, ge, lt, le, eq, ne)
- `reasonCode`   (in, nin, eq, ne)
- `reason`  (ct, nct, eq, ne)
- `replyDate` (gt, ge, lt, le, eq, ne)
- `caseNumber`  (ct, nct, eq, ne)
- `status`   (in, nin, eq, ne)
- `accountType`   (in, nin, eq, ne)
- `payaccountLastfour`   (nct, ct)
- `payaccountType`   (ne, eq, in, nin)
- `customerFirstname`   (ct, nct, eq, ne)
- `customerLastname`    (ct, nct, eq, ne)
- `customerName`   (ct, nct)
- `customerId`  (eq, ne)
- `customerNumber`  (ct, nct, eq, ne)
- `customerCompanyname`    (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity`    (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity`    (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId`  (eq) *mandatory when entry=org*
- `paypointId`  (ne, eq)
- `paypointLegal`  (ne, eq, ct, nct)
- `paypointDba`  (ne, eq, ct, nct)
- `orgName`  (ne, eq, ct, nct)
- `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

**List of comparison accepted - enclosed between parentheses:**

- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**List of parameters accepted:**
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listCustomers($entry, $request) -> QueryCustomerResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of customers for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listCustomers(
    '8cfec329267',
    new ListCustomersRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more details.

**List of Accepted Field Names:**

- `createdDate` (gt, ge, lt, le, eq, ne)
- `customernumber` (ne, eq, ct, nct)
- `firstname` (ne, eq, ct, nct)
- `lastname` (ne, eq, ct, nct)
- `name` (ct, nct)
- `address` (ne, eq, ct, nct)
- `city` (ne, eq, ct, nct)
- `country` (ne, eq, ct, nct)
- `zip` (ne, eq, ct, nct)
- `state` (ne, eq, ct, nct)
- `shippingaddress` (ne, eq, ct, nct)
- `shippingcity` (ne, eq, ct, nct)
- `shippingcountry` (ne, eq, ct, nct)
- `shippingzip` (ne, eq, ct, nct)
- `shippingstate` (ne, eq, ct, nct)
- `phone` (ne, eq, ct, nct)
- `email` (ne, eq, ct, nct)
- `company` (ne, eq, ct, nct)
- `username` (ne, eq, ct, nct)
- `balance` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name
- `orgId` (eq) *mandatory when entry=org*
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

**List of Accepted Comparisons:**

- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**Accepted Parameters:**
- `limitRecord`: Max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: Initial record in query

**Example Usage:**
`balance(gt)=20` will return all records with a balance greater than 20.00.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listCustomersOrg($orgId, $request) -> QueryCustomerResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of customers for an org. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listCustomersOrg(
    123,
    new ListCustomersOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more details.

**List of Accepted Field Names:**

- `createdDate` (gt, ge, lt, le, eq, ne)
- `customernumber` (ne, eq, ct, nct)
- `firstname` (ne, eq, ct, nct)
- `lastname` (ne, eq, ct, nct)
- `name` (ct, nct)
- `address` (ne, eq, ct, nct)
- `city` (ne, eq, ct, nct)
- `country` (ne, eq, ct, nct)
- `zip` (ne, eq, ct, nct)
- `state` (ne, eq, ct, nct)
- `shippingaddress` (ne, eq, ct, nct)
- `shippingcity` (ne, eq, ct, nct)
- `shippingcountry` (ne, eq, ct, nct)
- `shippingzip` (ne, eq, ct, nct)
- `shippingstate` (ne, eq, ct, nct)
- `phone` (ne, eq, ct, nct)
- `email` (ne, eq, ct, nct)
- `company` (ne, eq, ct, nct)
- `username` (ne, eq, ct, nct)
- `balance` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name
- `orgId` (eq) *mandatory when entry=org*
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

**List of Accepted Comparisons:**

- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**Accepted Parameters:**
- `limitRecord`: Max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: Initial record in query

**Example Usage:**
`balance(gt)=20` will return all records with a balance greater than 20.00.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listNotificationReports($entry, $request) -> QueryResponseNotificationReports</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of all reports generated in the last 60 days for a single entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listNotificationReports(
    '8cfec329267',
    new ListNotificationReportsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `reportName` (ct, nct, eq, ne)
- `createdAt` (gt, ge, lt, le, eq, ne)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: reportName(ct)=tr  return all records containing the string "tr"
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listNotificationReportsOrg($orgId, $request) -> QueryResponseNotificationReports</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of all reports generated in the last 60 days for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listNotificationReportsOrg(
    123,
    new ListNotificationReportsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query <Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `reportName` (ct, nct, eq, ne)
- `createdAt` (gt, ge, lt, le, eq, ne)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: reportName(ct)=tr  return all records containing the string "tr"
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listNotifications($entry, $request) -> QueryResponseNotifications</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of notifications for an entrypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listNotifications(
    '8cfec329267',
    new ListNotificationsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `frequency` (in, nin,ne, eq)
- `method` (in, nin, eq, ne)
- `event` (in, nin, eq, ne)
- `target` (ct, nct, eq, ne)
- `status` (eq, ne)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: totalAmount(gt)=20  return all records with totalAmount greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listNotificationsOrg($orgId, $request) -> QueryResponseNotifications</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Return a list of notifications for an organization. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listNotificationsOrg(
    123,
    new ListNotificationsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `frequency` (in, nin,ne, eq)
- `method` (in, nin, eq, ne)
- `event` (in, nin, eq, ne)
- `target` (ct, nct, eq, ne)
- `status` (eq, ne)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: totalAmount(gt)=20  return all records with totalAmount greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listOrganizations($orgId, $request) -> ListOrganizationsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of an organization's suborganizations and their full details such as orgId, users, and settings. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listOrganizations(
    123,
    new ListOrganizationsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
**List of field names accepted:**

- `createdAt` (gt, ge, lt, le, eq, ne)
- `startDate` (gt, ge, lt, le, eq, ne)
- `dbaname`  (ct, nct)
- `legalname`  (ct, nct)
- `ein`  (ct, nct)
- `address`  (ct, nct)
- `city`  (ct, nct)
- `state`  (ct, nct)
- `phone`  (ct, nct)
- `mcc`  (ct, nct)
- `owntype`  (ct, nct)
- `ownerName`  (ct, nct)
- `contactName`  (ct, nct)
- `orgParentname`  (ct, nct)
- `boardingId` (eq, ne) 
- `entryName`  (ct, nct)

**List of comparison accepted - enclosed between parentheses:**

- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array
- `nin` => not inside array

**List of parameters accepted:**

- `limitRecord` : max number of records for query (default="20", "0" or negative value for all)
- `fromRecord` : initial record in query

Example: `dbaname(ct)=hoa` returns all records with a `dbaname` containing "hoa"
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listPayout($entry, $request) -> QueryPayoutTransaction</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of money out transactions (payouts) for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listPayout(
    '8cfec329267',
    new ListPayoutRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

List of field names accepted:

  - `status` (in, nin, eq, ne)
  - `transactionDate` (gt, ge, lt, le, eq, ne)
  - `billNumber` (ct, nct)
  - `vendorNumber` (ct, nct, eq, ne)
  - `vendorName` (ct, nct, eq, ne)
  - `paymentMethod` (ct, nct, eq, ne, in, nin)
  - `paymentId` (ct, nct, eq, ne)
  - `parentOrgId` (ne, eq, nin, in)
  - `batchNumber` (ct, nct, eq, ne)
  - `totalAmount` (gt, ge, lt, le, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `accountId` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct)
  - `externalPaypointID` (ct, nct, eq, ne)
  - `paypointId` (eq, ne)
  - `vendorId` (eq, ne)
  - `vendorEIN` (ct, nct, eq, ne)
  - `vendorPhone` (ct, nct, eq, ne)
  - `vendorEmail` (ct, nct, eq, ne)
  - `vendorAddress` (ct, nct, eq, ne)
  - `vendorCity` (ct, nct, eq, ne)
  - `vendorState` (ct, nct, eq, ne)
  - `vendorCountry` (ct, nct, eq, ne)
  - `vendorZip` (ct, nct, eq, ne)
  - `vendorMCC` (ct, nct, eq, ne)
  - `vendorLocationCode` (ct, nct, eq, ne)
  - `vendorCustomField1` (ct, nct, eq, ne)
  - `vendorCustomField2` (ct, nct, eq, ne)
  - `comments` (ct, nct)
  - `payaccountCurrency` (ne, eq, in, nin)
  - `remitAddress` (ct, nct)
  - `source` (ct, nct, eq, ne)
  - `updatedOn` (gt, ge, lt, le, eq, ne)
  - `feeAmount` (gt, ge, lt, le, eq, ne)
  - `lotNumber` (ct, nct)
  - `customerVendorAccount` (ct, nct, eq, ne)
  - `batchId` (eq, ne)
  - `AchTraceNumber` (eq, ne)
  - `payoutProgram`(eq, ne) the options are `managed` or `odp`. For example, `payoutProgram(eq)=managed` returns all records with a `payoutProgram` equal to `managed`. 

  List of comparison accepted - enclosed between parentheses:
  - eq or empty => equal
  - gt => greater than
  - ge => greater or equal
  - lt => less than
  - le => less or equal
  - ne => not equal
  - ct => contains
  - nct => not contains
  - in => inside array separated by \"|\"
  - nin => not inside array separated by \"|\"

  List of parameters accepted:

  - limitRecord : max number of records for query (default=\"20\", \"0\" or negative value for all)
  - fromRecord : initial record in query
  - sortBy : indicate field name and direction to sort the results

  Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00

  Example: `sortBy=desc(netamount)` returns all records sorted by `netAmount` descending
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listPayoutOrg($orgId, $request) -> QueryPayoutTransaction</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of money out transactions (payouts) for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listPayoutOrg(
    123,
    new ListPayoutOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
List of field names accepted:
  
  - `status` (in, nin, eq, ne)
  - `transactionDate` (gt, ge, lt, le, eq, ne)
  - `billNumber` (ct, nct)
  - `vendorNumber` (ct, nct, eq, ne)
  - `vendorName` (ct, nct, eq, ne)
  - `parentOrgId` (ne, eq, nin, in)
  - `paymentMethod` (ct, nct, eq, ne, in, nin)
  - `paymentId` (ct, nct, eq, ne)
  - `batchNumber` (ct, nct, eq, ne)
  - `totalAmount` (gt, ge, lt, le, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `accountId` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct)
  - `externalPaypointID` (ct, nct, eq, ne)
  - `paypointId` (eq, ne)
  - `vendorId` (eq, ne)
  - `vendorEIN` (ct, nct, eq, ne)
  - `vendorPhone` (ct, nct, eq, ne)
  - `vendorEmail` (ct, nct, eq, ne)
  - `vendorAddress` (ct, nct, eq, ne)
  - `vendorCity` (ct, nct, eq, ne)
  - `vendorState` (ct, nct, eq, ne)
  - `vendorCountry` (ct, nct, eq, ne)
  - `vendorZip` (ct, nct, eq, ne)
  - `vendorMCC` (ct, nct, eq, ne)
  - `vendorLocationCode` (ct, nct, eq, ne)
  - `vendorCustomField1` (ct, nct, eq, ne)
  - `vendorCustomField2` (ct, nct, eq, ne)
  - `comments` (ct, nct)
  - `payaccountCurrency` (ne, eq, in, nin)
  - `remitAddress` (ct, nct)
  - `source` (ct, nct, eq, ne)
  - `updatedOn` (gt, ge, lt, le, eq, ne)
  - `feeAmount` (gt, ge, lt, le, eq, ne)
  - `lotNumber` (ct, nct)
  - `customerVendorAccount` (ct, nct, eq, ne)
  - `batchId` (eq, ne)
  - `AchTraceNumber` (eq, ne)
  - `payoutProgram`(eq, ne) the options are `managed` or `odp`. For example, `payoutProgram(eq)=managed` returns all records with a `payoutProgram` equal to `managed`.

  List of comparison accepted - enclosed between parentheses:
  - eq or empty => equal
  - gt => greater than
  - ge => greater or equal
  - lt => less than
  - le => less or equal
  - ne => not equal
  - ct => contains
  - nct => not contains
  - in => inside array separated by \"|\"
  - nin => not inside array separated by \"|\"

  List of parameters accepted:

  - limitRecord : max number of records for query (default=\"20\", \"0\" or negative value for all)
  - fromRecord : initial record in query
  - sortBy : indicate field name and direction to sort the results

  Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00

  Example: `sortBy=desc(netamount)` returns all records sorted by `netAmount` descending
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listPaypoints($orgId, $request) -> QueryEntrypointResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of paypoints in an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listPaypoints(
    123,
    new ListPaypointsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
**List of field names accepted:**

- `createdAt` (gt, ge, lt, le, eq, ne)
- `lastModified` (gt, ge, lt, le, eq, ne)
- `startDate` (gt, ge, lt, le, eq, ne)
- `dbaname`  (ct, nct)
- `status` (eq, ne)
- `legalname`  (ct, nct)
- `externalPaypointID` (ct, nct)
- `ein`  (ct, nct)
- `address`  (ct, nct)
- `city`  (ct, nct)
- `state`  (ct, nct)
- `phone`  (ct, nct)
- `mcc`  (ct, nct)
- `owntype`  (ct, nct)
- `ownerName`  (ct, nct)
- `contactName`  (ct, nct)
- `paypointId` (eq, ne)
- `orgParentname`  (ct, nct, in, nin)
- `boardingId` (eq, ne) 
- `entryName`  (ct, nct)
- `externalOrgID` (ct, nct)

**List of comparison accepted - enclosed between parentheses:**

- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array
- `nin` => not inside array

**List of parameters accepted:**

- `limitRecord` : max number of records for query (default="20", "0" or negative value for all)
- `fromRecord` : initial record in query

Example: `dbaname(ct)=hoa` returns all records with a `dbaname` containing "hoa"
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listSettlements($entry, $request) -> QueryResponseSettlements</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of settled transactions for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listSettlements(
    '8cfec329267',
    new ListSettlementsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted:**

- `settlementDate` (gt, ge, lt, le, eq, ne)
- `depositDate` (gt, ge, lt, le, eq, ne)
- `transId`  (ne, eq, ct, nct)
- `gatewayTransId`  (ne, eq, ct, nct)
- `method`   (in, nin, eq, ne)
- `settledAmount`  (gt, ge, lt, le, eq, ne)
- `operation`    (in, nin, eq, ne)
- `source`   (in, nin, eq, ne)
- `batchNumber`  (ct, nct, eq, ne)
- `payaccountLastfour`   (nct, ct)
- `payaccountType`   (ne, eq, in, nin)
- `customerFirstname`   (ct, nct, eq, ne)
- `customerLastname`    (ct, nct, eq, ne)
- `customerName`   (ct, nct)
- `customerId`  (eq, ne)
- `customerNumber`  (ct, nct, eq, ne)
- `customerCompanyname`    (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity`    (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity`    (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId`  (eq) *mandatory when entry=org*
- `isHold` (eq, ne)
- `paypointId`  (ne, eq)
- `paypointLegal`  (ne, eq, ct, nct)
- `paypointDba`  (ne, eq, ct, nct)
- `orgName`  (ne, eq, ct, nct)
- `batchId` (ct, nct, eq, neq)
- `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

**List of comparison accepted:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**List of parameters accepted:**

- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `settledAmount(gt)=20` returns all records with a `settledAmount` greater than 20.00.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listSettlementsOrg($orgId, $request) -> QueryResponseSettlements</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of settled transactions for an organization. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listSettlementsOrg(
    123,
    new ListSettlementsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted:**

- `settlementDate` (gt, ge, lt, le, eq, ne)
- `depositDate` (gt, ge, lt, le, eq, ne)
- `transId`  (ne, eq, ct, nct)
- `gatewayTransId`  (ne, eq, ct, nct)
- `method`   (in, nin, eq, ne)
- `settledAmount`  (gt, ge, lt, le, eq, ne)
- `operation`    (in, nin, eq, ne)
- `source`   (in, nin, eq, ne)
- `batchNumber`  (ct, nct, eq, ne)
- `payaccountLastfour`   (nct, ct)
- `payaccountType`   (ne, eq, in, nin)
- `customerFirstname`   (ct, nct, eq, ne)
- `customerLastname`    (ct, nct, eq, ne)
- `customerName`   (ct, nct)
- `customerId`  (eq, ne)
- `customerNumber`  (ct, nct, eq, ne)
- `customerCompanyname`    (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity`    (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity`    (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId`  (eq) *mandatory when entry=org*
- `isHold` (eq, ne)
- `paypointId`  (ne, eq)
- `paypointLegal`  (ne, eq, ct, nct)
- `paypointDba`  (ne, eq, ct, nct)
- `orgName`  (ne, eq, ct, nct)
- `batchId` (ct, nct, eq, neq)
- `additional-xxx`  (ne, eq, ct, nct) where xxx is the additional field name

**List of comparison accepted:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**List of parameters accepted:**

- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `settledAmount(gt)=20` returns all records with a `settledAmount` greater than 20.00.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listSubscriptions($entry, $request) -> QuerySubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of subscriptions for a single paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listSubscriptions(
    '8cfec329267',
    new ListSubscriptionsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.
      
**List of field names accepted:**

- `startDate` (gt, ge, lt, le, eq, ne)
- `endDate` (gt, ge, lt, le, eq, ne)
- `nextDate` (gt, ge, lt, le, eq, ne)
- `frequency` (in, nin, ne, eq)
- `method` (in, nin, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `feeAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `untilcancelled` (eq, ne)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `payaccountCurrency` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq)
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `externalPaypointId` (ct, nct, ne, eq)
- `subId` (eq, ne)
- `orderDescription` (ct, nct)
- `cycles` (eq, ne, gt, ge, lt, le)
- `leftcycles` (eq, ne, gt, ge, lt, le)
- `createdAt` (eq, ne, gt, ge, lt, le)
- `updatedOn` (eq, ne, gt, ge, lt, le)
- `invoiceNumber` (ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name  

**List of comparison operators accepted:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array
- `nin` => not inside array
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listSubscriptionsOrg($orgId, $request) -> QuerySubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of subscriptions for a single org. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listSubscriptionsOrg(
    123,
    new ListSubscriptionsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.
      
**List of field names accepted:**

- `startDate` (gt, ge, lt, le, eq, ne)
- `endDate` (gt, ge, lt, le, eq, ne)
- `nextDate` (gt, ge, lt, le, eq, ne)
- `frequency` (in, nin, ne, eq)
- `method` (in, nin, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `feeAmount` (gt, ge, lt, le, eq, ne)
- `status` (in, nin, eq, ne)
- `untilcancelled` (eq, ne)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `payaccountCurrency` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `orgId` (eq)
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `externalPaypointId` (ct, nct, ne, eq)
- `subId` (eq, ne)
- `orderDescription` (ct, nct)
- `cycles` (eq, ne, gt, ge, lt, le)
- `leftcycles` (eq, ne, gt, ge, lt, le)
- `createdAt` (eq, ne, gt, ge, lt, le)
- `updatedOn` (eq, ne, gt, ge, lt, le)
- `invoiceNumber` (ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name  

**List of comparison operators accepted:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array
- `nin` => not inside array      
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listTransactions($entry, $request) -> QueryResponseTransactions</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of transactions for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
By default, this endpoint returns only transactions from the last 60 days. To query transactions outside of this period, include `transactionDate` filters.
For example, this request parameters filter for transactions between April 01, 2024 and April 09, 2024. 
``` curl --request GET \
  --url https://sandbox.payabli.com/api/Query/transactions/org/1?limitRecord=20&fromRecord=0&transactionDate(ge)=2024-04-01T00:00:00&transactionDate(le)=2024-04-09T23:59:59\
  --header 'requestToken: <api-key>'

  ```
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listTransactions(
    '8cfec329267',
    new ListTransactionsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted:**

- `transactionDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct, in, nin)
- `gatewayTransId` (ne, eq, ct, nct)
- `orderId` (ne, eq)
- `scheduleId` (ne, eq)
- `returnId` (ne, eq)
- `refundId` (ne, eq)
- `idTrans` (ne, eq)
- `orgId` (ne, eq)
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `externalPaypointId` (ct, nct, eq, ne)
- `method` (in, nin, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `feeAmount` (gt, ge, lt, le, eq, ne)
- `operation` (in, nin, eq, ne)
- `source` (in, nin, eq, ne, ct, nct)
- `status` (in, nin, eq, ne)
- `settlementStatus` (in, nin, eq, ne)
- `batchNumber` (nct, ct)
- `invoiceNumber` (ct, nct)
- `ipAddress` (eq, ne)
- `authCode` (ct, nct)
- `orderDescription` (ct, nct)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `payaccountCurrency` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `deviceId` (ct, nct, in, nin, eq, ne)
- `AchSecCode` ( ct, nct, in, nin, eq, ne)
- `AchHolderType` (ct, nct, in, nin, eq, and ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name related to customer data
- 'invoiceAdditional-xxx' (ne, eq, ct, nct) where xxx is the additional field name related to invoice data

**List of comparison operators accepted:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array
- `nin` => not inside array      
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listTransactionsOrg($orgId, $request) -> QueryResponseTransactions</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>


Retrieve a list of transactions for an organization. Use filters to
limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.


By default, this endpoint returns only transactions from the last 60 days. To query transactions outside of this period, include `transactionDate` filters.

For example, this request parameters filter for transactions between April 01, 2024 and April 09, 2024. 

```
curl --request GET \
  --url https://sandbox.payabli.com/api/Query/transactions/org/1?limitRecord=20&fromRecord=0&transactionDate(ge)=2024-04-01T00:00:00&transactionDate(le)=2024-04-09T23:59:59\
  --header 'requestToken: <api-key>'

  ```
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listTransactionsOrg(
    123,
    new ListTransactionsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**List of field names accepted:**

- `transactionDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct, in, nin)
- `gatewayTransId` (ne, eq, ct, nct)
- `orderId` (ne, eq)
- `scheduleId` (ne, eq)
- `returnId` (ne, eq)
- `refundId` (ne, eq)
- `idTrans` (ne, eq)
- `orgId` (ne, eq)
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)
- `externalPaypointId` (ct, nct, eq, ne)
- `method` (in, nin, eq, ne)
- `totalAmount` (gt, ge, lt, le, eq, ne)
- `netAmount` (gt, ge, lt, le, eq, ne)
- `feeAmount` (gt, ge, lt, le, eq, ne)
- `operation` (in, nin, eq, ne)
- `source` (in, nin, eq, ne, ct, nct)
- `status` (in, nin, eq, ne)
- `settlementStatus` (in, nin, eq, ne)
- `batchNumber` (nct, ct)
- `invoiceNumber` (ct, nct)
- `authCode` (ct, nct)
- `orderDescription` (ct, nct)
- `payaccountLastfour` (nct, ct)
- `payaccountType` (ne, eq, in, nin)
- `payaccountCurrency` (ne, eq, in, nin)
- `customerFirstname` (ct, nct, eq, ne)
- `customerLastname` (ct, nct, eq, ne)
- `customerName` (ct, nct)
- `customerId` (eq, ne)
- `customerNumber` (ct, nct, eq, ne)
- `customerCompanyname` (ct, nct, eq, ne)
- `customerAddress` (ct, nct, eq, ne)
- `customerCity` (ct, nct, eq, ne)
- `customerZip` (ct, nct, eq, ne)
- `customerState` (ct, nct, eq, ne)
- `customerCountry` (ct, nct, eq, ne)
- `customerPhone` (ct, nct, eq, ne)
- `customerEmail` (ct, nct, eq, ne)
- `customerShippingAddress` (ct, nct, eq, ne)
- `customerShippingCity` (ct, nct, eq, ne)
- `customerShippingZip` (ct, nct, eq, ne)
- `customerShippingState` (ct, nct, eq, ne)
- `customerShippingCountry` (ct, nct, eq, ne)
- `deviceId` (ct, nct, in, nin, eq, ne)
- `AchSecCode` ( ct, nct, in, nin, eq, ne)
- `AchHolderType`` (ct, nct, in, nin, eq, and ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name related to customer data
- 'invoiceAdditional-xxx' (ne, eq, ct, nct) where xxx is the additional field name related to invoice data

**List of comparison operators accepted:**
- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array
- `nin` => not inside array
  
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listTransferDetails($entry, $transferId, $request) -> QueryTransferDetailResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of transfer details records for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listTransferDetails(
    '47862acd',
    123456,
    new ListTransfersPaypointRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$transferId:** `int` — The numeric identifier for the transfer, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter
the query. 

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions
Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference)
for more information.


**List of field names accepted:**

  - `grossAmount` (gt, ge, lt, le, eq, ne)
  - `chargeBackAmount` (gt, ge, lt, le, eq, ne)
  - `returnedAmount` (gt, ge, lt, le, eq, ne)
  - `billingFeeAmount` (gt, ge, lt, le, eq, ne)
  - `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)
  - `netFundedAmount` (gt, ge, lt, le, eq, ne)
  - `adjustmentAmount` (gt, ge, lt, le, eq, ne)
  - `splitFundingAmount` (gt, ge, lt, le, eq, ne)
  - `operation` (in, nin, eq, ne)
  - `transactionId` (eq, ne, in, nin)
  - `category` (eq, ne, ct, nct)
  - `type` (eq, ne, in, nin)
  - `method` (eq, ne, in, nin)
  
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listTransfers($entry, $request) -> TransferQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of transfers for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listTransfers(
    '47862acd',
    new ListTransfersRequest([
        'fromRecord' => 0,
        'limitRecord' => 20,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query. See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
List of field names accepted:

  - `transferDate` (gt, ge, lt, le, eq, ne)
  - `grossAmount` (gt, ge, lt, le, eq, ne)
  - `chargeBackAmount` (gt, ge, lt, le, eq, ne)
  - `returnedAmount` (gt, ge, lt, le, eq, ne)
  - `billingFeeAmount` (gt, ge, lt, le, eq, ne)
  - `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)
  - `netFundedAmount` (gt, ge, lt, le, eq, ne)
  - `adjustmentAmount` (gt, ge, lt, le, eq, ne)
  - `processor` (ne, eq, ct, nct)
  - `transferStatus` (ne, eq, in, nin)
  - `batchNumber` (ne, eq, ct, nct)
  - `batchId` (ne, eq, in, nin)
  - `transferId` (in, nin, eq, ne)
  - `bankAccountNumber` (ct, nct, ne, eq)
  - `bankRoutingNumber` (ct, nct, ne, eq)
  - `batchCurrency` (in, nin, ne, eq)
  - `parentOrgName` (ct, nct, ne, eq)
  - `parentOrgId` (ct, nct, ne, eq)
  - `externalPaypointID` (ct, nct)
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listTransfersOrg($orgId, $request) -> TransferQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of transfers for an org. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listTransfersOrg(
    123,
    new ListTransfersRequestOrg([
        'fromRecord' => 0,
        'limitRecord' => 20,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query. See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
List of field names accepted:

  - `transferDate` (gt, ge, lt, le, eq, ne)
  - `grossAmount` (gt, ge, lt, le, eq, ne)
  - `chargeBackAmount` (gt, ge, lt, le, eq, ne)
  - `returnedAmount` (gt, ge, lt, le, eq, ne)
  - `billingFeeAmount` (gt, ge, lt, le, eq, ne)
  - `thirdPartyPaidAmount` (gt, ge, lt, le, eq, ne)
  - `netFundedAmount` (gt, ge, lt, le, eq, ne)
  - `adjustmentAmount` (gt, ge, lt, le, eq, ne)
  - `processor` (ne, eq, ct, nct)
  - `transferStatus` (ne, eq, in, nin)
  - `batchNumber` (ne, eq, ct, nct)
  - `batchId` (ne, eq, in, nin)
  - `transferId` (in, nin, eq, ne)
  - `bankAccountNumber` (ct, nct, ne, eq)
  - `bankRoutingNumber` (ct, nct, ne, eq)
  - `batchCurrency` (in, nin, ne, eq)
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listUsersOrg($orgId, $request) -> QueryUserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of users for an org. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listUsersOrg(
    123,
    new ListUsersOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**List of field names accepted:**

- `createdDate` (gt, ge, lt, le, eq, ne)
- `name`  (ne, eq, ct, nct)
- `email`  (ne, eq, ct, nct)
- `status`   (in, nin, eq, ne)
- `role.xxx`  (ne, eq, ct, nct) where xxx is the role field: `roleLabel` or `roleValue`

**List of comparison accepted - enclosed between parentheses:**

- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**List of parameters accepted:**
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `name(ct)=john`  return all records with name containing 'john'.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listUsersPaypoint($entry, $request) -> QueryUserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of users for a paypoint. Use filters to limit results.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listUsersPaypoint(
    '8cfec329267',
    new ListUsersPaypointRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**List of field names accepted:**

- `createdDate` (gt, ge, lt, le, eq, ne)
- `name`  (ne, eq, ct, nct)
- `email`  (ne, eq, ct, nct)
- `status`   (in, nin, eq, ne)
- `role.xxx`  (ne, eq, ct, nct) where xxx is the role field: `roleLabel` or `roleValue`

**List of comparison accepted - enclosed between parentheses:**

- `eq` or empty => equal
- `gt` => greater than
- `ge` => greater or equal
- `lt` => less than
- `le` => less or equal
- `ne` => not equal
- `ct` => contains
- `nct` => not contains
- `in` => inside array separated by "|"
- `nin` => not inside array separated by "|"

**List of parameters accepted:**
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `name(ct)=john`  return all records with name containing 'john'
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listVendors($entry, $request) -> QueryResponseVendors</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of vendors for an entrypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listVendors(
    '8cfec329267',
    new ListVendorsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `method` (in, nin, eq, ne)
- `enrollmentStatus` (in,nin, eq, ne)
- `status` (in, nin, eq, ne)
- `vendorNumber` (ct, nct, eq, ne)
- `name` (ct, nct, eq, ne)
- `ein` (ct, nct, eq, ne)
- `phone` (ct, nct, eq, ne)
- `email` (ct, nct, eq, ne)
- `address` (ct, nct, eq, ne)
- `city` (ct, nct, eq, ne)
- `state` (ct, nct, eq, ne)
- `country` (ct, nct, eq, ne)
- `zip` (ct, nct, eq, ne)
- `mcc` (ct, nct, eq, ne)
- `locationCode` (ct, nct, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `parentOrgId` (ne, eq, nin, in)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listVendorsOrg($orgId, $request) -> QueryResponseVendors</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of vendors for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listVendorsOrg(
    123,
    new ListVendorsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `method` (in, nin, eq, ne)
- `enrollmentStatus` (in,nin, eq, ne)
- `status` (in, nin, eq, ne)
- `vendorNumber` (ct, nct, eq, ne)
- `name` (ct, nct, eq, ne)
- `ein` (ct, nct, eq, ne)
- `phone` (ct, nct, eq, ne)
- `email` (ct, nct, eq, ne)
- `address` (ct, nct, eq, ne)
- `city` (ct, nct, eq, ne)
- `state` (ct, nct, eq, ne)
- `country` (ct, nct, eq, ne)
- `zip` (ct, nct, eq, ne)
- `mcc` (ct, nct, eq, ne)
- `locationCode` (ct, nct, eq, ne)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `parentOrgId` (ne, eq, nin, in)
- `orgName` (ne, eq, ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array separated by "|"
- nin => not inside array separated by "|"

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listVcards($entry, $request) -> VCardQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of vcards (virtual credit cards) issued for an entrypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listVcards(
    '8cfec329267',
    new ListVcardsRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
List of field names accepted:  

  - `status` (in, nin, eq, ne)  
  - `createdAt` (gt, ge, lt, le, eq, ne)  
  - `cardToken` (ct, nct, eq, ne)  
  - `lastFour` (ct, nct, eq, ne)  
  - `expirationDate` (ct, nct, eq, ne)  
  - `payoutId` (ct, nct, eq, ne, in, nin)  
  - `vendorId` (ct, nct, eq, ne, in, nin)  
  - `miscData1` (ct, nct, eq, ne)  
  - `miscData2` (ct, nct, eq, ne)  
  - `currentUses` (gt, ge, lt, le, eq, ne)  
  - `amount` (gt, ge, lt, le, eq, ne)  
  - `balance` (gt, ge, lt, le, eq, ne)  
  - `paypointLegal` (ne, eq, ct, nct)  
  - `paypointDba` (ne, eq, ct, nct)  
  - `orgName` (ne, eq, ct, nct)  
  - `externalPaypointId` (ct, nct, eq, ne)  
  - `paypointId` (in, nin, eq, ne)  

List of comparison accepted - enclosed between parentheses:  

  - eq or empty => equal  
  - gt => greater than  
  - ge => greater or equal  
  - lt => less than  
  - le => less or equal  
  - ne => not equal  
  - ct => contains  
  - nct => not contains  
  - in => inside array separated by "|"  
  - nin => not inside array separated by "|"
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->query->listVcardsOrg($orgId, $request) -> VCardQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of vcards (virtual credit cards) issued for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->query->listVcardsOrg(
    123,
    new ListVcardsOrgRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter the query. 
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
List of field names accepted:  

  - `status` (in, nin, eq, ne)  
  - `createdAt` (gt, ge, lt, le, eq, ne)  
  - `cardToken` (ct, nct, eq, ne)  
  - `lastFour` (ct, nct, eq, ne)  
  - `expirationDate` (ct, nct, eq, ne)  
  - `payoutId` (ct, nct, eq, ne, in, nin)  
  - `vendorId` (ct, nct, eq, ne, in, nin)  
  - `miscData1` (ct, nct, eq, ne)  
  - `miscData2` (ct, nct, eq, ne)  
  - `currentUses` (gt, ge, lt, le, eq, ne)  
  - `amount` (gt, ge, lt, le, eq, ne)  
  - `balance` (gt, ge, lt, le, eq, ne)  
  - `paypointLegal` (ne, eq, ct, nct)  
  - `paypointDba` (ne, eq, ct, nct)  
  - `orgName` (ne, eq, ct, nct)  
  - `externalPaypointId` (ct, nct, eq, ne)  
  - `paypointId` (in, nin, eq, ne)  

List of comparison accepted - enclosed between parentheses:  

  - eq or empty => equal  
  - gt => greater than  
  - ge => greater or equal  
  - lt => less than  
  - le => less or equal  
  - ne => not equal  
  - ct => contains  
  - nct => not contains  
  - in => inside array separated by "|"  
  - nin => not inside array separated by "|"
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Statistic
<details><summary><code>$client->statistic->basicStats($mode, $freq, $level, $entryId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the basic statistics for an organization or a paypoint, for a given time period, grouped by a particular frequency. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->statistic->basicStats(
    1000000,
    'm',
    1,
    'ytd',
    new BasicStatsRequest([
        'endDate' => '2025-11-01',
        'startDate' => '2025-11-30',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mode:** `string` 

Mode for the request. Allowed values:

- `custom` - Allows you to set a custom date range
- `ytd` - Year To Date
- `mtd` - Month To Date
- `wtd` - Week To Date
- `today` - All current day
- `m12` - Last 12 months
- `d30` - Last 30 days
- `h24` - Last 24 hours
- `lasty` - Last Year
- `lastm` - Last Month
- `lastw` - Last Week
- `yesterday` - Last Day
  
    
</dd>
</dl>

<dl>
<dd>

**$freq:** `string` 

Frequency to group series. Allowed values:

- `m` - monthly
- `w` - weekly
- `d` - daily
- `h` - hourly

For example, `w` groups the results by week.
    
</dd>
</dl>

<dl>
<dd>

**$level:** `int` 

The entry level for the request: 
  - 0 for Organization
  - 2 for Paypoint
    
</dd>
</dl>

<dl>
<dd>

**$entryId:** `int` — Identifier in Payabli for the entity.
    
</dd>
</dl>

<dl>
<dd>

**$endDate:** `?string` 

Used with `custom` mode. The end date for the range. 
Valid formats:
  - YYYY-mm-dd
  - YYYY/mm/dd
  - mm-dd-YYYY
  - mm/dd/YYYY
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` — List of parameters.
    
</dd>
</dl>

<dl>
<dd>

**$startDate:** `?string` 

Used with `custom` mode. The start date for the range. 
Valid formats:
   - YYYY-mm-dd
   - YYYY/mm/dd
   -  mm-dd-YYYY
   - mm/dd/YYYY
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->statistic->customerBasicStats($mode, $freq, $customerId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the basic statistics for a customer for a specific time period, grouped by a selected frequency. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->statistic->customerBasicStats(
    998,
    'm',
    'ytd',
    new CustomerBasicStatsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mode:** `string` 

Mode for request. Allowed values:

- `ytd` - Year To Date
- `mtd` - Month To Date
- `wtd` - Week To Date
- `today` - All current day
- `m12` - Last 12 months
- `d30` - Last 30 days
- `h24` - Last 24 hours
- `lasty` - Last Year
- `lastm` - Last Month
- `lastw` - Last Week
- `yesterday` - Last Day
    
</dd>
</dl>

<dl>
<dd>

**$freq:** `string` 

Frequency to group series. Allowed values:

- `m` - monthly
- `w` - weekly
- `d` - daily
- `h` - hourly

For example, `w` groups the results by week.
    
</dd>
</dl>

<dl>
<dd>

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in PartnerHub. 
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` — List of parameters.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->statistic->subStats($interval, $level, $entryId, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the subscription statistics for a given interval for a paypoint or organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->statistic->subStats(
    1000000,
    '30',
    1,
    new SubStatsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$interval:** `string` 

Interval to get the data. Allowed values:

- `all` - all intervals
- `30` - 1-30 days
- `60` - 31-60 days
- `90` - 61-90 days
- `plus` - +90 days
    
</dd>
</dl>

<dl>
<dd>

**$level:** `int` 

The entry level for the request: 
  - 0 for Organization
  - 2 for Paypoint
    
</dd>
</dl>

<dl>
<dd>

**$entryId:** `int` — Identifier in Payabli for the entity.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` — List of parameters
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->statistic->vendorBasicStats($mode, $freq, $idVendor, $request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the basic statistics about a vendor for a given time period, grouped by frequency. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->statistic->vendorBasicStats(
    'm',
    1,
    'ytd',
    new VendorBasicStatsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mode:** `string` 

Mode for request. Allowed values:

- `ytd` - Year To Date
- `mtd` - Month To Date
- `wtd` - Week To Date
- `today` - All current day
- `m12` - Last 12 months
- `d30` - Last 30 days
- `h24` - Last 24 hours
- `lasty` - Last Year
- `lastm` - Last Month
- `lastw` - Last Week
- `yesterday` - Last Day
    
</dd>
</dl>

<dl>
<dd>

**$freq:** `string` 

Frequency to group series. Allowed values:

- `m` - monthly
- `w` - weekly
- `d` - daily
- `h` - hourly

For example, `w` groups the results by week.
    
</dd>
</dl>

<dl>
<dd>

**$idVendor:** `int` — Vendor ID.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` — List of parameters
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Subscription
<details><summary><code>$client->subscription->getSubscription($subId) -> SubscriptionQueryRecords</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a single subscription's details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->subscription->getSubscription(
    263,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$subId:** `int` — The subscription ID. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->subscription->newSubscription($request) -> AddSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a subscription or scheduled payment to run at a specified time and frequency. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->subscription->newSubscription(
    new RequestSchedule([
        'body' => new SubscriptionRequestBody([
            'customerData' => new PayorDataRequest([
                'customerId' => 4440,
            ]),
            'entryPoint' => 'f743aed24a',
            'paymentDetails' => new PaymentDetail([
                'serviceFee' => 0,
                'totalAmount' => 100,
            ]),
            'paymentMethod' => new PayMethodCredit([
                'cardcvv' => '123',
                'cardexp' => '02/25',
                'cardHolder' => 'John Cassian',
                'cardnumber' => '4111111111111111',
                'cardzip' => '37615',
                'initiator' => 'payor',
                'method' => 'card',
            ]),
            'scheduleDetails' => new ScheduleDetail([
                'endDate' => '03-20-2025',
                'frequency' => Frequency::Weekly->value,
                'planId' => 1,
                'startDate' => '09-20-2024',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `SubscriptionRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->subscription->removeSubscription($subId) -> RemoveSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a subscription, autopay, or recurring payment and prevents future charges.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->subscription->removeSubscription(
    396,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$subId:** `int` — The subscription ID. 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->subscription->updateSubscription($subId, $request) -> UpdateSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a subscription's details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->subscription->updateSubscription(
    231,
    new RequestUpdateSchedule([
        'setPause' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$subId:** `int` — The subscription ID. 
    
</dd>
</dl>

<dl>
<dd>

**$paymentDetails:** `?PaymentDetail` — Object describing details of the payment. To skip the payment, set the `totalAmount` to 0. Payments will be paused until the amount is updated to a non-zero value. When `totalAmount` is set to 0, the `serviceFee` must also be set to 0.
    
</dd>
</dl>

<dl>
<dd>

**$scheduleDetails:** `?ScheduleDetail` — Object describing the schedule for subscription
    
</dd>
</dl>

<dl>
<dd>

**$setPause:** `?bool` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Templates
<details><summary><code>$client->templates->deleteTemplate($templateId) -> PayabliApiResponseTemplateId</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a template by ID. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->templates->deleteTemplate(
    80,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateId:** `float` — The boarding template ID. Can be found at the end of the boarding template URL in PartnerHub. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->templates->getlinkTemplate($templateId, $ignoreEmpty) -> BoardingLinkApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generates a boarding link from a boarding template.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->templates->getlinkTemplate(
    true,
    80,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateId:** `float` — The boarding template ID. Can be found at the end of the boarding template URL in PartnerHub. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
    
</dd>
</dl>

<dl>
<dd>

**$ignoreEmpty:** `bool` — Ignore read-only and empty fields Default is `false`. If `ignoreEmpty` = `false` and any field is empty, then the request returns a failure response. If `ignoreEmpty` = `true`, the request returns the boarding link name regardless of whether fields are empty.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->templates->getTemplate($templateId) -> TemplateQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a boarding template's details by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->templates->getTemplate(
    80,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateId:** `float` — The boarding template ID. Can be found at the end of the boarding template URL in PartnerHub. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->templates->listTemplates($orgId, $request) -> TemplateQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of boarding templates for an organization. Use filters to limit results. You can't make a request that includes filters from the API console in the documentation. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->templates->listTemplates(
    123,
    new ListTemplatesRequest([
        'fromRecord' => 251,
        'limitRecord' => 0,
        'sortBy' => 'desc(field_name)',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orgId:** `int` — The numeric identifier for organization, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 


Collection of field names, conditions, and values used to filter the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>


See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

List of field names accepted:
- `createdAt` (gt, ge, lt, le, eq, ne)
- `title` (ct, nct)
- `description` (ct, nct)
- `code` (ct, nct)
- `orgParentname` (ct, nct)

List of comparison accepted - enclosed between parentheses:
- eq or empty => equal
- gt => greater than
- ge => greater or equal
- lt => less than
- le => less or equal
- ne => not equal
- ct => contains
- nct => not contains
- in => inside array
- nin => not inside array

List of parameters accepted:
- limitRecord : max number of records for query (default="20", "0" or negative value for all)
- fromRecord : initial record in query

Example: title(ct)=hoa return all records with title containing "hoa"
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TokenStorage
<details><summary><code>$client->tokenStorage->addMethod($request) -> AddMethodResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Saves a payment method for reuse. This call exchanges sensitive payment information for a token that can be used to process future transactions. The `ReferenceId` value in the response is the `storedMethodId` to use with transactions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenStorage->addMethod(
    new AddMethodRequest([
        'body' => new RequestTokenStorage([
            'customerData' => new PayorDataRequest([
                'customerId' => 4440,
            ]),
            'entryPoint' => 'f743aed24a',
            'fallbackAuth' => true,
            'paymentMethod' => new TokenizeCard([
                'cardcvv' => '123',
                'cardexp' => '02/25',
                'cardHolder' => 'John Doe',
                'cardnumber' => '4111111111111111',
                'cardzip' => '12345',
                'method' => 'card',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$achValidation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$createAnonymous:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$temporary:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `RequestTokenStorage` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->tokenStorage->getMethod($methodId, $request) -> GetMethodResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves details for a saved payment method.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenStorage->getMethod(
    '32-8877drt00045632-678',
    new GetMethodRequest([
        'cardExpirationFormat' => 1,
        'includeTemporary' => false,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$methodId:** `string` — The saved payment method ID.
    
</dd>
</dl>

<dl>
<dd>

**$cardExpirationFormat:** `?int` 

Format for card expiration dates in the response. 

Accepted values:
  
- 0: default, no formatting. Expiration dates are returned in the format they're saved in.

- 1: MMYY
 
- 2: MM/YY
    
</dd>
</dl>

<dl>
<dd>

**$includeTemporary:** `?bool` — When `true`, the request will include temporary tokens in the search and return details for a matching temporary token. The default behavior searches only for permanent tokens.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->tokenStorage->removeMethod($methodId) -> PayabliApiResponsePaymethodDelete</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a saved payment method.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenStorage->removeMethod(
    '32-8877drt00045632-678',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$methodId:** `string` — The saved payment method ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->tokenStorage->updateMethod($methodId, $request) -> PayabliApiResponsePaymethodDelete</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a saved payment method.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokenStorage->updateMethod(
    '32-8877drt00045632-678',
    new UpdateMethodRequest([
        'body' => new RequestTokenStorage([
            'customerData' => new PayorDataRequest([
                'customerId' => 4440,
            ]),
            'entryPoint' => 'f743aed24a',
            'fallbackAuth' => true,
            'paymentMethod' => new TokenizeCard([
                'cardcvv' => '123',
                'cardexp' => '02/25',
                'cardHolder' => 'John Doe',
                'cardnumber' => '4111111111111111',
                'cardzip' => '12345',
                'method' => 'card',
            ]),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$methodId:** `string` — The saved payment method ID.
    
</dd>
</dl>

<dl>
<dd>

**$achValidation:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `RequestTokenStorage` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## User
<details><summary><code>$client->user->addUser($request) -> AddUserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to add a new user to an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->addUser(
    new UserData([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `UserData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->authRefreshUser() -> PayabliApiResponseUserMfa</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to refresh the authentication token for a user within an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->authRefreshUser();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->authResetUser($request) -> AuthResetUserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to initiate a password reset for a user within an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->authResetUser(
    new UserAuthResetRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$email:** `?string` — The user's email address.
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `?string` — Identifier for entrypoint originating the request (used by front-end apps)
    
</dd>
</dl>

<dl>
<dd>

**$entryType:** `?int` — Type of entry identifier: 0 - partner, 2 - paypoint. This is used by front-end apps, required if an Entry is indicated.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->authUser($provider, $request) -> PayabliApiResponseMfaBasic</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

This endpoint requires an application API token.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->authUser(
    'provider',
    new UserAuthRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$provider:** `string` — Auth provider. This fields is optional and defaults to null for the built-in provider.
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `?string` — Identifier for entry point originating the request (used by front-end apps)
    
</dd>
</dl>

<dl>
<dd>

**$entryType:** `?int` — Type of entry identifier: 0 - partner, 2 - paypoint. This is used by front-end apps, required if an Entry is indicated.
    
</dd>
</dl>

<dl>
<dd>

**$psw:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$userTokenId:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->changePswUser($request) -> ChangePswUserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to change the password for a user within an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->changePswUser(
    new UserAuthPswResetRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$psw:** `?string` — New User password
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->deleteUser($userId) -> DeleteUserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to delete a specific user within an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->deleteUser(
    1000000,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `int` — The Payabli-generated `userId` value.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->editMfaUser($userId, $request) -> EditMfaUserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to enable or disable multi-factor authentication (MFA) for a user within an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->editMfaUser(
    1000000,
    new MfaData([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `int` — User Identifier
    
</dd>
</dl>

<dl>
<dd>

**$request:** `MfaData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->editUser($userId, $request) -> PayabliApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to modify the details of a specific user within an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->editUser(
    1000000,
    new UserData([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `int` — User Identifier
    
</dd>
</dl>

<dl>
<dd>

**$request:** `UserData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->getUser($userId, $request) -> UserQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to retrieve information about a specific user within an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->getUser(
    1000000,
    new GetUserRequest([
        'entry' => '478ae1234',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `int` — The Payabli-generated `userId` value.
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `?string` — The entrypoint identifier.
    
</dd>
</dl>

<dl>
<dd>

**$level:** `?int` — Entry level: 0 - partner, 2 - paypoint
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->logoutUser() -> LogoutUserResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to log a user out from the system.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->logoutUser();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->resendMfaCode($usrname, $entry, $entryType) -> PayabliApiResponseMfaBasic</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Resends the MFA code to the user via the selected MFA mode (email or SMS).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->resendMfaCode(
    'Entry',
    1,
    'usrname',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$usrname:** `string` —  
    
</dd>
</dl>

<dl>
<dd>

**$entry:** `string` —  
    
</dd>
</dl>

<dl>
<dd>

**$entryType:** `int` —  
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->user->validateMfaUser($request) -> PayabliApiResponseUserMfa</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to validate the multi-factor authentication (MFA) code for a user within an organization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->validateMfaUser(
    new MfaValidationData([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mfaCode:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$mfaValidationCode:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Vendor
<details><summary><code>$client->vendor->addVendor($entry, $request) -> PayabliApiResponseVendors</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a vendor in an entrypoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->vendor->addVendor(
    '8cfec329267',
    new VendorData([
        'vendorNumber' => '1234',
        'name1' => "Herman's Coatings and Masonry",
        'name2' => '<string>',
        'ein' => '12-3456789',
        'phone' => '5555555555',
        'email' => 'example@email.com',
        'address1' => '123 Ocean Drive',
        'address2' => 'Suite 400',
        'city' => 'Miami',
        'state' => 'FL',
        'zip' => '33139',
        'country' => 'US',
        'mcc' => '7777',
        'locationCode' => 'MIA123',
        'contacts' => [
            new Contacts([
                'contactName' => 'Herman Martinez',
                'contactEmail' => 'example@email.com',
                'contactTitle' => 'Owner',
                'contactPhone' => '3055550000',
            ]),
        ],
        'billingData' => new BillingData([
            'id' => 123,
            'bankName' => 'Country Bank',
            'routingAccount' => '123123123',
            'accountNumber' => '123123123',
            'typeAccount' => TypeAccount::Checking->value,
            'bankAccountHolderName' => 'Gruzya Adventure Outfitters LLC',
            'bankAccountHolderType' => BankAccountHolderType::Business->value,
            'bankAccountFunction' => 0,
        ]),
        'paymentMethod' => 'managed',
        'vendorStatus' => 1,
        'remitAddress1' => '123 Walnut Street',
        'remitAddress2' => 'Suite 900',
        'remitCity' => 'Miami',
        'remitState' => 'FL',
        'remitZip' => '31113',
        'remitCountry' => 'US',
        'payeeName1' => '<string>',
        'payeeName2' => '<string>',
        'customerVendorAccount' => 'A-37622',
        'internalReferenceId' => 123,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `string` — Entrypoint identifier.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `VendorData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->vendor->deleteVendor($idVendor) -> PayabliApiResponseVendors</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a vendor. 
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->vendor->deleteVendor(
    1,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idVendor:** `int` — Vendor ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->vendor->editVendor($idVendor, $request) -> PayabliApiResponseVendors</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a vendor's information. Send only the fields you need to update.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->vendor->editVendor(
    1,
    new VendorData([
        'name1' => "Theodore's Janitorial",
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idVendor:** `int` — Vendor ID.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `VendorData` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->vendor->getVendor($idVendor) -> VendorQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a vendor's details.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->vendor->getVendor(
    1,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$idVendor:** `int` — Vendor ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Wallet
<details><summary><code>$client->wallet->configureApplePayOrganization($request) -> ConfigureApplePayOrganizationApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Configure and activate Apple Pay for a Payabli organization
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->wallet->configureApplePayOrganization(
    new ConfigureOrganizationRequestApplePay([
        'cascade' => true,
        'isEnabled' => true,
        'orgId' => 901,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cascade:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$isEnabled:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `?int` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->wallet->configureApplePayPaypoint($request) -> ConfigureApplePaypointApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Configure and activate Apple Pay for a Payabli paypoint
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->wallet->configureApplePayPaypoint(
    new ConfigurePaypointRequestApplePay([
        'entry' => '8cfec329267',
        'isEnabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isEnabled:** `?bool` — When `true`, Apple Pay is enabled.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->wallet->configureGooglePayOrganization($request) -> ConfigureApplePayOrganizationApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Configure and activate Google Pay for a Payabli organization
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->wallet->configureGooglePayOrganization(
    new ConfigureOrganizationRequestGooglePay([
        'cascade' => true,
        'isEnabled' => true,
        'orgId' => 901,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cascade:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$isEnabled:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `?int` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client->wallet->configureGooglePayPaypoint($request) -> ConfigureGooglePaypointApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Configure and activate Google Pay for a Payabli paypoint
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->wallet->configureGooglePayPaypoint(
    new ConfigurePaypointRequestGooglePay([
        'entry' => '8cfec329267',
        'isEnabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entry:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$isEnabled:** `?bool` — When `true`, Google Pay is enabled.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>
