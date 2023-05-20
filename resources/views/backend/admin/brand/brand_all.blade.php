@extends('backend.admin.admin_master')

@section('contents')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Brands</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Brands</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase text-center">All Brands</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key=>$brand)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="http://127.0.0.1:8000/backend/assets/images/icons/chair.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">{{$brand->brand_name}}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$brand->created_at}}</td>
                                    <td>{{$brand->updated_at}}</td>
                                    <td>
                                        <a href="http://">edit</a>
                                        <a href="http://">view</a>
                                        <a href="http://">delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endpush
