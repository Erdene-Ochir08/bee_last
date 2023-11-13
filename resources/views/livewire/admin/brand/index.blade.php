<div>
    <div class="row">

        @include('livewire.admin.brand.modal-form')

        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        Brands List
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary btn-sm float-end">Brand нэмэх</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>

                                <td>
                                    @if($brand->image)
                                        <img src="{{ asset($brand->image) }}" alt="Brand Image" width="100">
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>
                                    @if($brand->category)
                                        {{ $brand->category->name }}
                                    @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $brand->slug }}</td>
                                <td>{{ $brand->status == '1' ? 'hidden':'visible' }}</td>
                                <td>
                                    <a href="#" wire:click="editBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-success btn-sm">Засах</a>
                                    <a href="#" wire:click="deleteBrand({{ $brand->id }})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-danger btn-sm">Устгах</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Brand одоогоор байхгүй байна</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $brands->links() }}
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>

        @push('script')
            <script>
                window.addEventListener('close-modal', event => {
                    $('#addBrandModal').modal('hide');
                    $('#updateBrandModal').modal('hide');
                    $('#deleteBrandModal').modal('hide');
                });
            </script>
@endpush
