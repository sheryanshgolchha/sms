@extends('header')
@section('title','Verify Society Member')
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
                  <h4 class="card-title">Verify Society Member</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                     <div class="col-12 text-right">
 				             </div>
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Phone No</th>
                          <th>Id-Proof</th>
                          <th>Photo</th>
                          <th>Wing Name</th>
                          <th>Flat No</th>
                          <th>Accept</th>
                          <th>Reject</th>
                       	</tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Phone No</th>
                          <th>Id-Proof</th>
                          <th>Photo</th>
                          <th>Wing Name</th>
                          <th>Flat No</th>
                          <th>Accept</th>
                          <th>Reject</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @foreach($sm as $s)

    		                <tr id="row_{{$s->reg_id}}">
                           <td>{{ $s->fname }}</td>
                           <td>{{ $s->lname }}</td>
                           <td>{{ $s->email }}</td>
                           <td>{{ $s->phone }}</td>
                           <td><img src="../uploads/{{$s->id_proof}}" height="50px" width="50px"/></td>
                           <td><img src="../uploads/{{$s->photo}}" height="50px" width="50px"/></td>
                           <td>{{ $s->wing_name }}</td>
                           <td>{{ $s->flat_no }}</td>
                           <td> <a href="javascript:void(0)" class="btn btn-success btn-sm" data-id="{{ $s->reg_id }}" onclick="accept(event.target)">Accept</a></td>
                           <td> <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-id="{{ $s->reg_id }}" onclick="reject(event.target)">Reject</a></td>
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
      function reject(event) 
      {
        var reg_id  = $(event).data("id");
        let _url = `/admin/verify-society-member/${reg_id}`;

          $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
              "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
              $("#row_"+reg_id).remove();
            }
        });
      }

      function accept(event) 
      {
        var reg_id  = $(event).data("id");
        let _url = `/admin/verify-society-member/${reg_id}`;
          $.ajax({
            url: _url,
            type: "POST",
            data: {
              "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
              $("#row_"+reg_id).remove();
            } 
          });
      }
 </script>

 @stop