@extends('header')
@section('title','Broadcast Message')
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
                  <h4 class="card-title">Broadcast Message</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                     <div class="col-12 text-right">
 				        <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-post" onclick="add()">Send Message</a>
       				 </div>
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Message</th>
                       	</tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Message</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @foreach($bmessage as $bm)
		                <tr id="row_{{$bm->broadcast_message_id}}">
		                   <td>{{ $bm->message  }}</td>
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
			            <h4 class="modal-title">Broadcast Message</h4>
			        </div>
			        <div class="modal-body">
			            <form name="userForm" class="form-horizontal">
			            	<div class="col-md-12">
		                   		<div class="alert alert-danger errors" style="display: none;">
		                        </div>
		                   </div>
			               <input type="hidden" name="broadcast_message_idr" id="broadcast_message_id">
			                <div class="form-group">
			                    <div class="col-sm-12">
			                       <textarea rows="4" id="message" name="message" class="form-control" placeholder="Write Message Here..!!"></textarea>
			                    </div>
			                </div>
			            </form>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-primary" onclick="create()">Send</button>
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
		    $("#broadcast_message_id").val('');
		    $("#message").val('');
		    $(".errors").css("display","none");
		    $('#post-modal').modal('show');
  		}
  		/*function edit(event) 
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
		}*/
		  function create() 
		  {
		    var message = $('#message').val();
		    var broadcast_message_id = $('#broadcast_message_id').val();

		    let _url     = `/admin/broadcast-message`;
		    //let _token   = $('meta[name="csrf-token"]').attr('content');

		      $.ajax({
		        url: _url,
		        type: "POST",
		        data: {
		          "broadcast_message_id": broadcast_message_id,
		          "message": message,
		          "_token": "{{ csrf_token() }}",
		        },
		        success: function(response) 
		        {
		            if(response.code == 200)
		            {
		            
		                $('table tbody').append('<tr id="row_'+response.data.broadcast_message_id+'"><td>'+response.data.message+'</td></tr>');
		               
		             }
		              $('#post-modal').modal('hide');
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

/*		  function delete_wing(event) 
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
*/	</script>


@stop