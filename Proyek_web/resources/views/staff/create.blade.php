@extends('layout')
@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Staff
                                <a href="{{url('admin/staff')}}" class="float-right btn btn-success btn-sm">Lihat</a>
                            </h6>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                            <p class="text-success">{{session('success')}}</p>
                            @endif
                            <div class="table-responsive">
                                <form enctype="multipart/form-data" method="post" action="{{url('admin/staff')}}">
                                    @csrf
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nama</th>
                                            <td><input name="full_name" type="text" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <th>Pilih Department</th>
                                            <td>
                                                <select name="department_id" class="form-control">
                                                    <option value="0">--- Pilih ---</option>
                                                    @foreach($departs as $dp)
                                                    <option value="{{$dp->id}}">{{$dp->title}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Photo</th>
                                            <td><input name="photo" type="file" /></td>
                                        </tr>
                                        <tr>
                                            <th>Bio</th>
                                            <td><textarea class="form-control" name="bio"></textarea></td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Gaji</th>
                                            <td>
                                                <input type="radio" name="salary_type" value="daily">Harian
                                                <input type="radio" name="salary_type" value="monthly"> Bulanan
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Gaji</th>
                                            <td><input name="salary_amt" class="form-control" type="number" /></td>
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
