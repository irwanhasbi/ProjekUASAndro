@extends('layout/app')

@section('content')
<div class="row">
    <div class="col-md-7 mx-auto">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Update Place</h4>
                <p class="card-category">Fill the form to update a place</p>
            </div>
            <div class="card-body">
                <form action="{{ route('update_data.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Nama Menu</label>
                                <input type="text" name="nama_menu" class="form-control" value="{{ $menu['nama_menu'] }}">
                                <input type="text" name="id" class="form-control" value="{{ $menu['id'] }}" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group bmd-form-group">
                                <label>Jenis Menu</label>
                                <select class="form-control" name="jenis_menu" id="exampleFormControlSelect1">
                                    @if($menu['jenis_menu'] == 'Makanan')
                                    <option value="Makanan" selected>Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    @else
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman" selected>Minuman</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Harga</label>
                                <input type="number" name="harga_menu" class="form-control" value="{{ $menu['harga_menu'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('img/places/' . $menu['gambar_menu']) }}" class="img-thumbnail" width="200" alt="..." id="thumbnail">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group bmd-form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="gambar_menu" id="gambar" class="form-control" style="position: initial; opacity: 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Create</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.getElementById('gambar').addEventListener('change', (e) => {
        let url = URL.createObjectURL(e.target.files[0]);

        document.getElementById('thumbnail').src = url;
    }, false);

</script>
@endpush
