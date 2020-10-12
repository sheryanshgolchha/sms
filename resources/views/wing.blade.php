@extends('header')
@section('title','Wing')
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
                  <h4 class="card-title">Wing</h4>
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
                          <th>Sr.No</th>
                          <th>Wing Name</th>
                          <th>Total Flats</th>
                          <th>Update</th>
                          <th>Delete</th>
                       	</tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Sr.No</th>
                          <th>Wing Name</th>
                          <th>Total Flats</th>
                          <th>Update</th>
                          <th>Delete</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @foreach($wings as $wing)
		                <tr id="row_{{$wing->wing_id}}">
		                   <td>{{ $wing->wing_id  }}</td>
		                   <td>{{ $wing->wing_name }}</td>
		                   <td>{{ $wing->total_flats }}</td>
		                   <td><a href="javascript:void(0)" data-id="{{ $wing->wing_id }}" onclick="edit(event.target)" class="btn btn-info btn-sm">Edit</a></td>
		                   <td>
		                    <a href="javascript:void(0)" data-id="{{ $wing->wing_id }}" class="btn btn-danger btn-sm" onclick="delete_wing(event.target)">Delete</a></td>
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
			            <h4 class="modal-title">Wing</h4>
			        </div>
			        <div class="modal-body">
			            <form name="userForm" class="form-horizontal">
			            	<div class="col-md-12">
		                   		<div class="alert alert-danger errors" style="display: none;">
		                        </div>
		                   </div>
			               <input type="hidden" name="wing_id" id="wing_id">
			                <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="wing_name" name="wing_name" placeholder="Wing Name">
			                    </div>
			                </div>

			                <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="total_flats" name="total_flats" placeholder="Total Flats">
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
		    $("#wing_id").val('');
		    $("#wing_name").val('');
		    $('#total_flats').val('');
		    $(".errors").css("display","none");
		    $('#post-modal').modal('show');
  		}
  		function edit(event) 
  		{
		    var wing_id  = $(event).data("id");
		    let _url = `/admin/wing/${wing_id}`;
		    $.ajax({
		      url: _url,
		      type: "GET",
		      success: function(response) {
		          if(response) {
		            $("#wing_id").val(response[0].wing_id);
		            $("#wing_name").val(response[0].wing_name);
		            $("#total_flats").val(response[0].total_flats);
		            $(".errors").css("display","none");
		            $('#post-modal').modal('show');
		          }
		      }
		    });
		}
		  function create() 
		  {
		    var wing_name = $('#wing_name').val();
		    var total_flats = $('#total_flats').val();
		    var wing_id = $('#wing_id').val();

		    let _url     = `/admin/wing`;
		    //let _token   = $('meta[name="csrf-token"]').attr('content');

		      $.ajax({
		        url: _url,
		        type: "POST",
		        data: {
		          "wing_id": wing_id,
		          "wing_name": wing_name,
		          "total_flats": total_flats,
		          "_token": "{{ csrf_token() }}",
		        },
		        success: function(response) 
		        {
		            if(response.code == 200)
		            {
		              if(wing_id != "")
		              {
		                $("#row_"+wing_id+" td:nth-child(2)").html(response.data.wing_name);
		                $("#row_"+wing_id+" td:nth-child(3)").html(response.data.total_flats);
		              } 
		              else 
		              {
		                $('table tbody').append('<tr id="row_'+response.data.wing_id+'"><td>'+response.data.wing_id+'</td><td>'+response.data.wing_name+'</td><td>'+response.data.total_flats+'</td><td><a href="javascript:void(0)" data-id="'+response.data.wing_id+'" onclick="edit(event.target)" class="btn btn-info btn-sm">Edit</a></td><td><a href="javascript:void(0)" data-id="'+response.data.wing_id+'" class="btn btn-danger btn-sm" onclick="delete_wing(event.target)">Delete</a></td></tr>');
		               
		              }
		              $('#wing_name').val('');
		              $('#total_flats').val('');
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

		  function delete_wing(event) 
		  {
		    var wing_id  = $(event).data("id");
		    let _url = `/admin/wing/${wing_id}`;

		      $.ajax({
		        url: _url,
		        type: 'DELETE',
		        data: {
		          "_token": "{{ csrf_token() }}",
		        },
		        success: function(response) {
		          $("#row_"+wing_id).remove();
		        }
		      });
  		   }
	</script>


@stop