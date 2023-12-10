<div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="edit_userForm" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_user_id">
                        <div class="mb-3 d-flex">
                            <div class="col-md-12 col-4">
                                <label for="nama" class="form-label mt-2">Nama</label>
                                <input type="text" class="form-control" id="edit_nama"
                                    placeholder="Masukan Nama.." />
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="col-md-12 col-4">
                                <label for="email" class="form-label mt-2">Email</label>
                                <input type="email" class="form-control" id="edit_email" aria-describedby="emailHelp"
                                    placeholder="Masukan Email.." />
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="col-md-12 col-4">
                                <label for="password" class="form-label mt-2">Password</label>
                                <input type="password" class="form-control" id="edit_password"
                                    aria-describedby="emailHelp" placeholder="Masukan Password.." />
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="col-md-12 col-4">
                                <label class="form-label">Role</label>
                                <select class="form-select form-select mb-3" id="edit_role"
                                    aria-label="Large select example">
                                    <option selected>Pilih...</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="col-md-12 col-4">
                                <label class="form-label">Division</label>
                                <select class="form-select form-select mb-3" id="edit_division_id"
                                    aria-label="Large select example" x`>
                                    <option selected>Pilih...</option>
                                    @foreach ($division as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="submit" id="update_user" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
