@extends('layout/app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('add_data.get') }}" class="btn btn-primary">Add Data</a>

    </div>

    @if (session('status'))
    <div class="col-md-12 mt-3">
        <div class="alert alert-{{ session('class') }}" role="alert">
            {{ session('status') }}
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Menu</h4>
                <p class="card-category">Here is a list for this table</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Nama Menu
                                </th>
                                <th>
                                    Harga
                                </th>
                                <th>
                                    Jenis
                                </th>
                                <th>
                                    Gambar
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                            <tr>
                                <td>
                                    {{ $menu['id'] }}
                                </td>
                                <td>
                                    {{ $menu['nama_menu'] }}
                                </td>
                                <td>
                                    {{ $menu['harga_menu'] }}
                                </td>
                                <td>
                                    {{ $menu['jenis_menu'] }}
                                </td>
                                <td>
                                    <img src="{{ asset('img/places/' . $menu['gambar_menu']) }}" width="200" />
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-sm" href="{{ route('update_data.get', ['id' => $menu['id']]) }}">
                                        <i class="material-icons text-white">edit</i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('delete', ['id' => $menu['id']]) }}" onclick="return confirm('Are you sure to delete {{ $menu['nama_menu'] }} ?');">
                                        <i class="material-icons text-white">delete</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        {{ $menus->links() }}
    </div>
</div>
<form action="{{ route('add_json') }}" method="post" enctype="multipart/form-data">
    <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Choose File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group bmd-form-group">
                        <label>File</label>
                        <input type="file" name="json" id="json" class="form-control" style="position: initial; opacity: 1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
