    @extends('admin.layouts.app')
    
    <style>
        .swal2-popup {
            font-size: 0.8rem;
            /* Adjust font size */
            padding: 0.5rem;
            /* Adjust padding */
            width: 300px;
            /* Adjust width */
        }
    
        .swal2-title {
            font-size: 1rem;
            /* Adjust title font size */
        }
    
        .swal2-content {
            font-size: 0.9rem;
            /* Adjust content font size */
        }
    </style>
    @section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">New Product</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                @include('admin.message')
                <div class="card">
                    <form action="" method="get">
                        <div class="card-header">
                            <div class="card-title">
                                <button type="button" onclick="window.location.href='{{ route('products.index') }}'"
                                    class="btn btn-default btn-sm">Reset</button>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input type="text" value="{{ Request::get('keyword') }}" name="keyword"
                                        class="form-control float-right" placeholder="Search">
    
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th width="60">Sr. No.</th>
                                    {{-- <th width="60">ID</th> --}}
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Price</th>
                                    {{-- <th>Qty</th> --}}
                                    {{-- <th>SKU</th> --}}
                                    <th width="100">Status</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->isNotEmpty())
                                    @php
                                    $counter = 1;
                                    @endphp
                                    @foreach ($products as $item)
                                        @php
                                            $productsImage = $item->product_images->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            {{-- <td>{{ $item->id }}</td> --}}
                                            <td>
                                                @if (!empty($productsImage->image))
                                                    <img src="{{ asset('/uploads/product/' . $productsImage->image) }}"
                                                        alt="img-thumbnail" width="70" />
                                                @else
                                                    <img src="{{ asset('admin-assets/img/default-150X150.png') }}"
                                                        alt="Default" width="50" />
                                                @endif
                                            </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->categoryName }}</td>
                                            <td>{{ $item->subcategoryName ? $item->subcategoryName : 'No Sub-Category'  }} </td>
                                            <td>{{ $item->product_price }}</td>
                                            <td>
                                                @if ($item->product_status === 'active')
                                                    <svg class="text-success-500 h-6 w-6 text-success"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('products.edit', $item->id) }}">
                                                    <svg class="filament-link-icon w-4 h-4 mr-1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="#" onclick="deleteCategory({{ $item->id }})"
                                                    class="text-danger w-4 h-4 mr-1">
                                                    <svg wire:loading.remove.delay="" wire:target=""
                                                        class="filament-link-icon w-4 h-4 mr-1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path ath fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">Recodes Not Found</td>
                                    </tr>
                                @endif
    
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    
    @endsection
    
    @section('customjs')
    <script>
        function deleteCategory(id) {
            var url = '{{ route('products.delete', 'ID') }}';
            var newUrl = url.replace("ID", id);
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: newUrl,
                        type: 'delete',
                        data: {},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response["status"]) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'The category has been deleted.',
                                    timer: 1000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = "{{ route('products.index') }}";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Something went wrong. Please try again later.',
                                    timer: 1000,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong. Please try again later.',
                                timer: 1000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        }
    </script>
    @endsection
