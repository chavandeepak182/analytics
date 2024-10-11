@extends('admin.layout.layout')
@section("content")

<style>
     .content-wrapper {
        min-height: 0 !important;
    }
    .faq-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .row.faq-color-div {
        margin: 0px 15px 15px;
        background: #2d296724;
        padding: 10px 0px;
        border: 1px solid #2d296726;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        border-radius: 2px;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <section class="content-header">
               <h1>
                  Add Reports
                  <div class="pull-right">
                     <a href="{{url('admin/report')}}">
                        <button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button>
                     </a>
                  </div>
               </h1>
            </section>
            <form action="{{ url('admin/report/store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ !empty($report->id) ? $report->id : '' }}">

                <div class="col-md-12 no-pad" style="display: block;">
                    <div class="box box-primary" style="background: #fff;">
                        <div class="box-body no-height">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label>Choose Category<span style="color: red;">*</span></label>
                                    <select class="form-control" name="category_id[]" id="category_id" multiple>
                                        @if(!empty($categories))
                                            <option value="">Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ isset($report) && in_array($category->id, explode(",", $report->category_id)) ? 'selected' : '' ; }}> {{ $category->category_name }} </option>
                                            @endforeach
                                        @else
                                            <option value="">Select</option>
                                        @endif
                                    </select>
                                    @if($errors->has('category_id'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('category_id')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 no-pad">
                    <section class="content" style="padding:5px 0px;">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-md-12 no-pad">
                                    <div class="row">
                                        <div class="col-md-8 no-pad">
                                            <div class="col-md-12 form-group no-pad-right ">
                                                <label class="lablefnt">Report Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ !empty($report->title) ? $report->title : old('title')  }}">
                                                @if($errors->has('title'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('title')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12 form-group no-pad-right ">
                                                <label class="lablefnt">Report URL</label>
                                                <input type="text" class="form-control" report_id="{{ !empty($report->id) ? $report->id : '' }}" id="report_url" name="url" value="{{ !empty($report->url) ? $report->url : old('url')  }}">
                                                <span class="text-danger" id="url_existence_message"></span>
                                                @if($errors->has('url'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('url')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12 form-group no-pad-right ">
                                                <label class="lablefnt">Report Keyword</label>
                                                <input type="text" class="form-control" id="keyword" name="keyword" value="{{ !empty($report->keyword) ? $report->keyword : old('keyword')  }}">
                                                @if($errors->has('keyword'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('keyword')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">Single User Cost <small class="text-danger">($)</small></label>
                                                <input type="text" class="form-control" id="single_user_cost" name="single_user_cost" value="{{ !empty($report->single_user_cost) ? $report->single_user_cost : old('single_user_cost')  }}">
                                                @if($errors->has('single_user_cost'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('single_user_cost')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">Multi User Cost <small class="text-danger">($)</small></label>
                                                <input type="text" class="form-control" id="multi_user_cost" name="multi_user_cost" value="{{ !empty($report->multi_user_cost) ? $report->multi_user_cost : old('multi_user_cost')  }}">
                                                @if($errors->has('multi_user_cost'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('multi_user_cost')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">Enterprise User Cost <small class="text-danger">($)</small></label>
                                                <input type="text" class="form-control" id="enterprise_user_cost" name="enterprise_user_cost" value="{{ !empty($report->enterprise_user_cost) ? $report->enterprise_user_cost : old('enterprise_user_cost')  }}">
                                                @if($errors->has('enterprise_user_cost'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('enterprise_user_cost')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">Published On</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar date"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right date" id="published_on" name="published_on" autocomplete="off" value="{{ !empty($report->published_on) ? $report->published_on : old('published_on')  }}">
                                                </div>
                                                @if($errors->has('published_on'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('published_on')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">Base Year</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar date"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right date" id="base_year" name="base_year" autocomplete="off" value="{{ !empty($report->base_year) ? $report->base_year : old('base_year')  }}">
                                                    @if($errors->has('base_year'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('base_year')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">Estimated Year</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar date"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right date" id="estimated_year" name="estimated_year" autocomplete="off" value="{{ !empty($report->estimated_year) ? $report->estimated_year : old('estimated_year')  }}">
                                                    @if($errors->has('estimated_year'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('estimated_year')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">Historical Data Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar date"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right date" id="historical_data" name="historical_data" autocomplete="off" value="{{ !empty($report->historical_data) ? $report->historical_data : old('historical_data')  }}">
                                                    @if($errors->has('historical_data'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('historical_data')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">Forecast Period</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar date"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right date" id="forecast_period" name="forecast_period" autocomplete="off" value="{{ !empty($report->forecast_period) ? $report->forecast_period : old('forecast_period')  }}">
                                                    @if($errors->has('forecast_period'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('forecast_period')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-4 form-group no-pad-right">
                                                <label class="lablefnt">No. Of Pages</label>
                                                <input type="text" class="form-control" id="total_pages" name="total_pages" value="{{ !empty($report->total_pages) ? $report->total_pages : old('total_pages')  }}">
                                                @if($errors->has('total_pages'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('total_pages')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-4 form-group no-pad">
                                            <div class="col-md-12">
                                                <label>Infographics Image 1<small class="text-danger">( 1600 * 900 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                <input type="file" class="form-control preview" id="image_1_path" name="image_1_path" accept=".jpg,.jpeg,.bmp,.png,">
                                                <img src="{{!empty($report->image_1_path) && Storage::exists($report->image_1_path) ? url('/').Storage::url($report->image_1_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($report->image_1_name) ? $report->image_1_name : 'User Image';}}">
                                                @if($errors->has('image_1_path'))
                                                    <span class="text-danger"><b>* {{$errors->first('image_1_path')}} </b></span>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mt-10">
                                                <label>Infographics Image 2<small class="text-danger">( 1600 * 900 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                <input type="file" class="form-control preview1" id="image_2_path" name="image_2_path" accept=".jpg,.jpeg,.bmp,.png,">
                                                <img src="{{!empty($report->image_2_path) && Storage::exists($report->image_2_path) ? url('/').Storage::url($report->image_2_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image1" alt="{{!empty($report->image_2_name) ? $report->image_2_name : 'User Image';}}">
                                                @if($errors->has('image_2_path'))
                                                    <span class="text-danger"><b>* {{$errors->first('image_2_path')}}</b></span>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mt-10">
                                                <label>Infographics Image 3<small class="text-danger">( 1600 * 900 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                <input type="file" class="form-control preview2" id="image_3_path" name="image_3_path" accept=".jpg,.jpeg,.bmp,.png,">
                                                <img src="{{!empty($report->image_3_path) && Storage::exists($report->image_3_path) ? url('/').Storage::url($report->image_3_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image2" alt="{{!empty($report->image_3_name) ? $report->image_3_name : 'User Image';}}">
                                                @if($errors->has('image_3_path'))
                                                    <span class="text-danger"><b>* {{$errors->first('image_3_path')}}</b></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group no-pad-right">
                                            <label>Full Description<span style="color: red;">*</span></label>
                                            <textarea class="form-control summernote" name="description" id="description">{!! !empty($report->description) ? $report->description : old('description') !!}</textarea>
                                            @if($errors->has('description'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('description')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Table of Content
                                                <span style="color: red;">*</span></label>
                                            <textarea class="form-control summernote" name="table_of_content" id="table_of_content">{!! !empty($report->table_of_content) ? $report->table_of_content : old('table_of_content') !!}</textarea>
                                            @if($errors->has('table_of_content'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('table_of_content')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group no-pad-right">
                                            <label>Research Mathodology<span style="color: red;">*</span></label>
                                            <textarea class="form-control summernote" name="research_methodology" id="research_methodology">{!! !empty($report->research_methodology) ? $report->research_methodology : old('research_methodology') !!}</textarea>
                                            @if($errors->has('research_methodology'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('research_methodology')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Ingographics<span style="color: red;">*</span></label>
                                            <textarea class="form-control summernote" name="infographics" id="infographics">{!! !empty($report->infographics) ? $report->infographics : old('infographics') !!}</textarea>
                                            @if($errors->has('infographics'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('infographics')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ !empty($report->meta_description) ? $report->meta_description : old('meta_description') }}">
                                            @if($errors->has('meta_description'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('meta_description')}}</span>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-12 form-group no-pad-right">
                                            <label class="lablefnt">Meta Keyword</label>
                                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ !empty($report->meta_keyword) ? $report->meta_keyword : old('meta_keyword') }}">
                                            @if($errors->has('meta_keyword'))
                                            <span class="text-danger"><b>*</b> {{$errors->first('meta_keyword')}}</span>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-12 form-group no-pad-right">
                                            <label class="lablefnt">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ !empty($report->meta_title) ? $report->meta_title : old('meta_title') }}">
                                            @if($errors->has('meta_title'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('meta_title')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 mb-10 hide-show-div faq-toggle">
                                            <div class="form-check">
                                                <label for="faq_status" class="css-label radGroup1 mb-0">FAQ's</label>
                                                <input class="form-check-input" type="checkbox" id="faq_status" name="faq_status" value="{{ (!empty($report->faq_status) && $report->faq_status == 'active') ? 'active' : 'inactive' }}" {{ (!empty($report->faq_status) && $report->faq_status == 'active') ? 'checked' : '' }}>
                                            </div>  
                                        </div>

                                        <div class="clearfix"></div>

                                        <div class="row faq-color-div">
                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Question 1.</label>
                                                <input type="text" class="form-control" id="faq_question_1" name="faq_question_1" value="{{ !empty($report->faq_question_1) ? $report->faq_question_1 : old('faq_question_1') }}">
                                                @if($errors->has('faq_question_1'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_question_1')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Answer</label>
                                                <input type="text" class="form-control" id="faq_answer_1" name="faq_answer_1" value="{{ !empty($report->faq_answer_1) ? $report->faq_answer_1 : old('faq_answer_1') }}">
                                                @if($errors->has('faq_answer_1'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_answer_1')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row faq-color-div">
                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Question 2.</label>
                                                <input type="text" class="form-control" id="faq_question_2" name="faq_question_2" value="{{ !empty($report->faq_question_2) ? $report->faq_question_2 : old('faq_question_2') }}">
                                                @if($errors->has('faq_question_2'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_question_2')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Answer</label>
                                                <input type="text" class="form-control" id="faq_answer_2" name="faq_answer_2" value="{{ !empty($report->faq_answer_2) ? $report->faq_answer_2 : old('faq_answer_2') }}">
                                                @if($errors->has('faq_answer_2'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_answer_2')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row faq-color-div">
                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Question 3.</label>
                                                <input type="text" class="form-control" id="faq_question_3" name="faq_question_3" value="{{ !empty($report->faq_question_3) ? $report->faq_question_3 : old('faq_question_3') }}">
                                                @if($errors->has('faq_question_3'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_question_3')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Answer</label>
                                                <input type="text" class="form-control" id="faq_answer_3" name="faq_answer_3" value="{{ !empty($report->faq_answer_3) ? $report->faq_answer_3 : old('faq_answer_3') }}">
                                                @if($errors->has('faq_answer_3'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_answer_3')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row faq-color-div">
                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Question 4.</label>
                                                <input type="text" class="form-control" id="faq_question_4" name="faq_question_4" value="{{ !empty($report->faq_question_4) ? $report->faq_question_4 : old('faq_question_4') }}">
                                                @if($errors->has('faq_question_4'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_question_4')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Answer</label>
                                                <input type="text" class="form-control" id="faq_answer_4" name="faq_answer_4" value="{{ !empty($report->faq_answer_4) ? $report->faq_answer_4 : old('faq_answer_4') }}">
                                                @if($errors->has('faq_answer_4'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_answer_4')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row faq-color-div">
                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Question 5.</label>
                                                <input type="text" class="form-control" id="faq_question_5" name="faq_question_5" value="{{ !empty($report->faq_question_5) ? $report->faq_question_5 : old('faq_question_5') }}">
                                                @if($errors->has('faq_question_5'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_question_5')}}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label class="lablefnt">Enter Answer</label>
                                                <input type="text" class="form-control" id="faq_answer_5" name="faq_answer_5" value="{{ !empty($report->faq_answer_5) ? $report->faq_answer_5 : old('faq_answer_5') }}">
                                                @if($errors->has('faq_answer_5'))
                                                    <span class="text-danger"><b>*</b> {{$errors->first('faq_answer_5')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 no-pad-left">
                                    <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> {{!empty($report->id) ? 'Update' : 'Add'}}</button>
                                    <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- End box-body -->
                    </section>
                </div>
            </form>                  <!-- End box-body -->

            <!-- End box -->
        </div>
    </section>
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $("#category_id").select2({
        placeholder: "Select Category",
        allowClear: true
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('input[type=checkbox]').click(function(){
            if($(this).val() == "active"){
                $(this).val('inactive');
                $(this).attr('checked','false');
            }else{
                $(this).val('active');
                $(this).attr('checked','true');
            }
        })
    });


    $(".s_meun").removeClass("active");
    // $(".system_users_active").addClass("active");
    $(".all_reports_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
        }).on('summernote.keyup', function() {
            var text = $(".summernote").summernote("code").replace(/&nbsp;|<\/?[^>]+(>|$)/g, "").trim();
            if (text.length == 0) {
                $('#product_description-error').show();
            } else {
                $('#product_description-error').hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#report_url").change(function(){
            $.ajax({
                type: "get",
                url: "{{ url('/admin/report/check-url-exist') }}",
                data: {
                    url: $("#report_url").val(), // Removed the semicolon here
                    report_id: $("#report_url").attr("report_id")
                },
                success: function(response){
                    if(response.trim() == "true"){
                        $("#url_existence_message").removeClass("d-none");
                        $("#url_existence_message").html("<b>*</b> this url has already been taken");
                    } else {
                        $("#url_existence_message").addClass("d-none");
                        $("#url_existence_message").html("");
                    }
                }
            });
        });

        //  datepicker script
        $('#published_on').datepicker({
        //  format: 'dd/mm/yyyy',
         autoclose: true,
         todayHighlight: true,
         changeMonth: true,
         changeYear: true
        });

        $('#base_year').datepicker({
         format: 'yyyy',
         autoclose: true,
         todayHighlight: true,
         changeMonth: true,
         changeYear: true,
         viewMode: "years",
         minViewMode: "years"
        });

        $('#estimated_year').datepicker({
            format: 'yyyy',
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            viewMode: "years",
            minViewMode: "years"
        });

        $('#historical_data').datepicker({
            format: 'yyyy',
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            viewMode: "years",
            minViewMode: "years"
        });

        $('#forecast_period').datepicker({
         format: 'yyyy',
         autoclose: true,
         todayHighlight: true,
         changeMonth: true,
         changeYear: true,
         viewMode: "years",
         minViewMode: "years"
        });
   });

</script>
@endsection

