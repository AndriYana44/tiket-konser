@extends('layouts.index')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tiket Terjual</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tiket</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-sm-11">
            <button class="generate-tiket btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#addtiket">Checkin Tiket</button>
            <div class="button-checked">
                <span>Belum Checkin</span>
                <span>Sudah Checkin</span>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Nomor Tiket</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Tanggal</th>    
                    <th>Aksi</th>
                </tr>
                @foreach ($tiket_sold as $key => $item) 
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->tiket_number }}</td>
                    <td>{{ $item->type }}</td>
                    <td>Rp.{{ number_format($item->price,2,',','.') }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <form class="d-inline form-delete-{{ $item->id }}" action="{{ route('deleteTiket', $item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" data-id="{{ $item->id }}" class="badge badge-danger delete mr-2" style="border:none">
                                Delete <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <a href="#" class="badge badge-warning">
                            Edit <i class="fa fa-pen"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
      </div>
    </div>
</section>
@endsection