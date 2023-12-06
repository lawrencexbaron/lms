<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $section->grade->name }} - {{ $section->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 10px; /* Reduced padding */
        }
        .header {
            text-align: center;
            margin-bottom: 0; /* Removed bottom margin */
        }
        .logo {
            height: 100px;
            margin-bottom: 0; /* Reduced space below logo */
        }
        .title {
            font-size: 18px;
            margin-top: 4px; /* Reduced space below the title */
            margin-bottom: 0; /* Reduced space below the title */
        }
        .subtitle {
            font-size: 14px;
            margin-top: 2px; /* Reduced space below the subtitle */
        }
        .school-info {
            text-align: center;
            margin-bottom: 24px; /* Reduced bottom margin */
            margin-top: 12px; /* Removed top margin */
            line-height: 0.5;
        }
        .school-name {
            font-size: 18px;
            margin-bottom: 4px; /* Reduced space below the school name */
        }
        .adviser, .section-info {
            font-size: 14px;
            margin-bottom: 0; /* Removed bottom margin */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px; /* Adjust padding as needed */
            text-align: left; /* Align text to the left */
        }
        th {
            background-color: #f3f3f3;
            font-size: 12px;
        }
        td {
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('uploads/logo.png') }}" alt="School Logo" class="logo">
        </div>
        <div class="school-info">
            <h3 class="school-name">{{ $setting->system_title }}</h3>
            <p class="adviser">
                {{ $section->adviser->last_name }}, {{ $section->adviser->first_name }}
                @if ($section->adviser->middle_name)
                    {{ strtoupper(substr($section->adviser->middle_name, 0, 1)) }}.
                @endif
            </p>
            <p class="section-info">
                {{ $section->grade->name }} - {{ $section->name }}
            </p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>LRN</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Type</th>
                    <th>Date Enrolled</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through your data to populate the table -->
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->lrn }}</td>
                        <td>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</td>
                        <td>{{ strtoupper($student->gender) }}</td>
                        <td>{{ strtoupper($student->student_type == 'balik_aral' ? 'Balik-Aral' : $student->student_type) }}</td>
                        <td>{{ $student->date_enrolled ? $student->date_enrolled->format('M d, Y - h:i A') : $student->created_at->format('M d, Y - h:i A') }}</td>
                    </tr>
                @endforeach
                @if($students->isEmpty())
                    <tr>
                        <td colspan="5" style="text-align: center;">No data available</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>