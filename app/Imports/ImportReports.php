<?php

namespace App\Imports;

use App\Models\Arm_reports;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Session;


HeadingRowFormatter::default('none');

class ImportReports implements ToCollection, WithHeadingRow, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function headingRow(): int
    {
        return 0;
    }
    public function startRow(): int
    {
        return 2;
    }

    // public function model(array $row)
    // {
    //     dd($row['report_title']);
    //     return new Arm_reports([
    //        'name'     => $row[0],
    //        'email'    => $row[1],
    //        'password' => Hash::make($row[2]),
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        set_time_limit(0);
        $inValidRecord = array();
        $successRecord = array();
        $data = array();
        foreach ($rows as $key => $row) {
            if ($row[0] != '' ||  $row[1] != '' || $row[2] != '') {
                $Arm_reports = new Arm_reports;

                if (Arm_reports::where('status', '!=', 'delete')->where('title', trim($row[0], " "))->exists()) {
                    $inValidRecord['title_error'][$key] = "title in row no. " . ++$key . " already exist";
                    continue;
                } else {
                    $Arm_reports->title = ($row[0]); //A
                }

                if (Arm_reports::where('status', '!=', 'delete')->where('url', trim($row[1], " "))->exists()) {
                    $inValidRecord['url_error'][$key] = "url in row no. " . ++$key . " already exist";
                    continue;
                } else {
                    if (!empty($row[1])) {
                        $Arm_reports->url = ($row[1]); //B
                    } else {
                        $inValidRecord['url_error'][$key] = "url not found in row no. " . ++$key . " already exist";
                        continue;
                    }
                }

                $Arm_reports->description = $row[2]; //C
                $Arm_reports->table_of_content = $row[3]; //D
                $Arm_reports->research_methodology = $row[4]; //E
                $Arm_reports->infographics = $row[5]; //F
                $Arm_reports->total_pages = $row[6]; //G

                if (is_numeric($row[7])) {
                    $Arm_reports->single_user_cost = $row[7]; //H
                } else {
                    $inValidRecord['single_user_cost_error'][$key] = "single user cost must be integer in row no. " . ++$key;
                    continue;
                }

                if (is_numeric($row[8])) {
                    $Arm_reports->multi_user_cost = $row[8]; //I
                } else {
                    $inValidRecord['multi_user_cost_error'][$key] = "multi user cost must be integer in row no. " . ++$key;
                    continue;
                }

                if (is_numeric($row[9])) {
                    $Arm_reports->enterprise_user_cost = $row[9]; //J
                } else {
                    $inValidRecord['enterprise_user_cost_error'][$key] = "enterprise user cost must be integer in row no. " . ++$key;
                    continue;
                }

                $Arm_reports->category_id = $row[10]; //K
                // $Arm_reports->category_name = $row[11]; //L 
                $Arm_reports->keyword = $row[12]; //M
                $Arm_reports->published_on = $row[13]; //N
                $Arm_reports->base_year = $row[14]; //O
                $Arm_reports->estimated_year = $row[15]; //P
                $Arm_reports->historical_data = $row[16]; //Q
                $Arm_reports->forecast_period = $row[17]; //R

                if(!empty($row[18])){
                    $Arm_reports->image_1_path = $row[18]; //S
                    $array = explode('/', $row[18]);
                    $image_name_1 = end($array);
                    $Arm_reports->image_1_name = $image_name_1; //S
                }
                if(!empty($row[19])){
                    $Arm_reports->image_2_path = $row[19]; //T
                    $array = explode('/', $row[19]);
                    $image_name_2 = end($array);
                    $Arm_reports->image_2_name = $image_name_2; //T
                }

                if(!empty($row[20])){
                    $Arm_reports->image_3_path = $row[20]; //U
                    $array = explode('/', $row[20]);
                    $image_name_3 = end($array);
                    $Arm_reports->image_3_name = $image_name_3; //U
                }

                $Arm_reports->meta_title = $row[21]; //V
                $Arm_reports->meta_keyword = $row[22]; //W
                $Arm_reports->meta_description = $row[23]; //X
                if($Arm_reports->save()){
                    $prefix = "WMR_";
                    $suffix = sprintf("%07s", $Arm_reports->id);
                    Arm_reports::where('id', $Arm_reports->id)->update(array("report_id" => $prefix.$suffix));
                    $successRecord['success'][$key] = "successfully done";
                }
                else{
                    $inValidRecord['error'][$key] = "Something Wrong in". $key;
                }
            }
        }
        $data['success'] = $successRecord;
        $data['error'] = $inValidRecord;
        Session::push('message_data', $data);
    }
}
