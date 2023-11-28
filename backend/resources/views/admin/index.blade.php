@extends('layout')


@section('content')
<a href="#"><button class="btn btn-primary me-2">Add</button></a>
<table class="table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Last Login</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($listAdmin as $admin)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $admin->id }}</strong></td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->fullname }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone_number }}</td>
                        <td><span class="badge bg-label-info me-1">{{ $admin->login_at }}</span></td>
                        <td><span class="badge bg-label-primary me-1">{{ $admin->status->name }}</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a class="dropdown-item" href=""><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <a class="dropdown-item" href=""><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
@endsection