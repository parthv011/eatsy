<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items Menu</title>
    <?php require('links.php') ?>
    <style>
        .custom-bg {
            background-color: hsl(120, 61.80%, 60.00%);
            border: none;
        }

        .custom-bg:hover {
            background-color: hsl(120, 46.50%, 44.70%);
            border: none;
        }
    </style>
</head>

<body class="bg-light">
    <?php require('header.php'); ?>
    <div class="container-fluid" id="main_content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">ROOMS</h3>

                <!-- Feature -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="table-responsive-lg" style="height:450px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col" class="bg-dark text-light">#</th>
                                        <th scope="col" class="bg-dark text-light">Name</th>
                                        <th scope="col" class="bg-dark text-light">Address</th>
                                        <th scope="col" class="bg-dark text-light">Pickup Point</th>
                                        <th scope="col" class="bg-dark text-light">Delivery Point</th>
                                        <th scope="col" class="bg-dark text-light">Price</th>
                                        <th scope="col" class="bg-dark text-light">Status</th>
                                        <th scope="col" class="bg-dark text-light">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!--Feature Modal -->
        <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="add_room_form" autocomplete="off">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Room</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Name</label>
                                    <input type="text" class="form-control shadow-none" name="feature_name" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Area</label>
                                    <input type="number" min="1" class="form-control shadow-none" name="area" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Guests</label>
                                    <input type="text" min="1" class="form-control shadow-none" name="guests" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Price</label>
                                    <input type="text" min="1" class="form-control shadow-none" name="price" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Quantity</label>
                                    <input type="text" min="1" class="form-control shadow-none" name="feature_name" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Price</label>
                                    <input type="text" min="1" class="form-control shadow-none" name="feature_name" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Action</label>
                                    <input type="text" class="form-control shadow-none" name="feature_name" required>
                                </div>
                                <div class="mb-3 col-12">
                                    <label class="formlabel fw-bold">Features</label>
                                    <div class="row">
                                        ...
                                        Features Name
                                        ...
                                    </div>
                                </div>
                                <div class="mb-3 col-12">
                                    <label class="formlabel fw-bold">Facilities</label>
                                    <div class="row">
                                        ...
                                        Facilities Name
                                        ...
                                    </div>
                                </div>
                                <div class="mb-3 col-12">
                                    <label class="formlabel fw-bold">Description</label>
                                    <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                                </div> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                            <button type="submit" class="custom-bg text-white shadow-none">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>