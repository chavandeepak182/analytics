<div class="card-body">
    <div class="table-responsive">
        <table id="report_record" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Report Title</th>
                    <th>Report URL</th>
                    <th>Report Description</th>
                    <th>Table of Content</th>
                    <th>Research Methodology</th>
                    <th>Infographics</th>

                    <th>No. of Pages</th>
                    <th>Single User Cost</th>
                    <th>Multi User Cost</th>
                    <th>Entrprise User Cost</th>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Keyword</th>

                    <th>Publish Date</th>
                    <th>Base Year</th>
                    <th>Estimated Year</th>
                    <th>Historical Data</th>
                    <th>Forecast Period</th>

                    <th>file1</th>
                    <th>file2</th>
                    <th>file3</th>

                    <th>Meta Title</th>
                    <th>Meta Keyword</th>
                    <th>Meta Description</th>

                    <th>FAQ Question 1</th>
                    <th>FAQ Answer 1</th>
                    <th>FAQ Question 2</th>
                    <th>FAQ Answer 2</th>
                    <th>FAQ Question 3</th>
                    <th>FAQ Answer 3</th>
                    <th>FAQ Question 4</th>
                    <th>FAQ Answer 4</th>
                    <th>FAQ Question 5</th>
                    <th>FAQ Answer 5</th>
                </tr>
            </thead>
            <tbody>
            @if($all_reports->count() > 0)
                @foreach($all_reports as $data)
                <tr>
                    <td> {{ (isset($data->title) && $data->title != '') ? $data->title : 'N/A' }} </td>
                    <td> <a href="{{ !empty($data->url) ? url('/reports/'.$data->url.'/'.$data['id']) : '' }}">{{ !empty($data->url) ? url('/reports/'.$data->url.'/'.$data['id']) : '' }} </a></td>
                    <td> {{ $data['description'] }} </td>
                    <td> {{ $data['table_of_content'] }} </td>
                    <td> {{ $data['research_methodology'] }} </td>
                    <td> {{ $data['infographics'] }} </td>
                    
                    <td> {{ $data['total_pages'] }} </td>
                    <td> {{ $data['single_user_cost'] }} </td>
                    <td> {{ $data['multi_user_cost'] }} </td>
                    <td> {{ $data['enterprise_user_cost'] }} </td>
                    <td> {{ $data['category_id'] }} </td>
                    <td> 
                        @if(!empty($data['category_id']))
                            @php
                                $category_name = "";
                                foreach(explode("," , $data['category_id']) as $category_id ){
                                    $category_name .= App\Helpers\Helpers\Helper::getCategoryNameById($category_id).", ";
                                }
                            @endphp
                        @endif
                        {{ $category_name }}
                    </td>
                    <td> {{ $data['keyword'] }} </td>
                    
                    <td> {{ $data['published_on'] }} </td>
                    <td> {{ $data['base_year'] }} </td>
                    <td> {{ $data['estimated_year'] }} </td>
                    <td> {{ $data['historical_data'] }} </td>
                    <td> {{ $data['forecast_period'] }} </td>

                    <td> {{ $data['image_1_path'] }} </td>
                    <td> {{ $data['image_2_path'] }} </td>
                    <td> {{ $data['image_3_path'] }} </td>

                    <td> {{ $data['meta_title'] }} </td>
                    <td> {{ $data['meta_keyword'] }} </td>
                    <td> {{ $data['meta_description'] }} </td>

                    <td> {{ $data['faq_question_1'] }} </td>
                    <td> {{ $data['faq_question_2'] }} </td>
                    <td> {{ $data['faq_question_3'] }} </td>
                    <td> {{ $data['faq_question_4'] }} </td>
                    <td> {{ $data['faq_question_5'] }} </td>
                    <td> {{ $data['faq_answer_1'] }} </td>
                    <td> {{ $data['faq_answer_2'] }} </td>
                    <td> {{ $data['faq_answer_3'] }} </td>
                    <td> {{ $data['faq_answer_4'] }} </td>
                    <td> {{ $data['faq_answer_5'] }} </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

