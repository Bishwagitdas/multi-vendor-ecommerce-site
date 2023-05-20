@extends('backend.admin.admin_master')

@section('contents')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Your Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form  method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Brand Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" value="{{old('brand_name')}}"/>
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Brand Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="brand_image" class="form-control" type="file" />

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script>

    const inputElement = document.querySelector('input[type="file"]');
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        server: {
            process: '/admin/tmp-upload',
            revert: '/admin/tmp-delete',
            headers: {
                'X-CSRF-TOKEN' : '{{ csrf_token()}}'
            }
        }
    });
</script>
@endpush
@endsection
