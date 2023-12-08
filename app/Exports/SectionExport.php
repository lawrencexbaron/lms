<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Setting;
use App\Models\Section;
use Carbon\Carbon;

class SectionExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithEvents
{
    protected $section_id;

    public function __construct($section_id)
    {
        $this->section_id = $section_id;
    }

    public function collection()
    {
        return Student::where('section_id', $this->section_id)->with('grade', 'section')->get();
    }

    public function map($student): array
    {
        return [
            $student->lrn ?? 'None',
            $student->student_number,
            $student->first_name,
            $student->middle_name,
            $student->last_name,
            $student->suffix,
            $student->gender,
            ucfirst(($student->student_type == 'balik_aral') ? 'Balik Aral' : $student->student_type),
            $student->birthdate ? Carbon::parse($student->birthdate)->format('M d, Y') : '',
            $student->enrolled_date ? Carbon::parse($student->enrolled_date)->format('M d, Y h:i A') : Carbon::parse($student->created_at)->format('M d, Y h:i A')
        ];
    }

    public function headings(): array
    {
        return [
            'LRN',
            'Student Number',
            'First Name',
            'Middle Name',
            'Last Name',
            'Suffix',
            'Gender',
            'Student Type',
            'Birthday',
            'Enrolled Date'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            // You can add more styling for other rows or columns as needed
        ];
    }

    public function registerEvents(): array
    {
        $setting = Setting::first();
        $school_name = strtoupper($setting->system_title);
        $section = Section::find($this->section_id)->with('grade')->first();
        $adviser = $section->adviser->last_name . ', ' . $section->adviser->first_name . ' ' . $section->adviser->suffix ?? '';
        $grade_section = $section->grade->name . ' - ' . $section->name;

        return [
            AfterSheet::class => function (AfterSheet $event) use ($school_name, $grade_section, $adviser) {
                $event->sheet->mergeCells('A1:J1'); // Merging cells for the title
                $event->sheet->mergeCells('A2:J2'); // Merging cells for the adviser
                $event->sheet->mergeCells('A3:J3'); // Merging cells for the grade and section

                // Setting the title, adviser, and grade/section
                $event->sheet->setCellValue('A1', $school_name);
                $event->sheet->setCellValue('A2', $adviser);
                $event->sheet->setCellValue('A3', $grade_section);

                // Apply styles to the merged cells
                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $event->sheet->getStyle('A2:J2')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $event->sheet->getStyle('A3:J3')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Remove borders on the merged cells
                $event->sheet->getStyle('A1:J1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE);
                $event->sheet->getStyle('A2:J2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE);
                $event->sheet->getStyle('A3:J3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE);

                // Apply font styles to the title, adviser, and grade/section cells
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $event->sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
                $event->sheet->getStyle('A3')->getFont()->setBold(true)->setSize(14);

                // Add the headers back
                $event->sheet->setCellValue('A4', 'LRN');
                $event->sheet->setCellValue('B4', 'Student Number');
                $event->sheet->setCellValue('C4', 'First Name');
                $event->sheet->setCellValue('D4', 'Middle Name');
                $event->sheet->setCellValue('E4', 'Last Name');
                $event->sheet->setCellValue('F4', 'Suffix');
                $event->sheet->setCellValue('G4', 'Gender');
                $event->sheet->setCellValue('H4', 'Student Type');
                $event->sheet->setCellValue('I4', 'Birthday');
                $event->sheet->setCellValue('J4', 'Enrolled Date');

                // add bold on the headers
                $event->sheet->getStyle('A4:J4')->getFont()->setBold(true)->setName('Calibri');

                $event->sheet->getStyle('A5:J' . $event->sheet->getHighestRow())->getFont()->setName('Calibri');
                // Get the collection of students
                $students = $this->collection();

                // Loop through the students and add the data to the sheet
                $row = 5;
                foreach ($students as $student) {
                    $event->sheet->setCellValue('A' . $row, $student->lrn ?? 'None');
                    $event->sheet->setCellValue('B' . $row, $student->student_number);
                    $event->sheet->setCellValue('C' . $row, $student->first_name);
                    $event->sheet->setCellValue('D' . $row, $student->middle_name);
                    $event->sheet->setCellValue('E' . $row, $student->last_name);
                    $event->sheet->setCellValue('F' . $row, $student->suffix);
                    $event->sheet->setCellValue('G' . $row, ucfirst($student->gender));
                    $event->sheet->setCellValue('H' . $row, ucfirst(($student->student_type == 'balik_aral') ? 'Balik Aral' : $student->student_type));
                    $event->sheet->setCellValue('I' . $row, $student->birthdate ? Carbon::parse($student->birthdate)->format('M d, Y') : '');
                    $event->sheet->setCellValue('J' . $row, $student->enrolled_date ? Carbon::parse($student->enrolled_date)->format('M d, Y h:i A') : Carbon::parse($student->created_at)->format('M d, Y h:i A'));

                    $row++;
                }

                // Apply styles to the headers and data cells
                $lastRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle('A4:J' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}