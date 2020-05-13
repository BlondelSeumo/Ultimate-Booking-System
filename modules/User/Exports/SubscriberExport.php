<?php
namespace Modules\User\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Modules\User\Models\Subscriber;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscriberExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return Subscriber::select([
            'email',
            'first_name',
            'last_name'
        ])->get();
    }

    /**
     * @var Subscriber $subscriber
     * @return array
     */
    public function map($subscriber): array
    {
        return [
            $subscriber->email,
            $subscriber->first_name,
            $subscriber->last_name,
        ];
    }

    public function headings(): array
    {
        return [
            'Email',
            'First name',
            'Last name',
        ];
    }
}
