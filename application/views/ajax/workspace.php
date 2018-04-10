        <!--Begin Content-->
        <div class="content bg-gray">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="row">


                        <div class="col-lg-12">
                        
                            <div class="ap-wrapper">
                                <div class="ap-box">
                                    <h5 class="ap-header">
                                        Cases
                                        <div class="ap-box-controls">
                                            <button class="btn btn-primary btn-sm" type="button" onClick="pageLoadFromServer('/add-case');"><i class="fa fa-plus"></i> Add Case</button>
                                            <i class="material-icons" data-box="refresh" data-effect="win8_linear" data-url="/user-cases">refresh</i>
                                            <i class="material-icons" data-box="fullscreen">fullscreen</i>
                                        </div>
                                    </h5>
                                    <div class="table-responsive" >
                                <table class="table table-separate table-extended">
                                    <thead>
                                    </thead>
                                    <tbody id="data-content">
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <div id="data-loader"></div>
        <!--End Content-->
<script type="text/javascript">
dataLoadFromServer('/user-cases');
</script>

