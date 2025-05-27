@extends('backend.layout.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Article</h1>

    </div>

    <div class="section-body">
        <h2 class="section-title">Article</h2>


        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Simple Table</h4>
                        <div class="d-flex">
                            <a href="{{ route('articles.create') }}" class="btn btn-primary mr-3">Create New</a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Désignation</th> {{-- MAKTX --}}
                                        <th>Unité de quantité de base</th> {{-- MEINS --}}
                                        <th>Type d'article</th> {{-- MTART --}}
                                        <th>Gestion de lot</th> {{-- XCHPF --}}
                                        <th>Groupe d'achats</th> {{-- EKGRP --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articles as $index => $article)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $article->MAKTX }}</td>
                                        <td>{{ $article->MEINS }}</td>
                                        <td>{{ $article->MTART }}</td>
                                        <td>
                                            @if($article->XCHPF == '1')
                                            <div class="badge badge-success">Active</div>
                                            @else
                                            <div class="badge badge-danger">Not Active</div>
                                            @endif
                                        </td>
                                        <td>{{ $article->EKGRP }}</td>
                                         <td><div class="badge badge-info">Completed</div></td>
                                        <td>
                                              <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('articles.destroy',$article->id) }}" class="btn btn-danger delete-item">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href=""
                                        class="btn bg-warning"><i class="fas fa-copy"></i></i></a>


                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    $("#table-1").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2,3]
        }]
    });


</script>
@endpush
