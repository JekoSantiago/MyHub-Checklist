<div class="modal fade" id="modal_acl_store" tabindex="-1" role="dialog" aria-labelledby="modal_acl_store"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Choose Checklist / Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="search-container mb-2">
                    <div class="input-group">
                        <input name="answer_clstore_search" id="answer_clstore_search" type="text" class="form-control"
                            placeholder="Title or description...">
                        <div class="input-group-append">
                            <button type="button" name="btn-search-aclstore" id="btn-search-aclstore"
                                class="btn btn-md btn-outline-default m-0 px-3 py-2 z-depth-0 waves-effect"><i
                                    class="fa fa-search" aria-hidden="true"></i> Search</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="answer-store table-checklist">
                        <thead>
                            <tr>
                                <th class="th-fit"></th>
                                <th>Title</th>
                                <th>Created by</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Body Here -->
                        </tbody>
                    </table>
                    <input type="hidden" name="locID" id="locID">
                    <div class="modal-table-loader">
                        <img src="{{asset('assets/images/loader.svg')}}" height="60" width="60" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>