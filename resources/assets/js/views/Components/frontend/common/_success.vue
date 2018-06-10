<template>
    <!--Message Success-->
    <div v-if="flash.success" class="alert alert-success fadeOut"><i class="fa fa-check-circle"></i> <a href="http://opencart.opencartworks.com/themes/so_supermarket/index.php?route=product/product&amp;product_id=101">Product A</a> added to <router-link to="/account/cartview">shopping cart</router-link>! <button type="button" class="fa fa-close close" data-dismiss="alert"></button></div>
</template>
