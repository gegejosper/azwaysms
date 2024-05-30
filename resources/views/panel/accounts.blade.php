@extends('layout.panel')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Accounts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/panel/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Accounts</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List</h3>

          <div class="card-tools">
            <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_account_Modal">
              <i class="fas fa-plus"></i> Add
            </button> -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_account_Modal">
            <i class="fas fa-plus"></i> Add
            </button>
            <!-- Modal -->
            <div class="modal fade" id="add_account_Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-3">
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="col-4">
                        <input type="email" class="form-control" placeholder="Email">
                      </div>
                      <div class="col-5">
                        <input type="text" class="form-control" placeholder="Sender Name">
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveAccount">Save</button>
                  </div>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                           Name
                      </th>
                      <th>
                          Load
                      </th>
                      <th>
                         Sender Name
                      </th>
                      <th>
                          SMS Sent
                      </th>
                      <th style="width: 8%" class="text-center">
                          Status
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                @foreach($accounts as $account)
                  <tr>
                      <td>
                          
                      </td>
                      <td>
                          {{$account->user_details->name}}
                      </td>
                      <td>
                          <a>
                          {{$account->load}}
                          </a>
                          <br>
                          <small>
                              
                          </small>
                      </td>
                      <td>
                        {{$account->sender_name}}
                      </td>
                      <td>
                        {{number_format($account->sms_sent->count(),0)}}
                      </td>
                      <td>
                          
                          <span class="badge badge-success">{{$account->status}}</span>
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view_account_Modal">
                              <i class="fas fa-search">
                              </i>
                              
                          </a>
                           <!-- Modal -->
                           <div class="modal fade" id="view_account_Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              @csrf
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Account Details</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-3">
                                      <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-4">
                                      <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col-5">
                                      <input type="text" class="form-control" placeholder="Sender Name">
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" id="saveAccount">Save</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_account_Modal" 
                            data-name="{{$account->user_details->name}}" 
                            data-email="{{$account->user_details->email}}" 
                            data-sender_name="{{$account->sender_name}}">
                              <i class="fas fa-pencil-alt"  >
                          </i>
                              
                          </a>
                          <!-- Modal -->
                          <div class="modal fade" id="edit_account_Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              @csrf
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="staticBackdropLabel">Update Account</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-3">
                                      <input type="text" class="form-control" name="name" placeholder="Name" id="edit_name">
                                    </div>
                                    <div class="col-4">
                                      <input type="email" class="form-control" name="email" placeholder="Email" id="edit_email">
                                    </div>
                                    <div class="col-5">
                                      <input type="text" class="form-control" name="sender_email" placeholder="Sender Name" id="edit_sender_name">
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" id="saveAccount">Save</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-eye">
                              </i>
                             
                          </a>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="{{asset('js/accounts.js')}}"></script>
  @endsection