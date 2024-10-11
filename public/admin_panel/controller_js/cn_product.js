
var OldProductImgFlg = ($("#old_product_image").val() != "") ? false : true;

$(document).ready(function () {
    $("#product_form").validate({
        rules: {
            category_id: {
                required: true,
            },
            brand_id: {
                required: true,
            },
            tax_id: {
                required: true,
                digits: true,
            },
            product_name: {
                required: true,
                remote: {
                    url:  base_url + "/admin/category-exists",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "post",
                    data: {
                        txtpkey: function () {
                            return $("#txtpkey").val();
                        },
                        category_id: function () {
                            return $("#category_id").val();
                        },
                        product_name: function () {
                            return $("#product_name").val();
                        },
                    },
                },
            },
            // product_description: {
            //     required: true,
            // },
            product_image_path: {
                required : OldProductImgFlg,
                extension: "jpg|jpeg|png"
            },
            unit_id_0: {
                required : true,
                digits: true,
            },
            weight_0: {
                required : true,
                digits: true,
            },
            price_0: {
                required : true,
                digits: true,
            },
            tax_0: {
                required : true,
                digits: true,
            },
            unit_based_product_image_1_path_0: {
                required : true,
            },
        },
        messages: {
            category_id: {
                required: "*Select category.",
            },
            brand_id: {
                required: "*Select brand.",
            },
            tax_id: {
                required: "*Enter tax.",
                digits: "*Enter only digits.",
            },
            product_name: {
                required: "*Enter product name.",
                remote: "*This product already exists under this category.",
            },
            product_description: {
                required: "*Enter product description.",
            },
            product_image_path: {
                required : "*Select product Image",
                extension: "Only jpg/jpeg/png image is allowed.",
            },
            unit_id_0: {
                required : "*Enter unit.",
                digits: "*Enter only digits.",
            },
            weight_0: {
                required : "*Enter unit.",
                digits: "*Enter only digits.",
            },
            price_0: {
                required : "*Enter unit.",
                digits: "*Enter only digits.",
            },
            tax_0: {
                required : "*Enter unit.",
                digits: "*Enter only digits.",
            },
            unit_based_product_image_1_path_0: {
                required : "*Select image.",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

$(function () {
    var table = $('#product_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "/admin/product-data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'product_unique_id',
            name: 'product_unique_id'
        },
        {
            data: 'product_name',
            name: 'product_name'
        },
        {
            data: 'category_name',
            name: 'category_name'
        },
        {
            data: 'brand_name',
            name: 'brand_name'
        },
        {
            data: 'status',
            name: 'status',
            orderable: false,
            searchable: false
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
        ]
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
})

function deleteProduct(product_id)
{
    var id = product_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to delete this product ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/delete-product",
            beforeSend: function () 
            {
                $(this).hide();
                actionDiv
                    .html(
                        "<i class='fa fa-spin fa-spinner' style='color: #0c0c0c !important;'></i>"
                    )
                    .show();
            },
            success: function (data) {

                if(data.status == 'true'){
                    var oTable = $("#product_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#product_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}


function ProductStatusChange(product_id)
{
    var id = product_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to change status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/change-product-status",
            beforeSend: function () 
            {
                $(this).hide();
                actionDiv
                    .html(
                        "<i class='fa fa-spin fa-spinner' style='color: #0c0c0c !important;'></i>"
                    )
                    .show();
            },
            success: function (data) {

                if(data.status == 'true'){
                    var oTable = $("#product_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#product_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}



$('#addRow').on('click', function(){

    $.ajax({
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: base_url + "/get-unit-list",
        success: function (data) {
            if (data.status == "true") {
                
                var html = '';

                html += '<div class="for-multiple-div">';
                html += '<div class="col-md-6 no-pad-left">';
                html += '<div class="col-md-3 form-group no-pad-left">';
                html += '<label>Unit<span style="color: red;">*</span></label>';
                html += '<select name="" id="" class="form-control units">';
                html += data.response;
                html += '</select>';
                html += '</div>';
                html += '<div class="col-md-3 form-group no-padd-left">';
                html += '<label for="">Weight<span style="color: red;">*</span></label>';
                html += '<input type="text" class="form-control weights" name="" id="">';
                html += '</div>';
                html += '<div class="col-md-3 form-group no-padd ">';
                html += '<label for="">MRP<span style="color: red;">*</span></label>';
                html += '<div class="input-group">';
                html += '<span class="input-group-addon">';
                html += '<i class="fa fa-rupee"></i>';
                html += '</span>';
                html += '<input type="text" class="form-control prices" name="" id="" placeholder="">';
                html += '</div>';
                html += '<label id="" class="error error_for_prices" for=""></label>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-md-4 form-group no-pad mb-0">';
                html += '<label for="">Upload Images<small class="text-danger">( 500 * 500 , Only jpg,png &amp; jpeg format)</small></label>';
                html += '<div class="products-img-upload">';
                html += '<div class="box">';
                html += '<div class="upload-options">';
                html += '<label>';
                html += '<input type="file" class="image-upload product_unit_image_1_images" name="" id="" accept="image/*" />';
                html += '</label>';
                html += '</div>';
                html += '<div class="js--image-preview"></div>';
                html += '</div>';

                html += '<div class="box">';
                html += '<div class="upload-options">';
                html += '<label>';
                html += '<input type="file" class="image-upload product_unit_image_2_images" name="" id="" accept="image/*" />';
                html += '</label>';
                html += '</div>';
                html += '<div class="js--image-preview"></div>';
                html += '</div>';

                html += '<div class="box">';
                html += '<div class="upload-options">';
                html += '<label>';
                html += '<input type="file" class="image-upload product_unit_image_3_images" name="" id="" accept="image/*" />';
                html += '</label>';
                html += '</div>';
                html += '<div class="js--image-preview"></div>';
                html += '</div>';
                html += '</div>';
                html += '<label id="" class="for_images_error error" for=""></label>';
                html += '</div>';
                html += '<div class="col-md-2 form-group ml-5 mt-20">';
                html += '<span type="button" class="btn btn-danger dlt_buttons" onClick="DeleteUnitRow(this.id)">Delete</span>';
                html += '</div>';
                html += '</div>';

                var prod_count = $("#total_unit_rows").val();
                prod_count = parseInt(prod_count) + 1;
                $("#total_unit_rows").val(prod_count);

                $(".multiple_units_table").append(html);

                assign_name_id();
            } else {
                
                var html = '';

                html += '<div class="for-multiple-div">';
                html += '<div class="col-md-6 no-pad-left">';
                html += '<div class="col-md-3 form-group no-pad-left">';
                html += '<label>Unit<span style="color: red;">*</span></label>';
                html += '<select name="" id="" class="form-control units">';
                html += '<option value="">Select Unit</option>';
                html += '</select>';
                html += '</div>';
                html += '<div class="col-md-3 form-group no-padd-left">';
                html += '<label for="">Weight<span style="color: red;">*</span></label>';
                html += '<input type="text" class="form-control weights" name="" id="">';
                html += '</div>';
                html += '<div class="col-md-3 form-group no-padd ">';
                html += '<label for="">MRP<span style="color: red;">*</span></label>';
                html += '<div class="input-group">';
                html += '<span class="input-group-addon">';
                html += '<i class="fa fa-rupee"></i>';
                html += '</span>';
                html += '<input type="text" class="form-control prices" name="" id="" placeholder="">';
                html += '</div>';
                html += '<label id="" class="error error_for_prices" for=""></label>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-md-4 form-group no-pad mb-0">';
                html += '<label for="">Upload Images<small class="text-danger">( 500 * 500 , Only jpg,png &amp; jpeg format)</small></label>';
                html += '<div class="products-img-upload">';
                html += '<div class="box">';
                html += '<div class="upload-options">';
                html += '<label>';
                html += '<input type="file" class="image-upload product_unit_image_1_images" name="" id="" accept="image/*" />';
                html += '</label>';
                html += '</div>';
                html += '<div class="js--image-preview"></div>';
                html += '</div>';

                html += '<div class="box">';
                html += '<div class="upload-options">';
                html += '<label>';
                html += '<input type="file" class="image-upload product_unit_image_2_images" name="" id="" accept="image/*" />';
                html += '</label>';
                html += '</div>';
                html += '<div class="js--image-preview"></div>';
                html += '</div>';

                html += '<div class="box">';
                html += '<div class="upload-options">';
                html += '<label>';
                html += '<input type="file" class="image-upload product_unit_image_3_images" name="" id="" accept="image/*" />';
                html += '</label>';
                html += '</div>';
                html += '<div class="js--image-preview"></div>';
                html += '</div>';
                html += '</div>';
                html += '<label id="" class="for_images_error error" for=""></label>';
                html += '</div>';
                html += '<div class="col-md-2 form-group ml-5 mt-20">';
                html += '<span type="button" class="btn btn-danger dlt_buttons" onClick="DeleteUnitRow(this.id)">Delete</span>';
                html += '</div>';
                html += '</div>';

                var prod_count = $("#total_unit_rows").val();
                prod_count = parseInt(prod_count) + 1;
                $("#total_unit_rows").val(prod_count);

                $(".multiple_units_table").append(html);

                assign_name_id();
            }
        },
    });
})

function assign_name_id() {
    var i = 0,j = 0,k = 0,l = 0,m = 0,n = 0,o = 0,p=0,q=0,r=1,s=0;

    $(".units").each(function () {
        $(this).attr("name", "unit_id_" + i);
        $(this).attr("id", "unit_id_" + i);
        i++;
    });
    $(".weights").each(function () {
        $(this).attr("name", "weight_" + j);
        $(this).attr("id", "weight_" + j);
        j++;
    });
    $(".prices").each(function () {
        $(this).attr("name", "price_" + k);
        $(this).attr("id", "price_" + k);
        k++;
    });
    $(".product_unit_image_1_images").each(function () {
        $(this).attr("name", "unit_based_product_image_1_path_" + m);
        $(this).attr("id", "unit_based_product_image_1_path_" + m);
        m++;
    });
    $(".product_unit_image_2_images").each(function () {
        $(this).attr("name", "unit_based_product_image_2_path_" + n);
        $(this).attr("id", "unit_based_product_image_2_path_" + n);
        n++;
    });
    $(".product_unit_image_3_images").each(function () {
        $(this).attr("name", "unit_based_product_image_3_path_" + o);
        $(this).attr("id", "unit_based_product_image_3_path_" + o);
        o++;
    });
    $(".for_images_error").each(function () {
        $(this).attr("id", "unit_based_product_image_1_path_"+p+"-error");
        $(this).attr("for", "unit_based_product_image_1_path_" + p);
        p++;
    });
    $(".error_for_prices").each(function () {
        $(this).attr("id", "price_"+q+"-error");
        $(this).attr("for", "price_" + q);
        q++;
    });
    $(".dlt_buttons").each(function () {
        $(this).attr("id", "dlt_row_"+r);
        r++;
    });
    $(".for-multiple-div").each(function () {
        $(this).attr("id", "row_div_"+s);
        s++;
    });

    set_validations();

}


function set_validations(){

    var unit_validation = 1;
    $('[name*="unit_id_"]').each(function () {
        $(this).rules("add", {
        required: true,
        messages: {
            required: "*Select Unit.",
        },
        });
        unit_validation++;
    });
    
    var weight_validation = 1;
    $('[name*="weight_"]').each(function () {
        $(this).rules("add", {
        required: true,
        digits : true,
        messages: {
            required: "*Enter weight.",
            digits: "*Enter only digits.",
        },
        });
        weight_validation++;
    });

    var prices_validation = 1;
    $('[name*="price_"]').each(function () {
        $(this).rules("add", {
        required: true,
        digits : true,
        messages: {
            required: "*Enter price.",
            digits: "*Enter only digits.",
        },
        });
        prices_validation++;
    });

    var unit_images_validation = 1;
    $('[name*="unit_based_product_image_1_path_"]').each(function () {
        $(this).rules("add", {
        required: true,
        messages: {
            required: "*Select Image.",
        },
        });
        unit_images_validation++;
    });

    // getAllUnits();
}

function getAllUnits(){
    $.ajax({
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: base_url + "/get-unit-list",
        success: function (data) {
            if (data.status == "true") {
                $('.units').each(function(){
                    $(this).html(data.html);
                });
            } else {
                $('.units').each(function(){
                    $(this).html('<option value=""></option>');
                });
            }
        },
    });
}

function DeleteUnitRow(dlt_btn_id){
    console.log(dlt_btn_id);
    var split_row_id = dlt_btn_id.split('_');
    var id = split_row_id[2];
    $('#row_div_'+id).remove();

    var prod_count = $("#total_unit_rows").val();
    prod_count = parseInt(prod_count) - 1;
    $("#total_unit_rows").val(prod_count);

    assign_name_id();
}
