<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InstructionExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $instructions;

    public function __construct(array $instructions)
    {
        $this->instructions = $instructions;
    }

    public function headings(): array
    {
        return [
            ['List of Instruction'],
            [
                '#',
                'Instruction ID',
                'Link To',
                'Instruction Type',
                'Assigned Vendor',
                'Attention Of',
                'Quotation No',
                'Customer PO',
                'Status',
            ]
        ];
    }
    
    public function array(): array
    {
        return $this->instructions;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:I1');

        $total = count($this->instructions) + 3;
        $left = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT;
        $center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

        return [
                // judul file
                1  => [
                    'font' => [
                        'size' => 20,
                        'argb' => '000000',
                    ],
                    'alignment' => [
                        'horizontal' => $center,
                    ],
                ],

                // nama field
                2 => [
                    'font' => [
                        'size' => 14,
                        'color' => [
                            'argb' => 'F5F6F8',
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => $left,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => '58595B',
                        ],
                    ],
                ],
                
                // data instructions
                '3:' . $total => [
                    'font' => [
                        'size' => 12,
                        'color' => [
                            'argb' => '000000',
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => $left,
                    ],
                ],
            ];
    }
}
