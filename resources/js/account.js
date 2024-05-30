$(document).ready(function() {
    $(document).on('click', '.add-employee', function() {
        $('#addEmployeeModal').modal('show');
        console.log('Clicked');
    });
    $(document).on('click', '.closemodify', function() {
        location.reload();
    });
    

    $(document).on('click', '.modify-employee', function() {
        $('#employee_modify_id').val($(this).data('employee_id'));
        $('#employee_modify_status').val($(this).data('employee_status'));
        $('#modifyEmployeeModal').modal('show');
    });
    
    $('.modal-footer').on('click', '#modifyEmployee', function() {
  
        $.ajax({
            type: 'post',
            url: '/panel/admin/employees/modify',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'employee_id': $('input[name=employee_modify_id]').val(),
                'employee_status': $('input[name=employee_modify_status]').val()
                
            },
            success: function(data) {
                $('#modifyEmployeeModal').modal('toggle');
                $('#modifyEmployeeModalSuccess').modal('show');
                
            },
            
            error: function(data){
              var errors = data.responseJSON.errors;
              var errormessage = '';
              Object.keys(errors).forEach(function(key) {
                  errormessage += errors[key] + '<br />';
                  $('.errors').html('');
                  $('.errors').append(`
                  <div class="alert alert-danger" role="alert"> ${errormessage} </div>
                  `);
              });
            }
        });
    });


    $(document).on('click', '.edit_account_Modal', function() {
        $('#edit_name').val($(this).data('name'));
        $('#edit_email').val($(this).data('email'));
        $('#edit_sender_name').val($(this).data('sender_name'));
        $('#edit_account_Modal').modal('show');
    });
    $('.modal-footer').on('click', '#editEmployee', function() {
  
          $.ajax({
              type: 'post',
              url: '/panel/admin/employees/update',
              data: {
                  //_token:$(this).data('token'),
                  '_token': $('input[name=_token]').val(),
                  'employee_fname': $('input[name=edit_employee_fname]').val(),
                  'employee_lname': $('input[name=edit_employee_lname]').val(),
                  'employee_position': $('input[name=edit_employee_position]').val(),
                  'employee_id': $('input[name=edit_employee_id]').val()
              },
              success: function(data) {
                $('#editEmployeeModal').modal('toggle');
                
                $('.row'+ data.id).replaceWith(`
                <tr class="row${data.id}">
                    <td class="py-8">
                        <div class="d-flex align-items-center">
                            <div>
                                <a href="/panel/admin/employees/${data.id}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">${data.fname} ${data.lname}</a>
                                
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">${data.position}</span>
                    </td>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">${data.status}</span>
                        
                    </td>
                    
                    <td class="pr-0 text-right">
                        <a href="/panel/admin/employees/${data.id}" class="btn btn-light-success font-weight-bolder font-size-sm"><i class="fas fa-search"></i></a>
                    <a href="javascript:;" class="btn btn-light-warning font-weight-bolder font-size-sm edit-employee"
                        data-employee_id="${data.id}"
                        data-employee_fname="${data.fname}"
                        data-employee_lname="${data.lname}"
                        data-employee_position="${data.position}"
                    ><i class="fas fa-pen"></i></a>
                    
                    <a href="javascript:;" id="modifyemployee${data.id}" class="btn btn-sm btn-warning modify-employee"
                        data-employee_id="${data.id}"
                        data-employee_status="inactive">
                        <i class="far fa-eye-slash"></i>
                    </a>
                    
                    </td>
                </tr>
                `);
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                  };
                toastr.success("Employee updated...");
              },
              
              error: function(data){
                var errors = data.responseJSON.errors;
                var errormessage = '';
                Object.keys(errors).forEach(function(key) {
                    errormessage += errors[key] + '<br />';
                    $('.errors').html('');
                    $('.errors').append(`
                    <div class="alert alert-danger" role="alert"> ${errormessage} </div>
                    `);
                });
              }
          });
    });
    
    $("#addEmployee").click(function(data) {
          $.ajax({
              type: 'post',
              url: '/panel/admin/employees/add',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'employee_fname': $('input[name=employee_fname]').val(),
                  'employee_lname': $('input[name=employee_lname]').val(),
                  'employee_position': $('input[name=employee_position]').val()
              },
              success: function(data) {
                $('#employeeTable').append(`
                    <tr class="row${data.id}">
                        <td class="py-8">
                            <div class="d-flex align-items-center">
                                <div>
                                    <a href="/panel/admin/employees/${data.id}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">${data.fname} ${data.lname}</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">${data.position}</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">${data.status}</span>
                            
                        </td>
                        
                        <td class="pr-0 text-right">
                            <a href="/panel/admin/employees/${data.id}" class="btn btn-light-success font-weight-bolder font-size-sm"><i class="fas fa-search"></i></a>
                        <a href="javascript:;" class="btn btn-light-warning font-weight-bolder font-size-sm edit-employee"
                            data-employee_id="${data.id}"
                            data-employee_fname="${data.fname}"
                            data-employee_lname="${data.lname}"
                            data-employee_position="${data.position}"
                        ><i class="fas fa-pen"></i></a>
                        
                        <a href="javascript:;" id="modifyemployee${data.id}" class="btn btn-sm btn-warning modify-employee"
                            data-employee_id="${data.id}"
                            data-employee_status="inactive">
                            <i class="far fa-eye-slash"></i>
                        </a>
                        
                        </td>
                    </tr>
                `);
                $('#employee_name').val('');
                $('#employee_description').val('');
                $('#employee_price').val(0);
                $('#addEmployeeModal').modal('toggle');
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.success("Employee added");
              },
              error: function(data){
                var errors = data.responseJSON.errors;
                var errormessage = '';
                Object.keys(errors).forEach(function(key) {
                    errormessage += errors[key] + '<br />';
                    $('.errors').html('');
                    $('.errors').append(`
                    <div class="alert alert-danger" role="alert"> ${errormessage} </div>
                    `);
                });
              }
  
          });
    });
   
  });
  