@extends('header')
@section('title','Service')
@extends('footer')
@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-table fa-2x"></i>
                  </div>
                  <h4 class="card-title">Service</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                     <div class="col-12 text-right">
 				        <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-post" onclick="add()">Add</a>
       				 </div>
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Service Type</th>
                          <th>Update</th>
                          <th>Delete</th>
                       	</tr>
                      </thead>
                      <tfoot>
                        <tr>
                      	  <th>Service Type</th>
                          <th>Update</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @foreach($stype as $st)
		                <tr id="row_{{$st->service_id}}">
		                   <td>{{ $st->service_type }}</td>
		                   <td><a href="javascript:void(0)" data-id="{{ $st->service_id }}" onclick="edit(event.target)" class="btn btn-info btn-sm">Edit</a></td>
		                   <td>
		                    <a href="javascript:void(0)" data-id="{{ $st->service_id }}" class="btn btn-danger btn-sm" onclick="delete_service(event.target)">Delete</a></td>
		                </tr>
		                @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
          </div>
          <!-- end row -->
        </div>
      </div>
      	<div class="modal fade" id="post-modal" aria-hidden="true">
		  	<div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h4 class="modal-title">Service</h4>
			        </div>
			        <div class="modal-body">
			            <form name="userForm" class="form-horizontal">
			            	<div class="col-md-12">
		                   		<div class="alert alert-danger errors" style="display: none;">
		                        </div>
		                   </div>
			               <input type="hidden" name="service_id" id="service_id">
			                <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="service_type" name="service_type" placeholder="Service Type">
			                    </div>
			                </div>
			            </form>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-primary" onclick="create()">Save</button>
			        </div>
			    </div>
		  </div>
		</div>
@stop


@section('script')

<script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });
    }); 
	</script>

	<script>
		function add()
		{
		    $("#service_id").val('');
		    $("#service_type").val('');
		    $(".errors").css("display","none");
		    $('#post-modal').modal('show');
  		}
  		function edit(event) 
  		{
		    var service_id  = $(event).data("id");
		    let _url = `/admin/service-type/${service_id}`;
		    $.ajax({
		      url: _url,
		      type: "GET",
		      success: function(response) {
		          if(response) {
		            $("#service_id").val(response[0].service_id);
		            $("#service_type").val(response[0].service_type);
		            $(".errors").css("display","none");
		            $('#post-modal').modal('show');
		          }
		      }
		    });
		}
		  function create() 
		  {
		    var service_type = $('#service_type').val();
		    var service_id = $('#service_id').val();

		    let _url     = `/admin/service-type`;
		    //let _token   = $('meta[name="csrf-token"]').attr('content');

		      $.ajax({
		        url: _url,
		        type: "POST",
		        data: {
		          "service_id": service_id,
		          "service_type": service_type,
		          "_token": "{{ csrf_token() }}",
		        },
		        success: function(response) 
		        {
		            if(response.code == 200)
		            {
		              if(service_id != "")
		              {
		                $("#row_"+service_id+" td:nth-child(1)").html(response.data.service_type);
		              } 
		              else 
		              {
		                $('table tbody').append('<tr id="row_'+response.data.service_id+'"><td>'+response.data.service_type+'</td><td><a href="javascript:void(0)" data-id="'+response.data.service_id+'" onclick="edit(event.target)" class="btn btn-info btn-sm">Edit</a></td><td><a href="javascript:void(0)" data-id="'+response.data.service_id+'" class="btn btn-danger btn-sm" onclick="delete_service(event.target)">Delete</a></td></tr>');
		               
		              }
		              $('#service_type').val('');
		              $('#post-modal').modal('hide');
		            }
		        },
		        error: function(response)
		        {
		        	var errors = $.parseJSON(response.responseText);
		        	$(".errors").html("");
                    $.each(errors['errors'], function (key, val) {
                        $(".errors").append(val+"<br>");
                    });
                    $(".errors").css("display","block");
		        }
		      });
		  }

		  function delete_service(event) 
		  {
		    var service_id  = $(event).data("id");
		    let _url = `/admin/service-type/${service_id}`;

		      $.ajax({
		        url: _url,
		        type: 'DELETE',
		        data: {
		          "_token": "{{ csrf_token() }}",
		        },
		        success: function(response) {
		          $("#row_"+service_id).remove();
		        }
		      });
  		   }
	</script>


@stop