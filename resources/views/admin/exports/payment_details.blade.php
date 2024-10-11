<div class="card-body">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Date Time</th>
                    <th>Report Name</th>
                    <th>User Name</th>
                    <th>Email ID</th>
                    <th>Mobile No.</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Payment ID</th>
                    <th>Amount</th>
                    <th>Licence Type</th>
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
                    <td>{{ $item->created_at}}</td>

                    <td>{{ $item->report_name}}</td>
                    <td>{{ $item->user_name}}</td>
                    <td>{{ $item->user_email}}</td>
                    <td>{{ $item->user_mobile}}</td>
                    <td>{{ $item->payment_method}}</td>

                    <td>{{ $item->payment_status}}</td>
                    <td>{{ $item->payment_id}}</td>
                    <td>{{ $item->report_price}}</td>
                    <td>{{ $item->license_type}}</td>
                    <td>{{ $item->created_ip_address}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>