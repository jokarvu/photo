<template>
    <div class="container-fluid mt--7">
        <!-- Overview -->
        <h1 class="h1-card">Overview</h1>
        <div class="row">
            <div class="col-lg-3 mb-2 mt-2">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">User</h5>
                                <span class="h2 font-weight-bold mb-0">5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-2 mt-2">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Banded User</h5>
                                <span class="h2 font-weight-bold mb-0">5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fas fa-user-times"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-2 mt-2">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Photographer</h5>
                                <span class="h2 font-weight-bold mb-0">5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fa fa-camera-retro"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-2 mt-2">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Banded Photographer</h5>
                                <span class="h2 font-weight-bold mb-0">5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-2 mt-2">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Order</h5>
                                <span class="h2 font-weight-bold mb-0">5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-2 mt-2">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Success Order</h5>
                                <span class="h2 font-weight-bold mb-0">5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                    <i class="fas fa-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-2 mt-2">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Cancel Order</h5>
                                <span class="h2 font-weight-bold mb-0">5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fas fa-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-2 mt-2">
                <div class="card card-stats mb-4 mb-xl-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Pending Order</h5>
                                <span class="h2 font-weight-bold mb-0">5</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                    <i class="fas fa-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <h1 class="h1-card">Chart</h1>
        <div class="card">
            <div class="card-body">
                <div class="progress-wrapper pt-0">
                    <div class="progress-info">
                        <div class="progress-label">
                        <span>Order complete</span>
                        </div>
                        <div class="progress-percentage">
                        <span>60.7%</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60.7" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews & Comment -->
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h1-card">Recent Reviews</h1>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive-lg mt-4" id="recent-review">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Photographer</th>
                                    <th>Review</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>Good photographer</td>
                                    <td>
                                        <p class="badge badge-primary">4 <i class="fas fa-star"></i></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>Good photographer</td>
                                    <td>
                                        <p class="badge badge-primary">4 <i class="fas fa-star"></i></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>Good photographer</td>
                                    <td>
                                        <p class="badge badge-primary">4 <i class="fas fa-star"></i></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>Good photographer</td>
                                    <td>
                                        <p class="badge badge-primary">4 <i class="fas fa-star"></i></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>Good photographer</td>
                                    <td>
                                        <p class="badge badge-primary">4 <i class="fas fa-star"></i></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="h1-card">Recent Orders</h1>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive-lg mt-4" id="recent-order">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Photographer</th>
                                    <th>Status</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>
                                        <p class="badge badge-warning">Pending</p>
                                    </td>
                                    <td>Quy Nhơn</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>
                                        <p class="badge badge-danger">Cancelled</p>
                                    </td>
                                    <td>Quy Nhơn</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>
                                        <p class="badge badge-success">Success</p>
                                    </td>
                                    <td>Quy Nhơn</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>
                                        <p class="badge badge-primary">Confirmed</p>
                                    </td>
                                    <td>Quy Nhơn</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Jokar Vũ</td>
                                    <td>Mito</td>
                                    <td>
                                        <p class="badge badge-warning">Pending</p>
                                    </td>
                                    <td>Quy Nhơn</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted () {
        $('#recent-review').DataTable({
            searching: false,
            paging: false,
            info: false
        });
        $('#recent-order').DataTable({
            searching: false,
            paging: false,
            info: false
        });
    }
}
</script>
