@extends('backend.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Liste des Mail recipients</h1>

    </div>

    <div class="section-body">
        <h2 class="section-title">Mail recipients</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                        <h4></h4>
                        <div class="d-flex">
                            <a href="{{ route('mail_recipients.create') }}" class="btn btn-primary mr-3">Create New</a>
                        </div>
                    </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>email</th>
                                <th>nom</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mailRecipients as $index => $mail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mail->email }}</td>
                                    <td>{{ $mail->name }}</td>
                                    <td>
                                         @if($mail->status == '1')
                                            <div class="badge badge-success">Active</div>
                                            @else
                                            <div class="badge badge-danger">Not Active</div>
                                            @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('mail_recipients.edit', $mail->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                         <a href="{{ route('mail_recipients.destroy',$mail->id) }}" class="btn btn-danger delete-item">
                                                <i class="fas fa-trash-alt"></i>
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
</section>
@endsection

@push('scripts')
<script>
    $("#table-1").dataTable({
        "columnDefs": [
            { "sortable": false, "targets": [2,3] }
        ]
    });
</script>
@endpush
