<?php
/*
Template Name: Calculator
*/
get_header(); ?>

<style type="text/css">
  .mortgage_details label{ display: block; padding: 0 0 12px 0; font-size: 17px; color: #4c4c4d;}
 .mortgage_details input[type=text], .mortgage_details input[type=email], .mortgage_details input[type=number], .mortgage_details input[type=tel] { width: 100%; background: none;  padding: 0 20px;  font-size: 17px;  color: #4c4c4d;  margin-bottom: 20px;  border: 1px solid #4c4c4d;  height: 60px;    line-height: 60px; -webkit-appearance: none;}
 #year_str{line-height: 55px;  padding: 0 15px; text-transform: uppercase; position: absolute; right: 15px; top: 0 }
 #month_str{line-height: 55px;  padding: 0 0 0 15px; text-transform: uppercase; position: absolute; right: 15px; top: 0}
 .dlr_fst{ position: relative; margin-bottom: 0px;}
 .dlrposition{ position: absolute; left: 10px; line-height: 58px; }
 #mortgage_amount{ padding-left: 25px; }
 .mortgage_details select{ width: 100%; background: none;  padding: 0 20px;  font-size: 17px;  color: #4c4c4d;  margin-bottom: 20px;  border: 1px solid #4c4c4d;  height: 60px;    line-height: 60px;     -webkit-appearance: none; background: url(https://bc-mortgage-broker.ca/wp-content/themes/FoundationPress-child/assets/images/down-arrow.png) !important; background-position: 95% center !important; background-repeat: no-repeat !important;background-size: 12px 10px !important; }
 .intwoholder{ position: relative; }
 .starting_mortgage_year{ padding-right: 50px; }
 .percent_sign{ position: absolute; right: 15px; line-height: 55px; }
 #interest_rate{ padding-right: 50px; }
 .mort_side_subhd h3{ text-transform: uppercase;  font-size: 16px;  color: #4c4c4d;  font-weight: 600;  } 
.calc_amt h3{ text-transform: uppercase;  font-size: 26px;  color: #010109;  font-weight: 600;  }
.martop{ margin-top: 20px; }

a#down_pmr {  cursor: pointer;  padding: 20px 5px; background: #008dbf; border-radius: 5px;  border: none; display: inline-block; font-size: 22px;  font-weight: 700; color: #fff; display: block; width: 100%; text-align: center;}
a#down_pmr:hover { background: #ffe400; color: #000;}
.invisible{ display: none; }
.custmpadd{ padding:0 15px; }
.mortgacal_p h4{ text-transform: uppercase; font-weight: 600; font-size: 19px; }
.mort_side h4{ text-transform: uppercase; font-weight: 600; font-size: 19px; }
.cal_content{ padding: 0 15px; margin-bottom: 45px; }
p.text-error{ color: red }
.label-success{ background-color: #5cb85c; margin: 0 0 30px 0!important; padding: 5px 15px !important; border-radius: 10px;  text-decoration: none; }
.label-success abbr{ text-decoration: none !important; border:none; color: #fff; }
.mort_side{ border:1px solid #f5f5f5;  border-radius: 6px; }
.panel-heading{ background: #f5f5f5; text-align: center;  }
.panel-heading h4{ padding: 25px 0 }
.panel-body{ padding: 25px; }
.mortgacal_p{ padding: 0 15px; }



</style>


<?php $wpblog_fetrdimg = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    if(empty($wpblog_fetrdimg)) { ?>
    
    
    
    
    <div class="featured-hero" style="background-image: url(https://beta.bc-mortgage-broker.ca/wp-content/uploads/2019/11/banner.jpg);"></div>
    
    <?php } else { ?>
     
     
        <div class="featured-hero" style="background:url(<?php echo $wpblog_fetrdimg; ?>);"></div>
     
    <?php }  ?>



  <div class="bodymain p-0"> 
          <div class="main-container innerpages">
            <div class="grid-x grid-margin-x">
              <div class="medium-12 cell custmpadd">
                <h1>Mortgage Calculator</h1>
              </div>
            </div>

<div class="cal_content">
            <?php 
if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
        the_content(); 
    endwhile; 
endif; 
?>
  </div>    
      

      <div class="grid-x grid-margin-x">

      <div class="medium-6 cell nomarginblog">
        
        <!-- Mortgage Details Input Section Start -->
        <div class="main-content blog_left mortgacal_p">
          <h4>Mortgage Details</h4>

          <div class="tab-content">
            <div id="mortgage_details" class="tab-pane fade in active mortgage_details">
              <div>
                <form id="mortgage_form" name="mortgage_form" action="https://bc-mortgage-broker.ca/calculate-mortgage.php" method="POST">
                  
                  <!-- Row 1 -->
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <!-- <div class="form-group">
                        <label for="mortgage-amount">Mortgage amount</label>
                        <input type="text" class="form-control mortgage-calculate" id="mortgage_amount" name="mortgage_amount" value="300000" onkeyup="calculate()">
                      </div> -->
                      
                      <label for="mortgage-amount">Mortgage amount</label>
                      <div class="form-group input-group dlr_fst">
                        <span class="input-group-addon dlrposition"><i class="fa fa-dollar"></i></span>
                        <input type="text" class="form-control calcM calcV rOffU" id="mortgage_amount" name="mortgage_amount" value="300000" onkeyup="calculate()">
                      </div>
                      <div id="mamt_err" class="invisible">
                        <p class="text-error"></p>
                      </div>
                      
                    </div>
                  </div>
                  
                  <!-- Row 2 -->
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <label for="starting-mortgage-term">Starting mortgage length</label>
                      
                      <div class="grid-x grid-margin-x">

                        <div class="medium-6 cell intwoholder">
                          <input type="text" class="form-control calcM calcV rOffU" id="starting_mortgage_year" name="starting_mortgage_year" placeholder="Years" value="25" data-format="year" data-min="1" data-max="30" maxlength="10" onkeyup="calculate()">
                          <span id="year_str" class="input-group-addon">years</span>
                        </div>

                        
                        <div class="medium-6 cell intwoholder">
                          <input type="text" class="form-control calcM calcV rOffU" id="starting_mortgage_month" name="starting_mortgage_month" placeholder="Month" value="0" data-format="month" data-min="0" data-max="11" maxlength="10" onkeyup="calculate()" >
                          <span id="month_str" class="input-group-addon">month</span>
                        </div>
                      </div>
                      <div id="mynm_err" class="invisible">
                        <p class="text-error"></p>
                      </div>
                      
                      
                    </div>
                    
                    <div class="col-md-6">  
                      <div class="form-group">
                        <label for="payment-frequency">Payment frequency</label>
                        <select class="form-control mortgage-calculate calcM" id="payment_frequency" name="payment_frequency" onChange="calculate()">
                          <option value="12" selected="selected">Monthly</option>
                          <option value="24">Semi-Monthly</option>
                          <option value="26">Bi-Weekly</option>
                          <option value="52">Weekly</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- Row 3 -->
                  <div class="grid-x grid-margin-x">
                    <div class="medium-6 cell">
                      <div class="form-group">
                        <label for="type-of-mortgage">Type of mortgage</label>
                        <select class="form-control mortgage-calculate calcM" id="type_of_mortgage" name="type_of_mortgage" onchange="calculate()">
                          <option value="0">Custom Rate</option>
                          <option value="1">6 month closed</option>
                          <option value="2">6 month open</option>
                          <option value="3">1 year open</option>
                          <option value="4">1 year closed</option>
                          <option value="5">2 year closed</option>
                          <option value="6">3 year closed</option>
                          <option value="7">4 year closed</option>
                          <option value="8">5 year closed</option>
                          <option value="9">7 year closed</option>
                          <option value="10">10 year closed</option>
                          <option value="11">5 year variable rate closed</option>
                          <option value="12">5 year variable rate open</option>
                          <option value="13">3 year ultimate variable rate</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="medium-6 cell">  
                      <!-- <div class="form-group">
                        <label for="interest-rate">Interest rate</label>
                        <input type="text" class="form-control mortgage-calculate" id="interest_rate" name="interest_rate" value="5.34" onkeyup="calculate()">
                      </div> -->
                      
                      <label for="interest-rate">Interest rate</label>
                      <div class="form-group input-group intwoholder">
                        <input type="text" class="form-control calcM calcFV rOffR" id="interest_rate" name="interest_rate" value="5.34" onkeyup="calculate()">
                        <span class="input-group-addon percent_sign"><i class="fa fa-percent"></i></span>
                      </div>

                      <div id="int_err" class="invisible">
                        <p class="text-error"></p>
                      </div>
                      
                    </div>
                  </div>

                  <div class="clearfix"></div>
                </form>
              </div>
            </div>  
          </div> 
        </div>
      </div>
        
        <div class="medium-6 cell">
          <div class="panel panel-default mort_side">
            <div class="panel-heading">
              <h4>Here's Your Mortgage Scenario</h4>
            </div>
            
            <div class="panel-body">
              
                <div class="mort_side_subhd martop">
                  <h3>Payments</h3> 
                </div>  
                
                <div class="calc_amt">
                  <h3><span id="display_payment"></span></h3>
                </div>
                
              
              
              
              
                <div class="mort_side_subhd">
                  <h3>Mortgage amount</h3>
                </div>  
                
                <div class="calc_amt">
                  <h3><span id="display_mortgage_amount"></span></h3>
                </div>
              
              
              
                <div class="mort_side_subhd">
                  <h3>New mortgage length</h3>
                </div>
                
                <div class="calc_amt">
                  <h3><span id="display_payment_term"></span></h3>
                  <span class="text-capitalize invisible" id="mortgage_term_booster"></span>  
                </div>
              
              
              
              
              <div class="cal_btn_holder">
                 <a id="down_pmr" download href="javascript:void(0);" type="button">Create personalized report</a> 
              </div>
              
            </div>
          </div>
        </div>
        <!-- Result Display Section End -->
</div>

        
      </div><!-- End of .row class -->    
    </div><!-- End of .container class --> 
    
  </div>

       </div>
<?php get_footer();
