        <!--Begin Content-->
        <div class="content">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="row">


                        <div class="col-lg-12">
                        
                            <div class="ap-wrapper">
                                <div class="ap-box">
                                    <h5 class="ap-header">
                                        Add New Case
                                    </h5>
                                    <div class="table-responsive" >
                                    <form id="frm" action="">
                                    <p class="text-danger" id="error"></p>
                                    <div class="row">
                                    <div class="col-lg-8">
                    <div class="form-group-ap form-float">
                        <div class="form-line-ap">
                            <input type="text" name="text" class="form-control" tabindex="1" placeholder autocomplete="off" required="" data-parsley-trigger="keyup" data-parsley-type="email" data-parsley-required-message="Please input your email to login">
                            <label class="form-label">Forum</label>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                    <div class="form-group-ap form-float">
                        <div class="form-line-ap">
                            <input type="text" name="text" class="form-control" tabindex="2" autocomplete="off" required="" data-parsley-trigger="keyup" data-parsley-type="email" data-parsley-required-message="Please input your email to login">
                            <label class="form-label">Case Type</label>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-4 col-sm-6">
                    <div class="form-group-ap form-float">
                        <div class="form-line-ap">
                            <input type="text" name="text" class="form-control" tabindex="3" autocomplete="off" required="" data-parsley-trigger="keyup" data-parsley-type="email" data-parsley-required-message="Please input your email to login">
                            <label class="form-label">Case No</label>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                    <div class="form-group-ap form-float">
                        <div class="form-line-ap">
                            <select name="caseYear" class="form-control" tabindex="4" required="">
                            <option disbaled></option>
                            <?php 
                            $year = date("Y");
foreach (range(date('Y'), 1950) as $x) {
    //echo '<option value="'.$x.'"'.($x === date('Y') ? ' selected="selected"' : '').'>'.$x.'</option>';
    echo '<option value="'.$x.'">'.$x.'</option>';
}
                            ?>
                            </select>
                            <label class="form-label">Case Year</label>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="form-group-ap form-float">
                        <div class="form-line-ap">
                            <input type="text" name="text" class="form-control" tabindex="5" autocomplete="off">
                            <label class="form-label">Office File No.</label>
                        </div>
                    </div>
                    </div>
                    </div>
                                    </form>
                            </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <div id="data-loader"></div>
        
        <script>
        $( "#city" ).autocomplete({
            source: function( request, response ) {
              $.ajax({
                url: "<?php echo API_URL?>forums",
                dataType: "jsonp",
                data: {
                  q: request.term
                },
                success: function( data ) {
                  response( data );
                }
              });
            },
            minLength: 3,
            select: function( event, ui ) {
              log( ui.item ?
                "Selected: " + ui.item.label :
                "Nothing selected, input was " + this.value);
            },
            open: function() {
              $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
            },
            close: function() {
              $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
            }
          });
        </script>