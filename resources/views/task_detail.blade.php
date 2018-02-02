<form action="{{ url('task', $task->id) }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <!-- Task Name -->
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <label for="task-title">Title</label>
            <input type="text" name="title" id="task-title" class="form-control" maxlength="255" value="{{ $task->title }}">
        </div>
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <label for="task-description">Description</label>
            <input type="text" name="description" id="task-description" class="form-control" value="{{ $task->description }}">
        </div>
    </div>
</form>