<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export to Excel</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                
                <th>Sr.No.</th>
                <th>Date</th>
                <th>Name</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>Company Name</th>
                <th>Message</th>
                <th>IP Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key=>$item)
            <tr>
                <td>{{$key+1}}</td>
            @php
                $date_time_str = $item->created_at;
                $date_time_obj = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date_time_str);

                // Extract day, month, and year
                $day = $date_time_obj->format('d');
                $month = $date_time_obj->format('F');
                $year = $date_time_obj->format('Y');

                // Format the date as "31 July 2023"
                $formatted_date = $day . ' ' . $month . ' ' . $year;
            @endphp
                <td>{{ $formatted_date}}</td>
                <td>{{$item->fname.' '.$item->lname}}</td>
                <td>{{ $item->phone}}</td>
                <td>{{ $item->email}}</td>
                <td>{{ $item->company_name}}</td>
                <td>{{ $item->message}}</td>
                <td>{{ $item->created_ip_address}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>