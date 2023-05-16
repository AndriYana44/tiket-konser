@extends('layouts.index')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tiket Tersedia</h1>
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
            <button class="generate-tiket btn btn-primary btn-sm my-2" data-toggle="modal" data-target="#addtiket">Generate Tiket</button>
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Nomor Tiket</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                    <th>Tanggal</th>    
                    <th>Aksi</th>
                </tr>
                @foreach ($data as $key => $item) 
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->tiket_number }}</td>
                    <td>{{ $item->type }}</td>
                    <td>Rp.{{ number_format($item->price,2,',','.') }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <form class="d-inline" action="{{ route('deleteTiket', $item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="badge badge-danger delete mr-2" style="border:none">
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

<!-- Modal -->
<div class="modal fade" id="addtiket" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('tiketStore') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="jenis">Jenis Tiket</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value=""></option>
                        <option data-harga="500000" value="regular">Regular</option>
                        <option data-harga="1000000" value="vip">vip</option>
                        <option data-harga="1500000" value="golden">Golden Circle</option>
                        <option data-harga="3000000" value="tribun">Tiket Tribun</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="harga">Harga</span>
                    </div>
                    <input type="text" class="harga" class="form-control" disabled>
                    <input type="text" class="harga" name="harga" hidden>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control input-generate" name="tiket_num" placeholder="Tiket number" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    <button class="btn btn-info generate-number" type="button">Generate Number</button>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="tanggal">Tanggal</span>
                    </div>
                    <input type="date" class="form-control" value="{{ $date }}" disabled>
                    <input type="date" name="date" class="form-control" value="{{ $date }}" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script>
    $(document).ready(function() {
        @if($message = Session::get('success'))
            swal({{ $message }}, "success");
        @endif
        
        $('#jenis').select2({ 
            placeholder: 'pilih jenis tiket',
            width: '100%' 
        });

        $(document).on('change', '#jenis', function(e) {
            let price = $(this).find(':selected').data('harga');
            $('.harga').each(function(i,v) {
                $(v).val( i == 0 ? ` Rp.${number_format(price)}` : price );
            });
        });

        $(document).on('click', '.generate-number', function(e) {
            let iid = Math.floor(100000000 + Math.random() * 900000000);
            $('.input-generate').val(iid);
            $(this).attr('disabled', 'on');
        });
    });
  </script>
@endsection