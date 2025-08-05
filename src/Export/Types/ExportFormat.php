<?php

namespace Payabli\Export\Types;

enum ExportFormat: string
{
    case Csv = "csv";
    case Xlsx = "xlsx";
}
