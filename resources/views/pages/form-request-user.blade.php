@extends('layouts.app')

@section('title', 'Form Request User')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Form Request User</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Export
    </button>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">User Request Form</h6>
        <p class="text-muted mb-3">Fill out the form below to submit a user request.</p>
        
        <form>
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="userName" class="form-label">User Name</label>
                <input type="text" class="form-control" id="userName" placeholder="Enter user name">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="userEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="userEmail" placeholder="Enter email">
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="requestType" class="form-label">Request Type</label>
                <select class="form-select" id="requestType">
                  <option selected disabled>Choose request type</option>
                  <option value="new_user">New User Account</option>
                  <option value="permission">Permission Change</option>
                  <option value="reset_password">Password Reset</option>
                  <option value="deactivate">Account Deactivation</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="priority" class="form-label">Priority</label>
                <select class="form-select" id="priority">
                  <option selected disabled>Choose priority</option>
                  <option value="low">Low</option>
                  <option value="medium">Medium</option>
                  <option value="high">High</option>
                  <option value="urgent">Urgent</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="description" class="form-label">Request Description</label>
            <textarea class="form-control" id="description" rows="4" placeholder="Describe your request in detail"></textarea>
          </div>
          
          <div class="mb-3">
            <label for="attachment" class="form-label">Attachment (Optional)</label>
            <input type="file" class="form-control" id="attachment">
          </div>
          
          <button type="submit" class="btn btn-primary me-2">Submit Request</button>
          <button type="button" class="btn btn-secondary">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
