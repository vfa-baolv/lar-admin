<div class="student-page">
    <div class="container">
        <div classs="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left"><strong>All Student</strong></h5>
                        <button
                            class="btn btn-sm btn-primary"
                            style="float: right;"
                            wire:click="openAddNewModal"
                        >Add new sdutent</button>
                    </div>

                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($students->count())
                                   @foreach ($students as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td style="text-align: center">
                                                <button class="btn btn-sm btn-secondary">view</button>
                                                <button class="btn btn-sm btn-primary" wire:click="openEditModal({{ $item->id }})">Edit</button>
                                                <button class="btn btn-sm btn-danger" wire:click="openDeleteModal({{ $item->id }})">Delete</button>
                                            </td>
                                        </tr>
                                   @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align: center">No Student Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div wire:ignore.self id="studentModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $ui['title'] }}</h5>
                    <button type="button" class="close" wire:click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" wire:submit.prevent="saveStudent">
                        <div class="form-group row">
                            <label for="student_id" class="col-3">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="student_id" class="form-control" wire:model.lazy="student_id">
                                @error('student_id')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-3">Name</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model.lazy="name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" class="form-control" wire:model.lazy="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-3">Phone</label>
                            <div class="col-9">
                                <input type="phone" id="phone" class="form-control" wire:model.lazy="phone">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                               <button type="submit" class="btn btn-sm btn-primary">{{ $ui['btnText'] }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self id="deleteStudentModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete student</h5>
                    <button type="button" class="close" wire:click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4 pb-4">
                   <h6>Are you sure ? You want to delete this student data!</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteStudent">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('open-modal', function() {
        $('#studentModal').modal('show');
    });

    window.addEventListener('close-modal', function() {
        $('#studentModal').modal('hide');
        $('#deleteStudentModal').modal('hide');
    });

    window.addEventListener('show-delete-modal-student', function() {
        $('#deleteStudentModal').modal('show');
    });
</script>
@endpush

