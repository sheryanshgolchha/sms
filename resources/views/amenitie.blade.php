@extends('header')
@section('title','Amenitie')
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
                  <h4 class="card-title">Amenitie</h4>
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
                          <th>Amenitie Name</th>
                          <th>Amenitie Photo</th>
                          <th>Open Time</th>
                          <th>Close Time</th>
                          <th>Charges</th>
                          <th>Update</th>
                          <th>Delete</th>
                       	</tr>
                      </thead>
                      <tfoot>
                          <th>Amenitie Name</th>
                          <th>Amenitie Photo</th>
                          <th>Open Time</th>
                          <th>Close Time</th>
                          <th>Charges</th>
                          <th>Update</th>
                          <th>Delete</th>
                      </tfoot>
                      <tbody>
                        @foreach($amenities as $amenitie)
		                <tr id="row_{{$amenitie->amenitie_id}}">
		                   <td>{{ $amenitie->amenitie_name }}</td>
		                   <td><img src="../uploads/{{$amenitie->amenitie_photo}}" height="100px" width="100px"/></td>
		                   <td>{{ $amenitie->open_time }}</td>
		                   <td>{{ $amenitie->close_time }}</td>
		                   <td>{{ $amenitie->charges }}</td>
		                   <td><a href="javascript:void(0)" data-id="{{ $amenitie->amenitie_id }}" onclick="edit(event.target)" class="btn btn-info btn-sm">Edit</a></td>
		                   <td>
		                    <a href="javascript:void(0)" data-id="{{ $amenitie->amenitie_id }}" class="btn btn-danger btn-sm" onclick="delete_amentite(event.target)">Delete</a></td>
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
			            <h4 class="modal-title">Amenitie</h4>
			        </div>
			        <div class="modal-body">
			            <form name="userForm" class="form-horizontal" enctype="multipart/form-data">
			            	{{ csrf_field() }}
			            	<div class="col-md-12">
		                   		<div class="alert alert-danger errors" style="display: none;">
		                        </div>
		                   </div>
			               <input type="hidden" name="amenitie_id" id="amenitie_id">
			                <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="amenitie_name" name="amenitie_name" placeholder="Amenitie Name">
			                    </div>
			                </div>
			                <div class="form-group">
			              		<div class="col-sm-12">
			              			<label>Amenitie Photo</label>
	                                <input type="file" class="form-control" id="amenitie_photo" name="amenitie_photo" onchange="getImagePhoto(this);" accept="image/*"><br><br>
	                            </div>
	                            <div class="col-sm-12">
	                            	<label for="amenitie_photo">
 	                                <img style="border:1px solid black" class="img-responsive mx-auto d-block" id="photo" src="../assets/img/amenitie.jpg" height="150px" width="150px">
 	                            	</label>
                            	</div>
 		                    </div>
			                <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="open_time" name="open_time" placeholder="Open Time" onfocus="(this.type='time')">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="close_time" name="close_time" placeholder="Close Time" onfocus="(this.type='time')">
			                    </div>
			                </div>
			                 <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="charges" name="charges" placeholder="Charges">
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
			$('#amenitie_name').val('');
			$('#amenitie_id').val('');
		    $('#amenitie_photo').val('');
		    $('#photo').attr('src','../assets/img/amenitie.jpg');
	        $('#open_time').val('');
	        $('#close_time').val('');
		    $('#charges').val('');
		    $(".errors").css("display","none");
			$('#post-modal').modal('show');
  		}
  		function edit(event) 
  		{
		    var amenitie_id  = $(event).data("id");
		    let _url = `/admin/amenitie/${amenitie_id}`;
		    $.ajax({
		      url: _url,
		      type: "GET",
		      success: function(response) {
		          if(response) {
		            $("#amenitie_id").val(response[0].amenitie_id);
		            $("#amenitie_name").val(response[0].amenitie_name);
		            $('#photo').attr('src','../uploads/'+response[0].amenitie_photo);
		            $("#open_time").val(response[0].open_time);
		            $("#close_time").val(response[0].close_time);
		            $("#charges").val(response[0].charges);
		            $(".errors").css("display","none");
		            $('#post-modal').modal('show');
		          }
		      }
		    });
		  }
		  function create() 
		  {
		    /*var amenitie_name=$('#amenitie_name').val();
		    var amenitie_photo=$('#amenitie_photo').val();
		    var open_time=$('#open_time').val();
		    var close_time=$('#close_time').val();*/
		    var amenitie_id = $('#amenitie_id').val();
		    let _url     = `/admin/amenitie`;
		    var data = new FormData($('form')[0]);
		    //let _token   = $('meta[name="csrf-token"]').attr('content');

		      $.ajax({
		        url: _url,
		        type: "POST",
		        data: data,
		        contentType: false,
    			processData: false,
		        success: function(response) 
		        {
		            if(response.code == 200)
		            {		              
		              var file="../uploads/"+response.data.amenitie_photo;
		              var img='<img src='+file+' height="100px" width="100px"/>';
		              if(amenitie_id != "")
		              {
		                $("#row_"+amenitie_id+" td:nth-child(1)").html(response.data.amenitie_name);
		                $("#row_"+amenitie_id+" td:nth-child(2)").html(img);
		                $("#row_"+amenitie_id+" td:nth-child(3)").html(response.data.open_time);
		                $("#row_"+amenitie_id+" td:nth-child(4)").html(response.data.close_time); 
		                $("#row_"+amenitie_id+" td:nth-child(4)").html(response.data.charges);    
		              } 
		              else 
		              {
						$('table tbody').append('<tr id="row_'+response.data.amenitie_id+'"><td>'+response.data.amenitie_name+'</td><td>'+img+'</td><td>'+response.data.open_time+'</td><td>'+response.data.close_time+'</td><td>'+response.data.charges+'</td><td><a href="javascript:void(0)" data-id="'+response.data.amenitie_id+'" onclick="edit(event.target)" class="btn btn-info btn-sm">Edit</a></td><td><a href="javascript:void(0)" data-id="'+response.data.amenitie_id+'" class="btn btn-danger btn-sm" onclick="delete_wing(event.target)">Delete</a></td></tr>');
		               
		              }
		              $('#amenitie_name').val('');
		              $('#amenitie_photo').val('');
		              $('#open_time').val('');
		              $('#close_time').val('');
		              $('#charges').val('');
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

		  function delete_amentite(event) 
		  {
		    var amenitie_id  = $(event).data("id");
		    let _url = `/admin/amenitie/${amenitie_id}`;

		      $.ajax({
		        url: _url,
		        type: 'DELETE',
		        data: {
		          "_token": "{{ csrf_token() }}",
		        },
		        success: function(response) {
		          $("#row_"+amenitie_id).remove();
		        }
		      });
  		   }


	</script>
			<script type="text/javascript">
              function getImagePhoto(input) 
              {
                if (input.files && input.files[0]) 
                {
                  var reader = new FileReader();
                  reader.onload = function (e) 
                  {
                    $('#photo').attr('src', e.target.result);
                  }
                reader.readAsDataURL(input.files[0]);
                }
              }
		    </script>

@stop