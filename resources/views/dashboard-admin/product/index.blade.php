@extends('dashboard-admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product</h1>
</div>
    <div class="table-responsive col-lg-8">
        <a href="/admin-product/create" class="btn btn-primary mb-3" >Create new product</a>
        <table class="table table-striped table-sm">
        <thead>
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        @foreach ($products as $product)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->nama }}</td>
            <td>{{ $product->harga }}</td>
            <td>
                <a href="{{ route('admin-product.edit', $product->id) }}" class="badge bg-warning"><span data-feather="edit"></span></a>
                <form action="{{ route('admin-product.destroy', $product->id) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                </form>                
            </td>
        </tr>
        @endforeach
        <tbody>
        </tbody>
        </table>
    </div>
@endsection