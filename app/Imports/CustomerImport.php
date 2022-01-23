<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CustomerImport implements ToModel, WithHeadingRow, WithStartRow
{
    use Importable;

    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model( array $row )
    {
        dump( $row );

        return new Customer( [
            'email'        => $row[ 'email' ],
            'phone_number' => $row[ 'phone_number' ],
            'first_name'   => $row[ 'first_name' ],
            'last_name'    => $row[ 'last_name' ],
        ] );
    }
}
