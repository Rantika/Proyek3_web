@extends('layout')
@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Customer
                                <a href="{{url('admin/customer')}}" class="float-right btn btn-success btn-sm">Lihat</a>
                            </h6>
                        </div>
                        <div class="card-body">

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <p class="text-danger">{{$error}}</p>
                                @endforeach
                            @endif

                            @if(Session::has('success'))
                            <p class="text-success">{{session('success')}}</p>
                            @endif
                            <div class="table-responsive">
                                <form method="post" enctype="multipart/form-data" action="{{url('admin/customer')}}">
                                    @csrf
                                    <table class="table table-bordered" >
                                        <tr>
                                            <th>Nama <span class="text-danger">*</span></th>
                                            <td><input name="full_name" type="text" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <th>Email <span class="text-danger">*</span></th>
                                            <td><input name="email" type="email" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <th>Password <span class="text-danger">*</span></th>
                                            <td><input name="password" type="password" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <th>Telepon <span class="text-danger">*</span></th>
                                            <td><input name="mobile" type="text" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <th>Photo</th>
                                            <td><input name="photo" type="file" /></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td><textarea name="address" class="form-control"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="submit" class="btn btn-primary" />
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

@endsection
