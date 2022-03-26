<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::whereNotNull('email_verified_at')->get();
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->first_name,
            $user->last_name,
            $user->email,
            Date::dateTimeToExcel($user->email_verified_at),
            Date::dateTimeToExcel($user->created_at),
            Date::dateTimeToExcel($user->updated_at),
        ];
    }
    public function headings(): array
    {
        return [
            'ID',
            'First Name',
            'Last Name',
            'E-Mail',
            'Verified Date',
            'Created Date',
            'Updated Date'
        ];
    }
}
