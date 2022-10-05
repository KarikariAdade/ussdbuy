@extends('layouts.master')
@section('content')
    @push('page-css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatable/datatable.min.css') }}"/>

    @endpush
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

        </div>
        <div class="row">
            <div class="col-md-12 card table-responsive">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            <h4>Numbers</h4>
                        </div>
                        <div class="col-md-5" style="text-align: right;">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNumberModal">Add Number <i class='bx bx-plus-circle'></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $dataTable->table(['class' => 'table table-hover']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNumberModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add Number</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form class="addItem" method="POST" action="{{ route('numbers.store') }}">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Enter Number" name="number"/>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Should Whitelist? <span class="text-danger">*</span></label>
                                <select class="form-control" name="whitelist">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editNumberModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Update Number</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form class="addItem" id="editNumberForm" method="POST" action="">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editNumber" placeholder="Enter Number" name="number"/>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Should Whitelist? <span class="text-danger">*</span></label>
                                <select class="form-control" name="whitelist" id="editWhitelist">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-success">Update Number</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('page-js')
    <script type="text/javascript" src="{{ asset('assets/Datatable/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/Datatable/pdfmake_font.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/Datatable/datatable.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush
