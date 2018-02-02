@extends('layouts.app')

@section('content')

<!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Task Form -->
    <form action="/task" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Task Name -->
        <div class="form-group">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <label for="task-title">Title</label>
                <input type="text" name="title" id="task-title" class="form-control" maxlength="255">
            </div>
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <label for="task-description">Description</label>
                <input type="text" name="description" id="task-description" class="form-control">
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Task
                </button>
            </div>
        </div>
    </form>
</div>

    <!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ str_limit($task->title, 50) }}</div>
                                </td>

                                <td class="table-text">
                                    <div class="task-status">
                                        @if($task->completed)
                                        <div class="circle-loader"><div class="checkmark draw"></div></div>
                                        @else
                                        <form action="/task/{{ $task->id }}/complete" method="POST">
                                            {{ csrf_field() }}

                                            <button>Mark as ..</button>
                                        </form>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    @if($task->completed)
                                    -
                                    @else
                                    <button type="button" class="task-edit" data-url="{{ url('task', $task->id) }}">Edit</button>
                                    @endif
                                </td>

                                <td>
                                <form action="/task/{{ $task->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit">Delete Task</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection

@section('modal')
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit task</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection