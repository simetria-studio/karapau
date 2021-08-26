@extends('layouts.painel.index')


@section('content')

    <div class="card m-5 col-md-10">
        <form action="{{ route('admin.artes.update', $arte->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Arte</label>
                        <input type="text" class="form-control" value="{{ $arte->name }}"name="name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"></label>
                        <input type="submit" class="form-control btn btn-dark" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="Cadastrar">
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>

    </script>
@endsection
