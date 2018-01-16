<template>
 <div class="navbar-top">
            
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                        <div class="pull-left ">
                            <ul class="userMenu ">
                                <li><a href="#"> <span class="hidden-xs">Helps</span><i
                                        class="glyphicon glyphicon-info-sign hide visible-xs "></i> </a></li>
                                <li class="phone-number">
                                    <a href="callto:+12025550151">
                                        <span> <i class="glyphicon glyphicon-phone-alt "></i></span>
                                        <span class="hidden-xs" style="margin-left:5px"> +1-202-555-0151 </span> </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 no-margin no-padding">
                       
                        <div class="pull-right">
                            <ul class="userMenu">
                                <li class="dropdown">
                                  <a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                                    <span class="hidden-xs hidden-sm hidden-md">My Account</span> 
                                    <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a href="<?php echo $account; ?>">My Account</a></li>
                                    <li><a href="<?php echo $order; ?>">Order History</a></li>
                                    <li><a href="<?php echo $transaction; ?>">Transaction</a></li>
                                    <li><a href="<?php echo $download; ?>">Downloads</a></li>
                                    <li><a href="<?php echo $logout; ?>">Logout</a></li>
                                    <li><router-link to="/account/register">Register</router-link></li>
                                    <li><router-link to="/account/login">Login</router-link></li>
                                  </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>    
</template>