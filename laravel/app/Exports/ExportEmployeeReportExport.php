<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ExportEmployeeReportExport implements  FromQuery
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    private $data;
    public function __construct($data)
    {
        $this->data =$data;
    }
    /*public function view(): View
    {
        return view('export_view', [
            'data' => $this->data
        ]);
    }*/
    public function query()
    {
        return User::employeesWithSalaries();
    }
}
