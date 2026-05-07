<?php

namespace App\Exports;

use App\Models\Parcel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ParcelsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $organizationId;

    public function __construct($organizationId)
    {
        $this->organizationId = $organizationId;
    }

    public function query()
    {
        return Parcel::query()
            ->where('organization_id', $this->organizationId)
            ->where('status', 'pending')
            ->with('user');
    }

    public function headings(): array
    {
        return [
            'رقم الطلب',
            'رقم الوصاية',
            'اسم العميل',
            'رقم هوية العميل',
            'هاتف العميل',
            'اسم الوكيل',
            'هاتف الوكيل',
            'رقم هوية الوكيل',
            'اسم الفرع',
            'تاريخ الإنشاء',
            'الحالة'
        ];
    }

    public function map($parcel): array
    {
        return [
            $parcel->id,
            $parcel->parcel_number,
            $parcel->user->name ?? 'غير محدد',
            $parcel->user->id_number ?? 'غير محدد',
            $parcel->user->phone ?? 'غير محدد',
            $parcel->agent_name,
            $parcel->agent_phone,
            $parcel->agent_id_number,
            $parcel->branch_name,
            $parcel->created_at->format('Y-m-d H:i'),
            $parcel->status == 'pending' ? 'قيد الانتظار' : ucfirst($parcel->status)
        ];
    }
}
