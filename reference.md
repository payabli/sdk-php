# Reference
## Bill
<details><summary><code>$client-&gt;bill-&gt;addBill($entry, $request) -> ?BillResponse</code></summary>
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
            'accountingField1' => 'MyInternalId',
            'attachments' => [
                new FileContent([
                    'filename' => 'my-doc.pdf',
                    'ftype' => FileContentFtype::Pdf->value,
                    'furl' => 'https://mysite.com/my-doc.pdf',
                ]),
            ],
            'billDate' => new DateTime('2024-07-01'),
            'billItems' => [
                new BillItem([
                    'itemCategories' => [
                        'deposits',
                    ],
                    'itemCommodityCode' => '010',
                    'itemCost' => 5,
                    'itemDescription' => 'Deposit for materials',
                    'itemMode' => 0,
                    'itemProductCode' => 'M-DEPOSIT',
                    'itemProductName' => 'Materials deposit',
                    'itemQty' => 1,
                    'itemTaxAmount' => 7,
                    'itemTaxRate' => 0.075,
                    'itemTotalAmount' => 123,
                    'itemUnitOfMeasure' => 'SqFt',
                ]),
            ],
            'billNumber' => 'ABC-123',
            'comments' => 'Deposit for materials',
            'dueDate' => new DateTime('2024-07-01'),
            'endDate' => new DateTime('2024-07-01'),
            'frequency' => Frequency::Monthly->value,
            'mode' => 0,
            'netAmount' => 3762.87,
            'status' => 1,
            'terms' => Terms::Net30->value,
            'vendor' => new BillOutDataVendor([
                'vendorNumber' => 'VEN-123',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;bill-&gt;getBill($idBill) -> ?GetBillResponse</code></summary>
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

<details><summary><code>$client-&gt;bill-&gt;editBill($idBill, $request) -> ?EditBillResponse</code></summary>
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
        'billDate' => new DateTime('2025-07-01'),
        'netAmount' => 3762.87,
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

<details><summary><code>$client-&gt;bill-&gt;deleteBill($idBill) -> ?BillResponse</code></summary>
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

<details><summary><code>$client-&gt;bill-&gt;getAttachedFromBill($idBill, $filename, $request) -> ?FileContent</code></summary>
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
    285,
    '0_Bill.pdf',
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

The filename in Payabli. Get this from the `zipName` field
in the `DocumentsRef.filelist` array returned by
`/api/Bill/{idBill}`. Example: `0_Bill.pdf`.
    
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

<details><summary><code>$client-&gt;bill-&gt;deleteAttachedFromBill($idBill, $filename, $request) -> ?BillResponse</code></summary>
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
    285,
    '0_Bill.pdf',
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

The filename in Payabli. Get this from the `zipName` field
in the `DocumentsRef.filelist` array returned by
`/api/Bill/{idBill}`. Example: `0_Bill.pdf`.
    
</dd>
</dl>

<dl>
<dd>

**$returnObject:** `?bool` — When `true`, the response includes the full bill object.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;bill-&gt;sendToApprovalBill($idBill, $request) -> ?BillResponse</code></summary>
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
            'approver@example.com',
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;bill-&gt;modifyApprovalBill($idBill, $request) -> ?ModifyApprovalBillResponse</code></summary>
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
        'approver1@example.com',
        'approver2@example.com',
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

<details><summary><code>$client-&gt;bill-&gt;setApprovedBill($idBill, $approved, $request) -> ?SetApprovedBillResponse</code></summary>
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
    285,
    'true',
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

<details><summary><code>$client-&gt;bill-&gt;listBills($entry, $request) -> ?BillQueryResponse</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response isn't filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `frequency` (`in`, `nin`, `ne`, `eq`)
- `method` (`in`, `nin`, `eq`, `ne`)
- `vendorNumber` (`eq`)
- `vendorId` (`eq`)
- `status` (`eq`, `ne`)
- `approvalUserId` (`eq`, `ne`)
- `parentOrgId` (`ne`, `eq`, `nin`, `in`)
- `approvalUserEmail` (`eq`, `ne`)
- `scheduleId` (`ne`, `eq`)

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;bill-&gt;listBillsOrg($orgId, $request) -> ?BillQueryResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response isn't filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `frequency` (in, nin, ne, eq)
- `method` (in, nin, eq, ne)
- `vendorNumber` (eq)
- `vendorId` (eq)
- `status` (eq, ne)
- `parentOrgId` (ne, eq, nin, in)
- `approvalUserId` (eq, ne)
- `approvalUserEmail` (eq, ne)

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

## Customer
<details><summary><code>$client-&gt;customer-&gt;addCustomer($entry, $request) -> ?PayabliApiResponseCustomerQuery</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a customer in an entrypoint. An identifier is required to create customer records. Change your identifier settings in Settings > Custom Fields in the Payabli Portal.
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
            'customerNumber' => 'C-90010',
            'firstname' => 'Irene',
            'lastname' => 'Canizales',
            'email' => 'irene@canizalesconcrete.com',
            'address1' => "123 Bishop's Trail",
            'city' => 'Mountain City',
            'state' => 'TN',
            'zip' => '37612',
            'country' => 'US',
            'timeZone' => -5,
            'identifierFields' => [
                'email',
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

**$entry:** `string` — The entrypoint identifier.
    
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;customer-&gt;getCustomer($customerId) -> ?CustomerQueryRecords</code></summary>
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
    4440,
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

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in the Payabli Portal.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customer-&gt;updateCustomer($customerId, $request) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
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
    4440,
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

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in the Payabli Portal.
    
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

<details><summary><code>$client-&gt;customer-&gt;deleteCustomer($customerId) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
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
    4440,
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

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in the Payabli Portal.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customer-&gt;requestConsent($customerId) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
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
    4440,
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

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in the Payabli Portal.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;customer-&gt;linkCustomerTransaction($customerId, $transId) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
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
    4440,
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

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in the Payabli Portal.
    
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

## CheckCapture
<details><summary><code>$client-&gt;checkCapture-&gt;checkProcessing($request) -> ?CheckCaptureResponse</code></summary>
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
        'entryPoint' => '8cfec329267',
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

**$frontImage:** `string` — Base64-encoded front check image. Must be JPEG or PNG format and less than 1MB. Image must show the entire check with no partial, blurry, or illegible portions.
    
</dd>
</dl>

<dl>
<dd>

**$rearImage:** `string` — Base64-encoded rear check image. Must be JPEG or PNG format and less than 1MB. Image must show the entire check with no partial, blurry, or illegible portions.
    
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

## MoneyIn
<details><summary><code>$client-&gt;moneyIn-&gt;authorize($request) -> ?AuthResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. New integrations should use the [Authorize endpoint](/developers/api-reference/moneyinV2/authorize-a-transaction), then capture, void, or refund the resulting transaction with the corresponding endpoints. Transactions created with this legacy endpoint must be managed with the legacy lifecycle endpoints — they aren't interchangeable with the current ones.
</Warning>


Authorize a card transaction. This returns an authorization code and reserves funds for the merchant. Authorized transactions aren't flagged for settlement until [captured](/developers/api-reference/moneyin/capture-an-authorized-transaction).

Only card transactions can be authorized. This endpoint can't be used for ACH transactions.
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
            'paymentDetails' => new PaymentDetail([
                'totalAmount' => 1.1,
            ]),
            'paymentMethod' => new PayMethodCredit([
                'cardexp' => 'cardexp',
                'cardnumber' => 'cardnumber',
                'method' => PayMethodCreditMethod::Card->value,
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

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyIn-&gt;capture($transId, $amount) -> ?CaptureResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. Use [POST `/capture/{transId}`](/developers/api-reference/moneyin/capture-an-authorized-transaction) instead, which supports partial captures and service fee adjustments.
</Warning>

  Capture an [authorized
transaction](/developers/api-reference/moneyin/authorize-a-transaction) to complete the transaction and move funds from the customer to merchant account.
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
    'transId',
    1.1,
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

<details><summary><code>$client-&gt;moneyIn-&gt;captureAuth($transId, $request) -> ?CaptureResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. Use it only to capture transactions originally authorized with the legacy [Authorize endpoint](/developers/api-reference/moneyin/authorize-a-transaction). New integrations should use the [Capture endpoint](/developers/api-reference/moneyinV2/capture-an-authorized-transaction), which only works on transactions authorized with the current [Authorize endpoint](/developers/api-reference/moneyinV2/authorize-a-transaction).
</Warning>

Capture an [authorized transaction](/developers/api-reference/moneyin/authorize-a-transaction) to complete the transaction and move funds from the customer to merchant account.

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
    'transId',
    new CaptureRequest([
        'paymentDetails' => new CapturePaymentDetails([
            'totalAmount' => 1.1,
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

<details><summary><code>$client-&gt;moneyIn-&gt;credit($request) -> ?PayabliApiResponse0</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Make a temporary microdeposit in a customer account to verify the customer's ownership and access to the target account. Reverse the microdeposit with `reverseCredit`. Payabli doesn't automatically make microdeposits when you add a bank account, you must manually make the requests.

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
            'customerNumber' => 'C-90010',
        ]),
        'entrypoint' => '8cfec329267',
        'paymentDetails' => new PaymentDetailCredit([
            'serviceFee' => 0,
            'totalAmount' => 1,
        ]),
        'paymentMethod' => new RequestCreditPaymentMethod([
            'achAccount' => '88354454',
            'achAccountType' => Achaccounttype::Checking->value,
            'achHolder' => 'John Smith',
            'achRouting' => '021000021',
            'method' => RequestCreditPaymentMethodMethod::Ach->value,
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

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyIn-&gt;details($transId) -> ?TransactionQueryRecordsCustomer</code></summary>
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

<details><summary><code>$client-&gt;moneyIn-&gt;getpaid($request) -> ?PayabliApiResponseGetPaid</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. New integrations should use the [Make a transaction endpoint](/developers/api-reference/moneyinV2/make-a-transaction) and manage the resulting transaction with the corresponding void or refund endpoints. Transactions created with this legacy endpoint must be managed with the legacy lifecycle endpoints — they aren't interchangeable with the current ones.
</Warning>

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
            'paymentDetails' => new PaymentDetail([
                'totalAmount' => 1.1,
            ]),
            'paymentMethod' => new PayMethodCredit([
                'cardexp' => 'cardexp',
                'cardnumber' => 'cardnumber',
                'method' => PayMethodCreditMethod::Card->value,
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

**$achValidation:** `?bool` — When `true`, enables real-time validation of ACH account and routing numbers. This is an add-on feature, contact Payabli for more information.
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$includeDetails:** `?bool` — When `true`, transactionDetails object is returned in the response. See a full example of the `transactionDetails` object in the [Transaction integration guide](/developers/developer-guides/money-in-transaction-add#includedetailstrue-response).
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyIn-&gt;reverse($transId, $amount) -> ?ReverseResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated and only works on transactions created with the legacy endpoints. There's no equivalent in the current endpoints. For transactions created with [Make a transaction](/developers/api-reference/moneyinV2/make-a-transaction) or [Authorize](/developers/api-reference/moneyinV2/authorize-a-transaction), check the transaction's settlement status and call [Void](/developers/api-reference/moneyinV2/void-a-transaction) or [Refund](/developers/api-reference/moneyinV2/refund-a-settled-transaction) based on the result.
</Warning>

A reversal either refunds or voids a transaction independent of the transaction's settlement status. Send a reversal request for a transaction, and Payabli automatically determines whether it's a refund or void. You don't need to know whether the transaction is settled or not. This endpoint only works on transactions made with the legacy endpoints. For transactions made with the current endpoints, check the transaction's settlement status and call void or refund based on the result.
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
    'transId',
    1.1,
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

<details><summary><code>$client-&gt;moneyIn-&gt;refund($transId, $amount) -> ?RefundResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. Use it only to refund transactions originally created with the legacy endpoints. New integrations should use the [Refund endpoint](/developers/api-reference/moneyinV2/refund-a-settled-transaction), which only works on transactions created with [Make a transaction](/developers/api-reference/moneyinV2/make-a-transaction) or [Authorize](/developers/api-reference/moneyinV2/authorize-a-transaction).
</Warning>

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
    'transId',
    1.1,
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

<details><summary><code>$client-&gt;moneyIn-&gt;refundWithInstructions($transId, $request) -> ?RefundWithInstructionsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. Use it only to refund transactions originally created with the legacy endpoints. To refund a split-funded transaction created with [Make a transaction](/developers/api-reference/moneyinV2/make-a-transaction) or [Authorize](/developers/api-reference/moneyinV2/authorize-a-transaction), use the [Refund endpoint](/developers/api-reference/moneyinV2/refund-a-settled-transaction) with split instructions in the request body.
</Warning>

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
    'transId',
    new RequestRefund([]),
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyIn-&gt;reverseCredit($transId) -> ?PayabliApiResponse</code></summary>
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

<details><summary><code>$client-&gt;moneyIn-&gt;sendReceipt2Trans($transId, $request) -> ?ReceiptResponse</code></summary>
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

<details><summary><code>$client-&gt;moneyIn-&gt;validate($request) -> ?ValidateResponse</code></summary>
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
        'entryPoint' => '8cfec329267',
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyIn-&gt;void($transId) -> ?VoidResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. Use it only to void transactions originally created with the legacy endpoints. New integrations should use the [Void endpoint](/developers/api-reference/moneyinV2/void-a-transaction), which only works on transactions created with [Make a transaction](/developers/api-reference/moneyinV2/make-a-transaction) or [Authorize](/developers/api-reference/moneyinV2/authorize-a-transaction).
</Warning>

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
    'transId',
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

<details><summary><code>$client-&gt;moneyIn-&gt;getpaidv2($request) -> ?V2TransactionResponseWrapper</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Make a single transaction. This method authorizes and captures a payment in one step. This is the v2 version of the `api/MoneyIn/getpaid` endpoint, and returns the unified response format. See [Pay In unified response codes reference](/guides/pay-in-unified-response-codes-reference) for more information.
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
$client->moneyIn->getpaidv2(
    new RequestPaymentV2([
        'body' => new TransRequestBody([
            'customerData' => new PayorDataRequest([
                'customerId' => 4440,
            ]),
            'entryPoint' => '8cfec329267',
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
                'method' => PayMethodCreditMethod::Card->value,
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

**$achValidation:** `?bool` — When `true`, enables real-time validation of ACH account and routing numbers. This is an add-on feature, contact Payabli for more information.
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyIn-&gt;authorizev2($request) -> ?V2TransactionResponseWrapper</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Authorize a card transaction. This returns an authorization code and reserves funds for the merchant. Authorized transactions aren't flagged for settlement until captured. This is the v2 version of the `api/MoneyIn/authorize` endpoint, and returns the unified response format. See [Pay In unified response codes reference](/guides/pay-in-unified-response-codes-reference) for more information.

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
$client->moneyIn->authorizev2(
    new RequestPaymentAuthorizeV2([
        'body' => new TransRequestBody([
            'customerData' => new PayorDataRequest([
                'customerId' => 4440,
            ]),
            'entryPoint' => '8cfec329267',
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
                'method' => PayMethodCreditMethod::Card->value,
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

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyIn-&gt;capturev2($transId, $request) -> ?V2TransactionResponseWrapper</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Capture an authorized transaction to complete the transaction and move funds from the customer to merchant account. This is the v2 version of the `api/MoneyIn/capture/{transId}` endpoint, and returns the unified response format. See [Pay In unified response codes reference](/guides/pay-in-unified-response-codes-reference) for more information.
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
$client->moneyIn->capturev2(
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

<details><summary><code>$client-&gt;moneyIn-&gt;refundv2($transId, $request) -> ?V2TransactionResponseWrapper</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Give a full refund for a transaction that has settled and send money back to the account holder. To perform a partial refund, see [Partially refund a transaction](/developers/api-reference/moneyinV2/partial-refund-a-settled-transaction).

This is the v2 version of the refund endpoint, and returns the unified response format. See [Pay In unified response codes reference](/guides/pay-in-unified-response-codes-reference) for more information.

<Note>
  To refund a split-funded transaction, include split instructions in the request body. Omit the body for a standard refund.
</Note>
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
$client->moneyIn->refundv2(
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

**$request:** `RefundV2Request` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;moneyIn-&gt;refundv2Amount($transId, $amount, $request) -> ?V2TransactionResponseWrapper</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Refund a transaction that has settled and send money back to the account holder. If `amount` is set to 0, performs a full refund. When a non-zero `amount` is provided, this endpoint performs a partial refund.

This is the v2 version of the refund endpoint, and returns the unified response format. See [Pay In unified response codes reference](/guides/pay-in-unified-response-codes-reference) for more information.

<Note>
  For a standard refund, whether full (`amount` set to 0) or partial, send no request body. Include a request body only to refund a split-funded transaction, with split instructions in `refundDetails`.
</Note>
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
$client->moneyIn->refundv2Amount(
    '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
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

**$amount:** `float` — Amount to refund from original transaction, minus any service fees charged on the original transaction. If set to 0, performs a full refund.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `RefundV2Request` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;moneyIn-&gt;voidv2($transId) -> ?V2TransactionResponseWrapper</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancel a transaction that hasn't been settled yet. Voiding non-captured authorizations prevents future captures. This is the v2 version of the `api/MoneyIn/void/{transId}` endpoint, and returns the unified response format. See [Pay In unified response codes reference](/guides/pay-in-unified-response-codes-reference) for more information.
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
$client->moneyIn->voidv2(
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

## Token
<details><summary><code>$client-&gt;token-&gt;createServerSideToken($request) -> ?PayabliAccessTokenResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Exchanges a client ID and client secret for a short-lived Bearer access token using the OAuth2 client-credentials flow. Designed for server-to-server use: the credentials and the returned token stay on your backend. Send the returned `access_token` in the `Authorization` header as `Bearer <access_token>` on subsequent API calls. See the [OAuth authentication guide](/developers/oauth-authentication) for the full flow.
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
$client->token->createServerSideToken(
    new CreateServerSideTokenRequest([
        'clientId' => 'YOUR_CLIENT_ID',
        'clientSecret' => 'YOUR_CLIENT_SECRET',
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

**$clientId:** `string` — The client ID issued for your integration when credentials are provisioned in the Payabli Portal.
    
</dd>
</dl>

<dl>
<dd>

**$clientSecret:** `string` — The client secret issued alongside the client ID. Keep it on your backend and never expose it in client-side code.
    
</dd>
</dl>

<dl>
<dd>

**$state:** `?string` — An optional opaque value echoed back in the response. Use it to correlate the request with its response.
    
</dd>
</dl>

<dl>
<dd>

**$permissions:** `?array` — An optional array of permission IDs that scopes the token to a subset of the credential's granted permissions. When omitted, the token carries all permissions granted to the credential.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Subscription
<details><summary><code>$client-&gt;subscription-&gt;getSubscription($subId) -> ?SubscriptionQueryRecords</code></summary>
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
    231,
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

<details><summary><code>$client-&gt;subscription-&gt;updateSubscription($subId, $request) -> ?UpdateSubscriptionResponse</code></summary>
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

**$invoiceData:** `?BillData` — Object describing an invoice linked to the subscription. Replaces the subscription's existing invoice data entirely. Send `null` to remove it, or leave it out to keep the current invoice data. See [Update a subscription](/guides/pay-in-developer-subscriptions-manage#update-a-subscription) for details.
    
</dd>
</dl>

<dl>
<dd>

**$paymentDetails:** `?PaymentDetail` — Object describing details of the payment. For Regular subscriptions, skip a payment by setting `totalAmount` to 0; payments pause until you update it to a non-zero value, and `serviceFee` must also be 0 when `totalAmount` is 0. For BalanceDriven subscriptions, any `totalAmount` you send is accepted but ignored at run time. Each run charges the payor's live balance, and a zero balance is skipped.
    
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

<details><summary><code>$client-&gt;subscription-&gt;removeSubscription($subId) -> ?RemoveSubscriptionResponse</code></summary>
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
    231,
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

<details><summary><code>$client-&gt;subscription-&gt;newSubscription($request) -> ?AddSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a subscription or scheduled payment to run at a specified time and frequency. You can use stored payment method tokens for card, ACH, and digital wallets by passing them into the `paymentMethod.storedMethodId` field.
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
        'customerData' => new PayorDataRequest([
            'customerId' => 4440,
        ]),
        'entryPoint' => '8cfec329267',
        'paymentDetails' => new PaymentDetail([
            'serviceFee' => 0,
            'totalAmount' => 100,
        ]),
        'paymentMethod' => new PayMethodCredit([
            'cardcvv' => '123',
            'cardexp' => '12/29',
            'cardHolder' => 'John Cassian',
            'cardnumber' => '4111111111111111',
            'cardzip' => '37615',
            'initiator' => 'payor',
            'method' => PayMethodCreditMethod::Card->value,
        ]),
        'scheduleDetails' => new ScheduleDetail([
            'endDate' => '2027-12-31',
            'frequency' => Frequency::Weekly->value,
            'planId' => 1,
            'startDate' => '2027-01-01',
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

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
</dd>
</dl>

<dl>
<dd>

**$customerData:** `?PayorDataRequest` — Object describing the customer/payor.
    
</dd>
</dl>

<dl>
<dd>

**$entryPoint:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$invoiceData:** `?BillData` — Object describing an Invoice linked to the subscription.
    
</dd>
</dl>

<dl>
<dd>

**$paymentDetails:** `?PaymentDetail` — Object describing details of the payment. For Regular subscriptions, skip a payment by setting `totalAmount` to 0; payments pause until you update it to a non-zero value, and `serviceFee` must also be 0 when `totalAmount` is 0. For BalanceDriven subscriptions, any `totalAmount` you send is accepted but ignored at run time. Each run charges the payor's live balance, and a zero balance is skipped.
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethod:** `PayMethodCredit|PayMethodAch|RequestSchedulePaymentMethodInitiator|null` — Information about the payment method for the transaction. Required and recommended fields for each payment method type are described in each schema below.
    
</dd>
</dl>

<dl>
<dd>

**$scheduleDetails:** `?ScheduleDetail` — Object describing the schedule for subscription.
    
</dd>
</dl>

<dl>
<dd>

**$setPause:** `?bool` 
    
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

<dl>
<dd>

**$subscriptionType:** `?string` — Subscription type. Defaults to `Regular` when omitted. Can't be changed after the subscription is created. If you send it to the update endpoint, it's ignored.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Invoice
<details><summary><code>$client-&gt;invoice-&gt;addInvoice($entry, $request) -> ?InvoiceResponseWithoutData</code></summary>
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
                'customerNumber' => 'C-90010',
                'firstName' => 'Tamara',
                'lastName' => 'Bagratoni',
            ]),
            'invoiceData' => new BillData([
                'discount' => 10,
                'frequency' => Frequency::OneTime->value,
                'invoiceAmount' => 1082.37,
                'invoiceDate' => new DateTime('2025-10-19'),
                'invoiceNumber' => 'INV-2345',
                'invoiceStatus' => 1,
                'invoiceType' => 0,
                'items' => [
                    new BillItem([
                        'itemCost' => 100,
                        'itemDescription' => 'Consultation for Georgian tours',
                        'itemMode' => 2,
                        'itemProductName' => 'Adventure Consult',
                        'itemQty' => 2,
                        'itemTotalAmount' => 200,
                    ]),
                    new BillItem([
                        'itemCost' => 882.37,
                        'itemDescription' => 'Deposit for trip planning',
                        'itemMode' => 2,
                        'itemProductName' => 'Deposit ',
                        'itemQty' => 1,
                        'itemTotalAmount' => 882.37,
                    ]),
                ],
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;invoice-&gt;getAttachedFileFromInvoice($idInvoice, $filename, $request) -> ?FileContent</code></summary>
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

The filename in Payabli. Get this from the `zipName` field
in the `DocumentsRef.filelist` array returned by
`/api/Invoice/{idInvoice}`. Example: `0_Bill.pdf`.
    
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

<details><summary><code>$client-&gt;invoice-&gt;deleteAttachedFromInvoice($idInvoice, $filename) -> ?InvoiceResponseWithoutData</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a file attached to an invoice.
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
    23548884,
    '0_Bill.pdf',
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

The filename in Payabli. Get this from the `zipName` field
in the `DocumentsRef.filelist` array returned by
`/api/Invoice/{idInvoice}`. Example: `0_Bill.pdf`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;invoice-&gt;getInvoice($idInvoice) -> ?GetInvoiceRecord</code></summary>
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

<details><summary><code>$client-&gt;invoice-&gt;editInvoice($idInvoice, $request) -> ?InvoiceResponseWithoutData</code></summary>
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
    23548884,
    new EditInvoiceRequest([
        'body' => new InvoiceDataRequest([
            'invoiceData' => new BillData([
                'invoiceAmount' => 982.37,
                'invoiceDate' => new DateTime('2025-10-19'),
                'invoiceNumber' => 'INV-2345',
                'items' => [
                    new BillItem([
                        'itemCost' => 882.37,
                        'itemDescription' => 'Deposit for trip planning',
                        'itemProductName' => 'Deposit',
                        'itemQty' => 1,
                    ]),
                ],
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

<details><summary><code>$client-&gt;invoice-&gt;deleteInvoice($idInvoice) -> ?InvoiceResponseWithoutData</code></summary>
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

<details><summary><code>$client-&gt;invoice-&gt;getInvoiceNumber($entry) -> ?InvoiceNumberResponse</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;invoice-&gt;listInvoices($entry, $request) -> ?QueryInvoiceResponse</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

Accepted field names:

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

Accepted comparison operators - enclosed between parentheses:

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

Accepted parameters:
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

<details><summary><code>$client-&gt;invoice-&gt;listInvoicesOrg($orgId, $request) -> ?QueryInvoiceResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

Accepted field names:

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

Accepted comparison operators - enclosed between parentheses:

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

Accepted parameters:
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

<details><summary><code>$client-&gt;invoice-&gt;sendInvoice($idInvoice, $request) -> ?SendInvoiceResponse</code></summary>
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

<details><summary><code>$client-&gt;invoice-&gt;getInvoicePdf($idInvoice) -> ?array</code></summary>
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

## PaymentLink
<details><summary><code>$client-&gt;paymentLink-&gt;addPayLinkFromInvoice($idInvoice, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generates a payment link for an invoice from the invoice ID.

The payment page configuration blocks (`logo`, `page`, `paymentMethods`, `review`, `messageBeforePaying`, `paymentButton`, `notes`, `contactUs`, and `settings`) are optional. When you omit a block, Payabli applies a default rather than hiding it. The block is enabled at a fixed display order, so the generated page stays complete and branded. To hide a section, send the block explicitly with `enabled` set to `false`. An explicit value is always honored and is never replaced by a default. For each block's default, see its description in the request body.
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
                    'validation' => 'alpha',
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
</dd>
</dl>

<dl>
<dd>

**$contactUs:** `?ContactElement` — Contact us section of payment link page. If omitted, this block is enabled at display order 11.
    
</dd>
</dl>

<dl>
<dd>

**$invoices:** `InvoiceElement` — Invoices section of payment link page. Required. Omitting it returns a `400` error with code `7045`.
    
</dd>
</dl>

<dl>
<dd>

**$logo:** `?Element` — Logo section of payment link page. If omitted, this block is enabled at display order 1, and the logo image is resolved from the paypoint's entry logo.
    
</dd>
</dl>

<dl>
<dd>

**$messageBeforePaying:** `?LabelElement` — Message section of payment link page. If omitted, this block is enabled at display order 5.
    
</dd>
</dl>

<dl>
<dd>

**$notes:** `?NoteElement` — Notes section of payment link page. If omitted, this block is enabled at display order 10.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?PageElement` — Page header section of payment link page. If omitted, this block is enabled at display order 2.
    
</dd>
</dl>

<dl>
<dd>

**$paymentButton:** `?LabelElement` — Payment button section of payment link page. If omitted, this block is enabled at display order 6, with the label "Pay Now".
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethods:** `?MethodElement` — Payment methods section of payment link page. If omitted, this block is enabled at display order 3, with all payment methods enabled except RDC.
    
</dd>
</dl>

<dl>
<dd>

**$payor:** `?PayorElement` — Customer/Payor section of payment link page
    
</dd>
</dl>

<dl>
<dd>

**$review:** `?HeaderElement` — Review section of payment link page. If omitted, this block is enabled at display order 4.
    
</dd>
</dl>

<dl>
<dd>

**$settings:** `?PagelinkSetting` — Settings section of payment link page. If omitted, defaults are applied, including page color `#10a0e3` and language `en`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paymentLink-&gt;addPayLinkFromBill($billId, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generates a payment link for a bill from the bill ID. The vendor receives a secure page where they can select their preferred payment method (ACH, virtual card, or check) and complete the payment.
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
    54323,
    new PayLinkDataBill([
        'mail2' => 'jo@example.com; ceo@example.com',
        'body' => new PaymentPageRequestBodyOut([
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
            'paymentMethods' => new MethodElementOut([
                'allMethodsChecked' => true,
                'allowMultipleMethods' => true,
                'defaultMethod' => 'vcard',
                'enabled' => true,
                'header' => 'Payment Methods',
                'methods' => new MethodsListOut([
                    'ach' => true,
                    'check' => true,
                    'vcard' => true,
                ]),
                'order' => 0,
                'showPreviewVirtualCard' => true,
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `PaymentPageRequestBodyOut` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paymentLink-&gt;deletePayLinkFromId($payLinkId) -> ?PayabliApiResponsePaymentLinks</code></summary>
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
    '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
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

<details><summary><code>$client-&gt;paymentLink-&gt;getPayLinkFromId($paylinkId) -> ?GetPayLinkFromIdResponse</code></summary>
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
    '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
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

<details><summary><code>$client-&gt;paymentLink-&gt;pushPayLinkFromId($payLinkId, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
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
    '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
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

<details><summary><code>$client-&gt;paymentLink-&gt;refreshPayLinkFromId($payLinkId, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
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
    '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
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

<details><summary><code>$client-&gt;paymentLink-&gt;sendPayLinkFromId($payLinkId, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
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
    '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
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

<details><summary><code>$client-&gt;paymentLink-&gt;updatePayLinkFromId($payLinkId, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
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
    '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
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

<details><summary><code>$client-&gt;paymentLink-&gt;addPayLinkFromBillLotNumber($lotNumber, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
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
        'entryPoint' => '8cfec329267',
        'vendorNumber' => 'VEN-123',
        'mail2' => 'customer@example.com; billing@example.com',
        'amountFixed' => 'true',
        'body' => new PaymentPageRequestBodyOut([
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
            'paymentMethods' => new MethodElementOut([
                'allMethodsChecked' => true,
                'allowMultipleMethods' => true,
                'defaultMethod' => 'vcard',
                'enabled' => true,
                'header' => 'Payment Methods',
                'methods' => new MethodsListOut([
                    'ach' => true,
                    'check' => true,
                    'vcard' => true,
                ]),
                'order' => 0,
                'showPreviewVirtualCard' => true,
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

**$entryPoint:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

**$request:** `PaymentPageRequestBodyOut` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paymentLink-&gt;patchOutPaymentLink($paylinkId, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Partially updates a Pay Out payment link's content, expiration date, and/or status. Use this to modify the payment page configuration, extend or change the expiration, or cancel a link. Updating the expiration date of an expired link reactivates it to Active status.
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
$client->paymentLink->patchOutPaymentLink(
    '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
    new PatchOutPaymentLinkRequest([
        'expirationDate' => '2026-06-01T00:00:00Z',
        'status' => PaymentLinkStatus::Active->value,
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

**$paylinkId:** `string` — ID for the payment link.
    
</dd>
</dl>

<dl>
<dd>

**$billPageData:** `?PaymentPageRequestBodyOut` — Updated payment link page configuration.
    
</dd>
</dl>

<dl>
<dd>

**$expirationDate:** `?string` — New expiration date for the payment link. Must be a future date. If null and the link is expired, uses the default expiration from settings. Updating the expiration date reactivates an expired payment link to Active status.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` — Updated status for the payment link.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paymentLink-&gt;updatePayLinkOutFromId($paylinkId, $request) -> ?PayabliApiResponsePaymentLinks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates the payment page content for a Pay Out payment link. Use this to change the branding, messaging, payment methods offered, or other page configuration.
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
$client->paymentLink->updatePayLinkOutFromId(
    '2325-XXXXXXX-90b1-4598-b6c7-44cdcbf495d7-1234',
    new PaymentPageRequestBodyOut([
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
        'paymentMethods' => new MethodElementOut([
            'allMethodsChecked' => true,
            'allowMultipleMethods' => true,
            'defaultMethod' => 'vcard',
            'enabled' => true,
            'header' => 'Payment Methods',
            'methods' => new MethodsListOut([
                'ach' => true,
                'check' => true,
                'vcard' => true,
            ]),
            'order' => 0,
            'showPreviewVirtualCard' => true,
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

**$paylinkId:** `string` — ID for the payment link.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `PaymentPageRequestBodyOut` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TokenStorage
<details><summary><code>$client-&gt;tokenStorage-&gt;addMethod($request) -> ?AddMethodResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Saves a payment method for reuse. This call exchanges sensitive payment information for a token that can be used to process future transactions. The `referenceId` value in the response is the `storedMethodId` to use with transactions, and the `methodId` to use when you manage the saved payment method.
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
            'entryPoint' => '8cfec329267',
            'fallbackAuth' => true,
            'fallbackAuthAmount' => 100,
            'methodDescription' => 'Primary Visa card',
            'paymentMethod' => new TokenizeCard([
                'method' => 'card',
                'cardcvv' => '123',
                'cardexp' => '12/29',
                'cardHolder' => 'John Doe',
                'cardnumber' => '4111111111111111',
                'cardzip' => '12345',
            ]),
            'source' => 'api',
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

**$achValidation:** `?bool` — When `true`, enables real-time validation of ACH account and routing numbers. This is an add-on feature, contact Payabli for more information.
    
</dd>
</dl>

<dl>
<dd>

**$createAnonymous:** `?bool` — When `true`, creates a saved method with no associated customer information. The token will be associated with customer information the first time it's used to make a payment. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$forceCustomerCreation:** `?bool` — When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$temporary:** `?bool` — Creates a temporary, one-time-use token for the payment method that expires in 12 hours. Defaults to `false`.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;tokenStorage-&gt;getMethod($methodId, $request) -> ?GetMethodResponse</code></summary>
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

<details><summary><code>$client-&gt;tokenStorage-&gt;updateMethod($methodId, $request) -> ?PayabliApiResponsePaymethodDelete</code></summary>
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
            'entryPoint' => '8cfec329267',
            'fallbackAuth' => true,
            'paymentMethod' => new TokenizeCard([
                'method' => 'card',
                'cardcvv' => '123',
                'cardexp' => '12/29',
                'cardHolder' => 'John Doe',
                'cardnumber' => '4111111111111111',
                'cardzip' => '12345',
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

**$achValidation:** `?bool` — When `true`, enables real-time validation of ACH account and routing numbers. This is an add-on feature, contact Payabli for more information.
    
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

<details><summary><code>$client-&gt;tokenStorage-&gt;removeMethod($methodId) -> ?PayabliApiResponsePaymethodDelete</code></summary>
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

## Paypoint
<details><summary><code>$client-&gt;paypoint-&gt;getBasicEntry($entry) -> ?GetBasicEntryResponse</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paypoint-&gt;getBasicEntryById($idPaypoint) -> ?GetBasicEntryByIdResponse</code></summary>
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

<details><summary><code>$client-&gt;paypoint-&gt;saveLogo($entry, $request) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

<details><summary><code>$client-&gt;paypoint-&gt;migrate($request) -> ?MigratePaypointResponse</code></summary>
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
        'entryPoint' => '8cfec329267',
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

**$entryPoint:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$newParentOrganizationId:** `int` — The ID for the paypoint's new parent organization.
    
</dd>
</dl>

<dl>
<dd>

**$notificationRequest:** `?NotificationRequest` — Optional notification request object for a webhook
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paypoint-&gt;settingsPage($entry) -> ?SettingsQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a paypoint's basic settings like custom fields, identifiers, and invoicing settings.
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paypoint-&gt;getEntryConfig($entry, $request) -> ?GetEntryConfigResponse</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

<details><summary><code>$client-&gt;paypoint-&gt;getPage($entry, $subdomain) -> ?PayabliPages</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the details for a single payment page for a paypoint.
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `string` — Payment page identifier. The subdomain value is the last portion of the payment page URL. For example, in `https://paypages-sandbox.payabli.com/513823dc10/pay-your-fees-1`, the subdomain is `pay-your-fees-1`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paypoint-&gt;removePage($entry, $subdomain) -> ?PayabliApiResponseGeneric2Part</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `string` — Payment page identifier. The subdomain value is the last portion of the payment page URL. For example, in `https://paypages-sandbox.payabli.com/513823dc10/pay-your-fees-1`, the subdomain is `pay-your-fees-1`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## HostedPaymentPages
<details><summary><code>$client-&gt;hostedPaymentPages-&gt;loadPage($entry, $subdomain) -> ?PayabliPages</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `string` — Payment page identifier. The subdomain value is the last part of the payment page URL. For example, in `https://paypages-sandbox.payabli.com/513823dc10/pay-your-fees-1`, the subdomain is `pay-your-fees-1`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;hostedPaymentPages-&gt;newPage($entry, $request) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;hostedPaymentPages-&gt;savePage($entry, $subdomain, $request) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `string` — Payment page identifier. The subdomain value is the last part of the payment page URL. For example, in `https://paypages-sandbox.payabli.com/513823dc10/pay-your-fees-1`, the subdomain is `pay-your-fees-1`.
    
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

## PaymentMethodDomain
<details><summary><code>$client-&gt;paymentMethodDomain-&gt;addPaymentMethodDomain($request) -> ?AddPaymentMethodDomainApiResponse</code></summary>
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
        'applePay' => new AddPaymentMethodDomainRequestApplePay([
            'isEnabled' => true,
        ]),
        'googlePay' => new AddPaymentMethodDomainRequestGooglePay([
            'isEnabled' => true,
        ]),
        'domainName' => 'checkout.example.com',
        'entityId' => 109,
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

<details><summary><code>$client-&gt;paymentMethodDomain-&gt;cascadePaymentMethodDomain($domainId) -> ?PaymentMethodDomainGeneralResponse</code></summary>
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

<details><summary><code>$client-&gt;paymentMethodDomain-&gt;getPaymentMethodDomain($domainId) -> ?PaymentMethodDomainApiResponse</code></summary>
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

<details><summary><code>$client-&gt;paymentMethodDomain-&gt;deletePaymentMethodDomain($domainId) -> ?DeletePaymentMethodDomainResponse</code></summary>
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

<details><summary><code>$client-&gt;paymentMethodDomain-&gt;updatePaymentMethodDomain($domainId, $request) -> ?PaymentMethodDomainGeneralResponse</code></summary>
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

<details><summary><code>$client-&gt;paymentMethodDomain-&gt;listPaymentMethodDomains($request) -> ?ListPaymentMethodDomainsResponse</code></summary>
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

<details><summary><code>$client-&gt;paymentMethodDomain-&gt;verifyPaymentMethodDomain($domainId) -> ?PaymentMethodDomainGeneralResponse</code></summary>
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

## Import
<details><summary><code>$client-&gt;import-&gt;importBills($entry, $request) -> ?PayabliApiResponseImport</code></summary>
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
    new ImportBillsRequest([
        'file' => File::createFromString("example_file", "example_file"),
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;import-&gt;importCustomer($entry, $request) -> ?PayabliApiResponseImport</code></summary>
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
    new ImportCustomerRequest([
        'file' => File::createFromString("example_file", "example_file"),
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

**$entry:** `string` — The entrypoint identifier.
    
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

<details><summary><code>$client-&gt;import-&gt;importVendor($entry, $request) -> ?PayabliApiResponseImport</code></summary>
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
    new ImportVendorRequest([
        'file' => File::createFromString("example_file", "example_file"),
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

**$entry:** `string` — The entrypoint identifier.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Query
<details><summary><code>$client-&gt;query-&gt;listBatchDetails($entry, $request) -> ?QueryBatchesDetailResponse</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

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

**Accepted comparison operators:**
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

**Accepted parameters:**

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

<details><summary><code>$client-&gt;query-&gt;listBatchDetailsOrg($orgId, $request) -> ?QueryBatchesDetailResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

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

**Accepted comparison operators:**
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

**Accepted parameters:**

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

<details><summary><code>$client-&gt;query-&gt;listBatches($entry, $request) -> ?QueryBatchesResponse</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

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

**Accepted parameters:**
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

<details><summary><code>$client-&gt;query-&gt;listBatchesOrg($orgId, $request) -> ?QueryBatchesResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

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

**Accepted parameters:**
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

<details><summary><code>$client-&gt;query-&gt;listBatchesOut($entry, $request) -> ?QueryBatchesOutResponse</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

**Accepted field names**:

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

<details><summary><code>$client-&gt;query-&gt;listBatchesOutOrg($orgId, $request) -> ?QueryBatchesOutResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names**:

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

<details><summary><code>$client-&gt;query-&gt;listChargebacks($entry, $request) -> ?QueryChargebacksResponse</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `chargebackDate` (gt, ge, lt, le, eq, ne)
- `transId`  (ne, eq, ct, nct)
- `method`   (in, nin, eq, ne)
- `amount`  (gt, ge, lt, le, eq, ne): the chargeback or return's own amount (the top-level `netAmount` in the response), unlike `netAmount`, which matches the original transaction's net
- `totalAmount`  (gt, ge, lt, le, eq, ne): the original transaction's gross amount, including service and pending fees (`transaction.totalAmount` in the response)
- `netAmount`  (gt, ge, lt, le, eq, ne)
- `reasonCode`   (in, nin, eq, ne)
- `reason`  (ct, nct, eq, ne)
- `replyDate` (gt, ge, lt, le, eq, ne)
- `replyBy` (gt, ge, lt, le, eq, ne): alias of `replyDate`, matching the `replyBy` field in the response
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

**Accepted comparison operators - enclosed between parentheses:**
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

**Accepted parameters:**
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`. For this endpoint, you can also sort by `amount` and `totalAmount`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;query-&gt;listChargebacksOrg($orgId, $request) -> ?QueryChargebacksResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info> See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**

- `chargebackDate` (gt, ge, lt, le, eq, ne)
- `transId`  (ne, eq, ct, nct)
- `method`   (in, nin, eq, ne)
- `amount`  (gt, ge, lt, le, eq, ne): the chargeback or return's own amount (the top-level `netAmount` in the response), unlike `netAmount`, which matches the original transaction's net
- `totalAmount`  (gt, ge, lt, le, eq, ne): the original transaction's gross amount, including service and pending fees (`transaction.totalAmount` in the response)
- `netAmount`  (gt, ge, lt, le, eq, ne)
- `reasonCode`   (in, nin, eq, ne)
- `reason`  (ct, nct, eq, ne)
- `replyDate` (gt, ge, lt, le, eq, ne)
- `replyBy` (gt, ge, lt, le, eq, ne): alias of `replyDate`, matching the `replyBy` field in the response
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

**Accepted comparison operators - enclosed between parentheses:**

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

**Accepted parameters:**
- `limitRecord`: max number of records for query (default="20", "0" or negative value for all)
- `fromRecord`: initial record in query

Example: `netAmount(gt)=20` returns all records with a `netAmount` greater than 20.00
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — The field name to use for sorting results. Use `desc(field_name)` to sort descending by `field_name`, and use `asc(field_name)` to sort ascending by `field_name`. For this endpoint, you can also sort by `amount` and `totalAmount`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;query-&gt;listCustomers($entry, $request) -> ?QueryCustomerResponse</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more details.

**Accepted field names:**

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

**Accepted comparison operators:**

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

**Accepted parameters:**
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

<details><summary><code>$client-&gt;query-&gt;listCustomersOrg($orgId, $request) -> ?QueryCustomerResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more details.

**Accepted field names:**

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

**Accepted comparison operators:**

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

**Accepted parameters:**
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

<details><summary><code>$client-&gt;query-&gt;listDevices($entry, $request) -> ?QueryDeviceResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of cloud and AXIUM devices for a single paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
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
$client->query->listDevices(
    '8cfec329267',
    new ListDevicesRequest([
        'fromRecord' => 0,
        'limitRecord' => 20,
        'sortBy' => 'desc(createdAt)',
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

Collection of field names, conditions, and values used to filter
the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/devices/8cfec329267?parameters=status=1&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/devices/8cfec329267?status=1&limitRecord=20
</Info>

See [Filters and Conditions
Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference)
for more information.

**Accepted field names:**


- `deviceId` (eq, ne, ct, nct)

- `serialNumber` (eq, ne, ct, nct)

- `friendlyName` (eq, ne, ct, nct)

- `description` (eq, ne, ct, nct)

- `model` (eq, ne, ct, nct)

- `make` (eq, ne, ct, nct)

- `macAddress` (eq, ne, ct, nct)

- `registrationCode` (eq, ne, ct, nct)

- `status` (eq, ne, in, nin)

- `deviceType` (eq, ne, in, nin)

- `deviceOs` (eq, ne, in, nin)

- `activationAttempts` (eq, ne, gt, ge, lt, le)

- `createdDate` (gt, ge, lt, le, eq, ne)

- `updatedDate` (gt, ge, lt, le, eq, ne)

- `lastHealthCheck` (gt, ge, lt, le, eq, ne)

- `activationExpiry` (gt, ge, lt, le, eq, ne). This filter corresponds to the `activationCodeExpiry` response field.

- `paypointId` (eq, ne)

- `paypointDba` (eq, ne, ct, nct)

- `paypointLegal` (eq, ne, ct, nct)

- `paypointEntry` (eq, ne, ct, nct)

- `externalPaypointId` (eq, ne, ct, nct)

- `parentOrgId` (eq, ne)

- `parentOrgName` (eq, ne, ct, nct)

- `paypointLogo` (eq, ne, ct, nct)

- `parentOrgLogo` (eq, ne, ct, nct)

- `transactionCount` (eq, ne, gt, ge, lt, le)

- `volumeProcessed` (eq, ne, gt, ge, lt, le)


**Accepted comparison operators:**

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

<details><summary><code>$client-&gt;query-&gt;listDevicesOrg($orgId, $request) -> ?QueryDeviceResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of cloud and AXIUM devices for a single organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.
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
$client->query->listDevicesOrg(
    123,
    new ListDevicesOrgRequest([
        'fromRecord' => 0,
        'limitRecord' => 20,
        'sortBy' => 'desc(createdAt)',
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

Collection of field names, conditions, and values used to filter
the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/devices/org/236?parameters=status=1&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/devices/org/236?status=1&limitRecord=20
</Info>

See [Filters and Conditions
Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference)
for more information.

**Accepted field names:**


- `deviceId` (eq, ne, ct, nct)

- `serialNumber` (eq, ne, ct, nct)

- `friendlyName` (eq, ne, ct, nct)

- `description` (eq, ne, ct, nct)

- `model` (eq, ne, ct, nct)

- `make` (eq, ne, ct, nct)

- `macAddress` (eq, ne, ct, nct)

- `registrationCode` (eq, ne, ct, nct)

- `status` (eq, ne, in, nin)

- `deviceType` (eq, ne, in, nin)

- `deviceOs` (eq, ne, in, nin)

- `activationAttempts` (eq, ne, gt, ge, lt, le)

- `createdDate` (gt, ge, lt, le, eq, ne)

- `updatedDate` (gt, ge, lt, le, eq, ne)

- `lastHealthCheck` (gt, ge, lt, le, eq, ne)

- `activationExpiry` (gt, ge, lt, le, eq, ne). This filter corresponds to the `activationCodeExpiry` response field.

- `paypointId` (eq, ne)

- `paypointDba` (eq, ne, ct, nct)

- `paypointLegal` (eq, ne, ct, nct)

- `paypointEntry` (eq, ne, ct, nct)

- `externalPaypointId` (eq, ne, ct, nct)

- `parentOrgId` (eq, ne)

- `parentOrgName` (eq, ne, ct, nct)

- `paypointLogo` (eq, ne, ct, nct)

- `parentOrgLogo` (eq, ne, ct, nct)

- `transactionCount` (eq, ne, gt, ge, lt, le)

- `volumeProcessed` (eq, ne, gt, ge, lt, le)


**Accepted comparison operators:**

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

<details><summary><code>$client-&gt;query-&gt;listNotificationReports($entry, $request) -> ?QueryResponseNotificationReports</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `reportName` (ct, nct, eq, ne)
- `createdAt` (gt, ge, lt, le, eq, ne)

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;query-&gt;listNotificationReportsOrg($orgId, $request) -> ?QueryResponseNotificationReports</code></summary>
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `reportName` (ct, nct, eq, ne)
- `createdAt` (gt, ge, lt, le, eq, ne)

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;query-&gt;listNotifications($entry, $request) -> ?QueryResponseNotifications</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `frequency` (in, nin,ne, eq)
- `method` (in, nin, eq, ne)
- `event` (in, nin, eq, ne)
- `target` (ct, nct, eq, ne)
- `status` (eq, ne)

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;query-&gt;listNotificationsOrg($orgId, $request) -> ?QueryResponseNotifications</code></summary>
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `frequency` (in, nin,ne, eq)
- `method` (in, nin, eq, ne)
- `event` (in, nin, eq, ne)
- `target` (ct, nct, eq, ne)
- `status` (eq, ne)

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;query-&gt;listOrganizations($orgId, $request) -> ?ListOrganizationsResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
**Accepted field names:**

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

**Accepted comparison operators - enclosed between parentheses:**

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

**Accepted parameters:**

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

<details><summary><code>$client-&gt;query-&gt;listPayout($entry, $request) -> ?QueryPayoutTransaction</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

Accepted field names:

  - `status` (in, nin, eq, ne)
  - `transactionDate` (gt, ge, lt, le, eq, ne)
  - `billNumber` (ct, nct)
  - `vendorNumber` (ct, nct, eq, ne)
  - `vendorName` (ct, nct, eq, ne)
  - `paymentMethod` (ct, nct, eq, ne, in, nin)
  - `paymentId` (ct, nct, eq, ne)
  - `orderId` (ne, eq)
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

  Accepted comparison operators - enclosed between parentheses:
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

  Accepted parameters:

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

<details><summary><code>$client-&gt;query-&gt;listPayoutOrg($orgId, $request) -> ?QueryPayoutTransaction</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
Accepted field names:

  - `status` (in, nin, eq, ne)
  - `transactionDate` (gt, ge, lt, le, eq, ne)
  - `billNumber` (ct, nct)
  - `vendorNumber` (ct, nct, eq, ne)
  - `vendorName` (ct, nct, eq, ne)
  - `parentOrgId` (ne, eq, nin, in)
  - `paymentMethod` (ct, nct, eq, ne, in, nin)
  - `paymentId` (ct, nct, eq, ne)
  - `orderId` (ne, eq)
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

  Accepted comparison operators - enclosed between parentheses:
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

  Accepted parameters:

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

<details><summary><code>$client-&gt;query-&gt;listPaypoints($orgId, $request) -> ?QueryEntrypointResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
**Accepted field names:**

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

**Accepted comparison operators - enclosed between parentheses:**

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

**Accepted parameters:**

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

<details><summary><code>$client-&gt;query-&gt;listSettlements($entry, $request) -> ?QueryResponseSettlements</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

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

**Accepted comparison operators:**
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

**Accepted parameters:**

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

<details><summary><code>$client-&gt;query-&gt;listSettlementsOrg($orgId, $request) -> ?QueryResponseSettlements</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

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

**Accepted comparison operators:**
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

**Accepted parameters:**

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

<details><summary><code>$client-&gt;query-&gt;listSubscriptions($entry, $request) -> ?QuerySubscriptionResponse</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

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
- `subscriptionType` (eq, ne, in, nin). Filters by subscription type. Accepts `Regular` or `BalanceDriven`. Case-insensitive. Example: `subscriptionType(in)=Regular|BalanceDriven`.
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
- `idPmethod` (eq, ne, ct, nct, in, nin). Filters by the subscription's linked stored method identifier (the value returned in `StoredMethod.IdPmethod`). Case-insensitive. Subscriptions without a linked stored method are excluded from matches. Example: `idPmethod(eq,6edcbb56-9c0e-4003-b3d1-99abf149ba0e)`.
- `orderDescription` (ct, nct)
- `cycles` (eq, ne, gt, ge, lt, le)
- `leftcycles` (eq, ne, gt, ge, lt, le)
- `createdAt` (eq, ne, gt, ge, lt, le)
- `updatedOn` (eq, ne, gt, ge, lt, le)
- `invoiceNumber` (ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

**Accepted comparison operators:**
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

<details><summary><code>$client-&gt;query-&gt;listSubscriptionsOrg($orgId, $request) -> ?QuerySubscriptionResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

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
- `subscriptionType` (eq, ne, in, nin). Filters by subscription type. Accepts `Regular` or `BalanceDriven`. Case-insensitive. Example: `subscriptionType(in)=Regular|BalanceDriven`.
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
- `idPmethod` (eq, ne, ct, nct, in, nin). Filters by the subscription's linked stored method identifier (the value returned in `StoredMethod.IdPmethod`). Case-insensitive. Subscriptions without a linked stored method are excluded from matches. Example: `idPmethod(eq,6edcbb56-9c0e-4003-b3d1-99abf149ba0e)`.
- `orderDescription` (ct, nct)
- `cycles` (eq, ne, gt, ge, lt, le)
- `leftcycles` (eq, ne, gt, ge, lt, le)
- `createdAt` (eq, ne, gt, ge, lt, le)
- `updatedOn` (eq, ne, gt, ge, lt, le)
- `invoiceNumber` (ct, nct)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name

**Accepted comparison operators:**
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

<details><summary><code>$client-&gt;query-&gt;listPayoutSubscriptions($entry, $request) -> ?QueryPayoutSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of payout subscriptions for a single paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for more information.
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
$client->query->listPayoutSubscriptions(
    '8cfec329267',
    new ListPayoutSubscriptionsRequest([
        'fromRecord' => 0,
        'limitRecord' => 20,
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/payoutsubscriptions/entry123?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/payoutsubscriptions/entry123?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.
**Accepted field names:**

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
- `payaccountLastfour` (ct, nct)
- `payaccountType` (ne, eq, in, nin)
- `payaccountCurrency` (ne, eq, in, nin)
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct, nin, in)
- `parentOrgId` (ne, eq, nin, in)
- `subscriptionId` (eq, ne)
- `orderDescription` (ct, nct)
- `cycles` (eq, ne, gt, ge, lt, le)
- `leftcycles` (eq, ne, gt, ge, lt, le)
- `createdAt` (eq, ne, gt, ge, lt, le)
- `updatedOn` (eq, ne, gt, ge, lt, le)
- `vendorNumber` (ne, eq, ct, nct)
- `name` (ne, eq, ct, nct)
- `phone` (ne, eq, ct, nct)
- `email` (ne, eq, ct, nct)
- `address` (ne, eq, ct, nct)
- `remitAddress` (ct, nct)
- `city` (ne, eq, ct, nct)
- `state` (ne, eq, ct, nct)
- `country` (ne, eq, ct, nct)
- `zip` (ne, eq, ct, nct)

**Accepted comparison operators:**
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

<details><summary><code>$client-&gt;query-&gt;listPayoutSubscriptionsOrg($orgId, $request) -> ?QueryPayoutSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of payout subscriptions for a single org. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for more information.
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
$client->query->listPayoutSubscriptionsOrg(
    123,
    new ListPayoutSubscriptionsOrgRequest([
        'fromRecord' => 0,
        'limitRecord' => 20,
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/payoutsubscriptions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/payoutsubscriptions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.
**Accepted field names:**

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
- `payaccountLastfour` (ct, nct)
- `payaccountType` (ne, eq, in, nin)
- `payaccountCurrency` (ne, eq, in, nin)
- `paypointId` (ne, eq)
- `paypointLegal` (ne, eq, ct, nct)
- `paypointDba` (ne, eq, ct, nct)
- `orgName` (ne, eq, ct, nct, nin, in)
- `parentOrgId` (ne, eq, nin, in)
- `subscriptionId` (eq, ne)
- `orderDescription` (ct, nct)
- `cycles` (eq, ne, gt, ge, lt, le)
- `leftcycles` (eq, ne, gt, ge, lt, le)
- `createdAt` (eq, ne, gt, ge, lt, le)
- `updatedOn` (eq, ne, gt, ge, lt, le)
- `vendorNumber` (ne, eq, ct, nct)
- `name` (ne, eq, ct, nct)
- `phone` (ne, eq, ct, nct)
- `email` (ne, eq, ct, nct)
- `address` (ne, eq, ct, nct)
- `remitAddress` (ct, nct)
- `city` (ne, eq, ct, nct)
- `state` (ne, eq, ct, nct)
- `country` (ne, eq, ct, nct)
- `zip` (ne, eq, ct, nct)

**Accepted comparison operators:**
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

<details><summary><code>$client-&gt;query-&gt;listTransactions($entry, $request) -> ?QueryResponseTransactions</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of transactions for a paypoint. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.

By default, this endpoint returns only transactions from the last 60 days. To query transactions outside of this period, include `transactionDate` filters.

These request parameters filter for transactions between April 1, 2024 and April 9, 2024.

```bash
curl -X GET https://api-sandbox.payabli.com/api/Query/transactions/8cfec329267?limitRecord=20&fromRecord=0&transactionDate(ge)=2024-04-01T00:00:00&transactionDate(le)=2024-04-09T23:59:59 \
  -H 'requestToken: <API TOKEN>'
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

- `transactionDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct, in, nin)
- `gatewayTransId` (ne, eq, ct, nct)
- `orderId` (ne, eq)
- `scheduleId` (ne, eq)
- `returnId` (ne, eq)
- `refundId` (ne, eq)
- `rejectId` (ne, eq)
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
- `binCardType` (eq, ne, in, nin). Filters by card type for card transactions. Accepts `CREDIT`, `DEBIT`, or `PREPAID`. Case-insensitive.
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
- `DeviceEntryMode` (eq, ne, in, nin). Filters by how the device read the card: `Chip`, `Contactless`, `Swipe`, `Manual`, `Fallback`, or `None`. Case-insensitive. Separate multiple values with `|`, for example `DeviceEntryMode(in)=Chip|Contactless`. `ne` and `nin` also return transactions with no entry mode, such as non-device transactions. An unrecognized value is ignored, so the filter isn't applied.
- `AchSecCode` ( ct, nct, in, nin, eq, ne)
- `AchHolderType` (ct, nct, in, nin, eq, and ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name related to customer data
- 'invoiceAdditional-xxx' (ne, eq, ct, nct) where xxx is the additional field name related to invoice data

**Accepted comparison operators:**
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

<details><summary><code>$client-&gt;query-&gt;listTransactionsOrg($orgId, $request) -> ?QueryResponseTransactions</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of transactions for an organization. Use filters to limit results. Include the `exportFormat` query parameter to return the results as a file instead of a JSON response.

By default, this endpoint returns only transactions from the last 60 days. To query transactions outside of this period, include `transactionDate` filters.

These request parameters filter for transactions between April 1, 2024 and April 9, 2024.

```bash
curl -X GET "https://api-sandbox.payabli.com/api/Query/transactions/org/1?limitRecord=20&fromRecord=0&transactionDate(ge)=2024-04-01T00:00:00&transactionDate(le)=2024-04-09T23:59:59" \
  -H 'requestToken: <API TOKEN>'
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.

**Accepted field names:**

- `transactionDate` (gt, ge, lt, le, eq, ne)
- `transId` (ne, eq, ct, nct, in, nin)
- `gatewayTransId` (ne, eq, ct, nct)
- `orderId` (ne, eq)
- `scheduleId` (ne, eq)
- `returnId` (ne, eq)
- `refundId` (ne, eq)
- `rejectId` (ne, eq)
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
- `binCardType` (eq, ne, in, nin). Filters by card type for card transactions. Accepts `CREDIT`, `DEBIT`, or `PREPAID`. Case-insensitive.
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
- `DeviceEntryMode` (eq, ne, in, nin). Filters by how the device read the card: `Chip`, `Contactless`, `Swipe`, `Manual`, `Fallback`, or `None`. Case-insensitive. Separate multiple values with `|`, for example `DeviceEntryMode(in)=Chip|Contactless`. `ne` and `nin` also return transactions with no entry mode, such as non-device transactions. An unrecognized value is ignored, so the filter isn't applied.
- `AchSecCode` ( ct, nct, in, nin, eq, ne)
- `AchHolderType`` (ct, nct, in, nin, eq, and ne)
- `additional-xxx` (ne, eq, ct, nct) where xxx is the additional field name related to customer data
- 'invoiceAdditional-xxx' (ne, eq, ct, nct) where xxx is the additional field name related to invoice data

**Accepted comparison operators:**
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

<details><summary><code>$client-&gt;query-&gt;listTransferDetails($entry, $transferId, $request) -> ?QueryTransferDetailResponse</code></summary>
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
    '8cfec329267',
    4521,
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$transferId:** `int` — The numeric identifier for the transfer, assigned by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before starting to collect the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — Max number of records to return for the query. Use `0` or negative value to return all records. Defaults to 20.
    
</dd>
</dl>

<dl>
<dd>

**$parameters:** `?array` 

Collection of field names, conditions, and values used to filter
the query.

<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions
Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference)
for more information.


**Accepted field names:**

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

<details><summary><code>$client-&gt;query-&gt;listTransfers($entry, $request) -> ?TransferQueryResponse</code></summary>
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
    '8cfec329267',
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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
Accepted field names:

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

<details><summary><code>$client-&gt;query-&gt;listTransfersOrg($orgId, $request) -> ?TransferQueryResponse</code></summary>
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

**$orgId:** `int` — Organization ID. Unique identifier assigned to an org by Payabli.
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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
Accepted field names:

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

<details><summary><code>$client-&gt;query-&gt;listTransfersOutOrg($orgId, $request) -> ?TransferOutQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of outbound transfers for an organization. Use filters to limit results.
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
$client->query->listTransfersOutOrg(
    123,
    new ListTransfersOutOrgRequest([
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

Collection of field names, conditions, and values used to filter the query. See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for more information.
<Info>
  **You must remove `parameters=` from the request before you send it, otherwise Payabli will ignore the filters.**

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client.

  For example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
Accepted field names:

  - `transferDate` (gt, ge, lt, le, eq, ne)
  - `grossAmount` (gt, ge, lt, le, eq, ne)
  - `returnedAmount` (gt, ge, lt, le, eq, ne)
  - `billingFeeAmount` (gt, ge, lt, le, eq, ne)
  - `netFundedAmount` (gt, ge, lt, le, eq, ne)
  - `processor` (ne, eq, ct, nct)
  - `transferStatus` (ne, eq, in, nin)
  - `transferId` (ne, eq, in, nin)
  - `paypointLegalName` (ne, eq, ct, nct)
  - `paypointDbaName` (ne, eq, ct, nct)
  - `batchNumber` (ne, eq, ct, nct)
  - `batchId` (ne, eq, in, nin)
  - `detailType` (eq, ne, in, nin, ct, nct)
  - `detailMethod` (eq, ne, in, nin, ct, nct)
  - `paymentId` (ne, eq, in, nin): The payout's payment ID. Returns every transfer linked to that payout: the payout transfer, any refund and stale check refund transfers, and the billing fee transfer.
    
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

<details><summary><code>$client-&gt;query-&gt;listTransfersOutPaypoint($entry, $request) -> ?TransferOutQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of outbound transfers for a paypoint. Use filters to limit results.
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
$client->query->listTransfersOutPaypoint(
    '8cfec329267',
    new ListTransfersOutPaypointRequest([
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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
Accepted field names:

  - `transferDate` (gt, ge, lt, le, eq, ne)
  - `grossAmount` (gt, ge, lt, le, eq, ne)
  - `returnedAmount` (gt, ge, lt, le, eq, ne)
  - `billingFeeAmount` (gt, ge, lt, le, eq, ne)
  - `netFundedAmount` (gt, ge, lt, le, eq, ne)
  - `processor` (ne, eq, ct, nct)
  - `transferStatus` (ne, eq, in, nin)
  - `transferId` (ne, eq, in, nin)
  - `paypointLegalName` (ne, eq, ct, nct)
  - `paypointDbaName` (ne, eq, ct, nct)
  - `batchNumber` (ne, eq, ct, nct)
  - `batchId` (ne, eq, in, nin)
  - `detailType` (eq, ne, in, nin, ct, nct)
  - `detailMethod` (eq, ne, in, nin, ct, nct)
  - `paymentId` (ne, eq, in, nin): The payout's payment ID. Returns every transfer linked to that payout: the payout transfer, any refund and stale check refund transfers, and the billing fee transfer.
    
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

<details><summary><code>$client-&gt;query-&gt;listTransferDetailsOut($entry, $transferId, $request) -> ?TransferOutDetailQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve details for a specific outbound transfer. Use filters to limit results.
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
$client->query->listTransferDetailsOut(
    '8cfec329267',
    4521,
    new ListTransferDetailsOutRequest([
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$transferId:** `int` — The numeric identifier for the transfer, assigned by Payabli.
    
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
Accepted field names:

  - `grossAmount` (gt, ge, lt, le, eq, ne)
  - `returnedAmount` (gt, ge, lt, le, eq, ne)
  - `billingFeeAmount` (gt, ge, lt, le, eq, ne)
  - `netFundedAmount` (gt, ge, lt, le, eq, ne)
  - `adjustmentAmount` (gt, ge, lt, le, eq, ne)
  - `transactionId` (eq, ne, in, nin)
  - `category` (eq, ne, ct, nct)
  - `type` (eq, ne, in, nin)
  - `method` (eq, ne, in, nin)
  - `walletType` (eq, ne, in, nin)
  - `splitFundingAmount` (gt, ge, lt, le, eq, ne)
    
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

<details><summary><code>$client-&gt;query-&gt;listUsersOrg($orgId, $request) -> ?QueryUserResponse</code></summary>
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**

- `createdDate` (gt, ge, lt, le, eq, ne)
- `name`  (ne, eq, ct, nct)
- `email`  (ne, eq, ct, nct)
- `status`   (in, nin, eq, ne)
- `role.xxx`  (ne, eq, ct, nct) where xxx is the role field: `roleLabel` or `roleValue`

**Accepted comparison operators - enclosed between parentheses:**

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

**Accepted parameters:**
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

<details><summary><code>$client-&gt;query-&gt;listUsersPaypoint($entry, $request) -> ?QueryUserResponse</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**

- `createdDate` (gt, ge, lt, le, eq, ne)
- `name`  (ne, eq, ct, nct)
- `email`  (ne, eq, ct, nct)
- `status`   (in, nin, eq, ne)
- `role.xxx`  (ne, eq, ct, nct) where xxx is the role field: `roleLabel` or `roleValue`

**Accepted comparison operators - enclosed between parentheses:**

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

**Accepted parameters:**
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

<details><summary><code>$client-&gt;query-&gt;listVendors($entry, $request) -> ?QueryResponseVendors</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `method` (in, nin, eq, ne)
- `enrollmentStatus` (in,nin, eq, ne)
- `status` (in, nin, eq, ne)
- `vendorNumber` (ct, nct, eq, ne)
- `name` (ct, nct, eq, ne)
- `ein` (ct, nct, eq, ne)
- `phone` (ct, nct, eq, ne)
- `email` (ct, nct, eq, ne)
- `remitEmail` (ct, nct, eq, ne)
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;query-&gt;listVendorsOrg($orgId, $request) -> ?QueryResponseVendors</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `method` (in, nin, eq, ne)
- `enrollmentStatus` (in,nin, eq, ne)
- `status` (in, nin, eq, ne)
- `vendorNumber` (ct, nct, eq, ne)
- `name` (ct, nct, eq, ne)
- `ein` (ct, nct, eq, ne)
- `phone` (ct, nct, eq, ne)
- `email` (ct, nct, eq, ne)
- `remitEmail` (ct, nct, eq, ne)
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;query-&gt;listVcards($entry, $request) -> ?VCardQueryResponse</code></summary>
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
Accepted field names:

  - `status` (eq, ne, ct, nct, sw, ew)
  - `createdAt` (gt, ge, lt, le, eq, ne)
  - `cardToken` (ct, nct, eq, ne)
  - `lastFour` (ct, nct, eq, ne)
  - `expirationDate` (ct, nct, eq, ne)
  - `payoutId` (eq, ne, gt, ge, lt, le)
  - `vendorId` (eq, ne, gt, ge, lt, le)
  - `miscData1` (ct, nct, eq, ne)
  - `miscData2` (ct, nct, eq, ne)
  - `currentUses` (gt, ge, lt, le, eq, ne)
  - `amount` (gt, ge, lt, le, eq, ne)
  - `balance` (gt, ge, lt, le, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `orgName` (eq, ne, ct, nct, sw, ew)
  - `externalPaypointId` (ct, nct, eq, ne)
  - `paypointId` (eq, ne, gt, ge, lt, le)
  - `cardType` (eq, ne, gt, ge, lt, le)

Accepted comparison operators - enclosed between parentheses:

  - eq or empty => equal
  - gt => greater than
  - ge => greater or equal
  - lt => less than
  - le => less or equal
  - ne => not equal
  - ct => contains
  - nct => not contains
  - sw => starts with
  - ew => ends with
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

<details><summary><code>$client-&gt;query-&gt;listVcardsTransactions($entry, $request) -> ?VCardTransactionQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of virtual card transactions for an entrypoint. Use filters to limit results.
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
$client->query->listVcardsTransactions(
    '8cfec329267',
    new ListVcardsTransactionsRequest([
        'fromRecord' => 0,
        'limitRecord' => 20,
        'sortBy' => 'desc(CreatedOn)',
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/vcardsTransactions/8cfec329267?parameters=transactionAmount(gt)=100&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/vcardsTransactions/8cfec329267?transactionAmount(gt)=100&limitRecord=20
</Info>

Accepted field names:

  - `identifier` (eq, ne, ct, nct)
  - `transactionType` (eq, ne, ct, nct)
  - `transactionStatus` (eq, ne, ct, nct, in, nin)
  - `transactionAmount` (eq, ne, gt, ge, lt, le, ct, nct)
  - `transactionCreatedOn` (eq, ne, gt, ge, lt, le)
  - `cardToken` (ct, nct, eq, ne)
  - `lastFour` (ct, nct, eq, ne)
  - `expirationDate` (ct, nct, eq, ne)
  - `mcc` (ct, nct, eq, ne)
  - `payoutId` (gt, lt, eq, ne)
  - `customerId` (gt, lt, eq, ne)
  - `vendorId` (gt, lt, eq, ne)
  - `miscData1` (ct, nct, eq, ne)
  - `miscData2` (ct, nct, eq, ne)
  - `currentUses` (gt, ge, lt, le, eq, ne)
  - `amount` (gt, ge, lt, le, eq, ne)
  - `balance` (gt, ge, lt, le, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct, in, nin)
  - `externalPaypointID` (ct, nct, eq, ne)
  - `paypointId` (gt, lt, eq, ne)

Accepted comparison operators - enclosed between parentheses:

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

<details><summary><code>$client-&gt;query-&gt;listVcardsTransactionsOrg($orgId, $request) -> ?VCardTransactionQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a list of virtual card transactions for an organization. Use filters to limit results.
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
$client->query->listVcardsTransactionsOrg(
    123,
    new ListVcardsTransactionsOrgRequest([
        'fromRecord' => 0,
        'limitRecord' => 20,
        'sortBy' => 'desc(CreatedOn)',
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/vcardsTransactions/org/236?parameters=transactionAmount(gt)=100&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/vcardsTransactions/org/236?transactionAmount(gt)=100&limitRecord=20
</Info>

Accepted field names:

  - `identifier` (eq, ne, ct, nct)
  - `transactionType` (eq, ne, ct, nct)
  - `transactionStatus` (eq, ne, ct, nct, in, nin)
  - `transactionAmount` (eq, ne, gt, ge, lt, le, ct, nct)
  - `transactionCreatedOn` (eq, ne, gt, ge, lt, le)
  - `cardToken` (ct, nct, eq, ne)
  - `lastFour` (ct, nct, eq, ne)
  - `expirationDate` (ct, nct, eq, ne)
  - `mcc` (ct, nct, eq, ne)
  - `payoutId` (gt, lt, eq, ne)
  - `customerId` (gt, lt, eq, ne)
  - `vendorId` (gt, lt, eq, ne)
  - `miscData1` (ct, nct, eq, ne)
  - `miscData2` (ct, nct, eq, ne)
  - `currentUses` (gt, ge, lt, le, eq, ne)
  - `amount` (gt, ge, lt, le, eq, ne)
  - `balance` (gt, ge, lt, le, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct, in, nin)
  - `externalPaypointID` (ct, nct, eq, ne)
  - `paypointId` (gt, lt, eq, ne)

Accepted comparison operators - enclosed between parentheses:

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

<details><summary><code>$client-&gt;query-&gt;listVcardsOrg($orgId, $request) -> ?VCardQueryResponse</code></summary>
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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
Accepted field names:

  - `status` (eq, ne, ct, nct, sw, ew)
  - `createdAt` (gt, ge, lt, le, eq, ne)
  - `cardToken` (ct, nct, eq, ne)
  - `lastFour` (ct, nct, eq, ne)
  - `expirationDate` (ct, nct, eq, ne)
  - `payoutId` (eq, ne, gt, ge, lt, le)
  - `vendorId` (eq, ne, gt, ge, lt, le)
  - `miscData1` (ct, nct, eq, ne)
  - `miscData2` (ct, nct, eq, ne)
  - `currentUses` (gt, ge, lt, le, eq, ne)
  - `amount` (gt, ge, lt, le, eq, ne)
  - `balance` (gt, ge, lt, le, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `orgName` (eq, ne, ct, nct, sw, ew)
  - `externalPaypointId` (ct, nct, eq, ne)
  - `paypointId` (eq, ne, gt, ge, lt, le)
  - `cardType` (eq, ne, gt, ge, lt, le)

Accepted comparison operators - enclosed between parentheses:

  - eq or empty => equal
  - gt => greater than
  - ge => greater or equal
  - lt => less than
  - le => less or equal
  - ne => not equal
  - ct => contains
  - nct => not contains
  - sw => starts with
  - ew => ends with
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

## Ocr
<details><summary><code>$client-&gt;ocr-&gt;ocrDocumentForm($typeResult, $request) -> ?PayabliApiResponseOcr</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use this endpoint to upload a document file for OCR processing as `multipart/form-data`, with the file in a field named `file`. The accepted file formats include PDF, JPG, JPEG, PNG, and GIF. Specify the desired type of result (either 'bill' or 'invoice') in the path parameter `typeResult`. The response will contain the OCR processing results, including extracted data such as bill number, vendor information, bill items, and more. To send the file as a Base64-encoded string in a JSON body instead, use `ocrDocumentJson`.
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
    new OcrDocumentFormRequest([
        'file' => File::createFromString("example_file", "example_file"),
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

**$typeResult:** `string` — The type of object to create in Payabli. Accepted values are `bill` and `invoice`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;ocr-&gt;ocrDocumentJson($typeResult, $request) -> ?PayabliApiResponseOcr</code></summary>
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
    new OcrDocumentJsonRequest([]),
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

**$typeResult:** `string` — The type of object to create in Payabli. Accepted values are `bill` and `invoice`.
    
</dd>
</dl>

<dl>
<dd>

**$ftype:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$filename:** `?string` — The name of the file to be uploaded
    
</dd>
</dl>

<dl>
<dd>

**$furl:** `?string` — Optional URL link to the file
    
</dd>
</dl>

<dl>
<dd>

**$fContent:** `?string` — Base64-encoded file content
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Notificationlogs
<details><summary><code>$client-&gt;notificationlogs-&gt;searchNotificationLogs($request) -> ?array</code></summary>
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
        'startDate' => new DateTime('2024-01-01T00:00:00Z'),
        'endDate' => new DateTime('2024-01-31T23:59:59Z'),
        'notificationEvent' => 'approvedpayment',
        'succeeded' => true,
        'orgId' => 123,
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

**$pageSize:** `?int` — Number of records on each response page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — The page number to retrieve. Defaults to 1 if not provided.
    
</dd>
</dl>

<dl>
<dd>

**$startDate:** `DateTime` — The start date for the search. Can't be more than 30 days before `endDate`.
    
</dd>
</dl>

<dl>
<dd>

**$endDate:** `DateTime` — The end date for the search. Can't be more than 30 days after `startDate`.
    
</dd>
</dl>

<dl>
<dd>

**$notificationEvent:** `?string` — The event to filter by, such as `approvedpayment`. Case-insensitive.
    
</dd>
</dl>

<dl>
<dd>

**$succeeded:** `?bool` — Filter by delivery outcome. Set to `false` to return only failed notifications.
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `?int` — The ID of the organization to filter by. Either `orgId` or `paypointId` is required.
    
</dd>
</dl>

<dl>
<dd>

**$paypointId:** `?int` — The ID of the paypoint to filter by. Either `orgId` or `paypointId` is required.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;notificationlogs-&gt;getNotificationLog($uuid) -> ?NotificationLogDetail</code></summary>
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

<details><summary><code>$client-&gt;notificationlogs-&gt;retryNotificationLog($uuid) -> ?NotificationRetryResponse</code></summary>
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

<details><summary><code>$client-&gt;notificationlogs-&gt;bulkRetryNotificationLogs($request) -> string</code></summary>
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
        'string',
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

**$request:** `array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Device
<details><summary><code>$client-&gt;device-&gt;challenge($entry) -> ?DeviceChallengeResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generates a one-time, 6-digit verification code for activating a
semi-integrated card-present device in a paypoint. This endpoint is
for AXIUM devices only. After calling this endpoint, an operator
enters the returned code on the device's terminal, along with a
device name, to register the device to the paypoint resolved from
`{entry}`.

A code expires 5 minutes after it's issued. A paypoint can have several
codes active at once — for example, when activating a batch of devices —
and a code binds to whichever device enters it first.

Authenticate with an OAuth2 bearer token that has the `device_registry` scope.
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
$client->device->challenge(
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TapToPay
<details><summary><code>$client-&gt;taptopay-&gt;activationChallenge($request) -> ?TapToPayActivationChallengeResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Issues a short-lived activation code for a Tap to Pay device in the
`Pending` state. This endpoint is for Tap to Pay devices only.
Deliver the code to the device to complete activation.

A code is valid for 30 minutes after it's issued. Calling this
endpoint again for the same device before the code expires returns
the same code, with `alreadyIssued` set to `true`, instead of
generating a new one. A new code is only generated when no valid
code exists.

Authenticate with an OAuth2 bearer token that has the `pos_create`
permission. See [Accept Tap to Pay payments](/guides/pay-in-developer-tap-to-pay)
for the full integration guide.
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
$client->taptopay->activationChallenge(
    new TapToPayActivationChallengeRequest([
        'entry' => '8cfec329267',
        'deviceId' => '499585-389fj484-3jcj8hj3',
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

**$deviceId:** `string` — The device identifier (`poiId`) returned when the device was registered.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Cloud
<details><summary><code>$client-&gt;cloud-&gt;addDevice($entry, $request) -> ?AddDeviceResponse</code></summary>
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
        'description' => 'Front Desk POS',
        'registrationCode' => 'YS7DS5',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;cloud-&gt;removeDevice($entry, $deviceId) -> ?RemoveDeviceResponse</code></summary>
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
    '8cfec329267',
    '499585-389fj484-3jcj8hj3',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

<details><summary><code>$client-&gt;cloud-&gt;historyDevice($entry, $deviceId) -> ?CloudQueryApiResponse</code></summary>
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
    '8cfec329267',
    '499585-389fj484-3jcj8hj3',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

<details><summary><code>$client-&gt;cloud-&gt;listDevice($entry, $request) -> ?CloudQueryApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Use [List devices by paypoint](/developers/api-reference/get-list-of-devices-for-a-paypoint) instead, which supports filters, sorting, and pagination.

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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

## LineItem
<details><summary><code>$client-&gt;lineItem-&gt;addItem($entry, $request) -> ?PayabliApiResponse6</code></summary>
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
    '8cfec329267',
    new AddItemRequest([
        'body' => new LineItem([
            'itemCommodityCode' => '010',
            'itemCost' => 12.45,
            'itemDescription' => 'Deposit for materials',
            'itemMode' => 0,
            'itemProductCode' => 'M-DEPOSIT',
            'itemProductName' => 'Materials deposit',
            'itemQty' => 1,
            'itemUnitOfMeasure' => 'SqFt',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

<details><summary><code>$client-&gt;lineItem-&gt;getItem($lineItemId) -> ?LineItemQueryRecord</code></summary>
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

<details><summary><code>$client-&gt;lineItem-&gt;updateItem($lineItemId, $request) -> ?PayabliApiResponse6</code></summary>
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

<details><summary><code>$client-&gt;lineItem-&gt;deleteItem($lineItemId) -> ?DeleteItemResponse</code></summary>
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

<details><summary><code>$client-&gt;lineItem-&gt;listLineItems($entry, $request) -> ?QueryResponseItems</code></summary>
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20

</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**

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

Accepted comparison operators - enclosed between parentheses:

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

Accepted parameters:
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

## Businesses
<details><summary><code>$client-&gt;businesses-&gt;listBusinesses($request) -> ?ListBusinessesEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists businesses with optional filtering and pagination.
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
$client->businesses->listBusinesses(
    new ListBusinessesBusinessesRequest([
        'limit' => 1,
        'page' => 1,
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

**$status:** `?string` — Filter by business status.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Filter by legal name.
    
</dd>
</dl>

<dl>
<dd>

**$merchantCatCode:** `?string` — Filter by merchant category code.
    
</dd>
</dl>

<dl>
<dd>

**$legalStructure:** `?string` — Filter by legal structure.
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page number to return.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — Field to sort by.
    
</dd>
</dl>

<dl>
<dd>

**$sortOrder:** `?string` — Sort direction.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;createBusiness($request) -> ?BusinessCreatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a business, the legal entity behind a paypoint. New businesses
start in `Draft`. Set `parentReference` to the organization 
the business belongs to, or omit it to use the organization your
credential belongs to.
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
$client->businesses->createBusiness(
    new CreateBusinessRequest([
        'externalId' => 'rg-001',
        'legalName' => 'Rose Gardens LLC',
        'legalStructure' => CreateBusinessRequestLegalStructure::Llc->value,
        'website' => 'https://example.com',
        'merchantCatCode' => '5814',
        'phone' => [
            '3055551212',
        ],
        'emails' => [
            'ops@example.com',
        ],
        'paymentMethods' => [
            new BusinessPaymentMethod([
                'type' => 'bank_account',
                'name' => 'Operating account',
                'financialInstitution' => 'Bank of Example',
                'ownerType' => 'business',
                'accountType' => 'checking',
                'accountNumber' => '123456789',
                'routingNumber' => '021000021',
                'usage' => [
                    'deposits',
                    'billing',
                ],
                'isDefault' => true,
            ]),
            new BusinessPaymentMethod([
                'type' => 'bank_account',
                'name' => 'Payout account',
                'financialInstitution' => 'Bank of Example',
                'ownerType' => 'business',
                'accountType' => 'checking',
                'accountNumber' => '987654321',
                'routingNumber' => '021000021',
                'usage' => [
                    'payOutFunding',
                ],
                'isDefault' => false,
            ]),
        ],
        'taxReference' => '477498993',
        'parentReference' => '8cfec329267',
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

**$request:** `CreateBusinessRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;getBusiness($businessReference) -> ?BusinessDetailEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a business by reference. Sensitive fields such as `taxReference` are masked.
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
$client->businesses->getBusiness(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;deactivateBusiness($businessReference, $request) -> ?BusinessDeactivatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deactivates a business. This is a soft delete: the business moves to
`Deactivated` and the record is kept.
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
$client->businesses->deactivateBusiness(
    '019fed33-615d-77b6-afaa-46e7ac9bf36e',
    new DeactivateBusinessRequest([
        'reason' => 'Duplicate record',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$reason:** `?string` — Optional reason for deactivation (max 500 characters).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;updateBusiness($businessReference, $request) -> ?BusinessUpdatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Applies a partial update to a business. Send only the fields you want to change.
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
$client->businesses->updateBusiness(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    new UpdateBusinessRequest([
        'website' => 'https://example.org',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$externalId:** `?string` — Your own identifier for the business.
    
</dd>
</dl>

<dl>
<dd>

**$legalName:** `?string` — The registered legal name of the business.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — A free-text description of the business.
    
</dd>
</dl>

<dl>
<dd>

**$legalStructure:** `?string` — The business's legal structure. Accepts the same values as create, and normalizes to a canonical value on read.
    
</dd>
</dl>

<dl>
<dd>

**$stockSymbol:** `?string` — The stock ticker symbol, if the business is publicly traded.
    
</dd>
</dl>

<dl>
<dd>

**$incorporationState:** `?string` — The state where the business is incorporated.
    
</dd>
</dl>

<dl>
<dd>

**$taxIdCountry:** `?string` — The country that issued the business's tax identifier.
    
</dd>
</dl>

<dl>
<dd>

**$establishedDate:** `?DateTime` — The date the business was established.
    
</dd>
</dl>

<dl>
<dd>

**$numberOfEmployees:** `?int` — The number of employees.
    
</dd>
</dl>

<dl>
<dd>

**$annualRevenue:** `?float` — The business's annual revenue.
    
</dd>
</dl>

<dl>
<dd>

**$website:** `?string` — The business's website URL.
    
</dd>
</dl>

<dl>
<dd>

**$merchantCatCode:** `?string` — The merchant category code (MCC) that classifies the business.
    
</dd>
</dl>

<dl>
<dd>

**$timezone:** `?string` — The business's time zone.
    
</dd>
</dl>

<dl>
<dd>

**$phone:** `?array` — Phone numbers for the business.
    
</dd>
</dl>

<dl>
<dd>

**$emails:** `?array` — Email addresses for the business.
    
</dd>
</dl>

<dl>
<dd>

**$operatingSeasons:** `?array` — The seasons the business operates in. Values are case-insensitive on input and returned capitalized.
    
</dd>
</dl>

<dl>
<dd>

**$addressDetails:** `?array` 

A non-empty `addressDetails` is rejected on update. Manage a business's
addresses through the `/v2/businesses/{businessReference}/addresses`
endpoints instead. An omitted field or an empty array is accepted as
"no address change requested."
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethods:** `?array` — The bank accounts and cards attached to the business.
    
</dd>
</dl>

<dl>
<dd>

**$customData:** `?array` 

Key-value data to merge into the business's stored `customData`.
Payabli stores the applicant's answers to a boarding template's
custom questions under the `templateAnswers` key.

When you update a business, Payabli merges `customData` into the
stored value, following JSON Merge Patch (RFC 7396). Keys you
don't send are kept at every depth, and nested objects merge key
by key. Strings, numbers, Boolean values, and arrays replace the
stored value, and arrays aren't merged. Send a key as `null` to
delete it, such as `{"crmId": null}`. A `customData` that isn't
an object, such as an array, replaces the stored value whole.
Leave out `customData` to keep it as is.

The `customData` you send can be up to 65,536 bytes serialized.
The limit applies to the request, not to the merged result.
    
</dd>
</dl>

<dl>
<dd>

**$isForeignOwned:** `?bool` — Whether the business is foreign-owned.
    
</dd>
</dl>

<dl>
<dd>

**$isTaxExempt:** `?bool` — Whether the business is tax-exempt.
    
</dd>
</dl>

<dl>
<dd>

**$taxExemptClassification:** `?string` — The business's tax-exempt classification, such as `501(c)(3)`.
    
</dd>
</dl>

<dl>
<dd>

**$processingMetrics:** `?ProcessingMetrics` 
    
</dd>
</dl>

<dl>
<dd>

**$payoutMetrics:** `?PayoutMetrics` 
    
</dd>
</dl>

<dl>
<dd>

**$license:** `?string` — The business's license number.
    
</dd>
</dl>

<dl>
<dd>

**$licenseState:** `?string` — The state that issued the business's license.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;getBusinessUnmasked($businessReference) -> ?BusinessDetailEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a business by reference with sensitive fields unmasked.
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
$client->businesses->getBusinessUnmasked(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;listBusinessAddresses($businessReference) -> ?BusinessAddressListEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the addresses on a business. Each address is identified by its `businessAddressReference`.
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
$client->businesses->listBusinessAddresses(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;createBusinessAddress($businessReference, $request) -> ?BusinessAddressEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Adds an address to a business. Returns the new address and its `businessAddressReference`.
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
$client->businesses->createBusinessAddress(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    new CreateBusinessAddressRequest([
        'type' => AddressType::Mailing->value,
        'location' => BusinessAddressLocation::Warehouse->value,
        'addressLine1' => '202 Warehouse Ln',
        'cityLocality' => 'Austin',
        'stateProvince' => 'TX',
        'postalCode' => '73302',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$type:** `string` — The address role.
    
</dd>
</dl>

<dl>
<dd>

**$location:** `?string` — The physical use of the address.
    
</dd>
</dl>

<dl>
<dd>

**$addressLine1:** `string` — The first line of the street address.
    
</dd>
</dl>

<dl>
<dd>

**$addressLine2:** `?string` — The second line of the street address.
    
</dd>
</dl>

<dl>
<dd>

**$cityLocality:** `string` — The city or locality.
    
</dd>
</dl>

<dl>
<dd>

**$stateProvince:** `string` — The state or province.
    
</dd>
</dl>

<dl>
<dd>

**$postalCode:** `string` — The postal or ZIP code.
    
</dd>
</dl>

<dl>
<dd>

**$country:** `string` — The two-character ISO country code.
    
</dd>
</dl>

<dl>
<dd>

**$floor:** `?string` — The floor, if applicable.
    
</dd>
</dl>

<dl>
<dd>

**$suiteApartNumber:** `?string` — The suite or apartment number, if applicable.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;getBusinessAddress($businessReference, $businessAddressReference) -> ?BusinessAddressEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a single business address by its `businessAddressReference`.
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
$client->businesses->getBusinessAddress(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    '019fed1a-84a6-7043-a6c0-e8aa2d4bec36',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$businessAddressReference:** `string` — The business address reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;deleteBusinessAddress($businessReference, $businessAddressReference) -> ?BusinessAddressDeletedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes an address from a business.
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
$client->businesses->deleteBusinessAddress(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    '019fed1a-67d6-768a-b4cc-29d4299e21d9',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$businessAddressReference:** `string` — The business address reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;updateBusinessAddress($businessReference, $businessAddressReference, $request) -> ?BusinessAddressEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Applies a partial update to a business address. Send only the fields you want to change; omitted fields are kept.
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
$client->businesses->updateBusinessAddress(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    '019fed1a-67d6-768a-b4cc-29d4299e21d9',
    new UpdateBusinessAddressRequest([
        'type' => AddressType::Billing->value,
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$businessAddressReference:** `string` — The business address reference.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` — The address role.
    
</dd>
</dl>

<dl>
<dd>

**$location:** `?string` — The physical use of the address.
    
</dd>
</dl>

<dl>
<dd>

**$addressLine1:** `?string` — The first line of the street address.
    
</dd>
</dl>

<dl>
<dd>

**$addressLine2:** `?string` — The second line of the street address.
    
</dd>
</dl>

<dl>
<dd>

**$cityLocality:** `?string` — The city or locality.
    
</dd>
</dl>

<dl>
<dd>

**$stateProvince:** `?string` — The state or province.
    
</dd>
</dl>

<dl>
<dd>

**$postalCode:** `?string` — The postal or ZIP code.
    
</dd>
</dl>

<dl>
<dd>

**$country:** `?string` — The two-character ISO country code.
    
</dd>
</dl>

<dl>
<dd>

**$floor:** `?string` — The floor, if applicable.
    
</dd>
</dl>

<dl>
<dd>

**$suiteApartNumber:** `?string` — The suite or apartment number, if applicable.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;listBusinessPeople($businessReference) -> ?BusinessPersonListEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the people linked to a business, each with the relationship's role, ownership, and relationship-scoped contact details.
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
$client->businesses->listBusinessPeople(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;linkBusinessPerson($businessReference, $request) -> ?BusinessPersonEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Links an existing person to a business, setting the relationship's role, ownership, primary-controller flag, contact fields, and addresses.
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
$client->businesses->linkBusinessPerson(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    new LinkBusinessPersonRequest([
        'personReference' => '01a0014d-ce1a-7110-9bac-c4c59647a88d',
        'personType' => PersonType::Owner->value,
        'ownershipPercentage' => 100,
        'isPrimaryController' => true,
        'isSigner' => true,
        'title' => 'CEO',
        'primaryEmail' => 'contact@example.com',
        'secondaryEmail' => 'contact.alt@example.net',
        'primaryPhoneNumber' => '3055551212',
        'secondaryPhoneNumber' => '3055559876',
        'billingAddress' => new PersonAddressRequest([
            'addressLine1' => '123 Main Street',
            'cityLocality' => 'Miami',
            'stateProvince' => 'FL',
            'postalCode' => '33101',
            'country' => 'US',
            'type' => PersonAddressType::Billing->value,
        ]),
        'mailingAddress' => new PersonAddressRequest([
            'addressLine1' => '456 Oak Avenue',
            'cityLocality' => 'Miami',
            'stateProvince' => 'FL',
            'postalCode' => '33102',
            'country' => 'US',
            'type' => PersonAddressType::Mailing->value,
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$personReference:** `string` — The reference of the person to link.
    
</dd>
</dl>

<dl>
<dd>

**$personType:** `?string` — The person's role on the business.
    
</dd>
</dl>

<dl>
<dd>

**$ownershipPercentage:** `?float` — The person's ownership percentage (0 to 100). Required when `personType` is `Owner`, and must be omitted for every other role. If the combined ownership would exceed 100%, the link is rejected with a `400`.
    
</dd>
</dl>

<dl>
<dd>

**$isPrimaryController:** `?bool` — Whether the person is the business's primary controller.
    
</dd>
</dl>

<dl>
<dd>

**$isSigner:** `?bool` 

Whether the person signs the business's boarding applications. Only an
owner can be the signer. Setting `isSigner` to `true` on a person with
another `personType` returns `400` with the message
`Only an owner can be the signer.` A business has one signer. Setting
`isSigner` to `true` on one person removes it from every other person
linked to the business.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` 

The person's job title at this business, such as `CEO` or
`Managing Member`, from 1 to 100 characters. A person linked to more than
one business can have a different title at each one. A blank value is
treated as not sent.
    
</dd>
</dl>

<dl>
<dd>

**$primaryEmail:** `?string` — The relationship's primary email address.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryEmail:** `?string` — The relationship's secondary email address.
    
</dd>
</dl>

<dl>
<dd>

**$primaryPhoneNumber:** `?string` — The relationship's primary phone number.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryPhoneNumber:** `?string` — The relationship's secondary phone number.
    
</dd>
</dl>

<dl>
<dd>

**$billingAddress:** `?PersonAddressRequest` — The billing address for the relationship.
    
</dd>
</dl>

<dl>
<dd>

**$mailingAddress:** `?PersonAddressRequest` — The mailing address for the relationship.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;getBusinessPerson($businessReference, $personReference) -> ?BusinessPersonEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a single business-person link by the person's reference.
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
$client->businesses->getBusinessPerson(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    '01a0014d-ce1a-7110-9bac-c4c59647a88d',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$personReference:** `string` — The person reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;unlinkBusinessPerson($businessReference, $personReference)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes the link between a person and a business. The person record itself isn't deleted.
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
$client->businesses->unlinkBusinessPerson(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    '01a0014d-ce1a-7110-9bac-c4c59647a88d',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$personReference:** `string` — The person reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;businesses-&gt;updateBusinessPerson($businessReference, $personReference, $request) -> ?BusinessPersonEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Applies a partial update to a business-person link. Send only the fields you want to change; omitted fields are kept.
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
$client->businesses->updateBusinessPerson(
    '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
    '01a0014d-ce1a-7110-9bac-c4c59647a88d',
    new UpdateBusinessPersonRequest([
        'isPrimaryController' => true,
        'primaryEmail' => 'updated.contact@example.com',
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

**$businessReference:** `string` — The business reference (`businessUuid`).
    
</dd>
</dl>

<dl>
<dd>

**$personReference:** `string` — The person reference.
    
</dd>
</dl>

<dl>
<dd>

**$personType:** `?string` — The person's role on the business.
    
</dd>
</dl>

<dl>
<dd>

**$ownershipPercentage:** `?float` — The person's ownership percentage (0 to 100).
    
</dd>
</dl>

<dl>
<dd>

**$isPrimaryController:** `?bool` — Whether the person is the business's primary controller.
    
</dd>
</dl>

<dl>
<dd>

**$isSigner:** `?bool` 

Whether the person signs the business's boarding applications. Only an
owner can be the signer. Setting `isSigner` to `true` on a person with
another `personType` returns `400` with the message
`Only an owner can be the signer.` Changing the signer's `personType`
away from `Owner` returns the same error. Setting it to `true` removes
it from every other person linked to the business. Setting it to
`false` leaves the business with no signer until you set another one.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` 

The person's job title at this business, from 1 to 100 characters. Updating it changes the title
for this business only. Omitting it, or sending `null` or a blank value,
keeps the stored title. You can replace a title, but you can't clear it.
    
</dd>
</dl>

<dl>
<dd>

**$primaryEmail:** `?string` — The relationship's primary email address.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryEmail:** `?string` — The relationship's secondary email address.
    
</dd>
</dl>

<dl>
<dd>

**$primaryPhoneNumber:** `?string` — The relationship's primary phone number.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryPhoneNumber:** `?string` — The relationship's secondary phone number.
    
</dd>
</dl>

<dl>
<dd>

**$billingAddress:** `?PersonAddressRequest` — The billing address for the relationship.
    
</dd>
</dl>

<dl>
<dd>

**$mailingAddress:** `?PersonAddressRequest` — The mailing address for the relationship.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## People
<details><summary><code>$client-&gt;people-&gt;listPeople($request) -> ?ListPeopleEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists people with optional filtering and pagination.
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
$client->people->listPeople(
    new ListPeoplePeopleRequest([
        'limit' => 1,
        'page' => 1,
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

**$name:** `?string` — Filter by name (partial match).
    
</dd>
</dl>

<dl>
<dd>

**$email:** `?string` — Filter by email (partial match).
    
</dd>
</dl>

<dl>
<dd>

**$verificationStatus:** `?string` — Comma-separated verification status filter.
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page number to return.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — Field to sort by.
    
</dd>
</dl>

<dl>
<dd>

**$sortOrder:** `?string` — Sort direction.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;people-&gt;createPerson($request) -> ?PersonDetailEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a person, an individual associated with a business such as an
owner, director, or signer. Include a `businessRelationship` object to
link the person to a business on create; the business reference, role
(`personType`), and `ownershipPercentage` go inside that object.

A person's job `title` and whether they're the signer (`isSigner`) also
belong to the business link, so send them inside `businessRelationship`.
A top-level `title` returns a `400` with the message
`title moved into the businessRelationship object; send them there instead of at the top level.`
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
$client->people->createPerson(
    new CreatePersonRequest([
        'firstName' => 'Marcus',
        'middleName' => 'James',
        'lastName' => 'Delgado',
        'primaryEmail' => 'marcus.delgado@example.com',
        'secondaryEmail' => 'm.delgado@example.net',
        'primaryPhoneNumber' => '3055551212',
        'secondaryPhoneNumber' => '3055559876',
        'dateOfBirth' => '1985-03-14',
        'ssn' => '412-55-9021',
        'nationality' => 'US',
        'driversLicenseNumber' => 'D1234567',
        'driversLicenseState' => 'FL',
        'externalId' => 'person-001',
        'customData' => [
            'department' => "finance",
        ],
        'addresses' => [
            new PersonAddressRequest([
                'addressLine1' => '123 Main Street',
                'addressLine2' => 'Suite 400',
                'cityLocality' => 'Miami',
                'stateProvince' => 'FL',
                'postalCode' => '33101',
                'country' => 'US',
                'type' => PersonAddressType::Legal->value,
            ]),
        ],
        'identificationDocuments' => [
            new IdentificationDocumentRequest([
                'type' => 'passport',
                'number' => 'X1234567',
                'issuingCountry' => 'US',
                'expirationDate' => '2030-06-30',
            ]),
        ],
        'businessRelationship' => new BusinessRelationshipRequest([
            'businessReference' => '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
            'personType' => PersonType::Owner->value,
            'ownershipPercentage' => 100,
            'isPrimaryController' => true,
            'isSigner' => true,
            'title' => 'CEO',
            'primaryEmail' => 'contact@example.com',
            'secondaryEmail' => 'contact.alt@example.net',
            'primaryPhoneNumber' => '3055551212',
            'secondaryPhoneNumber' => '3055559876',
            'billingAddress' => new PersonAddressRequest([
                'addressLine1' => '123 Main Street',
                'cityLocality' => 'Miami',
                'stateProvince' => 'FL',
                'postalCode' => '33101',
                'country' => 'US',
                'type' => PersonAddressType::Billing->value,
            ]),
            'mailingAddress' => new PersonAddressRequest([
                'addressLine1' => '456 Oak Avenue',
                'cityLocality' => 'Miami',
                'stateProvince' => 'FL',
                'postalCode' => '33102',
                'country' => 'US',
                'type' => PersonAddressType::Mailing->value,
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

**$firstName:** `string` — The person's first name.
    
</dd>
</dl>

<dl>
<dd>

**$middleName:** `?string` — The person's middle name.
    
</dd>
</dl>

<dl>
<dd>

**$lastName:** `string` — The person's last name.
    
</dd>
</dl>

<dl>
<dd>

**$primaryEmail:** `?string` — The person's primary email address.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryEmail:** `?string` — The person's secondary email address.
    
</dd>
</dl>

<dl>
<dd>

**$primaryPhoneNumber:** `?string` — The person's primary phone number.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryPhoneNumber:** `?string` — The person's secondary phone number.
    
</dd>
</dl>

<dl>
<dd>

**$dateOfBirth:** `?string` — The person's date of birth (`YYYY-MM-DD`).
    
</dd>
</dl>

<dl>
<dd>

**$ssn:** `?string` — The person's US Social Security Number, in `XXX-XX-XXXX` or `XXXXXXXXX` format. Applies when `nationality` is `US`, and needed to validate a US owner. Create doesn't enforce it. For any other nationality, send `nationalIdNumber` and `nationalIdIssuer` instead.
    
</dd>
</dl>

<dl>
<dd>

**$nationality:** `?string` — The person's nationality, as a two-letter ISO 3166-1 alpha-2 country code. Needed to validate an owner, but create doesn't enforce it. Nationality selects which identity number applies. `US` uses `ssn`, and any other value uses `nationalIdNumber` and `nationalIdIssuer`.
    
</dd>
</dl>

<dl>
<dd>

**$nationalIdNumber:** `?string` — The person's national identification number, for an individual whose `nationality` is not `US`. Send it with `nationalIdIssuer` when `nationality` is non-US. Create doesn't enforce it.
    
</dd>
</dl>

<dl>
<dd>

**$nationalIdIssuer:** `?string` — The authority that issued the national ID, for example the two-letter country code. Send it with `nationalIdNumber` when `nationality` is non-US. Create doesn't enforce it.
    
</dd>
</dl>

<dl>
<dd>

**$driversLicenseNumber:** `?string` — The person's driver's license number.
    
</dd>
</dl>

<dl>
<dd>

**$driversLicenseState:** `?string` — The two-letter state code for the driver's license.
    
</dd>
</dl>

<dl>
<dd>

**$externalId:** `?string` — Your own identifier for the person.
    
</dd>
</dl>

<dl>
<dd>

**$customData:** `?array` 

Arbitrary key-value data you attach to the person. Payabli
stores an owner's answers to a boarding template's custom
questions under the `templateAnswers` key.
    
</dd>
</dl>

<dl>
<dd>

**$addresses:** `?array` — Postal addresses associated with the person.
    
</dd>
</dl>

<dl>
<dd>

**$identificationDocuments:** `?array` — Government-issued identification documents for the person.
    
</dd>
</dl>

<dl>
<dd>

**$businessRelationship:** `?BusinessRelationshipRequest` 

Links the person to a business as you create them. The link's role,
ownership, primary-controller flag, contact fields, and addresses go here.
These relationship contact fields are separate from the person's own
top-level contact fields above.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;people-&gt;getPerson($personReference) -> ?PersonDetailEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a person by reference. Sensitive fields such as `ssn` are masked.
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
$client->people->getPerson(
    '01a0014d-ce1a-7110-9bac-c4c59647a88d',
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

**$personReference:** `string` — The person reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;people-&gt;updatePerson($personReference, $request) -> ?PersonUpdatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Applies a partial update to a person. Send only the fields you want to change.

A person's job title belongs to their business link, not the person. Sending `title` in any form, including `null`, returns a `400` with the message `title moved to the business relationship; update it with PATCH /api/v2/businesses/{businessReference}/people/{personReference}.`
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
$client->people->updatePerson(
    '01a0014d-ce1a-7110-9bac-c4c59647a88d',
    new UpdatePersonRequest([
        'primaryPhoneNumber' => '3055550199',
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

**$personReference:** `string` — The person reference.
    
</dd>
</dl>

<dl>
<dd>

**$firstName:** `?string` — The person's first name.
    
</dd>
</dl>

<dl>
<dd>

**$middleName:** `?string` — The person's middle name.
    
</dd>
</dl>

<dl>
<dd>

**$lastName:** `?string` — The person's last name.
    
</dd>
</dl>

<dl>
<dd>

**$primaryEmail:** `?string` — The person's primary email address.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryEmail:** `?string` — The person's secondary email address.
    
</dd>
</dl>

<dl>
<dd>

**$primaryPhoneNumber:** `?string` — The person's primary phone number.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryPhoneNumber:** `?string` — The person's secondary phone number.
    
</dd>
</dl>

<dl>
<dd>

**$nationality:** `?string` — The person's nationality, as a two-letter ISO 3166-1 alpha-2 country code. Nationality selects which identity number applies — `US` uses `ssn`, and any other value uses `nationalIdNumber` and `nationalIdIssuer`.
    
</dd>
</dl>

<dl>
<dd>

**$nationalIdIssuer:** `?string` — The authority that issued the national ID, used when `nationality` is not `US`.
    
</dd>
</dl>

<dl>
<dd>

**$driversLicenseNumber:** `?string` — The person's driver's license number.
    
</dd>
</dl>

<dl>
<dd>

**$driversLicenseState:** `?string` — The two-letter state code for the driver's license.
    
</dd>
</dl>

<dl>
<dd>

**$externalId:** `?string` — Your own identifier for the person.
    
</dd>
</dl>

<dl>
<dd>

**$customData:** `?array` 

Key-value data to merge into the person's stored `customData`.
Payabli stores an owner's answers to a boarding template's
custom questions under the `templateAnswers` key.

When you update a person, Payabli merges `customData` into the
stored value, following JSON Merge Patch (RFC 7396). Keys you
don't send are kept at every depth, and nested objects merge key
by key. Strings, numbers, Boolean values, and arrays replace the
stored value, and arrays aren't merged. Send a key as `null` to
delete it, such as `{"crmId": null}`. A `customData` that isn't
an object, such as an array, replaces the stored value whole.
Leave out `customData` to keep it as is.

The `customData` you send can be up to 65,536 bytes serialized.
The limit applies to the request, not to the merged result.
    
</dd>
</dl>

<dl>
<dd>

**$addresses:** `?array` — Postal addresses associated with the person.
    
</dd>
</dl>

<dl>
<dd>

**$identificationDocuments:** `?array` — Government-issued identification documents for the person.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;people-&gt;getPersonUnmasked($personReference) -> ?PersonDetailEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a person by reference with sensitive fields unmasked.
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
$client->people->getPersonUnmasked(
    '01a0014d-ce1a-7110-9bac-c4c59647a88d',
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

**$personReference:** `string` — The person reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;people-&gt;searchPeople($request) -> ?PeopleSearchEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches for people by identity attributes during boarding. The search
covers every business in your organization, so use it to find a person
before you create them again. To read the people already on a
paypoint's business, use a standard `GET` instead.
Provide at least one of `firstName` or `lastName`. Each result has a
`matchScore` showing how closely it matches, and an external identity
vendor can enrich the results. Each result's `dateOfBirth` is masked.
To get the full value, use the unmasked search.
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
$client->people->searchPeople(
    new SearchPeopleRequest([
        'entry' => '8cfec329267',
        'orgId' => 123,
        'body' => [
            'firstName' => "Marcus",
            'lastName' => "Delgado",
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

**$entry:** `string` — The entry name of your organization, from `OrgEntryName` on the organization. With a paypoint's entry name instead, the search covers only that paypoint's business.
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The ID of your organization.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `mixed` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;people-&gt;searchPeopleUnmasked($request) -> ?PeopleSearchEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches for people by identity attributes during boarding, and returns
each result's `dateOfBirth` unmasked. The query parameters, request
body, and other response fields match the standard people search.
Provide at least one of `firstName` or `lastName`.
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
$client->people->searchPeopleUnmasked(
    new SearchPeopleUnmaskedRequest([
        'entry' => '8cfec329267',
        'orgId' => 123,
        'body' => [
            'firstName' => "Marcus",
            'lastName' => "Delgado",
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

**$entry:** `string` — The entry name of your organization, from `OrgEntryName` on the organization. With a paypoint's entry name instead, the search covers only that paypoint's business.
    
</dd>
</dl>

<dl>
<dd>

**$orgId:** `int` — The ID of your organization.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `mixed` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Paypoints
<details><summary><code>$client-&gt;paypoints-&gt;listPaypoints($request) -> ?ListPaypointsEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists paypoints with optional filtering and pagination.
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
$client->paypoints->listPaypoints(
    new ListPaypointsPaypointsRequest([
        'limit' => 1,
        'page' => 1,
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

**$businessReference:** `?string` — Filter by the business the paypoint belongs to.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` — Filter by paypoint status. One of `active`, `inactive`, `suspended`, or `closed`. Any other value, including `pending`, returns `400`.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Free-text search across paypoints.
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page number to return.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paypoints-&gt;createPaypoint($request) -> ?PaypointCreatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a paypoint. New paypoints start in `pending`. Provide exactly
one of `businessReference` (an existing business) or `business` (to
create the business inline).
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
$client->paypoints->createPaypoint(
    new CreatePaypointWithBusinessReference([
        'paypointType' => 'merchant',
        'doingBusinessAs' => 'Rose Gardens',
        'description' => 'Boutique flower shop',
        'website' => 'https://example.com',
        'customerServicePhone' => '3055551212',
        'customerServiceEmail' => 'support@example.com',
        'timezone' => 'America/New_York',
        'businessReference' => '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
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

**$request:** `CreatePaypointWithBusinessReference|CreatePaypointWithInlineBusiness|CreatePaypointAllFields` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paypoints-&gt;getPaypoint($paypointReference) -> ?PaypointDetailEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a paypoint by reference.
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
$client->paypoints->getPaypoint(
    '019ff064-c690-7679-a73e-688418aadc7c',
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

**$paypointReference:** `string` — The paypoint reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paypoints-&gt;updatePaypoint($paypointReference, $request) -> ?PaypointUpdatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Applies a partial update to a paypoint. Send only the fields you want to change.
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
$client->paypoints->updatePaypoint(
    '019ff064-c690-7679-a73e-688418aadc7c',
    new UpdatePaypointRequest([
        'description' => 'Updated description',
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

**$paypointReference:** `string` — The paypoint reference.
    
</dd>
</dl>

<dl>
<dd>

**$paypointType:** `?string` — The paypoint type, for example `merchant`.
    
</dd>
</dl>

<dl>
<dd>

**$doingBusinessAs:** `?string` — The name the paypoint does business as (DBA).
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — A free-text description of the paypoint.
    
</dd>
</dl>

<dl>
<dd>

**$website:** `?string` — The paypoint's website URL.
    
</dd>
</dl>

<dl>
<dd>

**$customerServicePhone:** `?string` — The customer service phone number.
    
</dd>
</dl>

<dl>
<dd>

**$customerServiceEmail:** `?string` — The customer service email address.
    
</dd>
</dl>

<dl>
<dd>

**$timezone:** `?string` — The paypoint's time zone.
    
</dd>
</dl>

<dl>
<dd>

**$externalId:** `?string` — Your own identifier for the paypoint.
    
</dd>
</dl>

<dl>
<dd>

**$customData:** `?array` — Arbitrary key-value data you attach to the paypoint.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Organizations
<details><summary><code>$client-&gt;organizations-&gt;listOrganizations($request) -> ?ListPaypointsEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists organizations with optional filtering and pagination. Only
organizations are returned. Other paypoints never appear in this list.
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
$client->organizations->listOrganizations(
    new ListOrganizationsOrganizationsRequest([
        'businessReference' => '6e2b9d14-7a3c-4f58-b1e6-0c9d3a5f8e27',
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

**$businessReference:** `?string` — Filter by the business the organization belongs to.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` — Filter by organization status. One of `active`, `inactive`, `suspended`, or `closed`. Any other value returns `400`.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Free-text search across organizations.
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page number to return.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;createOrganization($request) -> ?PaypointCreatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates an organization. Provide exactly one of `business` (to create
the business inline, recommended) or `businessReference` (an existing
business). In intelligent boarding, an organization is a kind of paypoint, so the
request takes the paypoint create fields except `paypointType`. Payabli
sets the organization type itself. An organization isn't underwritten,
so only the fields needed to create the records are required. New
organizations start in `pending`. If you don't set
`parentPaypointReference`, the organization nests under the
organization your credential belongs to. Returns `409` if an
organization with the same `externalId` already exists.
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
$client->organizations->createOrganization(
    new CreateOrganizationWithInlineBusiness([
        'doingBusinessAs' => 'PropertyManager Pro',
        'description' => 'Property management software partner',
        'website' => 'https://example.com',
        'customerServicePhone' => '3055551212',
        'customerServiceEmail' => 'support@example.com',
        'timezone' => 'America/New_York',
        'externalId' => 'pmp-org-001',
        'business' => new CreateBusinessRequest([
            'externalId' => 'pmp-biz-001',
            'legalName' => 'PropertyManager Pro LLC',
            'legalStructure' => CreateBusinessRequestLegalStructure::Llc->value,
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

**$request:** `CreateOrganizationWithInlineBusiness|CreateOrganizationWithBusinessReference|CreateOrganizationAllFields` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;getOrganization($organizationReference) -> ?PaypointDetailEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves an organization by reference.
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
$client->organizations->getOrganization(
    'a8806f02-23b3-4f6d-bba3-42e1b94326ea',
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

**$organizationReference:** `string` — The organization reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organizations-&gt;updateOrganization($organizationReference, $request) -> ?PaypointUpdatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Applies a partial update to an organization. Send only the fields you want to change. You can't change an organization's type. If you send `paypointType`, the request ignores it and doesn't return an error.
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
$client->organizations->updateOrganization(
    'a8806f02-23b3-4f6d-bba3-42e1b94326ea',
    new UpdateOrganizationRequest([
        'description' => 'Updated description',
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

**$organizationReference:** `string` — The organization reference.
    
</dd>
</dl>

<dl>
<dd>

**$doingBusinessAs:** `?string` — The name the organization does business as (DBA).
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — A free-text description of the organization.
    
</dd>
</dl>

<dl>
<dd>

**$website:** `?string` — The organization's website URL.
    
</dd>
</dl>

<dl>
<dd>

**$customerServicePhone:** `?string` — The customer service phone number.
    
</dd>
</dl>

<dl>
<dd>

**$customerServiceEmail:** `?string` — The customer service email address.
    
</dd>
</dl>

<dl>
<dd>

**$timezone:** `?string` — The organization's time zone, as an IANA identifier such as `America/Chicago`.
    
</dd>
</dl>

<dl>
<dd>

**$externalId:** `?string` — Your own identifier for the organization.
    
</dd>
</dl>

<dl>
<dd>

**$customData:** `?array` — Arbitrary key-value data you attach to the organization.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Payment methods
<details><summary><code>$client-&gt;paymentMethods-&gt;listPaymentMethods($request) -> ?ListPaymentMethodsEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists payment methods with optional filtering and pagination.
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
$client->paymentMethods->listPaymentMethods(
    new ListPaymentMethodsPaymentMethodsRequest([
        'limit' => 1,
        'page' => 1,
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

**$accountOwner:** `?string` — Filter by the entity that owns the payment method.
    
</dd>
</dl>

<dl>
<dd>

**$ownerType:** `?string` — Filter by owner type.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` — Filter by payment method status.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` — Filter by payment method type.
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — Number of results per page.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page number to return.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — Field to sort by.
    
</dd>
</dl>

<dl>
<dd>

**$sortOrder:** `?string` — Sort direction.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paymentMethods-&gt;createPaymentMethods($request) -> ?PaymentMethodsCreatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates one or more payment methods for an entity in a single call.
Set each payment method's `accountOwner` to the entity it belongs to.
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
$client->paymentMethods->createPaymentMethods(
    new CreatePaymentMethodsRequest([
        'data' => [
            new CreatePaymentMethodRequest([
                'type' => CreatePaymentMethodRequestType::BankAccount->value,
                'accountOwner' => '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
                'ownerType' => PaymentMethodOwnerType::Business->value,
                'nickname' => 'Operating account',
                'financialInstitution' => 'Bank of Example',
                'accountType' => 'checking',
                'accountNumber' => '123456789',
                'routingNumber' => '021000021',
                'usage' => [
                    PaymentMethodUsage::Deposits->value,
                    PaymentMethodUsage::Billing->value,
                ],
            ]),
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

**$data:** `array` — The payment methods to create.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paymentMethods-&gt;getPaymentMethod($paymentMethodReference) -> ?PaymentMethodDetailEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a payment method by reference. Sensitive fields such as the account and routing numbers are masked.
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
$client->paymentMethods->getPaymentMethod(
    '019ff142-454b-7721-96a3-c8628b9d568f',
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

**$paymentMethodReference:** `string` — The payment method reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paymentMethods-&gt;deactivatePaymentMethod($paymentMethodReference) -> ?PaymentMethodDeactivatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deactivates a payment method. This is a soft delete: the payment
method moves to `INACTIVE` and the record is kept.
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
$client->paymentMethods->deactivatePaymentMethod(
    '019ff142-454b-7721-96a3-c8628b9d568f',
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

**$paymentMethodReference:** `string` — The payment method reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;paymentMethods-&gt;updatePaymentMethod($paymentMethodReference, $request) -> ?PaymentMethodUpdatedEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Applies a partial update to a payment method. Send only the fields you
want to change. Only payment methods in `PENDING` status can be updated.
Once a payment method is active, change it through the bank account
change process instead.
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
$client->paymentMethods->updatePaymentMethod(
    '019ff142-454b-7721-96a3-c8628b9d568f',
    new UpdatePaymentMethodRequest([
        'nickname' => 'Primary operating account',
        'usage' => [
            PaymentMethodUsage::Deposits->value,
            PaymentMethodUsage::Billing->value,
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

**$paymentMethodReference:** `string` — The payment method reference.
    
</dd>
</dl>

<dl>
<dd>

**$nickname:** `?string` — An optional label for the payment method.
    
</dd>
</dl>

<dl>
<dd>

**$financialInstitution:** `?string` — The bank or financial institution that holds the account.
    
</dd>
</dl>

<dl>
<dd>

**$accountType:** `?string` — The account type, for example `checking` or `savings`.
    
</dd>
</dl>

<dl>
<dd>

**$accountNumber:** `?string` — The bank account number.
    
</dd>
</dl>

<dl>
<dd>

**$routingNumber:** `?string` — The bank routing number.
    
</dd>
</dl>

<dl>
<dd>

**$usage:** `?array` — What the payment method is used for. Provide at least one value.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Boarding templates
<details><summary><code>$client-&gt;boardingTemplates-&gt;listTemplates($request) -> ?ListTemplatesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the boarding templates an organization owns, plus templates
inherited from ancestor organizations. Scope the listing with the
required `orgId` query parameter. You can filter by `status`, `name`,
`slug`, `orgName`, and `inherited`, and page through results.
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
$client->boardingTemplates->listTemplates(
    new ListTemplatesBoardingTemplatesRequest([
        'orgId' => 123,
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

**$orgId:** `int` — The numeric identifier of the organization to list templates for.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` — Filter by template status.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Filter by exact template name.
    
</dd>
</dl>

<dl>
<dd>

**$slug:** `?string` — Filter by exact template slug.
    
</dd>
</dl>

<dl>
<dd>

**$orgName:** `?string` — Filter by exact owning organization name.
    
</dd>
</dl>

<dl>
<dd>

**$inherited:** `?bool` — Filter by whether the template is inherited from an ancestor organization.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The number of records to skip before collecting the result set.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The maximum number of records to return. Use `0` or a negative value to return all records.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;boardingTemplates-&gt;getTemplate($uuid) -> ?Template</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a boarding template by UUID, including its current content version.
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
$client->boardingTemplates->getTemplate(
    '019ff129-d393-7761-9a31-e5afe85b4081',
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

**$uuid:** `string` — The template's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;boardingTemplates-&gt;archiveTemplate($uuid)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Archives a boarding template by UUID. Archiving is a soft delete: the
template stays readable with `status: archived`, so archiving an
already-archived template returns `409`, not another success. Unknown
templates return `404`.
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
$client->boardingTemplates->archiveTemplate(
    '019ff129-d393-7761-9a31-e5afe85b4081',
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

**$uuid:** `string` — The template's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;boardingTemplates-&gt;getTemplateVersion($uuid, $versionUuid) -> ?TemplateVersion</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a specific immutable content version of a template.
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
$client->boardingTemplates->getTemplateVersion(
    '019ff129-d393-7761-9a31-e5afe85b4081',
    '019ff129-d396-74c4-86da-ae3d082d7ef9',
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

**$uuid:** `string` — The template's UUID.
    
</dd>
</dl>

<dl>
<dd>

**$versionUuid:** `string` — The version's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Applications
<details><summary><code>$client-&gt;applications-&gt;listApplications($request) -> ?ListApplicationsEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists boarding applications with pagination.
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
$client->applications->listApplications(
    new ListApplicationsApplicationsRequest([]),
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

**$page:** `?int` — The page number to return, starting at 1.
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — The number of applications per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;createApplication($request) -> ?ApplicationEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a boarding application for a business. The business must
already have a paypoint. New applications start in `draft`.
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
$client->applications->createApplication(
    new CreateApplicationRequest([
        'businessReference' => '019fed1a-3d6e-75d3-a81e-cba3874b0a55',
        'externalId' => 'APP-2025-0417',
        'tags' => [
            'priority',
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

**$businessReference:** `string` — The reference of the business to board. The business must have a paypoint.
    
</dd>
</dl>

<dl>
<dd>

**$paypointReference:** `?string` — The reference of the paypoint to board. Defaults to the business's paypoint when omitted.
    
</dd>
</dl>

<dl>
<dd>

**$externalId:** `?string` — An optional identifier from your own system.
    
</dd>
</dl>

<dl>
<dd>

**$entityType:** `?string` — The type of entity being boarded.
    
</dd>
</dl>

<dl>
<dd>

**$requestTemplate:** `?string` — The reference of the boarding template to apply. Send one on every application. Payabli assigns the underwriting policy from the template, so a submitted application without one fails in review.
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Optional labels for the application.
    
</dd>
</dl>

<dl>
<dd>

**$representatives:** `?array` — The sales or service representatives assigned to the application.
    
</dd>
</dl>

<dl>
<dd>

**$configurations:** `?array` — Opaque application-level configuration. Null when not supplied.
    
</dd>
</dl>

<dl>
<dd>

**$services:** `?RequestedServices` — The services to request on the application.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;getApplication($requestsReference) -> ?ApplicationEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a boarding application by reference.
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
$client->applications->getApplication(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;updateApplication($requestsReference, $request) -> ?ApplicationEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Applies a partial update to a boarding application. Send only the fields you want to change.
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
$client->applications->updateApplication(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
    new UpdateApplicationRequest([
        'externalId' => 'APP-2025-0417-REV2',
        'tags' => [
            'priority',
            'expedited',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>

<dl>
<dd>

**$externalId:** `?string` — An optional identifier from your own system.
    
</dd>
</dl>

<dl>
<dd>

**$entityType:** `?string` — The type of entity being boarded.
    
</dd>
</dl>

<dl>
<dd>

**$requestTemplate:** `?string` — The reference of the boarding template to apply.
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Optional labels for the application.
    
</dd>
</dl>

<dl>
<dd>

**$representatives:** `?array` — The sales or service representatives assigned to the application.
    
</dd>
</dl>

<dl>
<dd>

**$configurations:** `?array` — Opaque application-level configuration.
    
</dd>
</dl>

<dl>
<dd>

**$services:** `?RequestedServices` — The services to request on the application. Replaces the whole `services` object, so send every service you want to keep. Leave it out to keep the current services.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;validateApplication($requestsReference) -> ?ValidationResultEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Checks whether the records linked to an application (the business, its people, and its payment methods) include everything the application's requested services need. The response lists any missing or invalid fields by section. Validation doesn't change the application, and it doesn't return a validation token. The request has no body.

One owner on the application must be the signer, flagged with `isSigner` on their business link. If no one is flagged, the `people` section returns a `missingFields` entry with `field` set to `people.isSigner`, `label` set to `Signer`, and `reason` set to `required — choose the person who signs the application`. The signer rule isn't reported when the application has no people.

The `people` section also checks ownership. At least one person must be the primary controller, flagged with `isPrimaryController`. If no one is, the entry has `field` set to `people.isPrimaryController`, `label` set to `Primary Controller`, and `reason` set to `required — at least one principal must be designated`. Unless the business's `legalStructure` is `government` or `non-profit`, at least one owner must have an `ownershipPercentage` of 25 or more. If no one does, the entry has `field` set to `people.ownershipPercentage`, `label` set to `Qualifying Owner`, and `reason` set to `at least one principal must have an ownership stake of 25% or more`.

Validation also reports required documents that have nothing uploaded. See [List application document requirements](/developers/api-reference/applications/list-application-document-requirements). The bank statement requirement appears in the `business` section, with `field` set to `documents.bankStatement`. A person document appears in the `people` section, with `field` set to `people.{personReference}.` followed by the requirement's `fieldPath`, such as `people.01a0014d-ce1a-7110-9bac-c4c59647a88d.person.documents.w9`. Submit doesn't enforce document requirements.
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
$client->applications->validateApplication(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;submitApplication($requestsReference, $request) -> ?TransitionResultEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Submits a draft application for review. Your integration (the applicant) calls this after the business, its people, payment methods, and services are in place. Verification then runs automatically.

The application must have a signer: an owner flagged with `isSigner` on their business link, or one you name in `signer.personReference`. Payabli records the signer's identity from their person record and business link, so update those before you submit. The `signer` object carries the signature details.

If the application has no signer, the request fails with `422` and the error `SIGNER_REQUIRED`. If `signer.personReference` names a person who isn't an owner, the request fails with `422` and the error `SIGNER_NOT_OWNER`. If the application isn't a draft, the request fails with `409` and the error `BIZ_004`, before any signer check. If `signer.reportedSignerIp` isn't a single valid IPv4 or IPv6 address, the request fails with `400` and the error `VALIDATION_ERROR`, and the application isn't submitted.

Submit doesn't check every rule that [validate](/developers/api-reference/applications/validate-an-application) reports, such as the primary controller and ownership rules. Validate the application and resolve its missing fields before you submit.
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
$client->applications->submitApplication(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
    new SubmitApplicationRequest([
        'signer' => new SubmitSigner([
            'personReference' => '01a0014d-ce1a-7110-9bac-c4c59647a88d',
            'signature' => 'Marcus J Delgado',
            'signatureType' => SignatureType::Type->value,
            'acceptance' => true,
            'pciAttestation' => true,
            'reportedSignerIp' => '203.0.113.7',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>

<dl>
<dd>

**$signer:** `SubmitSigner` — The signature details for the application's signer, and optionally which person signs.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;provideDocuments($requestsReference) -> ?TransitionResultEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Marks the documents that Payabli requested during review as provided, when the application is in `pendingdocuments`. It returns the application to review. The request has no body.
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
$client->applications->provideDocuments(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;provideResponse($requestsReference) -> ?TransitionResultEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Marks the information that Payabli requested during review as provided, when the application is in `pendingresponse`. It returns the application to review. The request has no body.
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
$client->applications->provideResponse(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;withdrawApplication($requestsReference, $request) -> ?TransitionResultEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Withdraws a boarding application. The response returns the application's
new status and the actions now allowed on it.
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
$client->applications->withdrawApplication(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
    new WithdrawApplicationRequest([
        'reason' => 'Duplicate application',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>

<dl>
<dd>

**$reason:** `?string` — An optional reason for the withdrawal, recorded in the status history.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;getApplicationHistory($requestsReference) -> ?StatusHistoryEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the status transition history of a boarding application, oldest first. History records changes only. An approved application that fails enablement the same way on every attempt doesn't add entries, so use [enablement](/developers/api-reference/applications/get-application-enablement-progress) to follow that progress.
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
$client->applications->getApplicationHistory(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;getApplicationEnablement($requestsReference) -> ?EnablementEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the progress of setting up an approved application's services with their processors. An application's status stays `approved` or `autoapproved` while this runs, and it moves to `activated` after every requested service is set up. Use this endpoint to see why an approved merchant isn't live yet.

Enablement doesn't send webhooks, so poll this endpoint to follow it. Until enablement starts, `state` and the other progress fields are `null`, and `services` is empty. That includes applications that are in `draft`, withdrawn, or in `error`.
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
$client->applications->getApplicationEnablement(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;listApplicationDocumentRequirements($requestsReference) -> ?DocumentRequirementListEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the documents an application asks for, from its template and from Payabli business rules. For example, a business with an annual revenue of $1,000,000 or more needs bank statements. Each requirement gives the `fieldPath` and `subject` to send when you upload, the formats it accepts, how many documents it takes, and how many are uploaded so far.

A person requirement appears once for each owner of the business, with that owner's `personReference`. The list is empty when the application asks for no documents.
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
$client->applications->listApplicationDocumentRequirements(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;listApplicationDocuments($requestsReference) -> ?ApplicationDocumentListEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the documents uploaded to an application. The list is empty when none are uploaded.
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
$client->applications->listApplicationDocuments(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;uploadApplicationDocument($requestsReference, $request) -> ?ApplicationDocumentEnvelope</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Uploads one document to an application as multipart form data. [List the application's document requirements](/developers/api-reference/applications/list-application-document-requirements) first. Send the requirement's `fieldPath`, one of its `subjectTypes` as `subject`, and, for a person requirement, its `personReference`.

The file can be up to 10 MB, in a format the requirement accepts. Payabli checks the file's content, not only its name. Each requirement takes up to `maxUploads` documents.

Uploading doesn't change the application's status. When underwriting requests documents, upload them, then call [provide documents](/developers/api-reference/applications/provide-application-documents) to return the application to review.
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
$client->applications->uploadApplicationDocument(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
    new UploadApplicationDocumentRequest([
        'file' => File::createFromString("example_file", "example_file"),
        'fieldPath' => 'documents.bankStatement',
        'subject' => DocumentSubjectType::Business->value,
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;applications-&gt;deleteApplicationDocument($requestsReference, $documentReference)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes a document you uploaded from an application. Deleting doesn't change the application's status. A deleted document no longer counts toward its requirement, so you can upload a replacement. Deleting a document that's already deleted returns `404`.
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
$client->applications->deleteApplicationDocument(
    '3f3caa7b-bdfe-4bf1-814b-30d54859247c',
    '019ff1d7-6e14-7c8b-a2f5-91d3b7e04c62',
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

**$requestsReference:** `string` — The application reference.
    
</dd>
</dl>

<dl>
<dd>

**$documentReference:** `string` — The document reference, from the upload response or [List application documents](/developers/api-reference/applications/list-application-documents).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Boarding
<details><summary><code>$client-&gt;boarding-&gt;addApplication($request) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [Create an application](/developers/api-reference/applications/create-an-application) instead. One legacy call becomes several intelligent boarding calls, one for each record. See [Map legacy calls to new endpoints](/guides/pay-ops-developer-boarding-legacy-migrate#map-legacy-calls-to-new-endpoints).
</Warning>


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
            'ach' => new AchSetup([]),
            'card' => new CardSetup([
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
        'bankData' => [
            new Bank([
                'accountId' => '123-456',
                'nickname' => 'Withdrawal Account',
                'bankName' => 'Test Bank 1',
                'routingAccount' => '123123123',
                'accountNumber' => '123123100',
                'typeAccount' => TypeAccount::Checking->value,
                'bankAccountHolderName' => 'Gruzya Adventure Outfitters LLC',
                'bankAccountHolderType' => BankAccountHolderType::Business->value,
                'bankAccountFunction' => 1,
            ]),
            new Bank([
                'accountId' => '123-789',
                'nickname' => 'Deposit Account',
                'bankName' => 'Test Bank 2',
                'routingAccount' => '321321321',
                'accountNumber' => '123123200',
                'typeAccount' => TypeAccount::Checking->value,
                'bankAccountHolderName' => 'Gruzya Adventure Outfitters LLC',
                'bankAccountHolderType' => BankAccountHolderType::Business->value,
                'bankAccountFunction' => 0,
            ]),
        ],
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
            new Contacts([
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
            new Owners([
                'ownername' => 'John Smith',
                'ownertitle' => 'CEO',
                'ownerpercent' => 100,
                'ownerssn' => '123456789',
                'ownerdob' => '01/01/1990',
                'ownerphone1' => '555888111',
                'ownerphone2' => '555888111',
                'owneremail' => 'test@email.com',
                'ownerdriver' => 'CA6677778',
                'oaddress' => '33 North St',
                'ocity' => 'Any City',
                'ocountry' => 'US',
                'odriverstate' => 'CA',
                'ostate' => 'CA',
                'ozip' => '55555',
            ]),
        ],
        'phonenumber' => '1234567890',
        'processingRegion' => 'US',
        'recipientEmail' => 'josephray@example.com',
        'recipientEmailNotification' => true,
        'resumable' => true,
        'signer' => new SignerDataRequest([
            'name' => 'John Smith',
            'ssn' => '123456789',
            'dob' => '01/01/1976',
            'phone' => '555888111',
            'email' => 'test@email.com',
            'address' => '33 North St',
            'address1' => 'STE 900',
            'city' => 'Bristol',
            'country' => 'US',
            'state' => 'TN',
            'zip' => '55555',
            'signedDocumentReference' => 'https://example.com/signed-document.pdf',
            'pciAttestation' => true,
            'attestationDate' => '04/20/2025',
            'additionalData' => [
                'deviceId' => '499585-389fj484-3jcj8hj3',
                'session' => 'fifji4-fiu443-fn4843',
                'timeWithCompany' => '6 Years',
            ],
            'signDate' => '04/20/2025',
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

<details><summary><code>$client-&gt;boarding-&gt;updateApplication($appId, $request) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Update the record that holds the data instead, such as [the business](/developers/api-reference/businesses/update-a-business) or [a person](/developers/api-reference/people/update-a-person). Use [Update an application](/developers/api-reference/applications/update-an-application) only for the application's own fields.
</Warning>


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

<details><summary><code>$client-&gt;boarding-&gt;deleteApplication($appId) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [Withdraw an application](/developers/api-reference/applications/withdraw-an-application) instead.
</Warning>


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

<details><summary><code>$client-&gt;boarding-&gt;getApplication($appId) -> ?ApplicationDetailsRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [Get an application](/developers/api-reference/applications/get-an-application) instead.
</Warning>


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

<details><summary><code>$client-&gt;boarding-&gt;getApplicationByAuth($xId, $request) -> ?ApplicationQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Intelligent boarding has no matching endpoint. Each application has its own hosted form link instead. See [Send merchants a boarding link](/guides/pay-ops-developer-boarding-legacy-migrate#send-merchants-a-boarding-link).
</Warning>


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
        'referenceId' => '129-219',
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

<details><summary><code>$client-&gt;boarding-&gt;getByIdLinkApplication($boardingLinkId) -> ?BoardingLinkQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Intelligent boarding has no matching endpoint. Each application has its own hosted form link instead. See [Send merchants a boarding link](/guides/pay-ops-developer-boarding-legacy-migrate#send-merchants-a-boarding-link).
</Warning>


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

<details><summary><code>$client-&gt;boarding-&gt;getByTemplateIdLinkApplication($templateId) -> ?BoardingLinkQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Intelligent boarding has no matching endpoint. Each application has its own hosted form link instead. See [Send merchants a boarding link](/guides/pay-ops-developer-boarding-legacy-migrate#send-merchants-a-boarding-link).
</Warning>


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

**$templateId:** `float` — The boarding template ID. You can find this at the end of the boarding template URL in the Payabli Portal. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;boarding-&gt;getExternalApplication($appId, $mail2, $request) -> ?PayabliApiResponse00</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Intelligent boarding has no matching endpoint. Each application has its own hosted form link instead. See [Send merchants a boarding link](/guides/pay-ops-developer-boarding-legacy-migrate#send-merchants-a-boarding-link).
</Warning>


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

<details><summary><code>$client-&gt;boarding-&gt;getLinkApplication($boardingLinkReference) -> ?BoardingLinkQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Intelligent boarding has no matching endpoint. Each application has its own hosted form link instead. See [Send merchants a boarding link](/guides/pay-ops-developer-boarding-legacy-migrate#send-merchants-a-boarding-link).
</Warning>


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

<details><summary><code>$client-&gt;boarding-&gt;listApplications($orgId, $request) -> ?QueryBoardingAppsListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [List applications](/developers/api-reference/applications/list-applications) instead.
</Warning>


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

**$exportFormat:** `?string` — Export format for file downloads. When specified, returns data as a file instead of JSON.
    
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

Accepted field names:
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
Accepted comparison operators - enclosed between parentheses:
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

<details><summary><code>$client-&gt;boarding-&gt;listBoardingLinks($orgId, $request) -> ?QueryBoardingLinksResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Intelligent boarding has no matching endpoint. Each application has its own hosted form link instead. See [Send merchants a boarding link](/guides/pay-ops-developer-boarding-legacy-migrate#send-merchants-a-boarding-link).
</Warning>


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

Accepted field names:
- `lastUpdated` (gt, ge, lt, le, eq, ne)
- `templateName` (ct, nct)
- `referenceName` (ct, nct)
- `acceptRegister` (eq, ne)
- `acceptAuth` (eq, ne)
- `templateCode` (ct, nct)
- `templateId` (eq, ne)
- `orgParentname` (ct, nct)

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;boarding-&gt;addServiceToPaypointFromApp($request) -> ?CreateApplicationFromPaypointResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [Create an application](/developers/api-reference/applications/create-an-application) for a paypoint that's already boarded instead. See [Request more services with the API](/guides/pay-ops-developer-boarding-add-services).
</Warning>


Creates a new boarding application linked to an existing paypoint as part of the multi-product boarding flow. Use this endpoint to add new services to a paypoint without creating a duplicate record. The system copies eligible business, contact, banking, and address data from the paypoint to the new application based on 1:1 field matching. The merchant only needs to provide fields that are specific to the new service. See the [Multi-product boarding](/guides/pay-ops-developer-boarding-multi-product) guide for the full flow.
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
$client->boarding->addServiceToPaypointFromApp(
    new CreateApplicationFromPaypointRequest([
        'paypointId' => 3040,
        'templateId' => 456,
        'recipientEmail' => 'merchant@example.com',
        'returnBoardingAccessInfoInLine' => true,
        'onCreate' => [
            'submitApplication',
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

**$paypointId:** `int` — ID of the existing paypoint to link to this application.
    
</dd>
</dl>

<dl>
<dd>

**$templateId:** `int` — ID of the boarding template to use for the new application.
    
</dd>
</dl>

<dl>
<dd>

**$recipientEmail:** `string` — Email address where the boarding link is sent. Required. If you don't want to email the merchant, send to an internal address and use `returnBoardingAccessInfoInLine` to retrieve the link from the response instead.
    
</dd>
</dl>

<dl>
<dd>

**$returnBoardingAccessInfoInLine:** `?bool` — When `true`, returns the boarding access information directly in the response.
    
</dd>
</dl>

<dl>
<dd>

**$onCreate:** `?array` — Additional actions to trigger when the application is created. Currently only `submitApplication` is supported, which automatically submits the application on creation and skips the draft state.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;boarding-&gt;getApplicationsByPaypointId($paypointId) -> ?QueryBoardingAppsListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [List applications](/developers/api-reference/applications/list-applications) instead. It doesn't filter by paypoint.
</Warning>


Returns all boarding applications associated with a specific paypoint, including those created through the multi-product boarding flow. Use this endpoint to track underwriting progress across multiple service additions or to build reporting views. See the [Multi-product boarding](/guides/pay-ops-developer-boarding-multi-product) guide for the full flow.
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
$client->boarding->getApplicationsByPaypointId(
    3040,
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

**$paypointId:** `int` — ID of the paypoint to retrieve applications for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Templates
<details><summary><code>$client-&gt;templates-&gt;deleteTemplate($templateId) -> ?PayabliApiResponseTemplateId</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [Archive a template](/developers/api-reference/boarding-templates/archive-a-template) instead.
</Warning>


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

**$templateId:** `float` — The boarding template ID. You can find this at the end of the boarding template URL in the Payabli Portal. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;templates-&gt;getlinkTemplate($templateId, $ignoreEmpty) -> ?BoardingLinkApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Intelligent boarding has no matching endpoint. Each application has its own hosted form link instead. See [Send merchants a boarding link](/guides/pay-ops-developer-boarding-legacy-migrate#send-merchants-a-boarding-link).
</Warning>


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
    80,
    true,
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

**$templateId:** `float` — The boarding template ID. You can find this at the end of the boarding template URL in the Payabli Portal. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
    
</dd>
</dl>

<dl>
<dd>

**$ignoreEmpty:** `bool` — Ignore read-only and empty fields. Default is `false`. If `ignoreEmpty` = `false` and any field is empty, then the request returns a failure response. If `ignoreEmpty` = `true`, the request returns the boarding link name regardless of whether fields are empty.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;templates-&gt;getTemplate($templateId) -> ?TemplateQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [Get a template](/developers/api-reference/boarding-templates/get-a-template) instead.
</Warning>


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

**$templateId:** `float` — The boarding template ID. You can find this at the end of the boarding template URL in the Payabli Portal. Example: `https://partner-sandbox.payabli.com/myorganization/boarding/edittemplate/80`. Here, the template ID is `80`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;templates-&gt;listTemplates($orgId, $request) -> ?TemplateQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [List templates](/developers/api-reference/boarding-templates/list-templates) instead.
</Warning>


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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>


See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
- `createdAt` (gt, ge, lt, le, eq, ne)
- `title` (ct, nct)
- `description` (ct, nct)
- `code` (ct, nct)
- `orgParentname` (ct, nct)

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

## Export
<details><summary><code>$client-&gt;export-&gt;exportApplications($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  Legacy boarding is deprecated and will be sunset in Q2 2027. Use [List applications](/developers/api-reference/applications/list-applications) instead. It doesn't export files.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportBatchDetails($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List batch details](/developers/api-reference/query/get-list-of-batchdetails-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

Export batch details for a paypoint. Use filters to limit results.
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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**

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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportBatchDetailsOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List batch details for org](/developers/api-reference/query/get-list-of-batchdetails-for-an-organization) with the `exportFormat` query parameter instead.
</Warning>

Export batch details for an organization. Use filters to limit results.
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**

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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportBatches($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List batches for paypoint](/developers/api-reference/query/get-list-of-batches-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportBatchesOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List batches for org](/developers/api-reference/query/get-list-of-batches-for-an-organization) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>
See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportBatchesOut($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List payout batches for paypoint](/developers/api-reference/query/get-list-of-moneyout-batches-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
  - `batchDate` (gt, ge, lt, le, eq, ne)
  - `batchNumber` (ne, eq)
  - `batchAmount` (gt, ge, lt, le, eq, ne)
  - `status` (in, nin, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct, nin, in)
  - `paypointId` (ne, eq)
  - `externalPaypointID` (ct, nct, eq, ne)
Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportBatchesOutOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List payout batches for org](/developers/api-reference/query/get-list-of-moneyout-batches-for-an-org) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
  - `batchDate` (gt, ge, lt, le, eq, ne)
  - `batchNumber` (ne, eq)
  - `batchAmount` (gt, ge, lt, le, eq, ne)
  - `status` (in, nin, eq, ne)
  - `paypointLegal` (ne, eq, ct, nct)
  - `paypointDba` (ne, eq, ct, nct)
  - `orgName` (ne, eq, ct, nct, nin, in)
  - `paypointId` (ne, eq)
  - `externalPaypointID` (ct, nct, eq, ne)
Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportBills($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List bills by paypoint](/developers/api-reference/bill/get-list-of-bills-for-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportBillsOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List bills by organization](/developers/api-reference/bill/get-list-of-bills-for-organization) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportChargebacks($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List disputes by paypoint](/developers/api-reference/chargebacks/get-list-of-chargebacks-and-returned-transactions-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportChargebacksOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List disputes by organization](/developers/api-reference/chargebacks/get-list-of-chargebacks-and-returned-transactions-for-an-org) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportCustomers($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List customers by paypoint](/developers/api-reference/customer/get-list-of-customers-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

**Accepted comparison operators - enclosed between parentheses:**
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

**Accepted parameters:**
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

<details><summary><code>$client-&gt;export-&gt;exportCustomersOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List customers by organization](/developers/api-reference/customer/get-list-of-customers-for-an-organization) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

**Accepted comparison operators - enclosed between parentheses:**
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

**Accepted parameters:**
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

<details><summary><code>$client-&gt;export-&gt;exportInvoices($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List invoices by paypoint](/developers/api-reference/invoice/get-list-of-invoices-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportInvoicesOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List invoices by organization](/developers/api-reference/invoice/get-list-of-invoices-for-an-organization) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportOrganizations($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List suborganizations by organization](/developers/api-reference/organization/get-list-of-organizations-for-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportPayout($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List payouts by paypoint](/developers/api-reference/query/get-list-of-payouts-for-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportPayoutOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List payouts by org](/developers/api-reference/query/get-list-of-payouts-for-organization) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportPaypoints($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List paypoints by organization](/developers/api-reference/paypoint/get-list-of-paypoints-for-an-organization) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportSettlements($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List settled transactions for paypoint](/developers/api-reference/query/get-list-of-settled-transactions-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportSettlementsOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List settled transactions for org](/developers/api-reference/query/get-list-of-settled-transactions-for-an-org) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportSubscriptions($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List subscriptions by paypoint](/developers/api-reference/subscription/get-list-of-subscriptions-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportSubscriptionsOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List subscriptions by organization](/developers/api-reference/subscription/get-list-of-subscriptions-for-an-org) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportTransactions($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List transactions for paypoint](/developers/api-reference/query/get-list-of-transactions-for-an-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

Export a list of transactions for an entrypoint in a file in XLSX or CSV format. Use filters to limit results. If you don't specify a date range in the request, the last two months of data are returned.
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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportTransactionsOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List transactions for org](/developers/api-reference/query/get-list-of-transactions-for-an-organization) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportTransferDetails($format, $entry, $transferId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [Get transfer details](/developers/api-reference/query/get-list-of-transfer-details) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
    4521,
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**

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

<details><summary><code>$client-&gt;export-&gt;exportTransfers($entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List transfers](/developers/api-reference/query/get-list-of-transfers) with the `exportFormat` query parameter instead.
</Warning>

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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

<details><summary><code>$client-&gt;export-&gt;exportVendors($format, $entry, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List vendors by paypoint](/developers/api-reference/vendor/get-list-of-vendors-for-entrypoint) with the `exportFormat` query parameter instead.
</Warning>

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
    ExportFormat1::Csv->value,
    '8cfec329267',
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

**$entry:** `string` — The paypoint's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

<details><summary><code>$client-&gt;export-&gt;exportVendorsOrg($format, $orgId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

<Warning>
  This endpoint is deprecated. To export this data, use [List vendors by organization](/developers/api-reference/vendor/get-list-of-vendors-for-organization) with the `exportFormat` query parameter instead.
</Warning>

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

  Because of a technical limitation, you can't make a request that includes filters from the API console on this page. The response won't be filtered. Instead, copy the request, remove `parameters=` and run the request in a different client, for example:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?parameters=totalAmount(gt)=1000&limitRecord=20

  should become:

  --url https://api-sandbox.payabli.com/api/Query/transactions/org/236?totalAmount(gt)=1000&limitRecord=20
</Info>

See [Filters and Conditions Reference](/developers/developer-guides/pay-ops-reporting-engine-overview#filters-and-conditions-reference) for help.

**Accepted field names:**
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

Accepted comparison operators - enclosed between parentheses:
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

Accepted parameters:
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

## Organization
<details><summary><code>$client-&gt;organization-&gt;addOrganization($request) -> ?AddOrganizationResponse</code></summary>
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;organization-&gt;editOrganization($orgIdPathParam, $request) -> ?EditOrganizationResponse</code></summary>
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
        'orgId' => '123',
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

**$orgIdPathParam:** `int` — The numeric identifier for organization, assigned by Payabli.
    
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

<details><summary><code>$client-&gt;organization-&gt;deleteOrganization($orgId) -> ?DeleteOrganizationResponse</code></summary>
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

<details><summary><code>$client-&gt;organization-&gt;getBasicOrganization($entry) -> ?GetBasicOrganizationResponse</code></summary>
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
    'pilgrim-planner',
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

**$entry:** `string` — The organization's entry name (`OrgEntryName`).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;organization-&gt;getBasicOrganizationById($orgId) -> ?GetBasicOrganizationResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets an organization's basic details by org ID.
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

<details><summary><code>$client-&gt;organization-&gt;getOrganization($orgId) -> ?OrganizationQueryRecord</code></summary>
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

<details><summary><code>$client-&gt;organization-&gt;getSettingsOrganization($orgId) -> ?SettingsQueryRecord</code></summary>
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

## Management
<details><summary><code>$client-&gt;management-&gt;verifyAccountDetails($entry, $request) -> ?VerifyAccountDetailsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Verifies a bank account and returns detailed verification results from the verification network, including bank name, account status, and response codes. Unlike a pass/fail verification, this endpoint returns granular data to support decision-making and troubleshooting.

When bank authentication is enabled for the paypoint's organization, the endpoint performs an identity verification check on the account holder. Otherwise, it performs an account existence check. When bank authentication is enabled, the `accountHolderType` and `holderName` fields are required.

Requires `inboundpayments_create` or `outboundpayments_create` permission.
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
$client->management->verifyAccountDetails(
    '8cfec329267',
    new VerifyAccountDetailsRequest([
        'routingNumber' => '122105278',
        'accountNumber' => '0000000016',
        'accountType' => 'Checking',
        'country' => 'US',
        'accountHolderType' => 'personal',
        'holderName' => 'Jane Doe',
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

**$entry:** `string` — The paypoint's entry name identifier.
    
</dd>
</dl>

<dl>
<dd>

**$routingNumber:** `string` — The bank routing number to verify.
    
</dd>
</dl>

<dl>
<dd>

**$accountNumber:** `string` — The bank account number to verify.
    
</dd>
</dl>

<dl>
<dd>

**$accountType:** `?string` — The type of bank account, such as `Checking` or `Savings`.
    
</dd>
</dl>

<dl>
<dd>

**$country:** `?string` — The ISO country code for the bank account, such as `US`.
    
</dd>
</dl>

<dl>
<dd>

**$accountHolderType:** `?string` — The type of account holder. Accepted values are `personal` or `business`. Required when bank authentication is enabled for the paypoint's organization.
    
</dd>
</dl>

<dl>
<dd>

**$holderName:** `?string` — The name of the bank account holder. For personal accounts, provide the holder's full name (for example, `Jane Doe`); the value is split on the first space into first and last name. For business accounts, provide the legal business name. Required when bank authentication is enabled for the paypoint's organization.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Statistic
<details><summary><code>$client-&gt;statistic-&gt;basicStats($mode, $freq, $level, $entryId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the basic statistics for an organization or a paypoint over a date range, grouped by a frequency. The response returns one row per time bucket. Counts and volumes cover approved transactions only and leave out declines. Volumes are net of fees.
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
    'custom',
    'm',
    2,
    1000000,
    new BasicStatsRequest([
        'startDate' => '2025-11-01',
        'endDate' => '2025-11-30',
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

<details><summary><code>$client-&gt;statistic-&gt;customerBasicStats($mode, $freq, $customerId) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the basic statistics for a customer over a date range, grouped by a frequency. This is a Pay In view: it counts the customer's approved transactions and returns one row per time bucket. Volume here is the gross amount, before fees.
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
    'm12',
    'm',
    4440,
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

**$customerId:** `int` — Payabli-generated customer ID. Maps to "Customer ID" column in the Payabli Portal.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;statistic-&gt;subStats($interval, $level, $entryId) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves subscription statistics for a paypoint or organization, bucketed by how soon active subscriptions are due to renew. This is a forward-looking forecast of upcoming renewals, not charges already taken. Request a single window with `interval`, or `all` to return every window in one call.
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
    'all',
    2,
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
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;statistic-&gt;vendorBasicStats($mode, $freq, $idVendor) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the basic statistics about a vendor over a date range, grouped by frequency. The response returns one row per time bucket, breaking the vendor's bills down by bill state (active, sent to approval, approved, in transit, paid, and so on). Volumes are net of fees.
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
    'ytd',
    'm',
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
</dd>
</dl>


</dd>
</dl>
</details>

## Notification
<details><summary><code>$client-&gt;notification-&gt;addNotification($request) -> ?PayabliApiResponseNotifications</code></summary>
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
            'eventType' => NotificationStandardRequestContentEventType::Createdapplication->value,
        ]),
        'frequency' => NotificationStandardRequestFrequency::Untilcancelled->value,
        'method' => NotificationStandardRequestMethod::Web->value,
        'ownerId' => 236,
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

<details><summary><code>$client-&gt;notification-&gt;getNotification($nId) -> ?NotificationQueryRecord</code></summary>
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

<details><summary><code>$client-&gt;notification-&gt;updateNotification($nId, $request) -> ?PayabliApiResponseNotifications</code></summary>
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
            'eventType' => NotificationStandardRequestContentEventType::Approvedpayment->value,
        ]),
        'frequency' => NotificationStandardRequestFrequency::Untilcancelled->value,
        'method' => NotificationStandardRequestMethod::Email->value,
        'ownerId' => 136,
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

<details><summary><code>$client-&gt;notification-&gt;deleteNotification($nId) -> ?PayabliApiResponseNotifications</code></summary>
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

<details><summary><code>$client-&gt;notification-&gt;getReportFile($id) -> ?array</code></summary>
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

## User
<details><summary><code>$client-&gt;user-&gt;addUser($request) -> ?AddUserResponse</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;getUser($userId, $request) -> ?UserQueryRecord</code></summary>
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
        'entry' => '8cfec329267',
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

<details><summary><code>$client-&gt;user-&gt;editUser($userId, $request) -> ?PayabliApiResponse</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;deleteUser($userId) -> ?DeleteUserResponse</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;authUser($provider, $request) -> ?PayabliApiResponseMfaBasic</code></summary>
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

**$provider:** `string` — Auth provider. Pass `null` to use the built-in provider.
    
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

<details><summary><code>$client-&gt;user-&gt;authRefreshUser() -> ?PayabliApiResponseUserMfa</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;authResetUser($request) -> ?AuthResetUserResponse</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;changePswUser($request) -> ?ChangePswUserResponse</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;logoutUser() -> ?LogoutUserResponse</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;validateMfaUser($request) -> ?PayabliApiResponseUserMfa</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;editMfaUser($userId, $request) -> ?EditMfaUserResponse</code></summary>
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

<details><summary><code>$client-&gt;user-&gt;resendMfaCode($usrname, $entry, $entryType) -> ?PayabliApiResponseMfaBasic</code></summary>
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
    'usrname',
    '8cfec329267',
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

## Vendor
<details><summary><code>$client-&gt;vendor-&gt;addVendor($entry, $request) -> ?PayabliApiResponseVendors</code></summary>
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
        'vendorNumber' => 'VEN-123',
        'address1' => '123 Ocean Drive',
        'address2' => 'Suite 400',
        'billingData' => new BillingData([
            'accountNumber' => '123123123',
            'bankAccountFunction' => 0,
            'bankAccountHolderName' => 'Gruzya Adventure Outfitters LLC',
            'bankAccountHolderType' => BankAccountHolderType::Business->value,
            'bankName' => 'Country Bank',
            'id' => 123,
            'routingAccount' => '123123123',
            'typeAccount' => TypeAccount::Checking->value,
        ]),
        'city' => 'Miami',
        'contacts' => [
            new Contacts([
                'contactEmail' => 'example@email.com',
                'contactName' => 'Herman Martinez',
                'contactPhone' => '3055550000',
                'contactTitle' => 'Owner',
            ]),
        ],
        'country' => 'US',
        'customerVendorAccount' => 'A-37622',
        'ein' => '12-3456789',
        'email' => 'example@email.com',
        'internalReferenceId' => 123,
        'locationCode' => 'MIA123',
        'mcc' => '7777',
        'name1' => "Herman's Coatings and Masonry",
        'name2' => 'HCM Services',
        'payeeName1' => 'Herman Martinez',
        'payeeName2' => 'Herman Coatings',
        'paymentMethod' => 'managed',
        'phone' => '5555555555',
        'remitAddress1' => '123 Walnut Street',
        'remitAddress2' => 'Suite 900',
        'remitCity' => 'Miami',
        'remitCountry' => 'US',
        'remitState' => 'FL',
        'remitZip' => '31113',
        'state' => 'FL',
        'vendorStatus' => 1,
        'issue1099' => true,
        'zip' => '33139',
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

<details><summary><code>$client-&gt;vendor-&gt;getVendor($idVendor) -> ?VendorQueryRecord</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a vendor's details, including enrichment status and payment acceptance info when available.
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

<details><summary><code>$client-&gt;vendor-&gt;editVendor($idVendor, $request) -> ?PayabliApiResponseVendors</code></summary>
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

<details><summary><code>$client-&gt;vendor-&gt;deleteVendor($idVendor) -> ?PayabliApiResponseVendors</code></summary>
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

<details><summary><code>$client-&gt;vendor-&gt;enrichVendor($entry, $request) -> ?VendorEnrichResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Triggers AI-powered vendor enrichment for an existing vendor. Runs one or more enrichment stages (invoice scan, web search) based on the `scope` parameter. Can automatically apply extracted payment acceptance info and vendor contact information to the vendor record, or return raw results for manual review. Contact Payabli to enable this feature.
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
$client->vendor->enrichVendor(
    '8cfec329267',
    new VendorEnrichRequest([
        'vendorId' => 456,
        'scope' => [
            'invoice_scan',
        ],
        'applyEnrichmentData' => false,
        'invoiceFile' => new FileContent([
            'fContent' => '<base64-encoded-pdf>',
            'filename' => 'invoice-2026-001.pdf',
            'ftype' => FileContentFtype::Pdf->value,
        ]),
        'fallbackMethod' => 'check',
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

**$vendorId:** `int` — ID of the vendor to enrich. Must be active and belong to the given entrypoint.
    
</dd>
</dl>

<dl>
<dd>

**$scope:** `?array` — Enrichment stages to run. Valid values are `invoice_scan` and `web_search`. Stages run in order: invoice scan first, then web search. If the vendor becomes payout-ready after invoice scan, web search is skipped.
    
</dd>
</dl>

<dl>
<dd>

**$applyEnrichmentData:** `?bool` — When `true` (the default), extracted data is automatically written to the vendor record. Only empty fields are populated, existing values are never overwritten. When `false`, the vendor record isn't modified. In both cases, `enrichmentData` in the response contains the extracted results. Use `false` for UI flows where users review and confirm changes before applying them with the update vendor endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$scheduleCallIfNeeded:** `?bool` — When `true`, Payabli schedules an AI outreach call to the vendor if the enrichment stages return insufficient payment acceptance info. The call collects the vendor's preferred payment method and contact email. This is the third enrichment stage and is opt-in at the org level. See the schedule outreach call endpoint for behavior and requirements.
    
</dd>
</dl>

<dl>
<dd>

**$invoiceFile:** `?FileContent` — PDF invoice file, Base64-encoded. Required when `scope` includes `invoice_scan`.
    
</dd>
</dl>

<dl>
<dd>

**$billId:** `?int` — Bill ID to associate with this enrichment request.
    
</dd>
</dl>

<dl>
<dd>

**$fallbackMethod:** `?string` — Payment method to apply if enrichment can't find payment details. Values are `check`, `ach`, or `card`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;vendor-&gt;scheduleEnrichmentCall($entry, $request) -> ?VendorScheduleCallResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Schedules an AI outreach call to a vendor to collect their preferred payment method and contact email. This is the third enrichment stage. Calls are scheduled for the next business day at around 9 AM in the vendor's timezone, with retries on no-answer and a fallback payment method applied when retries are exhausted. This feature is opt-in at the org level. Contact your Payabli representative to enable it, provision a phone number, and discuss pricing.
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
$client->vendor->scheduleEnrichmentCall(
    '8cfec329267',
    new ScheduleEnrichmentCallRequest([
        'vendorId' => 456,
        'phone' => '5555550200',
        'enrichmentId' => 'enrich-3890-a1b2c3d4',
        'billId' => 54323,
        'fallbackMethod' => 'check',
        'maxRetries' => 3,
        'timezone' => 'America/New_York',
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

**$vendorId:** `int` — ID of the vendor to call. Must be active and belong to the entrypoint in the path.
    
</dd>
</dl>

<dl>
<dd>

**$phone:** `?string` — Vendor phone number to call, digits only. Optional. When omitted, Payabli uses the phone number on the vendor's record. If the vendor has no phone on record, the request returns an error.
    
</dd>
</dl>

<dl>
<dd>

**$enrichmentId:** `?string` — ID of the originating enrichment run to associate with this call. Optional. When omitted, Payabli generates a standalone call schedule and skips the enrichment lookup. The bill due-date check only runs when both `enrichmentId` and `billId` are supplied.
    
</dd>
</dl>

<dl>
<dd>

**$billId:** `?int` — Bill ID used for the due-date check. When the bill is due in fewer than three days, the call is skipped and the fallback method is applied. Only evaluated when `enrichmentId` is also supplied.
    
</dd>
</dl>

<dl>
<dd>

**$fallbackMethod:** `?string` — Payment method to apply to the vendor record if the call can't determine a preference or all retries are exhausted. Values are `check` (the default) or `managed`.
    
</dd>
</dl>

<dl>
<dd>

**$maxRetries:** `?int` — Number of times to retry the call if the vendor doesn't answer. Defaults to 3. Maximum is 5. The get outreach call status response reports this value as `maxAttempts`.
    
</dd>
</dl>

<dl>
<dd>

**$timezone:** `?string` — IANA timezone identifier used to schedule the call in the vendor's local time. Defaults to `America/New_York`.
    
</dd>
</dl>

<dl>
<dd>

**$sendNow:** `?bool` — When `true`, dispatches the call immediately and bypasses the business-hours window and the bill due-date check. Defaults to `false`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;vendor-&gt;getEnrichmentCallStatus($idVendor) -> ?VendorCallStatusResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the latest AI outreach call activity for a vendor. The response is a composite object with a `state` discriminator (`none`, `scheduled`, `successful`, or `failed`); the block that matches the current state is populated. When the vendor has no call activity, `state` is `none` and the response returns HTTP 200.
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
$client->vendor->getEnrichmentCallStatus(
    456,
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

**$idVendor:** `int` — ID of the vendor to read call status for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## GhostCard
<details><summary><code>$client-&gt;ghostCard-&gt;createGhostCard($entry, $request) -> ?CreateGhostCardResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a ghost card, a multi-use virtual debit card issued to a vendor for recurring or discretionary spend.

Unlike single-use virtual cards issued as part of a payout transaction, ghost cards aren't tied to a specific payout. They're issued directly to a vendor and can be reused up to a configurable number of times within the card's spending limits.

Only one active ghost card can exist per vendor per paypoint. If the vendor already has one, the request fails with error `7067`. To issue a new card to the same vendor, cancel the existing card first. Canceled and expired cards don't count toward this limit. See [Cancel ghost card](/developers/api-reference/cards/cancel-ghost-card).
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
$client->ghostCard->createGhostCard(
    '8cfec329267',
    new CreateGhostCardRequestBody([
        'vendorId' => 456,
        'expenseLimit' => 500,
        'amount' => 500,
        'maxNumberOfUses' => 3,
        'exactAmount' => false,
        'expenseLimitPeriod' => 'monthly',
        'billingCycle' => 'monthly',
        'billingCycleDay' => '1',
        'dailyTransactionCount' => 5,
        'dailyAmountLimit' => 200,
        'transactionAmountLimit' => 100,
        'mcc' => '5411',
        'tcc' => 'R',
        'misc1' => 'PO-98765',
        'misc2' => 'Dept-Finance',
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$vendorId:** `int` — ID of the vendor who receives the card. The vendor must belong to the paypoint and have an active status.
    
</dd>
</dl>

<dl>
<dd>

**$expenseLimit:** `float` — Spending limit for the card. Must be greater than `0` and can't exceed the paypoint's configured payout credit limit.
    
</dd>
</dl>

<dl>
<dd>

**$expirationDate:** `?string` — Requested expiration date for the card. If not provided, defaults to 30 days from creation.
    
</dd>
</dl>

<dl>
<dd>

**$amount:** `float` — Initial load amount for the card.
    
</dd>
</dl>

<dl>
<dd>

**$maxNumberOfUses:** `int` — Maximum number of times the card can be used. Ignored and set to `1` when `exactAmount` is `true`.
    
</dd>
</dl>

<dl>
<dd>

**$exactAmount:** `bool` — When `true`, restricts the card to a single use. `maxNumberOfUses` is automatically set to `1` regardless of any other value provided.
    
</dd>
</dl>

<dl>
<dd>

**$expenseLimitPeriod:** `string` — Time period over which `expenseLimit` applies (for example, `monthly` or `weekly`).
    
</dd>
</dl>

<dl>
<dd>

**$billingCycle:** `string` — Billing cycle identifier.
    
</dd>
</dl>

<dl>
<dd>

**$billingCycleDay:** `string` — Day within the billing cycle.
    
</dd>
</dl>

<dl>
<dd>

**$dailyTransactionCount:** `int` — Maximum number of transactions allowed per day.
    
</dd>
</dl>

<dl>
<dd>

**$dailyAmountLimit:** `float` — Maximum total spend allowed per day.
    
</dd>
</dl>

<dl>
<dd>

**$transactionAmountLimit:** `int` — Maximum spend allowed per single transaction.
    
</dd>
</dl>

<dl>
<dd>

**$mcc:** `?string` — Merchant Category Code to restrict where the card can be used. Must be a valid MCC if provided.
    
</dd>
</dl>

<dl>
<dd>

**$tcc:** `?string` — Transaction Category Code to restrict where the card can be used. Must be a valid TCC if provided.
    
</dd>
</dl>

<dl>
<dd>

**$misc1:** `?string` — Custom metadata field. Stored on the card record.
    
</dd>
</dl>

<dl>
<dd>

**$misc2:** `?string` — Custom metadata field. Stored on the card record.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;ghostCard-&gt;deleteGhostCard($cardToken) -> ?DeleteGhostCardResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancels a ghost card. This is always a soft delete: Payabli keeps the card record, including its transaction history.

Canceling a ghost card frees the vendor's slot, so you can issue a new ghost card to the same vendor. A card canceled with this endpoint can't be used, reactivated, or canceled again.

Requires the `vcard_delete` permission.
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
$client->ghostCard->deleteGhostCard(
    'gc_abc123def456',
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

**$cardToken:** `string` — Token that identifies the ghost card to cancel. This is the `ReferenceId` returned when the card was created.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;ghostCard-&gt;updateCard($entry, $request) -> ?PayabliApiResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates the status of a virtual card (including ghost cards) under a paypoint.
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
$client->ghostCard->updateCard(
    '8cfec329267',
    new UpdateCardRequestBody([
        'cardToken' => 'gc_abc123def456',
        'status' => CardStatus::Cancelled->value,
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

**$entry:** `string` — The entity's entrypoint identifier. [Learn more](/developers/api-reference/api-overview#entrypoint-vs-entry)
    
</dd>
</dl>

<dl>
<dd>

**$cardToken:** `string` — Token that uniquely identifies the card. This is the `ReferenceId` returned when the card was created.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` — The new status to set on the card.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## MoneyOut
<details><summary><code>$client-&gt;moneyOut-&gt;authorizeOut($request) -> ?AuthCapturePayoutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Authorizes a transaction for payout.

If you don't pass `autoCapture` with a value of `true`, authorized transactions aren't flagged for settlement until captured. Use the `referenceId` returned in the response to capture the transaction.

When `autoCapture` is `true`, Payabli captures the transaction asynchronously after authorization. The response confirms only that the transaction was authorized; it doesn't confirm that capture succeeded. To confirm capture, listen for the [`payout_transaction_approvedcaptured`](/developers/webhooks/payout-transaction-approved-captured) webhook event.

If a velocity fraud alert is triggered, the endpoint returns a `202` response with `responseCode` `9051`, and the authorization is held for risk review rather than rejected. If a risk policy blocks the transaction, the endpoint returns a `422` response with `responseCode` `9005`, a terminal rejection.

For check payouts, Payabli validates the remit (mailing) address at authorization. If the address fails deliverability validation, the endpoint returns a `422` response and doesn't charge the paypoint. Correct the address and re-authorize. Other payout rails (ACH, RTP, virtual card, wire, and managed payables) aren't affected.
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
    new RequestOutAuthorize([
        'body' => new AuthorizePayoutBody([
            'entryPoint' => '8cfec329267',
            'orderDescription' => 'Window Painting',
            'paymentMethod' => new AuthorizePaymentMethod([
                'method' => 'managed',
            ]),
            'paymentDetails' => new RequestOutAuthorizePaymentDetails([
                'totalAmount' => 47,
                'unbundled' => false,
            ]),
            'vendorData' => new RequestOutAuthorizeVendorData([
                'vendorNumber' => 'VEN-123',
            ]),
            'invoiceData' => [
                new RequestOutAuthorizeInvoiceData([
                    'billId' => 54323,
                ]),
            ],
            'autoCapture' => true,
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

**$sameDayAch:** `?bool` 

When `true`, Payabli authorizes the payout for same-day ACH processing instead of standard ACH. Same-day ACH must be enabled for the paypoint, otherwise the authorization fails with a `400` response and `responseCode` `3492`. Only ACH payouts honor this flag. Wire and RTP payouts ignore it.

Same-day ACH has a daily cutoff. Capture the transaction before the cutoff, or pass `autoConvertSameDayAch` with a value of `true` when you capture it.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyOut-&gt;cancelAllOut($request) -> ?CaptureAllOutResponse</code></summary>
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
        '129-230',
        '129-219',
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

<details><summary><code>$client-&gt;moneyOut-&gt;cancelOutGet($referenceId) -> ?PayabliApiResponse0000</code></summary>
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

<details><summary><code>$client-&gt;moneyOut-&gt;cancelOutDelete($referenceId) -> ?PayabliApiResponse0000</code></summary>
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

<details><summary><code>$client-&gt;moneyOut-&gt;captureAllOut($request) -> ?CaptureAllOutResponse</code></summary>
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
            '129-230',
            '129-219',
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

**$autoConvertSameDayAch:** `?bool` 

Controls what happens to a payout authorized with `sameDayACH` set to `true` when you capture it after the same-day ACH cutoff. When `true`, Payabli converts the payout to a standard ACH payment and captures it. When `false`, the capture is declined.

This parameter has no effect on payouts that weren't authorized for same-day ACH.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyOut-&gt;captureOut($referenceId, $request) -> ?AuthCapturePayoutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Captures a single authorized payout transaction by ID. If the transaction was authorized with `autoCapture` set to `true`, you don't need to call this endpoint to capture the transaction for processing.

If a velocity fraud alert is triggered, the endpoint returns a `202` response with `responseCode` `9051`, and the capture is held for risk review rather than rejected. If a risk policy blocks the transaction, the endpoint returns a `422` response with `responseCode` `9005`, a terminal rejection.
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

**$autoConvertSameDayAch:** `?bool` 

Controls what happens to a payout authorized with `sameDayACH` set to `true` when you capture it after the same-day ACH cutoff. When `true`, Payabli converts the payout to a standard ACH payment and captures it. When `false`, the capture is declined.

This parameter has no effect on payouts that weren't authorized for same-day ACH.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;moneyOut-&gt;payout($request) -> ?AuthCapturePayoutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Authorizes a payout and captures it in the same request, returning the capture result. Use this endpoint when you need the capture outcome synchronously: it does the same work as calling `POST /MoneyOut/authorize` followed by `GET /MoneyOut/capture/{referenceId}`, in a single call.

Risk and fraud review runs at both the authorize and capture stages, exactly as it does for the two-call flow.

Payabli ignores the `autoCapture` field in the request body, since this endpoint always captures inline.

If the capture fails, the payout stays authorized. Retry the capture with `GET /MoneyOut/capture/{referenceId}` using the `referenceId` from the error response rather than resubmitting, which would create a second payout. See the [Manage payouts guide](/guides/pay-out-developer-payouts-manage#authorize-and-capture-in-one-call) for details.
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
$client->moneyOut->payout(
    new PayoutRequest([
        'body' => new AuthorizePayoutBody([
            'entryPoint' => '8cfec329267',
            'orderDescription' => 'Window Painting',
            'paymentMethod' => new AuthorizePaymentMethod([
                'method' => 'managed',
            ]),
            'paymentDetails' => new RequestOutAuthorizePaymentDetails([
                'totalAmount' => 47,
            ]),
            'vendorData' => new RequestOutAuthorizeVendorData([
                'vendorNumber' => 'VEN-123',
            ]),
            'invoiceData' => [
                new RequestOutAuthorizeInvoiceData([
                    'billId' => 54323,
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

**$sameDayAch:** `?bool` 

When `true`, Payabli authorizes the payout for same-day ACH processing instead of standard ACH. Same-day ACH must be enabled for the paypoint, otherwise the authorization fails with a `400` response and `responseCode` `3492`. Only ACH payouts honor this flag. Wire and RTP payouts ignore it.

Because this endpoint captures immediately, pass `autoConvertSameDayAch` with a value of `true` to fall back to standard ACH if the capture runs after the same-day ACH cutoff.
    
</dd>
</dl>

<dl>
<dd>

**$doNotCreateBills:** `?bool` — When `true`, Payabli won't automatically create a bill for this payout transaction.
    
</dd>
</dl>

<dl>
<dd>

**$allowDuplicatedBills:** `?bool` — When `true`, the payout bypasses the requirement for unique bills, identified by vendor invoice number. This allows you to make more than one payout for a bill, like a split payment.
    
</dd>
</dl>

<dl>
<dd>

**$updateVendorPaymentMethod:** `?bool` — When `true`, Payabli updates the vendor's stored default payment method to the method used in this payout.
    
</dd>
</dl>

<dl>
<dd>

**$autoConvertSameDayAch:** `?bool` 

Controls what happens to a payout authorized with `sameDayACH` set to `true` when the capture runs after the same-day ACH cutoff. When `true`, Payabli converts the payout to a standard ACH payment and captures it. When `false`, the capture is declined.

This parameter has no effect on payouts that weren't authorized for same-day ACH.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;moneyOut-&gt;payoutDetails($transId) -> ?BillDetailResponse</code></summary>
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

<details><summary><code>$client-&gt;moneyOut-&gt;vCardGet($cardToken) -> ?VCardGetResponse</code></summary>
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

<details><summary><code>$client-&gt;moneyOut-&gt;renewVCard($cardToken, $request) -> ?RenewVCardResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Renews an expired or expiring virtual card by extending its expiration date to a future month.

The card must be a virtual card that hasn't been fully used. The new expiration date must be in `MM-YYYY` or `MM/YYYY` format and no more than 2 years and 363 days in the future. The card expires on the last day of the month you specify.

On success, `referenceId` holds the renewed card's token (the card processor may issue a new token). The response reuses the standard payout result object, so the payment-transaction fields it carries don't apply to renewal and always return `null`.
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
$client->moneyOut->renewVCard(
    '20231206142225226104',
    new RenewVCardRequest([
        'expirationDate' => '12-2027',
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

**$cardToken:** `string` — ID for the virtual card to renew.
    
</dd>
</dl>

<dl>
<dd>

**$expirationDate:** `string` — The new expiration date for the virtual card, in `MM-YYYY` or `MM/YYYY` format. The card expires on the last day of the month you specify. The date can't be more than 2 years and 363 days in the future.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;moneyOut-&gt;sendVCardLink($request) -> ?OperationResult</code></summary>
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

<details><summary><code>$client-&gt;moneyOut-&gt;getCheckImage($assetName) -> ?string</code></summary>
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

<details><summary><code>$client-&gt;moneyOut-&gt;updateCheckPaymentStatus($transId, $checkPaymentStatus) -> ?PayabliApiResponse00Responsedatanonobject</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates the status of a processed check payment transaction. This endpoint handles the status transition, updates related bills, creates audit events, and triggers notifications.

The transaction must meet all of the following criteria:
- **Status**: Must be in Processing or Processed status.
- **Payment method**: Must be a check payment method.

### Allowed status values

| Value | Status | Description |
|-------|--------|-------------|
| `0` | Cancelled/Voided | Cancels the check transaction. Reverts associated bills to their previous state (Approved or Active), creates "Cancelled" events, and sends a `payout_transaction_voidedcancelled` notification if the notification is enabled. |
| `5` | Paid | Marks the check transaction as paid. Updates associated bills to "Paid" status, creates "Paid" events, and sends a `payout_transaction_paid` notification if the notification is enabled. |
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
$client->moneyOut->updateCheckPaymentStatus(
    'TRANS123456',
    AllowedCheckPaymentStatus::Paid->value,
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

**$transId:** `string` — The Payabli transaction ID for the check payment.
    
</dd>
</dl>

<dl>
<dd>

**$checkPaymentStatus:** `string` — The new status to apply to the check transaction. To mark a check as `Paid`, send 5. To mark a check as `Cancelled`, send 0.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;moneyOut-&gt;getNextCheckNumber($paypointId, $accountId) -> ?NextCheckNumberResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a suggested check number for the next check payout from a paypoint's funding account. Payabli suggests the highest check number on the account's check payouts plus one, or `1` if the account has no check history. Canceled check payouts don't count toward the highest number.


Use the suggested value with the `checkNumber` field when you reissue a check, or when you create a new check payout.


Errors return HTTP `400`: `3005` when the paypoint ID is invalid or inactive, and `3758` when the account ID isn't valid for the paypoint.
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
$client->moneyOut->getNextCheckNumber(
    3040,
    '123-456',
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

**$paypointId:** `int` — The ID of the paypoint that owns the funding account.
    
</dd>
</dl>

<dl>
<dd>

**$accountId:** `string` — The `accountId` of the bank account linked to the paypoint's check service, such as `123-456`. Find it in the paypoint's bank account details (`BankData`).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;moneyOut-&gt;reissueOut($request) -> ?ReissuePayoutResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Reissues a payout transaction with a new payment method. This creates a new transaction linked to the original and marks the original transaction as reissued.

The original transaction must be in **Processing** or **Processed** status. An ACH payout with a **Returned** status can also be reissued. The payment method in the request body is used directly. The endpoint doesn't fall back to vendor-managed payment methods.

The new transaction goes through the standard authorize-and-capture flow automatically. Both the original and new transactions are linked through their event histories for audit purposes.

The reissue request doesn't accept a service fee. Payabli always charges the fee configured in the paypoint's ACH payout pricing, even when the pricing allows fee overrides. The new transaction keeps the original payout's total amount. The vendor receives that amount minus the configured fee.
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
$client->moneyOut->reissueOut(
    new ReissueOutRequest([
        'transId' => '129-219',
        'paymentMethod' => new ReissuePaymentMethod([
            'method' => 'ach',
            'achHolder' => 'Acme Corp',
            'achRouting' => '021000021',
            'achAccount' => '9876543210',
            'achAccountType' => 'savings',
            'achHolderType' => AchHolderType::Business->value,
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

**$transId:** `string` — The transaction ID of the payout to reissue.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethod:** `ReissuePaymentMethod` 
    
</dd>
</dl>

<dl>
<dd>

**$checkNumber:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Funding
<details><summary><code>$client-&gt;funding-&gt;depositFunds($request) -> ?DepositFundsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deposits funds into a paypoint's available payout balance. Deposited funds enter a pending state and aren't available for instant payouts until confirmed through FBO reconciliation.
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
$client->funding->depositFunds(
    new DepositFundsRequest([
        'amount' => 1500,
        'entrypoint' => '48acde49',
        'accountId' => '333',
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

**$amount:** `float` — The amount to deposit, in dollars. Must be greater than zero.
    
</dd>
</dl>

<dl>
<dd>

**$entrypoint:** `string` — The entry point identifier for the paypoint receiving the deposit.
    
</dd>
</dl>

<dl>
<dd>

**$accountId:** `string` — The remittance account ID to withdraw funds from.
    
</dd>
</dl>

<dl>
<dd>

**$paypointId:** `?int` — The paypoint ID. Optional if the entry point uniquely identifies the paypoint.
    
</dd>
</dl>

<dl>
<dd>

**$sameDayAch:** `?bool` — When `true` and the request is submitted before 2 PM ET, the deposit processes as same-day ACH. If the request is submitted after 2 PM ET, it processes as standard ACH regardless of this flag.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Wallet
<details><summary><code>$client-&gt;wallet-&gt;configureApplePayOrganization($request) -> ?ConfigureApplePayOrganizationApiResponse</code></summary>
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
        'orgId' => 123,
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

<details><summary><code>$client-&gt;wallet-&gt;configureApplePayPaypoint($request) -> ?ConfigureApplePaypointApiResponse</code></summary>
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

<details><summary><code>$client-&gt;wallet-&gt;configureGooglePayOrganization($request) -> ?ConfigureApplePayOrganizationApiResponse</code></summary>
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
        'orgId' => 123,
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

<details><summary><code>$client-&gt;wallet-&gt;configureGooglePayPaypoint($request) -> ?ConfigureGooglePaypointApiResponse</code></summary>
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

## PayoutSubscription
<details><summary><code>$client-&gt;payoutSubscription-&gt;createPayoutSubscription($request) -> ?AddPayoutSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a payout subscription to automatically send payouts to a vendor on a recurring schedule. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for a step-by-step guide.
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
$client->payoutSubscription->createPayoutSubscription(
    new RequestPayoutSchedule([
        'entryPoint' => '8cfec329267',
        'paymentMethod' => new AuthorizePaymentMethod([
            'method' => 'ach',
            'achHolder' => 'Herman Coatings',
            'achRouting' => '021000021',
            'achAccount' => '3453445666',
            'achAccountType' => 'checking',
        ]),
        'paymentDetails' => new PayoutPaymentDetail([
            'totalAmount' => 500,
            'serviceFee' => 0,
            'currency' => 'USD',
        ]),
        'vendorData' => new RequestOutAuthorizeVendorData([
            'vendorId' => 456,
        ]),
        'billData' => [
            new BillPayOutDataRequest([
                'dueDate' => new DateTime('2027-08-15'),
                'invoiceDate' => new DateTime('2027-08-01'),
                'invoiceNumber' => 'INV-2345',
                'netAmount' => '500',
            ]),
        ],
        'scheduleDetails' => new PayoutScheduleDetail([
            'startDate' => '01/01/2027',
            'endDate' => '12/31/2027',
            'frequency' => Frequency::Monthly->value,
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
</dd>
</dl>

<dl>
<dd>

**$entryPoint:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$subdomain:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$accountId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$source:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$setPause:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethod:** `AuthorizePaymentMethod` — Payment method for the payout subscription. Supports `ach`, `vcard`, and `check`. The `managed` method isn't supported for payout subscriptions.
    
</dd>
</dl>

<dl>
<dd>

**$paymentDetails:** `?PayoutPaymentDetail` — Object describing details of the payout.
    
</dd>
</dl>

<dl>
<dd>

**$vendorData:** `RequestOutAuthorizeVendorData` — Object identifying the vendor for this subscription. Only a `vendorId` or `vendorNumber` is needed to link to an existing vendor.
    
</dd>
</dl>

<dl>
<dd>

**$billData:** `?array` — Array of bills associated with the payout subscription. If omitted and `doNotCreateBills` isn't set to `true`, the system creates a bill automatically.
    
</dd>
</dl>

<dl>
<dd>

**$scheduleDetails:** `?PayoutScheduleDetail` — Object describing the schedule for the payout subscription.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;payoutSubscription-&gt;getPayoutSubscription($id) -> ?GetPayoutSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a single payout subscription's details. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for more information.
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
$client->payoutSubscription->getPayoutSubscription(
    42,
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

**$id:** `int` — The payout subscription ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;payoutSubscription-&gt;updatePayoutSubscription($id, $request) -> ?UpdatePayoutSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a payout subscription's details. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for more information.
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
$client->payoutSubscription->updatePayoutSubscription(
    42,
    new UpdatePayoutSubscriptionBody([
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

**$id:** `int` — The payout subscription ID.
    
</dd>
</dl>

<dl>
<dd>

**$setPause:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$paymentDetails:** `?PayoutPaymentDetail` — Object describing details of the payout.
    
</dd>
</dl>

<dl>
<dd>

**$paymentMethod:** `?AuthorizePaymentMethod` 
    
</dd>
</dl>

<dl>
<dd>

**$scheduleDetails:** `?PayoutScheduleDetail` — Object describing the schedule for the payout subscription.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;payoutSubscription-&gt;deletePayoutSubscription($id) -> ?DeletePayoutSubscriptionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a payout subscription and prevents future payouts. See [Manage payout subscriptions](/guides/pay-out-developer-payout-subscriptions-manage) for more information.
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
$client->payoutSubscription->deletePayoutSubscription(
    42,
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

**$id:** `int` — The payout subscription ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ChargeBacks
<details><summary><code>$client-&gt;chargeBacks-&gt;addResponse($id, $request) -> ?AddResponseResponse</code></summary>
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

**$idempotencyKey:** `?string` — _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
    
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

<details><summary><code>$client-&gt;chargeBacks-&gt;getChargeback($id) -> ?ChargebackQueryRecords</code></summary>
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

**$id:** `int` — ID of the chargeback or return record. This is returned as `chargebackID` in the [ReceivedChargeBack](/developers/webhooks/payops-chargeback-received) and [ReceivedAchReturn](/developers/webhooks/payops-ach-return-received) webhook notifications.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;chargeBacks-&gt;getChargebackAttachment($id, $fileName) -> ?string</code></summary>
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

## Case Management
<details><summary><code>$client-&gt;caseManagement-&gt;validateBankAccountChange($paypointId, $request) -> ?PreCreationValidationResult</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Validates a bank account change for a paypoint without creating a case.
Runs the same checks the create endpoint runs, and returns blocking
conditions and warnings. Blocking conditions prevent creation; warnings
don't.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->validateBankAccountChange(
    3040,
    new ValidateBankAccountChangeRequest([
        'routingNumber' => '123456789',
        'accountNumber' => '987654321',
        'accountType' => 'checking',
        'bankAccountHolderType' => 'business',
        'bankAccountFunction' => CaseManagementBankAccountFunction::Deposits->value,
        'services' => new BankAccountServices([
            'moneyIn' => [
                CaseManagementMoneyInService::Ach->value,
            ],
            'moneyOut' => [
                CaseManagementMoneyOutService::Ach->value,
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

**$paypointId:** `int` — The paypoint's numeric identifier.
    
</dd>
</dl>

<dl>
<dd>

**$routingNumber:** `string` — The 9-digit bank routing number.
    
</dd>
</dl>

<dl>
<dd>

**$accountNumber:** `string` — The bank account number (4 to 17 digits).
    
</dd>
</dl>

<dl>
<dd>

**$accountType:** `string` — The account type. Must be `checking` or `savings`.
    
</dd>
</dl>

<dl>
<dd>

**$bankAccountHolderType:** `string` — The account holder type. Must be `personal` or `business`.
    
</dd>
</dl>

<dl>
<dd>

**$bankAccountFunction:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$services:** `BankAccountServices` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;createBankAccountChange($paypointId, $request) -> ?CaseResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a bank-account-change case for a paypoint. The account and
routing numbers are validated and tokenized before the case is saved —
the raw numbers are never stored or returned. The account holder name is
taken from the paypoint's legal name. On success the case is created in
`Submitted` and asynchronous verification starts.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->createBankAccountChange(
    3040,
    new CreateBankAccountChangeCaseRequest([
        'nickname' => 'Main Settlement Account',
        'bankName' => 'First National Bank',
        'routingNumber' => '123456789',
        'accountNumber' => '987654321',
        'accountType' => 'checking',
        'bankAccountHolderType' => 'business',
        'bankAccountFunction' => CaseManagementBankAccountFunction::Deposits->value,
        'services' => new BankAccountServices([
            'moneyIn' => [
                CaseManagementMoneyInService::Ach->value,
            ],
            'moneyOut' => [
                CaseManagementMoneyOutService::Ach->value,
            ],
        ]),
        'default' => true,
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

**$paypointId:** `int` — The paypoint's numeric identifier.
    
</dd>
</dl>

<dl>
<dd>

**$nickname:** `string` — A label for the account.
    
</dd>
</dl>

<dl>
<dd>

**$bankName:** `string` — The name of the bank.
    
</dd>
</dl>

<dl>
<dd>

**$routingNumber:** `string` — The 9-digit bank routing number.
    
</dd>
</dl>

<dl>
<dd>

**$accountNumber:** `string` — The bank account number (4 to 17 digits).
    
</dd>
</dl>

<dl>
<dd>

**$accountType:** `string` — The account type. Must be `checking` or `savings`.
    
</dd>
</dl>

<dl>
<dd>

**$bankAccountHolderType:** `string` — The account holder type. Must be `personal` or `business`.
    
</dd>
</dl>

<dl>
<dd>

**$bankAccountFunction:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$services:** `BankAccountServices` 
    
</dd>
</dl>

<dl>
<dd>

**$default_:** `bool` — Whether this is the default account for the selected services.
    
</dd>
</dl>

<dl>
<dd>

**$scheduleFor:** `?DateTime` 

When to run the change, as a UTC timestamp (trailing `Z`). Must be at
least 1 hour and at most 30 days in the future. Omit to run as soon as
the case is approved.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;getCase($uuid) -> ?CaseResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a case by its UUID, including its current state, parameters,
state history, verification metadata, and attachments.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->getCase(
    '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
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

**$uuid:** `string` — The case's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;listCases($organizationId, $request) -> ?CaseListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists cases for an organization, climbing the platform org hierarchy.
Supports pagination and sorting through query parameters, and filtering
through repeatable `parameters[field(op)]=value` query parameters (for
example `parameters[state(in)]=Assigned|PendingReview`). Filterable
fields include `state`, `caseType`, `paypointId`, `createdAt`,
`updatedAt`, `scheduleFor`, and `createdBy`.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->listCases(
    123,
    new ListCasesCaseManagementRequest([
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

**$organizationId:** `int` — The organization's numeric identifier.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — The zero-based index of the first record to return.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` — The maximum number of records to return (1 to 200).
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?string` — Sort expression, such as `desc(createdAt)` or `asc(state)`. Defaults to `desc(createdAt)`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;listMessages($caseUuid, $request) -> ?MessagePage</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the notes on a case, ordered oldest to newest. Cursor-paginated.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->listMessages(
    '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
    new ListMessagesCaseManagementRequest([]),
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

**$caseUuid:** `string` — The case's UUID.
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — The maximum number of notes to return (default 50, max 200).
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — An opaque cursor for the next page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;postMessage($caseUuid, $request) -> ?PostedMessage</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Adds a note to a case.

Available to both Platform and Enterprise Partners.

This endpoint is in development and not yet available for API use. To
add a note for now, use Case Management in the
[Payabli Portal](/guides/pay-ops-portal-bank-account-changes-manage).
To read existing notes on a case, use
[List case notes](/developers/api-reference/caseManagement/list-case-notes).
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
$client->caseManagement->postMessage(
    '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
    new PostCaseMessageRequest([
        'content' => 'Reviewed supporting documents; account ownership confirmed.',
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

**$caseUuid:** `string` — The case's UUID.
    
</dd>
</dl>

<dl>
<dd>

**$content:** `string` — The note text (1 to 4000 characters).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;listTransitions($uuid) -> ?AvailableTransitionsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the review actions currently available on a case. The list is
empty when no user action is available (for example while the case is
mid-automation).

Available to both Platform and Enterprise Partners, though only
Enterprise Partners can fire the returned actions.
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
$client->caseManagement->listTransitions(
    '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
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

**$uuid:** `string` — The case's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;transition($uuid, $request) -> ?CaseResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Fires a review action on a case, such as `Approve`, `Deny`, `Escalate`,
or `RequestReview`. Assigning a case uses the dedicated assign endpoint,
not this one. Firing an action that isn't valid for the case's current
state returns `409`.

Available to Enterprise Partners only.
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
$client->caseManagement->transition(
    '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
    new TransitionCaseRequest([
        'trigger' => CaseTrigger::Approve->value,
        'reason' => 'Account ownership confirmed with the merchant by phone.',
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

**$uuid:** `string` — The case's UUID.
    
</dd>
</dl>

<dl>
<dd>

**$trigger:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$reason:** `string` — The reason for the action.
    
</dd>
</dl>

<dl>
<dd>

**$declineReason:** `?string` — The decline reason. Required when the trigger is `Deny`, and must be omitted otherwise.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;assignCase($uuid, $request) -> ?CaseResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Assigns a case to a reviewer.

Available to Enterprise Partners only.
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
$client->caseManagement->assignCase(
    '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
    new AssignCaseRequest([
        'assigneeId' => 4238,
        'reason' => 'Routing to the risk team for review.',
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

**$uuid:** `string` — The case's UUID.
    
</dd>
</dl>

<dl>
<dd>

**$assigneeId:** `int` — The numeric id of the reviewer to assign the case to.
    
</dd>
</dl>

<dl>
<dd>

**$reason:** `?string` — An optional reason for the assignment.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;listAttachments($caseUuid) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the files attached to a case.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->listAttachments(
    '9c2b7e14-3a5f-4d21-b8e0-1f6a4c9d2e70',
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

**$caseUuid:** `string` — The case's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;uploadAttachment($caseUuid, $request) -> ?AttachmentResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Uploads a file to a case as multipart form data. The maximum size is
25 MiB, and the content type must be an allowed type such as PDF, PNG,
JPEG, CSV, XLSX, DOCX, or plain text.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->uploadAttachment(
    'caseUuid',
    new UploadAttachmentCaseManagementRequest([
        'file' => File::createFromString("example_file", "example_file"),
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

**$caseUuid:** `string` — The case's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;getAttachment($caseUuid, $attachmentId) -> string</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Streams the file content of an attachment.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->getAttachment(
    'caseUuid',
    'attachmentId',
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

**$caseUuid:** `string` — The case's UUID.
    
</dd>
</dl>

<dl>
<dd>

**$attachmentId:** `string` — The attachment's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;caseManagement-&gt;deleteAttachment($caseUuid, $attachmentId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes an attachment from a case.

Available to both Platform and Enterprise Partners.
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
$client->caseManagement->deleteAttachment(
    'caseUuid',
    'attachmentId',
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

**$caseUuid:** `string` — The case's UUID.
    
</dd>
</dl>

<dl>
<dd>

**$attachmentId:** `string` — The attachment's UUID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Billing
<details><summary><code>$client-&gt;billing-&gt;listProfiles($orgId, $request) -> ?BillingProfileQueryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns every billing profile that belongs to an organization. This is
the data behind the Profile Library table in the Payabli Portal.

Requires a token with the `billing_profile_read` permission; a token
without it gets `403 Forbidden`.
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
$client->billing->listProfiles(
    123,
    new ListBillingProfilesRequest([
        'limitRecord' => 20,
        'fromRecord' => 0,
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

**$orgId:** `int` — The organization's numeric identifier.
    
</dd>
</dl>

<dl>
<dd>

**$profileName:** `?string` — Filter to profiles whose name contains this string.
    
</dd>
</dl>

<dl>
<dd>

**$feeType:** `?int` 

Filter by fee type. Repeatable to match more than one. Send the enum
value (`1` Flat, `2` ICP).
    
</dd>
</dl>

<dl>
<dd>

**$serviceVertical:** `?int` 

Filter by billing vertical. Repeatable to match more than one. Send
the enum value (`1` PayIn, `2` PayOut, `3` PayOps).
    
</dd>
</dl>

<dl>
<dd>

**$profileId:** `?int` — Filter to a single profile by its identifier.
    
</dd>
</dl>

<dl>
<dd>

**$limitRecord:** `?int` 

Page size. Defaults to `20`. Passing `0` returns no records — use a
positive value to page through results.
    
</dd>
</dl>

<dl>
<dd>

**$fromRecord:** `?int` — Zero-based offset into the result set. Defaults to `0`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;billing-&gt;getProfile($serviceGroup, $entityType, $entityId) -> ?BillingProfileResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the billing profile currently assigned to an entity, including
its billable events and fee schedules. Use it to read the pricing terms
in effect for an organization, paypoint, template, or application.

Requires a token with the `billing_profile_read` permission and access
to the requested entity; otherwise the call gets `403 Forbidden`.

If the entity exists but has no profile assigned, the call returns
`404 Not Found`.
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
$client->billing->getProfile(
    GetProfileBillingRequestServiceGroup::PayIn->value,
    GetProfileBillingRequestEntityType::Organization->value,
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

**$serviceGroup:** `string` 

The billing vertical. Only `PayIn` and `PayOut` are accepted; any
other value returns `400 Bad Request`.
    
</dd>
</dl>

<dl>
<dd>

**$entityType:** `string` 

The owning entity type: `Organization`, `Paypoint`, `Template`, or
`Application`.
    
</dd>
</dl>

<dl>
<dd>

**$entityId:** `int` — The numeric identifier of the entity.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

