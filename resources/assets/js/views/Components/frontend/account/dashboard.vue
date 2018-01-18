<template>
    <div>
      	<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="account-1.html">Authentication</a></li>
                <li class="active"> My account</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7">
            <h1 class="section-title-inner"><span><i class="fa fa-unlock-alt"></i> My account </span></h1>

            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    <p> Your account has been created. </p>

                    <h2 class="block-title-2"><span>Welcome to your account. Here you can manage all of your personal information and orders.</span>
                    </h2>
                    <ul class="myAccountList row ">
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail"><a title="Orders" href="order-list.html"><i
                                    class="fa fa-calendar"></i> Order history </a></div>
                        </li>
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail"><a title="My addresses" href="my-address.html"><i
                                    class="fa fa-map-marker"></i> My addresses</a></div>
                        </li>
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
<<<<<<< HEAD
                            <div class="thumbnail">
                                 <router-link v-bind:to="'/account/addressform'" title="Add address">
                                    <i class="fa fa-edit"> </i> Add address
                                </router-link>
                            </div>
=======
                            <div class="thumbnail"><a title="Add  address" href="add-address.html"> <i
                                    class="fa fa-edit"> </i> Add address</a></div>
>>>>>>> 50998f9635f671539e20de36c9f66407c2ecbfc1
                        </li>
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail"><a title="Personal information"
                                                      href="user-information.html"><i class="fa fa-cog"></i>
                                Personal information</a></div>
                        </li>
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail"><a title="My wishlists" href="wishlist.html"><i
                                    class="fa fa-heart"></i> My wishlists </a></div>
                        </li>
                    </ul>
                    <div class="clear clearfix"></div>
                </div>
            </div>
            <!--/row end-->

        </div>
        <div class="col-lg-3 col-md-3 col-sm-5"></div>
    </div>
    <!--/row-->

    <div style="clear:both"></div>
</div>
<!-- /wrapper -->
<div class="gap"></div>
    </div>
</template>