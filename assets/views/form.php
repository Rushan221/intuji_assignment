<?php include './header.php' ?>

<div class="card">
    <div class="card-header">
        <h3>Add Event to Google Calendar</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="../../add_event.php">
            <div class="mb-3">
                <label for="summary" class="form-label">Event Summary:</label>
                <input type="text" class="form-control" id="summary" name="summary" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="start_datetime" class="form-label">Start Date & Time:</label>
                <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required>
            </div>
            <div class="mb-3">
                <label for="end_datetime" class="form-label">End Date & Time:</label>
                <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
<?php include './footer.php' ?>
