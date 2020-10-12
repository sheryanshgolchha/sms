<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css">
    .register{
    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    margin-top: 1%;
    padding: 3%;
    }
    .register-left{
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }
    .register-left input{
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }
    .register-right{
        background: #f8f9fa;
        border-top-left-radius: 10% 50%;
        border-bottom-left-radius: 10% 50%;
    }
    .register-left img{
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite  alternate;
        animation: mover 1s infinite  alternate;
    }
    @-webkit-keyframes mover {
        0% { transform: translateY(0); }
        100% { transform: translateY(-20px); }
    }
    @keyframes mover {
        0% { transform: translateY(0); }
        100% { transform: translateY(-20px); }
    }
    .register-left p{
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }
    .register .register-form{
        padding: 10%;
        margin-top: 10%;
    }
    .btnRegister{
        float: right;
        margin-top: 10%;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }
    .register .nav-tabs{
        margin-top: 3%;
        border: none;
        background: #0062cc;
        border-radius: 1.5rem;
        width: 28%;
        float: right;
    }
    .register .nav-tabs .nav-link{
        padding: 2%;
        height: 34px;
        font-weight: 600;
        color: #fff;
        border-top-right-radius: 1.5rem;
        border-bottom-right-radius: 1.5rem;
    }
    .register .nav-tabs .nav-link:hover{
        border: none;
    }
    .register .nav-tabs .nav-link.active{
        width: 100px;
        color: #0062cc;
        border: 2px solid #0062cc;
        border-top-left-radius: 1.5rem;
        border-bottom-left-radius: 1.5rem;
    }
    .register-heading{
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: #495057;
    }
    </style>
</head>
<body>
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="../assets/img/login_logo.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>Society Management System</p>
                        <input type="button" id="login" value="Login"/><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <!-- <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Employee</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hirer</a>
                            </li>
                        </ul> -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form action="{{ url('ins_register') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <h3 class="register-heading">Society Management System</h3>
                                <div class="row register-form">
                                    <div class="col-md-12">
                                        @if(count($errors))
                                            <!-- <div class="alert alert-danger"> 
                                                <ul>
                                                    @foreach($errors->all() as $error) 
                                                        <li>{{ $error }}</li> 
                                                    @endforeach
                                                </ul>
                                            </div> -->
                                            <div class="alert alert-danger">
                                                    @foreach($errors->all() as $error) 
                                                        {{ $error }}<br> 
                                                    @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="First Name *" value="{{old('fname')}}" id="fname" name="fname" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name *" value="{{old('lname')}}" id="lname" name="lname" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password *" value="{{old('pwd')}}" id="pwd" name="pwd" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"  placeholder="Confirm Password *" value="{{old('cnfpwd')}}" id="cnfpwd" name="cnfpwd" />
                                        </div>
                                        <div class="form-group">
                                            <label for="userphoto">Your Photo *</label>
                                            <input type="file" class="form-control" id="userphoto" name="userphoto" onchange="getImagePhoto(this);">
                                        </div>
                                        <div>
                                            <img style="border:1px solid black" class="img-responsive mx-auto d-block" id="uphoto" src="../assets/img/avatar.png" height="150px" width="150px">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Email Id *" value="{{old('email')}}" id="email" name="email" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="phone" name="phone" class="form-control" placeholder="Mobile Number *" value="{{old('phone')}}" />
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="wing" name="wing">
                                                <option class="hidden"  selected value="" disabled>Select Wing *</option>
                                                @foreach($wings as $wing)
                                                <option value="{{ $wing->wing_id }}">{{ $wing->wing_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Flat Number *" value="{{old('flatno')}}" id="flatno" name="flatno"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="idphoto">Your Id Proof *</label>
                                            <input type="file" class="form-control" id="idphoto" name="idphoto" onchange="getIdPhoto(this);">
                                        </div>
                                        <div>
                                            <img style="border:1px solid black" class="img-responsive mx-auto d-block" id="iphoto" src="../assets/img/proof.png" height="150px" width="150px">
                                        </div>
                                        <input type="submit" class="btnRegister"  value="Register"/>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <script type="text/javascript">
                    document.getElementById("login").onclick = function () {
                    window.location.href = "/login";
                    };
            </script>
            <script type="text/javascript">
              function getImagePhoto(input) 
              {
                if (input.files && input.files[0]) 
                {
                  var reader = new FileReader();
                  reader.onload = function (e) 
                  {
                    $('#uphoto').attr('src', e.target.result);
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
                    $('#iphoto').attr('src', e.target.result);
                  }
                reader.readAsDataURL(input.files[0]);
                }
              }
            </script>
</body>
</html>