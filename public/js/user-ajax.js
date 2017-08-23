var page = 1;

var current_page = 1;

var total_page = 0;

var is_ajax_fire = 0;

$('#error').html('');


manageData();


/* manage data list */

function manageData() {

    $.ajax({

        dataType: 'json',

        url: url,

        data: {page:page}

    }).done(function(data){


    	total_page = data.last_page;

    	current_page = data.current_page;


    	$('#pagination').twbsPagination({

	        totalPages: total_page,

	        visiblePages: current_page,

	        onPageClick: function (event, pageL) {

	        	page = pageL;

                if(is_ajax_fire != 0){

	        	  getPageData();

                }

	        }

	    });


    	manageRow(data.data);

        is_ajax_fire = 1;

    });

}


$.ajaxSetup({

    headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

});


/* Get Page Data*/

function getPageData() {

	$.ajax({

    	dataType: 'json',

    	url: url,

    	data: {page:page}

	}).done(function(data){

		manageRow(data.data);

	});

}


/* Add new Item table row */

function manageRow(data) {

	var	rows = '';

	$.each( data, function( key, value ) {

	  	rows = rows + '<tr>';

        rows = rows + '<input type="hidden" name="role" id="role" value="'+value.role+'" >';

	  	rows = rows + '<td>'+value.first_name+'</td>';

        rows = rows + '<td>'+value.last_name+'</td>';

	  	rows = rows + '<td>'+value.email+'</td>';

        rows = rows + '<td>'+value.birth_date+'</td>';
        
        if(value.role == 0){
            rows = rows + '<td>Simple User</td>';
        }else{
            rows = rows + '<td>Manager User</td>';
        }

	  	rows = rows + '<td data-id="'+value.id+'">';

            rows = rows + '<button data-toggle="modal" data-target="#edit-user" class="btn btn-primary edit-item">Edit</button> ';

            rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';

            rows = rows + '</td>';

	  	rows = rows + '</tr>';

	});


	$("tbody").html(rows);

}


/* Create new Item */

$(".crud-submit").click(function(e){

    

    e.preventDefault();

    var form_action = $("#create-user").find("form").attr("action");

    var first_name = $("#create-user").find("input[name='first_name']").val();

    var last_name = $("#create-user").find("input[name='last_name']").val();

    var birth_date = $("#create-user").find("input[name='birth_date']").val();

    var email = $("#create-user").find("input[name='email']").val();

    var password = $("#create-user").find("input[name='password']").val();

    var role = $("#create-user").find("select[name='role']").val();
        
    $.ajax({

        dataType: 'json',

        type:'POST',

        url: form_action,

        data:{first_name:first_name, last_name:last_name, birth_date:birth_date,email:email, password:password, role:role}

    }).done(function(data){

        if ((data.errors)) {
            
            //$('.error').text(data.errors.name);

            // $.each(data.errors in error ){
            //     alert(error);

            //     //$('#error').html();
            // }

            error_mes = "";
            $.each( data.errors, function( key, value ) {
              error_mes += "<li>"+value+"</li>";
            });

            error_ctn = "<div class='alert alert-danger'> <ul> "+error_mes+"  </ul> </div>";

            $('#error').html(error_ctn);
            
        } else {
            
            $('#error').remove();
            //$('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

            getPageData();

            $(".modal").modal('hide');

            toastr.success('User Created Successfully.', 'Success Alert', {timeOut: 5000});
        }


        // getPageData();

        // $(".modal").modal('hide');

        // toastr.success('User Created Successfully.', 'Success Alert', {timeOut: 5000});

    });


});


/* Remove Item */

$("body").on("click",".remove-item",function(){

    var id = $(this).parent("td").data('id');

    var c_obj = $(this).parents("tr");

    $.ajax({

        dataType: 'json',

        type:'delete',

        url: url + '/' + id,

    }).done(function(data){

        c_obj.remove();

        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});

        getPageData();

    });

});


/* Edit Item */

$("body").on("click",".edit-item",function(){

    var id = $(this).parent("td").data('id');

    // var title = $(this).parent("td").prev("td").prev("td").text();

    // var description = $(this).parent("td").prev("td").text();

    var first_name = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();



    var last_name = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();

    var email = $(this).parent("td").prev("td").prev("td").prev("td").text();

    var password = $(this).parent("td").prev("td").prev("td").prev("td").text();

    var birth_date = $(this).parent("td").prev("td").prev("td").text();

    var role = $('#role').val();



    //var role = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();

    //var role = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();

    $("#edit-user").find("input[name='first_name']").val(first_name);

    $("#edit-user").find("input[name='last_name']").val(last_name);

    $("#edit-user").find("input[name='email']").val(email);

    $("#edit-user").find("input[name='birth_date']").val(birth_date);

    $("#edit-user").find("select[name='role']").val(role);



    //$("#edit-item").find("textarea[name='description']").val(description);

    $("#edit-user").find("form").attr("action",url + '/' + id);

});


/* Updated new Item */

$(".crud-submit-edit").click(function(e){

    

    e.preventDefault();

    var form_action = $("#edit-user").find("form").attr("action");

    // var title = $("#edit-item").find("input[name='title']").val();

    // var description = $("#edit-item").find("textarea[name='description']").val();

    var first_name = $("#edit-user").find("input[name='first_name']").val();

    var last_name = $("#edit-user").find("input[name='last_name']").val();

    var birth_date = $("#edit-user").find("input[name='birth_date']").val();

    var email = $("#edit-user").find("input[name='email']").val();

    var role = $("#edit-user").find("select[name='role']").val();


    $.ajax({

        dataType: 'json',

        type:'PUT',

        url: form_action,

        data:{first_name:first_name, last_name:last_name, birth_date:birth_date,email:email, role:role}

    }).done(function(data){

        getPageData();

        $(".modal").modal('hide');

        toastr.success('User Updated Successfully.', 'Success Alert', {timeOut: 5000});

    });

});