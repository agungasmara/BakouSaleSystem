<template>
    <div v-bind:class="{ active: isActive }" class="loading">
      <div class="banner">
        <div class="full-container">
            <div class="slider-content">
                <ul id="pager2" class="container">
                </ul>
                <!-- prev/next links -->

                <span class="prevControl sliderControl"> <i class="fa fa-angle-left fa-3x "></i></span> <span
                    class="nextControl sliderControl"> <i class="fa fa-angle-right fa-3x "></i></span>

                <div class="slider slider-v1"
                     data-cycle-swipe=true
                     data-cycle-prev=".prevControl"
                     data-cycle-next=".nextControl" data-cycle-loader="wait">
                    
                     <!-- <div class="slider-item slider-item-img1">
                        <img src="/assets/frontend/images/slider/slider0.jpg"
                                                                   class="img-responsive parallaximg sliderImg" alt="img">
                    </div> -->

                    <!-- <div v-for="post of posts" :class="thClassValue(post.banner_image_id)">
                        <div class="sliderInfo">
                            <div class="container">
                                <div class="col-lg-12 col-md-12 col-sm-12 sliderTextFull ">
                                    <div class="inner text-center">
                                        <div class="topAnima animated">
                                            <h1 class="uppercase xlarge">{{post.title}}</h1>

                                            <h3 class="hidden-xs"> Free Standard Shipping on Orders Over $100 </h3>
                                        </div>
                                        <a class="btn btn-danger btn-lg bottomAnima animated opacity0">SHOP NOW ON TSHOP
                                        <span class="arrowUnicode">►</span></a></div>
                                </div>
                            </div>
                        </div>
                        <img src="/assets/frontend/images/slider/slider1.jpg" class="img-responsive parallaximg sliderImg" alt="img">
                    </div> -->
                    <!--/.slider-item-->

                    
                        <div class="sliderInfo">
                            <div class="container">
                                <div class="col-lg-12 col-md-12 col-sm-12 sliderTextFull  ">
                                    <div class="inner dark maxwidth500 text-center animated topAnima">
                                        <div class=" ">
                                            <h1 class="uppercase xlarge"> CUSTOM HTML BLOCK</h1>

                                            <h3 class="hidden-xs"> Custom Slides to Your Slider </h3>
                                        </div>
                                        <a class="btn btn-danger btn-lg">SHOP NOW ON TSHOP <span
                                                class="arrowUnicode">►</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="/assets/frontend/images/slider/slider3.jpg" class="img-responsive parallaximg sliderImg" alt="img">
                    </div>
                    <!--/.slider-item-->

                    <!-- <div class="slider-item slider-item-img3 ">
                        <div class="sliderInfo">
                            <div class="container">
                                <div class="col-lg-5 col-md-4 col-sm-6 col-xs-8   pull-left sliderText white hidden-xs">
                                    <div class="inner">
                                        <h1>TSHOP JEANS</h1>

                                        <h3 class="price "> Free Shipping on $100</h3>

                                        <p class="hidden-xs">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                                            diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
                                            volutpat. </p>
                                        <a href="category.html" class="btn btn-primary">Shop Now<span class="arrowUnicode">►</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="/assets/frontend/images/slider/slider4.jpg" class="img-responsive parallaximg sliderImg" alt="img"></div> -->
                    <!--/.slider-item-->

                    <!-- <div class="slider-item slider-item-img3">
                        <div class="sliderInfo">
                            <div class="container">
                                <div class="col-lg-5 col-md-6 col-sm-5 col-xs-5 pull-left sliderText blankstyle transformRight">
                                    <div class="inner text-right"><img src="/assets/frontend/images/slider/color.png" class="img-responsive"
                                                                       alt="img"></div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-7   pull-left sliderText blankstyle color-white">
                                    <div class="inner">
                                        <h1 class="uppercase topAnima animated ">10+ Amazing Color Theme</h1>

                                        <p class="bot tomAnima animated opacity0 hidden-xs"> Fully responsive bootstrap
                                            Ecommerce Template. Available in 10+ color schemes and easy to set. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="/assets/frontend/images/slider/6.jpg" class="img-responsive parallaximg sliderImg" alt="img"></div> -->
                </div>
                <!--/.slider slider-v1-->
            </div>
            <!--/.slider-content-->
        </div>
        <!--/.full-container-->
    </div>
    <!--/.banner style1-->
    </div>
</template>

<script type="text/javascript">
    import axios from 'axios'
    import Flash from '../../../../helper/flash'
    import {post} from '../../../../helper/api'

    export default {
        data() {
            return {
                isActive: true,
                credential: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                flash: Flash.state,
                error: Flash.state,
                error: {},
                posts: [],
                isProcessing: false
            }
        },
        created() {
            axios.get(`/api/slide`)
            .then(response => {
              this.posts = response.data['data']
              this.isActive = !this.isActive
            })
            .catch(e => {
              this.errors.push(e)
            })
        },
        ready() {
            this.credential.name    = credential.name;
            this.credential.email    = credential.email;
            this.credential.password = credential.password;
            this.credential.password_confirmation = credential.password_confirmation;
            this.register();
        },
        methods: {
            thClassValue: function (id) {
                var value = ['slider-item slider-item-img'+id]
                // if (this.orderKey === id) {
                //   value.push('active')
                // }
                return value.join(' ')
            },
            register() {
                this.isProcessing = true
                this.error = {}
                post('/api/register', this.credential)
                    .then((res) => {
                    if(res.data.registered) {
                    Flash.setSuccess('Congratulations! You have now successfully registered.')
                    this.$router.push('/login')
                }
                this.isProcessing = false
            })
            .catch((err) => {
                    if(err.response.status === 422) {
                    this.error = err.response.data
                }
                this.isProcessing = false
            })
            }
        }
    }
</script>
