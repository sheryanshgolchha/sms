@extends('header')
@section('title','Service Provider')
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
                  <h4 class="card-title">Service Provider</h4>
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
                          <th>Name</th>
                          <th>Service Type</th>
                          <th>Phone No</th>
                          <th>Photo</th>
                          <th>Address</th>
                          <th>Id_proof</th>
                          <th>Delete</th>
                       	</tr>
                      </thead>
                      <tfoot>
                      	 <tr>
                          <th>Name</th>
                          <th>Service Type</th>
                          <th>Phone No</th>
                          <th>Photo</th>
                          <th>Address</th>
                          <th>Id_proof</th>
                          <th>Delete</th>
                       	</tr>    
                      </tfoot>
                      <tbody>
                        @foreach($sprovider as $sp)
		                <tr id="row_{{$sp->service_provider_id}}">
		                   <td>{{ $sp->name }}</td>
		                   <td>{{ $sp->service_type }}</td>
		                   <td>{{ $sp->phone }}</td>
		                   <td><img src="../uploads/{{$sp->photo}}" height="100px" width="100px"/></td>
		                   <td>{{ $sp->address }}</td>
		                   <td><img src="../uploads/{{$sp->id_proof}}" height="100px" width="100px"/></td>
		                   <td>
		                    	<a href="javascript:void(0)" data-id="{{ $sp->service_provider_id }}" class="btn btn-danger btn-sm" onclick="delete_service_provider(event.target)">Delete</a>
		                	</td>
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
			               <input type="hidden" name="service_provider_id" id="service_provider_id">
			                <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
			                    </div>
			                </div>
			                <div class="form-group">
			                	<div class="col-sm-12 ">
			                			<select id="service_id" name="service_id" class="form-control">
			                				<option class="hidden" selected value="" disabled>Service Type</option>
			                				@foreach($stype as $st)
                                       	    <option value="{{ $st->service_id }}">{{ $st->service_type }}</option>
                                            @endforeach
                                		</select>
                                   
             	                </div>
             	            </div><br>
             	            <div class="form-group">
			                    <div class="col-sm-12">
			                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
			                    </div>
			                </div>
			                <div class="form-group">
			              		<div class="col-sm-12">
			              			<label>Photo</label>
	                                <input type="file" class="form-control" id="photo" name="photo" onchange="getImagePhoto(this);" accept="image/*"><br><br>
	                            </div>
	                            <div class="col-sm-12">
	                            	<label for="photo">
 	                                <img style="border:1px solid black" class="img-responsive mx-auto d-block" id="userphoto" src="../assets/img/avatar.png" height="100px" width="100px">
 	                            	</label>
                            	</div>
 		                    </div>
			               	<div class="form-group">
			                    <div class="col-sm-12">
			                        <textarea class="form-control" rows="1" placeholder="Address" id="address" name="address"></textarea>
			                    </div>
			                </div>
			                <div class="form-group">
			              		<div class="col-sm-12">
			              			<label>Id Proof</label>
	                                <input type="file" class="form-control" id="id_proof" name="id_proof" onchange="getIdPhoto(this);" accept="image/*"><br><br>
	                            </div>
	                            <div class="col-sm-12">
	                            	<label for="id_proof"> 
 	                                <img style="border:1px solid black" class="img-responsive mx-auto d-block" id="proof" src="../assets/img/proof.png" height="100px" width="100px">
 	                            	</label>
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
			$('#name').val('');
			$('#service_provider_id').val('');
		    $('#photo').val('');
		    $('#id_proof').val('');
		    $('#userphoto').attr('src','../assets/img/avatar.png');
	        $('#proof').attr('src','../assets/img/proof.png');
	        $('#address').val('');
	        $('#service_id').val('');
		    $('#phone').val('');
		    $(".errors").css("display","none");
			$('#post-modal').modal('show');
  		}
  		function create() 
		  {
		    /*var amenitie_name=$('#amenitie_name').val();
		    var amenitie_photo=$('#amenitie_photo').val();
		    var open_time=$('#open_time').val();
		    var close_time=$('#close_time').val();*/
		    /*var amenitie_id = $('#amenitie_id').val();*/
		    let _url     = `/admin/service-provider`;
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
		              var file="../uploads/"+response.data.photo;
		              var photo='<img src='+file+' height="100px" width="100px"/>';
		              file="../uploads/"+response.data.id_proof;
		              var proof='<img src='+file+' height="100px" width="100px"/>';
		              /*if(amenitie_id != "")
		              {
		                $("#row_"+amenitie_id+" td:nth-child(1)").html(response.data.amenitie_name);
		                $("#row_"+amenitie_id+" td:nth-child(2)").html(img);
		                $("#row_"+amenitie_id+" td:nth-child(3)").html(response.data.open_time);
		                $("#row_"+amenitie_id+" td:nth-child(4)").html(response.data.close_time); 
		                $("#row_"+amenitie_id+" td:nth-child(4)").html(response.data.charges);    
		              } 
		              else 
		              {*/
						$('table tbody').append('<tr id="row_'+response.data.service_provider_id+'"><td>'+response.data.name+'</td><td>'+response.data.service_id+'</td><td>'+response.data.phone+'</td><td>'+photo+'</td><td>'+response.data.address+'</td><td>'+proof+'</td><td><a href="javascript:void(0)" data-id="'+response.data.service_provider_id+'" class="btn btn-danger btn-sm" onclick="delete_service_provider(event.target)">Delete</a></td></tr>');
		               
		              //}
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

		  function delete_service_provider(event) 
		  {
		    var service_provider_id  = $(event).data("id");
		    let _url = `/admin/service-provider/${service_provider_id}`;

		      $.ajax({
		        url: _url,
		        type: 'DELETE',
		        data: {
		          "_token": "{{ csrf_token() }}",
		        },
		        success: function(response) {
		          $("#row_"+service_provider_id).remove();
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
                    $('#userphoto').attr('src', e.target.result);
                  }
                reader.readAsDataURL(input.files[0]);
                }
              }
               function getIdPhoto(input) 
              {
              	
                if (input.files && input.files[0]) 
                {
                  var reader = new FileReader();
                  reader.onload = function (e) 
                  {
                    $('#proof').attr('src', e.target.result);
                  }
                reader.readAsDataURL(input.files[0]);
                }
              }
		    </script>

@stop