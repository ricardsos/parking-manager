<?php

namespace App\Exports;

use App\Models\Stay;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ResidentPaymentReport implements FromQuery
{
    use Exportable;

    /**
    * @return Builder
     */
    public function query(): Builder
    {
        return Stay::where();
    }
}
