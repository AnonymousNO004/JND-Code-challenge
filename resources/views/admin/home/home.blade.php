@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/home/home.css')}}">
@endsection
@section('body')
    <div class="py-3 px-2 px-md-5 d-flex flex-row justify-content-between align-items-center" id="header">
        <div class="font-weight-bold">
            {{$username}}
        </div>
        <div>
            <a class="btn btn-primary" href="{{url('admin/logout')}}">Logout</a>
        </div>
    </div>
    <div class="d-flex align-items-center h-100">
        <div class="container my-5">
            <div class="row bg-white rounded-lg py-5 px-md-3 px-">
                <div class="col-12">
                    <h3>All Users</h3>
                    <div class="table-responsive">
                        <table class="table my-3" id="TableLists">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Permission</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">แก้ไข</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="FormEdit">
                <input type="hidden" name="id" id="edit_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_permission">Permission:</label>
                                <select name="permission" id="edit_permission" class="form-control" required style="width: 100% !important;">
                                    <option value=""></option>
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                    <option value="full">full permissions</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/admin/home/home.js')}}"></script>
@endsection
