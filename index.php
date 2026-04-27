<?php include('includes/header.php'); ?>

<!-- Insert model -->
<div class="modal fade" id="insertdata" tabindex="-1" aria-labelledby="insertdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertdataLabel">Insert data into database using bootstrap pop-up model</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="enter name">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="enter email">
                    </div>
                    <div class="form-group mb-3">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="enter number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save_data" class="btn btn-primary">save data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>PHP POP-UP MODAL CRUD- part1</h4>
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#insertdata">
                        INSERT DATA
                    </button>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>