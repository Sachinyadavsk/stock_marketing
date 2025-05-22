


            <!--Reward Cat Modal -->
            <div class="modal fade" id="rewardCatModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Withdrawal Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="false">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/withdrawal/create" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="yXjdRIbKmMP1Ae8EcyLoNGtH8SjLz37UMQYcLmpU">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-label"> Title</label>
                                    <input type="text" class="form-control" name="name" placeholder="Paypal,etc"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Minimum Coin Required For this
                                        Method</label>
                                    <input type="text" class="form-control" name="min_coin" placeholder="100" required>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Available In Country (all=for all
                                        country)</label>
                                    <input type="text" class="form-control" name="country" placeholder="US,IN"
                                        value="all">
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="orm-label">Thumbnail(W 200* H 150 )</label>
                                    <input type="file" class="form-control" name="icon" required>
                                </div>

                                <hr class="horizontal dark my-2">
                                <label for="projectName" class="form-label">Description</label>
                                <textarea class="ckeditor form-control" name="description" required></textarea>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-info">Add</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Reward Cat Modal -->
            <div class="modal fade" id="UpdaterewardCatModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Withdrawal Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="false">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/withdrawal/update" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="yXjdRIbKmMP1Ae8EcyLoNGtH8SjLz37UMQYcLmpU">
                                <input type="hidden" id="reward_cat_id" name="id">
                                <input type="hidden" id="reward_cat_oldicon" name="oldicon">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-label"> Title</label>
                                    <input type="text" class="form-control" name="name" id="catname">
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Minimum Coin Required For this
                                        Method</label>
                                    <input type="text" class="form-control" name="min_coin" placeholder="100"
                                        id="redeem_cat_min_coin" required>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Available In Country (all=for all
                                        country)</label>
                                    <input type="text" class="form-control" name="country" id="country"
                                        placeholder="US,IN" value="all">
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="orm-label">Thumbnail(W 200* H 150 )</label>
                                    <input type="file" class="form-control" name="icon">
                                </div>

                                <hr class="horizontal dark my-2">
                                <label for="projectName" class="form-label">Description</label>
                                <textarea class="ckeditor form-control" name="description" id="redeemcat_description"
                                    required></textarea>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-info">Save Changes</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>





            <!--balance Modal -->
            <div class="modal fade" id="balanceModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Coin Credit / Debit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="false">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/users/coins" method="POST">
                                <input type="hidden" name="_token" value="yXjdRIbKmMP1Ae8EcyLoNGtH8SjLz37UMQYcLmpU">
                                <input type="hidden" name="id" id="uid">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Select Type:</label>
                                    <select class="form-control" name="type" id="choices-tag2" placeholder="Select Type"
                                        required>
                                        <option value="">Select</option>
                                        <option value="credit">Credit</option>
                                        <option value="debit">Debit</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Coin :</label>
                                    <input type="number" class="form-control" name="coin"
                                        placeholder="How much coin you want to debit or credit" required>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Remark :</label>
                                    <input type="text" class="form-control" name="remark" placeholder="Bonus Credited"
                                        required>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-info">Update Balance</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Payment Request Approve / Reject -->
            <div class="modal fade" id="withdraw_approve" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Withdrawal Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="false">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/withdrawal/status/update" method="POST">
                                <input type="hidden" name="_token" value="yXjdRIbKmMP1Ae8EcyLoNGtH8SjLz37UMQYcLmpU">
                                <input type="hidden" name="id" id="request_id">

                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Remark :</label>
                                    <select name="type" class="form-control">
                                        <option value="Success">Success</option>
                                        <option value="Reject">Reject</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-label">Remark :</label>
                                    <input type="text" class="form-control" name="remark"
                                        value="Your Payment will be sent">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-danger">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


           